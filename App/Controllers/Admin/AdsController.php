<?php

namespace App\Controllers\Admin;

use System\Controller;

class AdsController extends Controller
{

    /**
     * Display Ads list
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('Ads');
        $data['ads'] = $this->load->model('Ads')->all();
        return $this->adminLayout->render($this->view->render('admin/ads/list', $data));
    }

    /**
     * Add a new Ads
     *
     * @return string
     */
    public function add()
    {
        $this->html->setTitle('Add a new advertisement');
        $data['action']     = $this->url->link('/admin/ads/submit');
        $data['date']       = date('Y-m-d');
        $data['categories'] = $this->load->model('Categories')->all();
        $data['pages']      = $this->pages();
        $view               = $this->app->view->render('admin/ads/form', $data);
        return $this->adminLayout->render($view);
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
            $adModel          = $this->load->model('Ads');
            $adModel->create();
            $json['success']  = 'Your ad was Created Successfully';
            $json['redirect'] = $this->url->link('/admin/ads');
        } else {
            $json['errors'] = $this->validator->flatMsg();
        }
        return $this->json($json);
    }

    /**
     * Edit Ads info
     *
     * @param int $id
     * @return string
     */
    public function edit($id)
    {
        $adModel = $this->load->model('Ads');
        if (!$adModel->exists($id)) {
            return $this->url->redirect('/404');
        }
        // Getting Ads data
        $ad             = $adModel->get($id);
        $data['action'] = $this->url->link('/admin/ads/save') . '/' . $id;
        $data['link']   = $ad->link;
        $data['start']  = date('Y-m-d', $ad->start);
        $data['end']    = date('Y-m-d', $ad->end);
        $data['pages']  = $this->pages();
        $data['adPage'] = $ad->page;
        $data['status'] = $ad->status;
        $data['img']    = $this->url->link('Public/uploads/img/ads/') . '/' . $ad->img;
        $this->html->setTitle('Edit: ' . $ad->link);
        $view           = $this->app->view->render('admin/ads/form-edit', $data);
        return $this->adminLayout->render($view);
    }

    /**
     * Submit form for editing an existing ads
     *
     * @param int $id
     * @return string / JSON
     */
    public function save($id)
    {
        if ($this->isValid($id)) {
            $adModel          = $this->load->model('Ads');
            $adModel->update($id);
            $json['success']  = 'Your ad has been successfully updated';
            $json['redirect'] = $this->url->link('/admin/ads');
        } else {
            $json['errors'] = $this->validator->flatMsg();
        }
        return $this->json($json);
    }

    /**
     * Deleting ads
     *
     * @param int $id
     * @return string / JSON
     */
    public function delete($id)
    {
        $adModel          = $this->load->model('Ads');
        $adModel->delete($id);
        $json['redirect'] = $this->url->link('/admin/ads');
        return $this->json($json);
    }

    /**
     * Validate form
     *
     * @return bool
     */
    private function isValid($id = NULL)
    {
        $this->validator->required('link', 'Please submit the link');
        $this->validator->required('start', 'Please submit the start date');
        $this->validator->required('end', 'Please submit the end date');
        $this->validator->required('page', 'Please choose the page');
        if (is_null($id)) {
            // If the $id is null,
            // This means that image is required for creating a new ad
            $this->validator->requiredFile('img')->img('img');
        } else {
            // This means that the admin either changed the image or not
            // but it's no neccesserely required
            if ($this->request->file('img')->exists()) {
                $this->validator->img('img');
            }
        }
        return $this->validator->pass();
    }

    /**
     * Accessible pages
     *
     * @return array
     */
    private function pages()
    {
        $permissions = [];
        foreach ($this->app->route->routes() as $route) {
            if (strpos($route['url'], '/admin') !== 0) {
                $permissions[] = $route['url'];
            }
        }
        return $permissions;
    }

}
