<?php
namespace App\Controllers;

use System\Controller;

class HomeController extends Controller
{
    public function index()
    {
//        $q  = $this->app->db->where('id = ? AND uid = ?', 1, 1)->fetch('u');
//        pre($q);
        $userModel  = $this->load->model('Users');
        $uid    =   $userModel->get(1);
        pre($uid);
        $this->html->setTitle('Home');
        $data['title']  = $this->html->getTitle();
        return $this->view->render('home', $data);
    }
}















