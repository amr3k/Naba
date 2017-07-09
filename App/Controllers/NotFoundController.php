<?php

namespace App\Controllers;

use System\Controller;

class NotFoundController extends Controller
{

    public function index()
    {
        $this->blogLayout->disable('sidebar');
        $data['referer'] = $this->request->referer() ?: $this->url->link('/');
        $view            = $this->view->render('not-found', $data);
        return $this->blogLayout->render($view);
    }

}
