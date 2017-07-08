<?php

namespace App\Controllers\Blog;

use System\Controller;

class RegisterController extends Controller
{

    /**
     * Display Registration Page
     *
     * @return mixed
     */
    public function index()
    {
        $loginModel = $this->load->model('Login');
        if ($loginModel->isLogged()) {
            return $this->url->redirect('/');
        }
        $this->blogLayout->title('Create New Account');
        $view = $this->view->render('blog/users/register');
        // disable sidebar
        $this->blogLayout->disable('sidebar');
        return $this->blogLayout->render($view);
    }

    /**
     * Submit for creating new user
     *
     * @return string | JSON
     */
    public function submit()
    {
        $json = [];
        if ($this->isValid()) {
            // it means there are no errors in form validation
            // set the users group id for the registered user
            // to be the id of the "users" group
            $this->request->setPost('ugid', 2);
            // Set the user status to be disabled untill the admin approves it
            $this->request->setPost('status', 'disabled');
            $this->load->model('Users')->create();
            $json['success']    = 'Your account has been successfully created, Please wait for approval';
            $json['redirectTo'] = $this->url->link('/login');
        } else {
            // it means there are errors in form validation
            $json['errors'] = $this->validator->flattenMessages();
        }
        return $this->json($json);
    }

    /**
     * Validate the form
     *
     * @param int $id
     * @return bool
     */
    private function isValid()
    {
        $this->validator->required('name', 'Please set the Users name')->min('name', 3)->max('name', 32);
        $this->validator->required('email')->email('email')->unique('email', ['u', 'email'], 'This email already exists')->max('email', 64);
        $this->validator->required('pass')->min('pass', 8)->max('pass', 128)->match('pass', 're-pass');
        $this->validator->requiredFile('img')->img('img');
        return $this->validator->pass();
    }

}
