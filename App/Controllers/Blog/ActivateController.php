<?php

namespace App\Controllers\Blog;

use System\Controller;

class ActivateController extends Controller
{

    /**
     * Display activation code form
     *
     * @param text $code Activation code
     * @return mixed
     */
    public function index($code)
    {
        $loginModel = $this->load->model('Login');
        if ($loginModel->isLogged()) {
            return $this->url->redirect('/');
        }
        $this->blogLayout->disable('sidebar');
        $this->blogLayout->title('Account activation');
        $user = $this->load->model('Users')->fetch($code, 'code');
        if (!$user) {
            return $this->url->redirect('/404');
        }
        if ((time() - $user->created) <= 86400) { // If the user has opened the activation link whithin 24 hours
            // Activating user's account
            $this->load->model('Users')->activate($user->id);
        } else { // If the user has opened the activation link after 24 hours
            // Displaying an error and offer to re-activate
            $data['error'] = 'This link is expired! Please request a new activation code';
        }
        $view = $this->view->render('blog/users/login', $data);
        return $this->blogLayout->render($view);
    }

    /**
     * Submit requiring an activation code
     *
     * @return mixed
     */
    public function submit()
    {
        if ($this->isValid()) {
            $email      = $this->request->post('email');
            $pass       = $this->request->post('password');
            $loginModel = $this->load->model('Login');
            if (!$loginModel->isValidLogin($email, $pass)) {
                $json['errors'] = 'Invalid email or password';
                return $this->json($json);
            }
            $logged_in_user = $loginModel->user();
            if ($logged_in_user->status === 'disabled') {
                $json['errors'] = 'Please confirm your email by openeing the link we\'ve sent to';
                return $this->json($json);
            }
            // save login data in cookie and session
            $this->cookie->set('login', $logged_in_user->code);
            $this->session->set('login', $logged_in_user->code);
            $json               = [];
            $json['success']    = 'Welcome Back ' . $logged_in_user->name;
            $json['redirectTo'] = $this->url->link('/');
            return $this->json($json);
        } else {
            $json           = [];
            $json['errors'] = $this->validator->flatMsg();
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
        $this->validator
                ->required('email')
                ->email('email')
                ->min('email', 10)
                ->max('email', 64);
        $this->validator
                ->required('password')
                ->max('password', 128)
                ->valString('password');
        return $this->validator->pass();
    }

}
