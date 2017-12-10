<?php

namespace App\Controllers\Blog\Common;

use System\Controller;

class HeaderController extends Controller
{

    public function index()
    {
        $settings           = $this->load->model('Settings')->all();
        $data['icon']       = $this->url->link('Public/uploads/img/') . '/' . $settings[7]->v;
        $data['baseUrl']    = $this->request->baseUrl();
        $data['title']      = $this->html->getTitle();
        $data['site_name']  = $settings[0]->v;
        $data['FBappID']    = $settings[10]->v;
        $loginModel         = $this->load->model('Login');
        $data['user']       = $loginModel->isLogged() ? $loginModel->user() : null;
        $data['categories'] = $this->load->model('Categories')->getEnabledCategoriesWithNumberOfTotalPosts();
        return $this->view->render('blog/common/header', $data)->getOutput();
    }

}
