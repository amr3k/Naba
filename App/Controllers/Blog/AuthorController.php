<?php

namespace App\Controllers\Blog;

use System\Controller;

class AuthorController extends Controller
{

    /**
     * Display Category Page
     *
     * @param string name
     * @param int $id
     * @return mixed
     */
    public function index($author)
    {
        $user = $this->load->model('Users')->fetch($author, 'name');
        if (!$user || $user->status !== 'enabled') {
            return $this->url->redirect('/404');
        }
        $posts = $this->load->model('Posts')->getPostsByAuthor($user->id);
        pred($posts);
        if (!$posts) {
            $data['author'] = $author;
            $data['posts']  = $posts;
            $view           = $this->view->render('blog/author', $data);
            return $this->blogLayout->render($view);
        }
        $this->html->setTitle($author . '\'s articles');
        if ($this->pagination->page() != 1) {
            // then just redirect him to the first page of the category
            // regardless there is posts or not in that category
            return $this->url->redirect("/author/$author");
        }
        $data['author'] = $author;
        $data['posts']  = $posts;
        $postController = $this->load->controller('Blog/Post');

        // the idea here as follows:
        // first we will pass the $post variable to $post_box variable
        // in the view file
        // why ? because $post_box is an anonymous function
        // when calling it, it will call the "box" method
        // from the post controller
        // so it will pass to it the "$post" variable to be used in the
        // post-box view
        $data['post_box'] = function ($post) use ($postController) {
            return $postController->box($post);
        };

        $data['url']        = $this->url->link('/author/' . seo($user->name) . '/' . '?page=');
        $data['pagination'] = $this->pagination->paginate();
        $view               = $this->view->render('blog/author', $data);
        return $this->blogLayout->render($view);
    }

}
