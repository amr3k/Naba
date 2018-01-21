<?php

namespace app\Controllers\Blog;

use System\Controller;

class SiteStatusController extends Controller
{

    public function index()
    {
        $status = $this->load->model('Settings')->get(3)->v;
        $route  = $this->route->getCurrentRoute();
        if ($status === 'off' && ($route !== '/contact' && $route !== '/about')) {
            return $this->url->redirect('/error');
        }
    }

}
