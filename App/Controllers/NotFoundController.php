<?php

namespace App\Controllers;

use System\Controller;

class NotFoundController extends Controller
{

    public function index()
    {
        $this->blogLayout->disable('sidebar');
        $this->html->setTitle('404');
        $data['referer'] = $this->request->referer() ?: $this->url->link('/');
        $view            = $this->view->render('not-found', $data);
        return $this->blogLayout->render($view);
    }

}
