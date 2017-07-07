<?php

namespace App\Models;

use System\Model;

class AdsModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected $table = 'ads';

    /**
     * Create a new Ad record
     *
     * @return void
     */
    public function create()
    {
        // Getting image
        $img = $this->upImg();
        // Changing image file permissions
        chmod($this->app->file->toAdsImg($img), 0777);
        $this->db
                ->data('link', $this->request->post('link'))
                ->data('start', strtotime(trim($this->request->post('start'))))
                ->data('end', strtotime(trim($this->request->post('end'))))
                ->data('page', $this->request->post('page'))
                ->data('img', $img)
                ->data('status', $this->request->post('status'))
                ->insert($this->table);
    }

    /**
     * Updating Ad data
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        // Checking for existing ad
        $ad = $this->get($id);
        if (!$ad) {
            return;
        }
        $img = $this->upImg();
        if ($img) {
            // Deleting old photo before submitting the new one
            $oldImg     = $ad->img;
            $oldImgPath = $this->app->file->toAdsImg($oldImg);
            unlink($oldImgPath);
            // Changing new image file permissions
            $newImgPath = $this->app->file->toAdsImg($img);
            chmod($newImgPath, 0777);
            // Inserting the image filename in database
            $this->db->data('img', $img);
        }
        $this->db
                ->data('link', $this->request->post('link'))
                ->data('start', strtotime(trim($this->request->post('start'))))
                ->data('end', strtotime(trim($this->request->post('end'))))
                ->data('page', $this->request->post('page'))
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
        $imgPath = $img->move($this->app->file->to('Public/uploads/img/ads'));
        return $imgPath;
    }

    /**
     * Get Enabled Ads for the current page
     *
     * @return array
     */
    public function enabled()
    {
        $currentRoute = $this->route->getCurrentRoute();

        $now = time();

        return $this->db
                        ->where('status=? AND page=? AND start <= ? AND end >= ?', 'enabled', $currentRoute, $now, $now)
                        ->fetchAll($this->table);
    }

    /**
     * Delete ad and its image
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $ad      = $this->get($id);
        $imgPath = $this->app->file->toAdsImg($ad->img);
        unlink($imgPath);
        parent::delete($id);
    }

}
