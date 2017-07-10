<?php

namespace App\Models;

use System\Model;

class ProfileModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected $table = 'u';

    /**
     * Updating user data
     *
     * @param int $id
     * @return void
     */
    public function update()
    {
// Checking for existing user
        $user     = $this->load->model('Login')->user();
        $id       = $user->id;
        $password = $this->request->post('pass');
        if ($password) {
            $this->db->data('pass', password_hash($password, PASSWORD_DEFAULT));
        }
        $img = $this->upImg();
        if ($img) {
            if (!strstr($user->img, 'default/')) {
                // Deleting old photo before submitting the new one
                $oldImg     = $user->img;
                $oldImgPath = $this->app->file->toAvatar($oldImg);
                unlink($oldImgPath);
                // Changing new image file permissions
                $newImgPath = $this->app->file->toAvatar($img);
                chmod($newImgPath, 0777);
            }
            // Inserting the image filename in database
            $this->db->data('img', $img);
        }
        $this->db
                ->data('name', trim(strtolower($this->request->post('name'))))
                ->data('email', $this->request->post('email'))
                ->data('bio', $this->request->post('bio'))
                ->where('id = ?', $id)
                ->update($this->table);
    }

    /**
     * Verifying old password password
     *
     * @param $pass
     * @return bool
     */
    public function password()
    {
        $pass        = $this->load->model('Login')->user()->pass;
        $oldPassword = $this->request->post('old_pass');
        return password_verify($oldPassword, $pass);
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

}
