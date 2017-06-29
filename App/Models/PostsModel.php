<?php

namespace App\Models;

use System\Model;

class PostsModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected $table = 'posts';

    /**
     * Create a new Post record
     *
     * @return void
     */
    public function create()
    {
        // Getting user ID
        $uid = $this->load->model('Login')->user()->id;
        // Getting image
        $img = $this->upImg();
        // Changing image file permissions
        chmod($this->app->file->toPostsImg($img), 0777);
        $this->db
                ->data('uid', $uid)
                ->data('cid', $this->request->post('category'))
                ->data('title', trim($this->request->post('title')))
                ->data('text', $this->request->post('text'))
                ->data('img', $img)
                ->data('tags', $this->request->post('tags'))
                ->data('status', $this->request->post('status'))
                ->data('created', time())
                ->insert($this->table);
    }

    /**
     * Updating post data
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        // Checking for existing post
        $post = $this->db
                ->where('id = ?', $id)
                ->fetch($this->table);
        if (!$post) {
            return;
        }
        $img = $this->upImg();
        if ($img) {
            // Deleting old photo before submitting the new one
            $oldImg     = $post->img;
            $oldImgPath = $this->app->file->toPostsImg($oldImg);
            unlink($oldImgPath);
            // Changing new image file permissions
            $newImgPath = $this->app->file->toPostsImg($img);
            chmod($newImgPath, 0777);
            // Inserting the image filename in database
            $this->db->data('img', $img);
        }
        $this->db
                ->data('title', $this->request->post('title'))
                ->data('text', $this->request->post('text'))
                ->data('tags', $this->request->post('tags'))
                ->data('status', $this->request->post('status'))
                ->data('cid', $this->request->post('category'))
                ->where('id = ?', $id)
                ->update($this->table);
    }

    /**
     * Upload image
     *
     * @return string
     */
    public function upImg()
    {
        $img = $this->request->file('img');
        if (!$img->exists()) {
            return;
        }
        $imgPath = $img->move($this->app->file->to('Public/uploads/img/posts'));
        return $imgPath;
    }

    /**
     * Delete post and its image
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $post    = $this->get($id)[0];
        $imgPath = $this->app->file->toPostsImg($post->img);
        unlink($imgPath);
        parent::delete($id);
    }

    /**
     * Get record by ID
     *
     * @param int $id
     * @return array
     */
    public function get($id)
    {
        $post     = $this->db
                ->where('id = ?', $id)
                ->fetch($this->table);
        $author   = $this->db
                ->select('name')
                ->where('id = ?', $post->uid)
                ->fetch('u');
        $category = $this->db
                ->select('name')
                ->where('id = ?', $post->cid)
                ->fetch('categories');
        return [$post, $author, $category];
    }

    /**
     * Get all posts
     *
     * @return array
     */
    public function all()
    {
        return $this->db
                        ->select('posts.*', 'categories.name AS category, u.name AS `author`')
                        ->from('posts')
                        ->joins('LEFT JOIN categories ON posts.cid = categories.id')
                        ->joins('LEFT JOIN u ON posts.uid = u.id')
                        ->fetchAll();
    }

}
