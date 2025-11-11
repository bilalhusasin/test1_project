<?php namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\ContentModel;

class Content extends BaseController
{
    protected $moduleurl = 'content';
    
    public function index($id) {
        $data = [];
        $model = new ContentModel();
        $data['page_id'] = $id;
        $data['data'] = $model->where('page_id', $id)->findAll();

        return view('admin/'.$this->moduleurl.'/manage', $data);
    }
    
    public function create($id) {        
        $data['page_id'] = $id;
        $data['type'] = 'create';
        
        return view('admin/'.$this->moduleurl.'/form', $data);
    }
    
    public function save_new($page_id) {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => 'required|min_length[3]'
            ];
            
            if ($this->validate($rules)) {
                $data = $this->request->getVar();
                
                $model = new ContentModel();
                $model->save($data);
                
                return redirect()->to('/adminpanel/content/'.$data['page_id']);
            }
            else {
                $data['validation'] = $this->validator;
            }
        }
        
        $data['type'] = 'create';
        $data['page_id'] = $page_id;
        
        return view('admin/'.$this->moduleurl.'/form', $data);
    }
    
    public function edit($page_id, $id = null) {
        $data = [];
        $model = new ContentModel();
        $data['data'] = $model->find($id);     
        $data['page_id'] = $page_id;
        $data['type'] = 'edit';

        return view('admin/'.$this->moduleurl.'/form', $data);
    }
    
    public function save_edit($page_id, $id) {
        $model = new ContentModel();
        
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'content' => 'required|min_length[3]'
            ];
            
            if ($this->validate($rules)) {
                $data = $this->request->getVar();
                
                if (is_numeric($id) && $id != 0) {
                    $data['id'] = $id;
                }
                
                $model->save($data);
                
                return redirect()->to('/adminpanel/content/'.$data['page_id']);
            }
            else {
                $data['validation'] = $this->validator;
            }
        }
        
        $data['data'] = $model->find($id);
        $data['type'] = 'edit';
        $data['page_id'] = $page_id;
        
        return view('admin/'.$this->moduleurl.'/form', $data);
    }
    
    public function delete($page_id, $id) {        
        $data = [];
        $model = new ContentModel();
        $data['data'] = $model->find($id);
        $data['page_id'] = $page_id;
        
        return view('admin/'.$this->moduleurl.'/delete', $data);
    }

    public function delete_sure($page_id, $id) {        
        $model = new ContentModel();
        $data = $model->find($id);
        
        if (!is_null($data)) {
            $model->delete($id);
            session()->setFlashdata('success','Succesvol verwijderd');
        }
        
        return redirect()->to('/adminpanel/content/'.$page_id);
    }
}