<?php
namespace App\Controllers\Admin;

use System\Controller;

class LoginController extends Controller{
    public function index()
    {
//       echo 'Hello from LoginController';
//        pre($this->route->getProperRoute());
       return $this->view->render('admin/users/login');
    }
}
