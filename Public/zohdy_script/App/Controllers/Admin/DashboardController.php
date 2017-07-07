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
        $json['name'] = $this->request->post('fullname');
        return $this->json($json);
        $this->validator->required('email')->email('email')->unique('email', ['users' , 'email']);
        $this->validator->required('password');
        $this->validator->match('password', 'confirm_password');

        $file = $this->request->file('image'); // UploadedFile Object

        if ($file->isImage()) {
            $file->moveTo($this->file->to('public/images'));
        }
    }
}