<?php

namespace App\Controllers\Admin;

use System\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return $this->view->render('admin/main/dashboard');
    }

}
