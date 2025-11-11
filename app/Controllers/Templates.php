<?php namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\TemplatesModel;
use App\Models\PagesModel;

class Templates extends BaseController
{
    protected $moduleurl = 'templates';
    
    public function index() {        
        $data = [];
        $model = new TemplatesModel();
        $data['data'] = $model->orderBy('id','desc')->findAll();

        return view('admin/'.$this->moduleurl.'/manage', $data);
    }
    
    public function create() {
        return view('admin/'.$this->moduleurl.'/form');
    }
    
    public function edit($id = null) {
        $data = [];
        $model = new TemplatesModel();
        $data['data'] = $model->find($id);

        return view('admin/'.$this->moduleurl.'/form', $data);
    }
    
    public function save($id = null) {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => 'required|min_length[3]'
            ];
            
            if ($this->validate($rules)) {
                $data = $this->request->getVar();
                if (is_numeric($id) && $id != 0) {
                    $data['id'] = $id;
                }
                
                $data['file'] = url_title($data['name'], '-', TRUE);
                
                //if (write_file(APPPATH.'views/'.$data['file'].'.php', '')){
                    $model = new TemplatesModel();
                    $model->save($data);

                    return redirect($this->moduleurl);
                //}
            }
            else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/'.$this->moduleurl.'/form', $data);
    }
    
    public function delete($id) {
        $data = [];
        $model = new TemplatesModel();
        $data['data'] = $model->find($id);
        
        return view('admin/'.$this->moduleurl.'/delete', $data);
    }

    public function delete_sure($id) {
        $model = new TemplatesModel();
        $data = $model->find($id);
        
        $modelPages = new PagesModel();
        $data = array();

        if($modelPages->where('template', $id)->countAllResults() > 0){
            session()->setFlashdata('error','Er is nog een pagina die deze template gebruikt!');
        }else{
            if (!is_null($data)) {
                $model->delete($id);
                session()->setFlashdata('success','Succesvol verwijderd');
            }
        }
        return redirect($this->moduleurl);
    }
}