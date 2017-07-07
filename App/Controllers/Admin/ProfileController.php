<?php

namespace App\Controllers\Admin;

use System\Controller;

class ProfileController extends Controller
{

    /**
     * Display Users list
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('Profile');
        $data['user']   = $this->load->model('Login')->user();
        $data['action'] = $this->url->link('admin/profile/submit');
        $data['img']    = $this->url->link('Public/uploads/img/avatar/') . '/' . $data['user']->img;
        return $this->adminLayout->render($this->view->render('admin/profile/page', $data));
    }

    /**
     * Submit form for creating a new Users
     *
     * @param string $name
     * @return string / JSON
     */
    public function submit()
    {
        if ($this->isValid()) {
            $profileModel     = $this->load->model('Profile');
            $profileModel->update();
            $json['success']  = 'Your profile hes been successfully updated';
            $json['redirect'] = $this->url->link('/admin/profile');
        } else {
            $json['errors'] = $this->validator->flatMsg();
        }
        return $this->json($json);
    }

    /**
     * Validate form
     *
     * @return bool
     */
    private function isValid()
    {
        $this->validator->required('name')->min('name', 3)->max('name', 255);
        $this->validator->required('email')->email('email')->max('email', 255);
        if ($this->request->file('img')->exists()) {
            $this->validator->img('img');
        }
        if ($this->request->post('pass') || $this->request->post('old_pass')) {
            if (!$this->load->model('Profile')->password()) {
                $this->validator->msg('Wrong password');
            } else {
                $this->validator->match('pass', 're-pass')->min('pass', 8)->max('pass', 128);
            }
        }
        return $this->validator->pass();
    }

}
