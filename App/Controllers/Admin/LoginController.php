<?php
namespace App\Controllers\Admin;

use System\Controller;

class LoginController extends Controller{
    
    /**
     * Display login form
     * 
     * @return mixed
     */
    public function index()
    {
        pre($this->session->all());
        pre($this->cookie->all());
        $loginModel   = $this->load->model('Login');
        if ($loginModel->isLogged()){
//            return $this->url->redirect('/admin');
        }
        $data['errors'] = $this->errors;
        return $this->view->render('admin/users/login', $data);
    }
    
    /**
     * Submit login form
     * 
     * @return void
     */
    public function submit()
    {
        if ($this->isValid()){
            $loginModel   = $this->load->model('Login');
            $logged_in_user   =   $loginModel->user();
            if ($this->request->post('remember')){
                // Save login info in cookie
                $this->cookie->set('login', $logged_in_user->code);
            } else {
                // Save login info in session
                $this->session->set('login', $logged_in_user->code);
            }
            $json   =   [];
            $json['success']    =   'Welcome back ' . $logged_in_user->name;
            $json['redirect']   =   $this->url->link('/admin');
            return $this->json($json);
        } else {
            $json = [];
            $json['errors'] = implode('<br>', $this->errors);
            return $this->json($json);
        }
    }
    
    /**
     * Validate login form
     * 
     * @return bool
     */
    private function isValid()
    {
        $email  = $this->request->post('email');
        $pass   = $this->request->post('pass');
        if (! $email){
            $this->errors[] =   'Please insert your email address';
        } elseif(! filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->errors[] =   'Please insert a valid email address';
        }
        if (! $pass){
            $this->errors[] =   'Please insert your password';
        }
        if (! $this->errors){
            $loginModel   = $this->load->model('Login');
            if (! $loginModel->isValidLogin($email, $pass)){
                $this->errors[] =   'Invalid email or password';
            }
        }
        return empty($this->errors);
    }
}



