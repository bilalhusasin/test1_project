<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    public function login()
    {
        return view('admin/users/login');
    }
    
    public function login_submit()
    {
        $data = [];
        
        $data['error'] = '';
        
        $rules = [
            'email'    => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
        }else{
            $model = new UsersModel();
            $user = $model->where('email', $this->request->getVar('email'))->first();
            
            if(isset($user['pass'])){
                if(password_verify($this->request->getVar('password'), $user['pass'])){
                    session()->set('loggedIn', TRUE);
                    return redirect('products');
                }else{
                    $data['error'] = 'U heeft een verkeerd wachtwoord ingevoerd.';
                }
            }else{
                $data['error'] = 'Dit e-mailadres is niet bekend bij ons.';
            }
        }
        
        $data['email'] = $this->request->getVar('email');
        $data['password'] = $this->request->getVar('password');
        
        return view('admin/users/login', $data);
    }

    public function logout() {
        session()->destroy();
        return redirect('login');
    }
}
