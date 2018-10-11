<?php

namespace app\Controllers\Blog;

use System\Controller;

class ProfileController extends Controller
{

    /**
     * Display Users list
     *
     * @return mixed
     */
    public function index()
    {
        $this->blogLayout->title('Profile');
        $this->blogLayout->disable('sidebar');
        $loginModel = $this->load->model('Login');
        if (!$loginModel->isLogged()) {
            return $this->url->redirect('/');
        }
        $user           = $this->load->model('Login')->user();
        $data['user']   = $user;
        $data['action'] = $this->url->link('/profile/submit') . '/' . $user->id;
        $data['bio']    = $user->bio;
        $data['img']    = $this->url->link('public/uploads/img/avatar/') . '/' . $data['user']->img;
        $data['errors'] = $this->errors;
        $view           = $this->view->render('blog/users/profile', $data);
        return $this->blogLayout->render($view);
    }

    /**
     * Submit form for creating a new Users
     *
     * @param int $id
     * @return string / JSON
     */
    public function submit($id)
    {
        if ($this->isValid($id)) {
            $profileModel       = $this->load->model('Profile');
            $profileModel->update();
            $json['success']    = 'Your profile hes been successfully updated';
            $json['redirectTo'] = $this->url->link('/profile');
        } else {
            $json['errors'] = $this->validator->flatMsg();
        }
        return $this->json($json);
    }

    /**
     * Validate form
     *
     * @return bool
     */
    private function isValid($id)
    {
        $this->validator
                ->required('name')
                ->min('name', 3)
                ->max('name', 255)
                ->unique('name', ['u', 'name', 'id', $id], 'This username is already registered, Please choose another one');
        $this->validator
                ->required('email')->email('email')
                ->unique('email', ['u', 'email', 'id', $id], 'This email already exists')
                ->max('email', 255);
        if ($this->request->post('bio')) {
            $this->validator->min('bio', 6)->max('bio', 140);
        }
        if ($this->request->file('img')->exists()) {
            $this->validator->img('img');
        }
        if ($this->request->post('pass') || $this->request->post('old_pass')) {
            if (!$this->load->model('Profile')->password()) {
                $this->validator->msg('Wrong password');
            } else {
                $this->validator->match('pass', 're-pass')->min('pass', 8)->max('pass', 128);
            }
        }
        return $this->validator->pass();
    }

}
