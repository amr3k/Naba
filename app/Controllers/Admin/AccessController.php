<?php

namespace app\Controllers\Admin;

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
        $loginModel   = $this->load->model('Login');
        $ignored      = ['/admin/login', '/admin/login/submit', '/404'];
        $currentRoute = $this->app->route->getCurrentRoute();
        if (($isNotLogged  = !$loginModel->isLogged()) && !in_array($currentRoute, $ignored)) {
            return $this->url->redirect('/admin/login');
        }
        if ($isNotLogged) {
            return FALSE;
        }
        $user = $loginModel->user();
        $ugm  = $this->load->model('UsersGroups');
        $ug   = $ugm->get($user->ugid);
        if (!in_array($currentRoute, $ug->page)) {
            return $this->url->redirect('/404');
        }
    }

}
