<?php
namespace App\Controllers\Admin;

use System\Controller;

class UsersGroupsController extends Controller
{
    /**
     * Display Users Groups list
     * 
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('Users Groups');
        $data['ugs'] =   $this->load->model('UsersGroups')->all();
        return $this->adminLayout->render($this->view->render('admin/users-groups/list', $data));
    }
    
    /**
     * Add a new Users Group
     * 
     * @return string
     */
    public function add()
    {
        $data['action']     =   $this->url->link('/admin/users-groups/submit');
        $data['pages']      =   $this->pages();
        return $this->app->view->render('admin/users-groups/form', $data);
    }
    
    /**
     * Submit form for creating a new Users Group
     * 
     * @param string $name
     * @return string / JSON
     */
    public function submit()
    {
        if ($this->isValid()){
            $ugModel    =   $this->load->model('UsersGroups');
            $newName    =   $this->request->post('name');
            if ($ugModel->exists($newName)){
                $json['errors']    =    'This name already exists';
            } else {
                $ugModel->create();
                $json['success']    =   '<b>' . $newName . ' </b> was Created Successfully';
                $json['redirect']   =   $this->url->link('/admin/users-groups');
            }
        }else {
            $json['errors']    =    $this->validator->flatMsg();
        }
        return $this->json($json);
    }
    
    /**
     * Edit Users group info
     * 
     * @param int $id
     * @return string
     */
    public function edit($id)
    {
        $ugModel    =   $this->load->model('UsersGroups');
        if (! $ugModel->exists($id)){
            return $this->url->redirect('/404');
        }
        $ugName    =   $ugModel->get($id);
        $data['name']   =   $ugName->name;
        $data['action']     =   $this->url->link('/admin/users-groups/save'). '/' . $id;
        $data['pages']      =   $this->pages();
        $data['selected']   =   $ugName->page;
        return $this->app->view->render('admin/users-groups/form-edit', $data);
    }

    /**
     * Submit form for editing an existing users-group
     * 
     * @param int $id
     * @return string / JSON
     */
    public function save($id)
    {
        if ($this->isValid()){
            $ugModel    =   $this->load->model('UsersGroups');
            $ugNewName  =   $this->request->post('name');
            $ugOldName =   $ugModel->get($id)->name;
            if ($ugOldName !== $ugNewName && $ugModel->exists($ugNewName, 'name')){
                $json['errors']    =    'The new name already exists';
            } else {
                $ugModel->update($id);
                $json['success']    =   '<b>'.$ugOldName.'</b> has been successfully changed to <b>' . $ugNewName . '</b>';
                $json['redirect']   =   $this->url->link('/admin/users-groups');
            }
        }else {
            $json['errors']    =    $this->validator->flatMsg();
        }
        return $this->json($json);
    }
    
    /**
     * Deleting users-group
     * 
     * @param int $id
     * @return string / JSON
     */
    public function delete($id)
    {
        $ugModel    =   $this->load->model('UsersGroups');
        if (! $ugModel->exists($id) || $id === '1'){
            return $this->url->redirect('/404');
        }
        $ugModel->delete($id);
//        $json['success']    =   '<b>' . $this->request->post('name') . ' </b> has been deleted successfully';
        $json['redirect']   =   $this->url->link('/admin/users-groups');
        return $this->json($json);
    }

    /**
     * Validate form
     * 
     * @return bool
     */
    private function isValid()
    {
        $this->validator->required('name', 'Please set the Users-Group name');
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



