<?php

namespace App\Models;

use System\Model;

class UsersModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected $table = 'u';

    /**
     * Create a new Users group record
     *
     * @return void
     */
    public function create()
    {
        $img = $this->upImg();
        // Changing image file permissions
        chmod($this->app->file->toAvatar($img), 0777);
        $this->db
                ->data('name', trim($this->request->post('name')))
                ->data('email', trim($this->request->post('email')))
                ->data('pass', password_hash(trim($this->request->post('pass')), PASSWORD_DEFAULT))
                ->data('img', $img)
                ->data('ugid', $this->request->post('ugid'))
                ->data('status', $this->request->post('status'))
                ->data('created', time())
                ->data('ip', $this->request->ip())
                ->data('code', sha1(time()))
                ->insert($this->table);
    }

    /**
     * Updating user data
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        // Checking for existing user
        $user = $this->db
                ->where('id = ?', $id)
                ->fetch($this->table);
        if (!$user) {
            return;
        }
        $id       = $user->id;
        $password = $user->pass;
        if (!empty($this->request->post('pass'))) {
            $password = password_hash($this->request->post('pass'), PASSWORD_DEFAULT);
        }
        $img = $this->upImg();
        if ($img) {
            // Deleting old photo before submitting the new one
            $oldImg     = $user->img;
            $oldImgPath = $this->app->file->toAvatar($oldImg);
            unlink($oldImgPath);
            // Changing new image file permissions
            $newImgPath = $this->app->file->toAvatar($img);
            chmod($newImgPath, 0777);
            // Inserting the image filename in database
            $this->db->data('img', $img);
        }
        $this->db
                ->data('name', $this->request->post('name'))
                ->data('email', $this->request->post('email'))
                ->data('pass', $password)
                ->data('ugid', $this->request->post('ugid'))
                ->data('status', $this->request->post('status'))
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
        $imgPath = $img->move($this->app->file->to('Public/uploads/img/avatar'));
        return $imgPath;
    }

    /**
     * Delete user and his image
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $user    = $this->get($id);
        $imgPath = $this->app->file->toAvatar($user->img);
        unlink($imgPath);
        parent::delete($id);
    }

    /**
     * Get all users
     *
     * @return array
     */
    public function all()
    {
        return $this->db
                        ->select('users.*', 'users_groups.name AS `group`')
                        ->from('u users')
                        ->joins('LEFT JOIN ug users_groups ON users.ugid = users_groups.id')
                        ->fetchAll();
    }

}
