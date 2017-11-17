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
     * @return json A JSON file to deliver it via AJAX request to user's browser
     */
    public function submit()
    {
        $json = [];
        if ($this->isValid()) {
            // it means there are no errors in form validation
            // set the users group id for the registered user
            // to be the id of the "users" group
            $this->request->setPost('ugid', 2);
            // Set the user status to be disabled until user activates his account
            $this->request->setPost('status', 'disabled');
            $create = $this->load->model('Users')->create();
            if ($this->sendMail($create)) {
                $json['success'] = 'Please confirm your email address by opening the link we\'ve sent to';
            } else {
                $json['errors'] = 'We have trouble in our email service! Please try again later.';
            }
        } else {
            // it means there are errors in form validation
            $json['errors'] = $this->validator->flatMsg();
        }
        return $this->json($json);
    }

    /**
     * Send an activation email to user
     *
     * @param int $user_id
     * @return bool In case the message is not sent , this function will return false
     */
    private function sendMail($user_id)
    {
        $user    = $this->load->model('Users')->get($user_id);
        $email   = $user->email;
        $link    = $this->request->baseUrl() . 'activate/' . $user->code;
        $subject = 'Activate your account';
        $msg     = 'Hello, Thanks for registeration ;)<br>Please open the link below to activate your account:<br>' . $link;
        return mail($email, $subject, $msg);
    }

    /**
     * Validate the form
     *
     * @param int $id
     * @return bool
     */
    private function isValid()
    {
        $this->validator
                ->required('name', 'Please set the Users name')
                ->min('name', 3)
                ->max('name', 32)
                ->valString('name')
                ->unique('name', ['u', 'name'], 'This username is already registered, Please choose another one');
        $this->validator
                ->required('email')
                ->email('email')
                ->unique('email', ['u', 'email'], 'This email already exists')
                ->min('email', 10)
                ->max('email', 64);
        $this->validator
                ->required('pass')
                ->min('pass', 8)
                ->max('pass', 128)
                ->match('pass', 're-pass')
                ->valString('pass');
        $this->validator->recaptcha();
        return $this->validator->pass();
    }

}
