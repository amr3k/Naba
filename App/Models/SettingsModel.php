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
                ->data('name', $this->request->post('name'))
                ->data('email', $this->request->post('email'))
                ->data('status', $this->request->post('status'))
                ->data('msg', $this->request->post('msg'))
                ->where('id = ?', 1)
                ->update($this->table);
    }

}
