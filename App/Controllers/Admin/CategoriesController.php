<?php
namespace App\Controllers\Admin;

use System\Controller;

class CategoriesController extends Controller{
    
    /**
     * Display Categories list
     * 
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('Categories');
        $data['categories'] =   $this->load->model('Categories')->all();
        return $this->adminLayout->render($this->view->render('admin/categories/list', $data));
    }
    
    /**
     * Add a new category
     * 
     * @return string
     */
    public function add()
    {
        $data['action']     =   $this->url->link('/admin/categories/submit');
        return $this->app->view->render('admin/categories/form', $data);
    }
    
    /**
     * Submit form for creating a new category
     * 
     * @param string $name
     * @return string / JSON
     */
    public function submit()
    {
        if ($this->isValid()){
            $catModel   =   $this->load->model('Categories');
//            if ($catModel->exists($name)){
//                $json['errors']    =    'This name already exists';
//            } else {
                $catModel->create();
                $json['success']    =   '<b>' . $this->request->post('name') . ' </b> was Created Successfully';
                $json['redirect']   =   $this->url->link('/admin/categories');
//            }
        }else {
            $json['errors']    =    $this->validator->flatMsg();
        }
        return $this->json($json);
    }
    
    /**
     * Edit category info
     * 
     * @param int $id
     * @return string
     */
    public function edit($id)
    {
        $categoriesModel    =   $this->load->model('Categories');
        if (! $categoriesModel->exists($id)){
            return $this->url->redirect('/404');
        }
        $catName    =   $categoriesModel->get($id);
        $data['name']   =   $catName->name;
        $data['status'] =   $catName->status;
        $data['action']     =   $this->url->link('/admin/categories/save'). '/' . $id;
        return $this->app->view->render('admin/categories/form-edit', $data);
    }

    /**
     * Submit form for editing an exiting category
     * 
     * @param int $id
     * @return string / JSON
     */
    public function save($id)
    {
        if ($this->isValid()){
            $catModel   =   $this->load->model('Categories');
//            if ($catModel->exists($name)){
//                $json['errors']    =    'This name already exists';
//            } else {
            $catOldName =   $catModel->get($id)->name;
            $catModel->update($id);
            if ($catOldName !== $this->request->post('name')){
                $json['success']    =   '<b>'.$catOldName.'</b> has been successfully changed to <b>' . $this->request->post('name') . '</b>';
            }else{
                $json['success']    =   '<b>'.$catOldName.'</b> has been updated successfully';
            }
            $json['redirect']   =   $this->url->link('/admin/categories');
//            }
        }else {
            $json['errors']    =    $this->validator->flatMsg();
        }
        return $this->json($json);
    }
    
    /**
     * Deleting category
     * 
     * @param int $id
     * @return string / JSON
     */
    public function delete($id)
    {
        $categoriesModel    =   $this->load->model('Categories');
        if (! $categoriesModel->exists($id)){
            return $this->url->redirect('/404');
        }
        $categoriesModel->delete($id);
//        $json['success']    =   '<b>' . $this->request->post('name') . ' </b> has been deleted successfully';
        $json['redirect']   =   $this->url->link('/admin/categories');
        return $this->json($json);
    }

    /**
     * Validate form
     * 
     * @return bool
     */
    private function isValid()
    {
        $this->validator->required('name', 'Please set the category name');
        return $this->validator->pass();
    }
    
}



