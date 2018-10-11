<?php

namespace app\Controllers\Blog\Common;

use System\Controller;

class SidebarController extends Controller
{

    public function index()
    {
        $data['categories'] = $this->load->model('Categories')->getEnabledCategoriesWithNumberOfTotalPosts();
        $data['posts']      = $this->load->model('Posts')->getPostsByViews();
        $data['ads']        = $this->load->model('Ads')->enabled();
        $data['status']     = $this->load->model('Settings')->all()[2]->v;
        return $this->view->render('blog/common/sidebar', $data);
    }

}
