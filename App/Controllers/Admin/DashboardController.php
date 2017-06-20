<?php
namespace App\Controllers\Admin;

use System\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->view->render('admin/main/dashboard');
    }
    
    public function submit()
    {
//        return json_encode($_FILES['img']);
//        $this->validator->required('email')->email('email')->unique('email', ['u', 'email']);
//        $this->validator->required('pass', 'Please type your password')->max('pass', 8);
//        $this->validator->match('pass', 're-pass');
//        $file    = $this->request->file('img');
//        if ($file->isImg()){
//            $file->move($this->file->to('Public/uploads/img/'));
//            return json_encode('File Uploaded');
//        }
    }
}















