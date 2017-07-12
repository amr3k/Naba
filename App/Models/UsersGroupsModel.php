<?php

namespace App\Models;

use System\Model;

class UsersGroupsModel extends Model
{

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'ug';

    /**
     * Create a new Users group record
     *
     * @return void
     */
    public function create()
    {
        $ugid  = $this->db->data('name', $this->request->post('name'))->insert($this->table)->lastId();
        $pages = array_filter($this->app->request->post('pages'));
        foreach ($pages as $page) {
            $this->db
                    ->data('ugid', $ugid)
                    ->data('page', $page)
                    ->insert('ugp');
        }
    }

    /**
     * Update an existing users group
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        $this->db
                ->data('name', $this->request->post('name'))
                ->where('id = ?', $id)
                ->update($this->table);
        $pages = array_filter($this->app->request->post('pages'));
        // Existing database pages should be removed first
        $this->db
                ->where('ugid = ?', $id)
                ->delete('ugp');
        // This step is to insert the provided pages in database
        foreach ($pages as $page) {
            $this->db
                    ->data('ugid', $id)
                    ->data('page', $page)
                    ->insert('ugp');
        }
    }

    /**
     * Deleting a user group and its related pages
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        parent::delete($id);
        $this->db
                ->where('ugid = ?', $id)
                ->delete('ugp');
    }

    /**
     * Get all user groups with total number of users
     *
     * @return mixed
     */
    public function all()
    {
        return $this->db
                        ->select('ug.*')
                        ->select('(SELECT COUNT(u.id) FROM u WHERE u.ugid=ug.id) AS total_users')
                        ->from('ug')
                        ->fetchAll();
    }

    /**
     * Get User group permissions
     *
     * @return mixed
     */
    public function get($id)
    {
        $ug = parent::get($id);
        if ($ug) {
            $pages    = $this->db->select('page')->where('ugid = ?', $ug->id)->fetchAll('ugp');
            $ug->page = [];
            if ($pages) {
                foreach ($pages as $page) {
                    $ug->page[] = $page->page;
                }
            }
        }
        return $ug;
    }

}
