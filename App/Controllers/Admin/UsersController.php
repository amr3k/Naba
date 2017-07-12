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
//        pred($this->load->model('Users')->all());
        $this->html->setTitle('Users');
        $data['users']    = $this->load->model('Users')->all();
        $data['admin_id'] = $this->load->model('Login')->user()->id;
        return $this->adminLayout->render($this->view->render('admin/users/list', $data));
    }

    /**
     * Add a new Users
     *
     * @return string
     */
    public function add()
    {
        $current_admin  = $this->load->model('Login')->user();
        $groupsModel    = $this->load->model('UsersGroups');
        $groups         = $groupsModel->all();
        $data['action'] = $this->url->link('/admin/users/submit');
        $data['groups'] = $groups;
        $data['admin']  = $current_admin->id;
        $data['code']   = $current_admin->code;
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
            $code = $this->request->post('code');
            if ($this->admin($code) !== '1') {
                $this->request->setPost('ugid', 2);
            }
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
        $current_admin = $this->load->model('Login')->user();
        $userModel     = $this->load->model('Users');
        if (!$userModel->exists($id)) {
            return $this->url->redirect('/404');
        }
        // Getting groups info
        $groupsModel    = $this->load->model('UsersGroups');
        $groups         = $groupsModel->all();
        $data['groups'] = $groups;
        // Getting Users info
        $userName       = $userModel->get($id);
        // Setting data
        $data['admin']  = $this->load->model('Login')->user()->id;
        $data['action'] = $this->url->link('/admin/users/save') . '/' . $id;
        $data['id']     = $userName->id;
        $data['ugid']   = $userName->ugid;
        $data['name']   = $userName->name;
        $data['email']  = $userName->email;
        $data['status'] = $userName->status;
        $data['img']    = $this->url->link('Public/uploads/img/avatar/') . '/' . $userName->img;
        $data['code']   = $current_admin->code;
        if ($current_admin->id !== '1') {
            // This means that This user is not the site owner (super admin)
            // So , He should edit only his private info
            // As well as normal users status, and the ability to delete himself and normal users
            return $this->app->view->render('admin/users/form-edit-admin', $data);
        }
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
        $code     = $this->request->post('code');
        $admin_id = $this->admin($code);
        if ($admin_id === '1') {
            // This means that the current admin is the site owner
            // He can edit his own info and other users status and user group
            if ($id === '1') {
                $this->request->setPost('ugid', 1);
                $this->request->setPost('status', 'enabled');
                if ($this->isValid($id)) {
                    $userModel        = $this->load->model('Users');
                    $username         = trim($this->request->post('name'));
                    $userModel->update($id);
                    $json['success']  = '<b>' . $username . '</b>\'s info has been successfully updated';
                    $json['redirect'] = $this->url->link('/admin/users');
                } else {
                    $json['errors'] = $this->validator->flatMsg();
                }
            } else {
                // Only can edit group and status
                $userModel        = $this->load->model('Users');
                $userModel->smallUpdate($id);
                $username         = $this->load->model('Users')->get($id)->name;
                $json['success']  = '<b>' . $username . '</b>\'s info has been successfully updated';
                $json['redirect'] = $this->url->link('/admin/users');
            }
        } else {
            // This means that the current admin is a normal admin
            if ($admin_id == $id) {
                // Normal admin can edit his own info, and other normal users' status
                if ($this->isValid($id)) {
                    $this->request->setPost('ugid', 1);
                    $this->request->setPost('status', 'enabled');
                    $userModel        = $this->load->model('Users');
                    $username         = trim($this->request->post('name'));
                    $userModel->update($id);
                    $json['success']  = '<b>' . $username . '</b>\'s info has been successfully updated';
                    $json['redirect'] = $this->url->link('/admin/users');
                } else {
                    $json['errors'] = $this->validator->flatMsg();
                }
            } else {
                $this->request->setPost('ugid', 2);
                $userModel        = $this->load->model('Users');
                $userModel->smallUpdate($id);
                $userOldName      = $this->load->model('Users')->get($id)->name;
                $json['success']  = '<b>' . $userOldName . '</b>\'s info has been successfully updated';
                $json['redirect'] = $this->url->link('/admin/users');
            }
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
        $current_admin = $this->load->model('Login')->user()->id;
        $userModel     = $this->load->model('Users');
        if (!$userModel->exists($id) || $id === '1') {
            return $this->url->redirect('/404');
        }
        if ($current_admin === '1') {
            $userModel->delete($id);
        } else {
            if ($userModel->isAdmin($id)) {
                return $this->url->redirect('/404');
            }
            $userModel->delete($id);
        }
        $json['redirect'] = $this->url->link('/admin/users');
        return $this->json($json);
    }

    /**
     * Checking admin privileges
     *
     * @return int
     */
    private function admin($code)
    {
        $admin_id = $this->load->model('Users')->fetch($code, 'code')->id;
        return $admin_id;
    }

    /**
     * Validate form
     *
     * @return bool
     */
    private function isValid($id = NULL)
    {
        $this->validator->required('email')->email('email')
                ->unique('email', ['u', 'email', 'id', $id], 'This email already exists')
                ->max('email', 64);
        $this->validator->required('name', 'Please set the username')->min('name', 3)->max('name', 32);
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
