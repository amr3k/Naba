<?php
namespace App\Models;

use System\Model;

class CategoriesModel extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table    =   'categories';
    
    /**
     * Create a new category record
     * 
     * @return void
     */
    public function create()
    {
        $this->db->data('name', $this->request->post('name'))->data('status', $this->request->post('status'))->insert($this->table);
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
    
}










