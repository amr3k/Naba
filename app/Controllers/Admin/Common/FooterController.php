<?php

namespace app\Controllers\Admin\Common;

use System\Controller;

class FooterController extends Controller
{

    public function index()
    {
        return $this->view->render('admin/common/footer');
    }

}
