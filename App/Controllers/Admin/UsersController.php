<?php

namespace App\Controllers\Admin;

use System\Controller;

class UsersController extends Controller
{

    /**
     * Display Users list
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('Users');
        $data['users'] = $this->load->model('Users')->all();
        return $this->adminLayout->render($this->view->render('admin/users/list', $data));
    }

    /**
     * Add a new Users
     *
     * @return string
     */
    public function add()
    {
        $groupsModel    = $this->load->model('UsersGroups');
        $groups         = $groupsModel->all();
        $data['action'] = $this->url->link('/admin/users/submit');
        $data['groups'] = $groups;
        return $this->app->view->render('admin/users/form', $data);
    }

    /**
     * Submit form for creating a new Users
     *
     * @param string $name
     * @return string / JSON
     */
    public function submit()
    {
        if ($this->isValid()) {
            $userModel = $this->load->model('Users');
            $newName   = trim($this->request->post('name'));
            if ($userModel->exists($newName)) {
                $json['errors'] = 'This name already exists';
            } else {
                $userModel->create();
                $json['success']  = '<b>' . $newName . ' </b> was Created Successfully';
                $json['redirect'] = $this->url->link('/admin/users');
            }
        } else {
            $json['errors'] = $this->validator->flatMsg();
        }
        return $this->json($json);
    }

    /**
     * Edit Users info
     *
     * @param int $id
     * @return string
     */
    public function edit($id)
    {
        $userModel = $this->load->model('Users');
        if (!$userModel->exists($id)) {
            return $this->url->redirect('/404');
        }
        // Getting groups info
        $groupsModel    = $this->load->model('UsersGroups');
        $groups         = $groupsModel->all();
        $data['groups'] = $groups;
        // Getting Users info
        $userName       = $userModel->get($id);
        $data['action'] = $this->url->link('/admin/users/save') . '/' . $id;
        $data['name']   = $userName->name;
        $data['email']  = $userName->email;
        $data['status'] = $userName->status;
        $data['ugid']   = $userName->ugid;
        $data['img']    = $this->url->link('Public/uploads/img/avatar/') . '/' . $userName->img;
        return $this->app->view->render('admin/users/form-edit', $data);
    }

    /**
     * Submit form for editing an existing users
     *
     * @param int $id
     * @return string / JSON
     */
    public function save($id)
    {
        if ($this->isValid($id)) {
            $userModel       = $this->load->model('Users');
            $userNewName     = trim($this->request->post('name'));
            $userOldName     = $userModel->get($id)->name;
            $userModel->update($id);
            $json['success'] = '<b>' . $userOldName . '</b> has been successfully changed to <b>' . $userNewName . '</b>';
            if ($userNewName === $userOldName) {
                $json['success'] = '<b>' . $userOldName . '</b>\'s info has been successfully update';
            }
            $json['redirect'] = $this->url->link('/admin/users');
        } else {
            $json['errors'] = $this->validator->flatMsg();
        }
        return $this->json($json);
    }

    /**
     * Deleting users
     *
     * @param int $id
     * @return string / JSON
     */
    public function delete($id)
    {
        $userModel = $this->load->model('Users');
        if (!$userModel->exists($id) || $id === '1') {
            return $this->url->redirect('/404');
        }
        $userModel->delete($id);
        $json['redirect'] = $this->url->link('/admin/users');
        return $this->json($json);
    }

    /**
     * Validate form
     *
     * @return bool
     */
    private function isValid($id = NULL)
    {
        $this->validator->required('email')->email('email')->unique('email', ['u', 'email', 'id', $id], 'This email already exists');
        $this->validator->required('name', 'Please set the Users name');
        if (is_null($id)) {
            // If the $id is null,
            // This means that password and image are required for creating a new user
            $this->validator->required('pass')->min('pass', 8)->max('pass', 128)->match('pass', 're-pass');
            $this->validator->requiredFile('img')->img('img');
        } else {
            // This means that the user either changed the password or not
            // but it's not neccesserely required
            if ($this->request->post('pass')) {
                $this->validator->min('pass', 8)->max('pass', 128)->match('pass', 're-pass');
            }
            if ($this->request->file('img')->exists()) {
                $this->validator->img('img');
            }
        }
        return $this->validator->pass();
    }

}
