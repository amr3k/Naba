<?php
namespace App\Controllers;

use System\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->html->setTitle('Home');
        $data['title']  = $this->html->getTitle();
        return $this->view->render('home', $data);
    }
}















