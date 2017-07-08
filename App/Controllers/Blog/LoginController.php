<?php

namespace App\Controllers\Blog;

use System\Controller;

class LoginController extends Controller
{

    /**
     * Display Login Form
     *
     * @return mixed
     */
    public function index()
    {
        $this->blogLayout->title('Login');
        $loginModel = $this->load->model('Login');
        // disable sidebar
        $this->blogLayout->disable('sidebar');
        if ($loginModel->isLogged()) {
            return $this->url->redirect('/');
        }
        $data['errors'] = $this->errors;
        $view           = $this->view->render('blog/users/login', $data);
        return $this->blogLayout->render($view);
    }

    /**
     * Submit Login form
     *
     * @return mixed
     */
    public function submit()
    {
        if ($this->isValid()) {
            $loginModel     = $this->load->model('Login');
            $logged_in_user = $loginModel->user();
            if ($this->request->post('remember')) {
                // save login data in cookie and session
                $this->cookie->set('login', $logged_in_user->code);
                $this->session->set('login', $logged_in_user->code);
            } else {
                // save login data in session
                $this->session->set('login', $logged_in_user->code);
            }
            $json               = [];
            $json['success']    = 'Welcome Back ' . $logged_in_user->name;
            $json['redirectTo'] = $this->url->link('/');
            return $this->json($json);
        } else {
            $json           = [];
            $json['errors'] = implode('<br>', $this->errors);
            return $this->json($json);
        }
    }

    /**
     * Validate Login Form
     *
     * @return bool
     */
    private function isValid()
    {
        $email = $this->request->post('email');
        $pass  = $this->request->post('password');
        if (!$email) {
            $this->errors[] = 'Please insert your email address';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Please insert a valid email address';
        }
        if (!$pass) {
            $this->errors[] = 'Please insert your password';
        }
        if (!$this->errors) {
            $loginModel = $this->load->model('Login');
            if (!$loginModel->isValidLogin($email, $pass)) {
                $this->errors[] = 'Invalid email or password';
            }
        }
        return empty($this->errors);
    }

}
