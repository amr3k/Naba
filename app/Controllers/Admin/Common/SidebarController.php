<?php

namespace app\Controllers\Admin\Common;

use System\Controller;

class SidebarController extends Controller
{

    public function index()
    {
        $data['admin'] = $this->load->model('Login')->user()->id;
        return $this->view->render('admin/common/sidebar', $data);
    }

}
