<?php
namespace App\Controllers\Admin;

use System\Controller;

class AccessController extends Controller{
    
    /**
     * Check user permissions 
     * 
     * @return void
     */
    public function index()
    {
        $loginModel   = $this->load->model('Login');
        if (! $loginModel->isLogged()){
            return $this->url->redirect('/admin/login');
        }
    }
}
