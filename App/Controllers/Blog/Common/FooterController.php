<?php

namespace App\Controllers\Blog\Common;

use System\Controller;

class FooterController extends Controller
{

    public function index()
    {
        $data['user']  = $this->load->model('Login')->user();
        $data['title'] = $this->load->model('Settings')->get(1)->name;

        return $this->view->render('blog/common/footer', $data);
    }

}
