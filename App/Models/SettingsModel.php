<?php

namespace App\Models;

use System\Model;

class SettingsModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected $table = 'settings';

    /**
     * Updating post data
     *
     * @return void
     */
    public function update()
    {
        $this->db
                ->data('v', $this->request->post('name'))
                ->where('id = ?', 1)
                ->update($this->table);
        $this->db
                ->data('v', $this->request->post('email'))
                ->where('id = ?', 2)
                ->update($this->table);
        $this->db
                ->data('v', $this->request->post('status'))
                ->where('id = ?', 3)
                ->update($this->table);
        $this->db
                ->data('v', $this->request->post('msg'))
                ->where('id = ?', 4)
                ->update($this->table);
        $this->db
                ->data('v', $this->request->post('contact'))
                ->where('id = ?', 5)
                ->update($this->table);
        $this->db
                ->data('v', $this->request->post('about'))
                ->where('id = ?', 6)
                ->update($this->table);
        $this->db
                ->data('v', $this->request->post('facebook'))
                ->where('id = ?', 7)
                ->update($this->table);
        $this->db
                ->data('v', $this->request->post('twitter'))
                ->where('id = ?', 9)
                ->update($this->table);
        $this->db
                ->data('v', $this->request->post('instagram'))
                ->where('id = ?', 10)
                ->update($this->table);
        // Uploading icon
        $img = $this->upImg();
        if ($img) {
            // Deleting old image before submitting the new one
            $oldImg     = $this->db
                    ->where('id = ?', 8)
                    ->fetch($this->table);
            $oldImgPath = $this->app->file->to('Public/uploads/img/') . $oldImg->v;
            if ($oldImg->v !== $img) {
                unlink($oldImgPath);
            }
            // Changing new image file permissions
            $newImgPath = $this->app->file->to('Public/uploads/img/') . $img;
            chmod($newImgPath, 0777);
            // Inserting the image filename in database
            $this->db
                    ->data('v', $img)
                    ->where('id = ?', 8)
                    ->update($this->table);
        }
    }

    /**
     * Upload fav icon
     *
     * @return string
     */
    public function upImg()
    {
        $img = $this->request->file('icon');
        if (!$img->exists()) {
            return;
        }
        $imgPath = $img->move($this->app->file->to('Public/uploads/img/'), 'icon');
        return $imgPath;
    }

}
