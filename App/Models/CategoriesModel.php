<?php

namespace App\Models;

use System\Model;

class CategoriesModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected $table = 'categories';

    /**
     * Create a new category record
     *
     * @return void
     */
    public function create()
    {
        $this->db
                ->data('name', $this->request->post('name'))
                ->data('status', $this->request->post('status'))
                ->insert($this->table);
    }

    /**
     * Update an existing Category
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        $this->db
                ->data('name', $this->request->post('name'))
                ->data('status', $this->request->post('status'))
                ->where('id = ?', $id)
                ->update($this->table);
    }

    /**
     * Get enabled categories with total number of posts for each category
     *
     * @return array
     */
    public function getEnabledCategoriesWithNumberOfTotalPosts()
    {
        // share the categories in the application to not call it twice in same request
        if (!$this->app->isSharing('enabled-categories')) {
            // first we will get the enabled categories
            // and we will add another condition that total number of posts
            // for each category
            // should be more than zero
            $categories = $this->db
                    ->select('categories.*')
                    ->select('(SELECT COUNT(posts.id) FROM posts WHERE posts.status="enabled" AND posts.cid=categories.id) AS total_posts')
                    ->from('categories')
                    ->where('categories.status=?', 'enabled')
                    ->having('total_posts > 0')
                    ->fetchAll();
            $this->app->share('enabled-categories', $categories);
        }
        return $this->app->get('enabled-categories');
    }

    /**
     * Get all categories with total number of posts for each category
     *
     * @return array
     */
    public function all()
    {
        // first we will get the enabled categories
        // and we will add another condition that total number of posts
        // for each category
        // should be more than zero
        return $this->db
                        ->select('categories.*')
                        ->select('(SELECT COUNT(posts.id) FROM posts WHERE posts.cid=categories.id) AS total_posts')
                        ->from('categories')
                        ->fetchAll();
    }

    /**
     * Get Category With Posts
     *
     * @param int $id
     * @return array
     */
    public function getCategoryWithPosts($id)
    {
        $category = $this->db->where('id=? AND status=?', $id, 'enabled')->fetch($this->table);

        if (!$category) {
            return [];
        }
        // We Will get the current page
        $currentPage     = $this->pagination->page();
        // We Will get the items Per Page
        $limit           = $this->pagination->itemsPerPage();
        // Set our offset
        $offset          = $limit * ($currentPage - 1);
        $category->posts = $this->db
                ->select('posts.*', 'u.name AS `author`')
                ->select('(SELECT COUNT(comments.id) FROM `comments` WHERE comments.post_id=posts.id) AS total_comments')
                ->from('posts')
                ->joins('LEFT JOIN u ON posts.uid = u.id')
                ->where('posts.cid=? AND posts.status=? AND u.status=?', $id, 'enabled', 'enabled')
                ->orderBy('posts.id', 'DESC')
                ->limit($limit, $offset)
                ->fetchAll();
        // Get total posts for pagination
        $totalPosts      = count($category->posts);
//        $totalPosts      = $this->db
//                ->select('COUNT(id) AS `total`')
//                ->from('posts')
//                ->where('cid=? AND status=?', $id, 'enabled')
//                ->orderBy('id', 'DESC')
//                ->fetch();
        if ($totalPosts) {
            $this->pagination->setTotalItems($totalPosts);
        }
        return $category;
    }

    /**
     * Delete category with its posts
     *
     * @param int $id Category ID
     * @return void
     */
    public function delete($id)
    {
        $posts = $this->db
                ->select('id')
                ->from('posts')
                ->where('posts.cid=?', $id)
                ->fetchAll();
        foreach ($posts as $post) {
            $this->load->model('Posts')->delete($post->id);
        }
        parent::delete($id);
    }

}
