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
        $this->html->setTitle('Settings');
        $data['action'] = $this->url->link('admin/settings/submit');
        $data['site']   = $this->load->model('Settings')->get(1);
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
        if ($this->isValid()) {
            $adModel          = $this->load->model('Settings');
            $adModel->update();
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
        $this->validator->required('name')->min('name', 1)->max('name', 255);
        $this->validator->required('email')->email('email')->min('email', 6)->max('email', 32);
        $this->validator->required('msg')->max('msg', 255);
        return $this->validator->pass();
    }

}
