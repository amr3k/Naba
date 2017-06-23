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
        $data['users'] =   $this->load->model('Users')->all();
        return $this->adminLayout->render($this->view->render('admin/users/list', $data));
    }
    
    /**
     * Add a new Users
     * 
     * @return string
     */
    public function add()
    {
        $data['action']     =   $this->url->link('/admin/users/submit');
        $data['pages']      =   $this->pages();
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
        if ($this->isValid()){
            $userModel    =   $this->load->model('Users');
            $newName    =   $this->request->post('name');
            if ($userModel->exists($newName)){
                $json['errors']    =    'This name already exists';
            } else {
                $userModel->create();
                $json['success']    =   '<b>' . $newName . ' </b> was Created Successfully';
                $json['redirect']   =   $this->url->link('/admin/users');
            }
        }else {
            $json['errors']    =    $this->validator->flatMsg();
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
        $userModel    =   $this->load->model('Users');
        if (! $userModel->exists($id)){
            return $this->url->redirect('/404');
        }
        $userName    =   $userModel->get($id);
        $data['name']   =   $userName->name;
        $data['action']     =   $this->url->link('/admin/users/save'). '/' . $id;
        $data['pages']      =   $this->pages();
        $data['selected']   =   $userName->page;
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
        if ($this->isValid()){
            $userModel    =   $this->load->model('Users');
            $userNewName  =   $this->request->post('name');
            $userOldName =   $userModel->get($id)->name;
            if ($userOldName !== $userNewName && $userModel->exists($userNewName, 'name')){
                $json['errors']    =    'The new name already exists';
            } else {
                $userModel->update($id);
                $json['success']    =   '<b>'.$userOldName.'</b> has been successfully changed to <b>' . $userNewName . '</b>';
                $json['redirect']   =   $this->url->link('/admin/users');
            }
        }else {
            $json['errors']    =    $this->validator->flatMsg();
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
        $userModel    =   $this->load->model('Users');
        if (! $userModel->exists($id) || $id === '1'){
            return $this->url->redirect('/404');
        }
        $userModel->delete($id);
//        $json['success']    =   '<b>' . $this->request->post('name') . ' </b> has been deleted successfully';
        $json['redirect']   =   $this->url->link('/admin/users');
        return $this->json($json);
    }

    /**
     * Validate form
     * 
     * @return bool
     */
    private function isValid()
    {
        $this->validator->required('name', 'Please set the Users name');
        return $this->validator->pass();
    }
    
    /**
     * Accessible pages
     * 
     * @return array
     */
    private function pages()
    {
        $permissions    =   [];
        foreach ($this->app->route->routes() as $route){
            if (strpos($route['url'], '/admin') === 0){
                $permissions[]  =   $route['url'];
            }
        }
        return $permissions;
    }
}