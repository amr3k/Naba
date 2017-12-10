<?php

namespace App\Controllers\Admin;

use System\Controller;

class SettingsController extends Controller
{

    /**
     * Display Settings form
     *
     * @return mixed
     */
    public function index()
    {
        $current_admin = $this->load->model('Login')->user();
        if ($current_admin->id != 1) {
            return $this->url->redirect('/404');
        }
        $this->html->setTitle('Settings');
        $data['action'] = $this->url->link('admin/settings/submit');
        $data['info']   = $this->load->model('Settings')->all();
        $data['img']    = $this->url->link('Public/uploads/img') . '/';
        return $this->adminLayout->render($this->view->render('admin/settings/page', $data));
    }

    /**
     * Submit form for creating a new Ads
     *
     * @param string $name
     * @return string / JSON
     */
    public function submit()
    {
        $current_admin = $this->load->model('Login')->user();
        if ($current_admin->id != 1) {
            return $this->url->redirect('/404');
        }
        if ($this->isValid()) {
            $settingsModel    = $this->load->model('Settings');
            $settingsModel->update();
            $json['success']  = 'Your settings was successfully updated';
            $json['redirect'] = $this->url->link('/admin/settings');
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
        $this->validator->required('name')->valString('name')->min('name', 1)->max('name', 255);
        $this->validator->required('email')->email('email')->min('email', 6)->max('email', 32);
        $this->validator->required('msg')->min('msg', 10)->max('msg', 255);
        $this->validator->required('contact')->min('msg', 12)->max('contact', 10000);
        $this->validator->required('about')->min('msg', 12)->max('about', 10000);
        $this->validator->required('facebook')->url('facebook')->max('facebook', 255);
        $this->validator->required('twitter')->url('twitter')->max('twitter', 255);
        $this->validator->required('instagram')->url('instagram')->max('instagram', 255);
        $this->validator->required('FBappID')->valNumber('FBappID')->min('FBappID', 10)->max('FBappID', 20);
        if ($this->request->file('icon')->exists()) {
            $this->validator->img('icon');
        }
        return $this->validator->pass();
    }

}
