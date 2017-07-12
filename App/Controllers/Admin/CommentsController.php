<?php

namespace App\Controllers\Admin;

use System\Controller;

class CommentsController extends Controller
{

    /**
     * Display Posts list
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('Comments');
        $data['comments'] = $this->load->model('Comments')->all();
        return $this->adminLayout->render($this->view->render('admin/comments/list', $data));
    }

    /**
     * Deleting posts
     *
     * @param int $id
     * @return string / JSON
     */
    public function delete($id)
    {
        $this->load->model('Comments')->delete($id);
        $json['redirect']     = $this->url->link('/admin/comments/');
        $json['redirectHome'] = $this->request->referer();
        return $this->json($json);
    }

}
