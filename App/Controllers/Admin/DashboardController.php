<?php

namespace App\Controllers\Admin;

use System\Controller;

class DashboardController extends Controller
{

    /**
     * Display Dashboard
     *
     * @return mixed
     */
    public function index()
    {
        $data['avatar'] = avatar('default/1.jpg');
        $view           = $this->view->render('admin/main/dashboard', $data);
        return $this->adminLayout->render($view);
    }

}
