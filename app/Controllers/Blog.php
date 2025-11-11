<?php

namespace App\Controllers;

use App\Models\BlogModel;
use App\Models\ProductsModel;

class Blog extends BaseController
{
    protected $blogModel;

    public function __construct()
    {
        $this->blogModel = new BlogModel();
    }

    // Frontend Blog Overzicht
    public function index()
    {
        $data['blogs'] = $this->blogModel->orderBy('created_at', 'DESC')->findAll();

        $data['page_title'] = 'Blog';
        $data['page_description'] = 'Overzicht van onze nieuwste blogartikelen.';

        return view('blog/index', $data);
    }

    // Frontend Blog Detail
    public function detail(string $slug)
    {
        $blog = $this->blogModel->findBySlug($slug);

        if (!$blog) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['blog'] = $blog;
        $data['page_title'] = $blog['title'];
        $data['page_description'] = substr(strip_tags($blog['content']), 0, 150) . '...';

        return view('blog/detail', $data);
    }

    // Admin Blog Overzicht (vereist authenticatie - wordt nu afgehandeld door de route filter)
    public function admin()
    {
        $data['blogs'] = $this->blogModel->orderBy('created_at', 'DESC')->findAll();
        
        return view('admin/blog/index', $data);
    }

    // Admin Nieuw Blogartikel Formulier (vereist authenticatie - wordt nu afgehandeld door de route filter)
    public function create()
    {
        $model = new ProductsModel(); // Of CategoryModel als je dat hebt
        $data['cats'] = $model->where('parent', -1)->findAll();

        return view('admin/blog/create', $data);
    }

    public function save()
    {
        $data = $this->request->getPost();
        $slug = url_title($data['title'], '-', true);
        $data['slug'] = $slug;

        $imageFile = $this->request->getFile('image');

        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(ROOTPATH . 'public/uploads', $newName);
            $data['image'] = $newName;
        }

        if ($this->blogModel->save($data)) {
            return redirect()->to(route_to('adminBlog'))->with('success', 'Blogartikel succesvol aangemaakt.');
        } else {
            return view('adminpanel/blog/create', ['validation' => $this->blogModel->errors()]);
        }
    }

    // Admin Blogartikel Bewerken Formulier (vereist authenticatie - wordt nu afgehandeld door de route filter)
    public function edit(int $id)
    {
        $blog = $this->blogModel->find($id);
        if (!$blog) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $model = new ProductsModel();
        $cats = $model->where('parent', -1)->findAll();

        return view('admin/blog/edit', [
            'blog' => $blog,
            'cats' => $cats
        ]);
    }

    public function update(int $id)
    {
        $data = $this->request->getPost();
        $blog = $this->blogModel->find($id);
        if (!$blog) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $slug = url_title($data['title'], '-', true);
        if ($slug !== $blog['slug']) {
            $data['slug'] = $slug;
        }

        $imageFile = $this->request->getFile('image');

        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            // Verwijder de oude afbeelding als deze bestaat
            if (!empty($blog['image']) && file_exists(ROOTPATH . 'public/uploads/' . $blog['image'])) {
                unlink(ROOTPATH . 'public/uploads/' . $blog['image']);
            }
            $newName = $imageFile->getRandomName();
            $imageFile->move(ROOTPATH . 'public/uploads', $newName);
            $data['image'] = $newName;
        } elseif ($this->request->getPost('remove_image')) { // Optioneel: afbeelding verwijderen
            if (!empty($blog['image']) && file_exists(ROOTPATH . 'public/uploads/' . $blog['image'])) {
                unlink(ROOTPATH . 'public/uploads/' . $blog['image']);
            }
            $data['image'] = null;
        }

        if ($this->blogModel->update($id, $data)) {
            return redirect()->to(route_to('adminBlog'))->with('success', 'Blogartikel succesvol bijgewerkt.');
        } else {
            return view('adminpanel/blog/edit', ['blog' => $blog, 'validation' => $this->blogModel->errors()]);
        }
    }

    // Admin Blogartikel Verwijderen Bevestiging (vereist authenticatie - wordt nu afgehandeld door de route filter)
    public function delete(int $id)
    {
        $blog = $this->blogModel->find($id);
        if (!$blog) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['blog'] = $blog;
        return view('admin/blog/delete', $data);
    }

    // Admin Blogartikel Definitief Verwijderen (vereist authenticatie - wordt nu afgehandeld door de route filter)
    public function delete_sure(int $id)
    {
        if ($this->blogModel->delete($id)) {
            return redirect()->to(route_to('adminBlog'))->with('success', 'Blogartikel succesvol verwijderd.');
        } else {
            return redirect()->to(route_to('adminBlog'))->with('error', 'Er is een fout opgetreden bij het verwijderen van het blogartikel.');
        }
    }
}