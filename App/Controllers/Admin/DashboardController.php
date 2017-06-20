<?php
namespace App\Controllers\Admin;

use System\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        pre($this->session->all());
        pre($this->cookie->all());
        return $this->view->render('admin/main/dashboard');
    }
    
    public function submit()
    {
        
    }
}















