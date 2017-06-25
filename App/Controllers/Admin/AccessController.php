<?php

namespace App\Controllers\Admin;

use System\Controller;

class AccessController extends Controller
{

    /**
     * Check user permissions
     *
     * @return void
     */
    public function index()
    {
//        $loginModel  = $this->load->model('Login');
//        $ignored     = ['/admin/login', '/admin/login/submit', '/404'];
//        $currentPage = $this->app->request->url();
//        if (!$loginModel->isLogged() && !in_array($currentPage, $ignored)) {
//            return $this->url->redirect('/admin/login');
//        }
//        $user = $loginModel->user();
//        $ugm  = $this->load->model('UsersGroups');
//        $ug   = $ugm->get($user->ugid);
//        if (in_array($currentPage, $ug->page)) {
//            return $this->url->redirect('/404');
//        }
    }

}
