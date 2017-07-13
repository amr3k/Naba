<?php

namespace App\Controllers\Admin;

use System\Controller;

class LoginController extends Controller
{

    /**
     * Display login form
     *
     * @return mixed
     */
    public function index()
    {
        $loginModel = $this->load->model('Login');
        if ($loginModel->isLogged()) {
            return $this->url->redirect('/admin');
        }
        $data['errors'] = $this->errors;
        return $this->view->render('admin/users/login', $data);
    }

    /**
     * Submit login form
     *
     * @return void
     */
    public function submit()
    {
        if ($this->isValid()) {
            $email      = $this->request->post('email');
            $pass       = $this->request->post('pass');
            $loginModel = $this->load->model('Login');
            if (!$loginModel->isValidLogin($email, $pass)) {
                $json['errors'] = 'Invalid email or password';
                return $this->json($json);
            }
            $logged_in_user = $loginModel->user();
            if ($this->request->post('remember')) {
                // Save login info in cookie and session
                $this->cookie->set('login', $logged_in_user->code);
                $this->session->set('login', $logged_in_user->code);
            } else {
                // Save login info in session
                $this->session->set('login', $logged_in_user->code);
            }
            $json             = [];
            $json['success']  = 'Welcome back ' . $logged_in_user->name;
            $json['redirect'] = $this->url->link('/admin');
            return $this->json($json);
        } else {
            $json           = [];
            $json['errors'] = $this->validator->flatMsg();
            return $this->json($json);
        }
    }

    /**
     * Validate login form
     *
     * @return bool
     */
    private function isValid()
    {
        $this->validator
                ->required('email')
                ->email('email')
                ->min('email', 10)
                ->max('email', 64);
        $this->validator
                ->required('pass')
                ->max('pass', 128)
                ->valString('pass');
        return $this->validator->pass();
    }

}
