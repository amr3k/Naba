<?php

namespace app\Controllers\Blog;

use System\Controller;

class SearchController extends Controller
{

    /**
     * Displaying search results
     *
     * @return mixed
     */
    public function index()
    {
        $query = filter_var($this->request->get('q'), FILTER_SANITIZE_STRING);
        $posts = $this->load->model('Posts')->search($query);
        if (!$posts || !$query || strlen($query) > 20) {
            $this->blogLayout->title('No results');
            $data['query'] = $query;
            $data['posts'] = NULL;
            $view          = $this->view->render('blog/search', $data);
            return $this->blogLayout->render($view);
        }
        $this->blogLayout->title('Search ' . $query);
        if ($this->pagination->page() != 1) {
            // then just redirect him to the first page of the category
            // regardless there is posts or not in that category
            return $this->url->redirect("/search/" . $query);
        }
        $data['query']  = $query;
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

        $data['url']        = $this->url->link('/search/' . seo($query) . '/' . '?page=');
        $data['pagination'] = $this->pagination->paginate();
        $view               = $this->view->render('blog/search', $data);
        return $this->blogLayout->render($view);
    }

}
