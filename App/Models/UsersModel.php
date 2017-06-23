<?php
namespace App\Models;

use System\Model;

class UsersModel extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table    =   'u';
    
    /**
     * Get all users
     * 
     * @return array
     */
    public function all()
    {
        return  $this->db
                ->select('users.*', 'users_groups.name AS `group`')
                ->from('u users')
                ->joins('LEFT JOIN ug users_groups ON users.ugid = users_groups.id')
                ->fetchAll();
    }
}











