<?php

namespace App\Controllers\Blog;

use System\Controller;

class ContactController extends Controller
{

    /**
     * Displaying contact form
     *
     * @return mixed
     */
    public function index()
    {
        $this->blogLayout->title('Contact');
        $data['site_email'] = $this->load->model('Settings')->get(1)->email;
        $data['ads']        = $this->load->model('Ads')->enabled();
        $data['errors']     = $this->errors;
        $view               = $this->view->render('blog/contact', $data);
        return $this->blogLayout->render($view);
    }

}
