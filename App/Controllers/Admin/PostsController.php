<?php

namespace App\Controllers\Admin;

use System\Controller;

class PostsController extends Controller
{

    /**
     * Display Posts list
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('Posts');
        $data['posts'] = $this->load->model('Posts')->latest();
        return $this->adminLayout->render($this->view->render('admin/posts/list', $data));
    }

    /**
     * Add a new Posts
     *
     * @return string
     */
    public function add()
    {
        $this->html->setTitle('Add a new post');
        $data['action']     = $this->url->link('/admin/posts/submit');
        $data['categories'] = $this->load->model('Categories')->all();
        $view               = $this->app->view->render('admin/posts/form', $data);
        return $this->adminLayout->render($view);
    }

    /**
     * Submit form for creating a new Posts
     *
     * @param string $name
     * @return string / JSON
     */
    public function submit()
    {
        if ($this->isValid()) {
            $postModel        = $this->load->model('Posts');
            $postModel->create();
            $json['success']  = 'Your post was Created Successfully';
            $json['redirect'] = $this->url->link('/admin/posts');
        } else {
            $json['errors'] = $this->validator->flatMsg();
        }
        return $this->json($json);
    }

    /**
     * Edit Posts info
     *
     * @param int $id
     * @return string
     */
    public function edit($id)
    {
        $postModel = $this->load->model('Posts');
        if (!$postModel->exists($id)) {
            return $this->url->redirect('/404');
        }
        // Getting Categories data
        $catModel           = $this->load->model('Categories');
        $cats               = $catModel->all();
        $data['categories'] = $cats;
        // Getting Posts data
        $record             = $postModel->get($id);
        $post               = $record[0];
        $author             = $record[1];
        $category           = $record[2];
        $data['action']     = $this->url->link('/admin/posts/save') . '/' . $id;
        $data['title']      = $post->title;
        $data['cat']        = $category->name;
        $data['author']     = $author->name;
        $data['text']       = $post->text;
        $data['tags']       = $post->tags;
        $data['status']     = $post->status;
        $data['img']        = $this->url->link('Public/uploads/img/posts/') . '/' . $post->img;
        $this->html->setTitle('Edit: ' . $post->title);
        $view               = $this->app->view->render('admin/posts/form-edit', $data);
        return $this->adminLayout->render($view);
    }

    /**
     * Submit form for editing an existing posts
     *
     * @param int $id
     * @return string / JSON
     */
    public function save($id)
    {
        if ($this->isValid($id)) {
            $postModel        = $this->load->model('Posts');
            $postModel->update($id);
            $json['success']  = 'Your post has been successfully updated';
            $json['redirect'] = $this->url->link('/admin/posts');
        } else {
            $json['errors'] = $this->validator->flatMsg();
        }
        return $this->json($json);
    }

    /**
     * Deleting posts
     *
     * @param int $id
     * @return string / JSON
     */
    public function delete($id)
    {
        $postModel        = $this->load->model('Posts');
        $postModel->delete($id);
        $json['redirect'] = $this->url->link('/admin/posts');
        return $this->json($json);
    }

    /**
     * Validate form
     *
     * @return bool
     */
    private function isValid($id = NULL)
    {
        $this->validator->required('title', 'Please choose a title');
        $this->validator->required('text', 'Please type some text');
        $this->validator->required('tags', 'Please choose some tags');
        if (is_null($id)) {
            // If the $id is null,
            // This means that image is required for creating a new post
            $this->validator->requiredFile('img')->img('img');
        } else {
            // This means that the admin either changed the image or not
            // but it's no neccesserely required
            if ($this->request->file('img')->exists()) {
                $this->validator->img('img');
            }
        }
        return $this->validator->pass();
    }

}
