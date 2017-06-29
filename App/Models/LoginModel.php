<?php

namespace App\Models;

use System\Model;

class LoginModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected $table = 'u';

    /**
     * Logged in user info
     *
     * @var \stdClass
     */
    protected $user;

    /**
     * Get logged in user data
     *
     * @return \stdClass
     */
    public function user()
    {
        if ($this->user) {
            return $this->user;
        }
        $code       = $this->app->session->get('login');
        $user       = $this->db->where('code = ?', $code)->fetch($this->table);
        $this->user = $user;
        return $user;
    }

    /**
     * Determine if the given login data is valid
     *
     * @param string $email
     * @param string $pass
     * @return bool
     */
    public function isValidLogin($email, $pass)
    {
        $user = $this->db->where('email = ?', $email)->fetch($this->table);
        if (!$user) {
            return FALSE;
        }
        $this->user = $user;
        return password_verify($pass, $user->pass);
    }

    /**
     * Determine if the user is logged in
     *
     * @return bool
     */
    public function isLogged()
    {
        if ($this->app->cookie->has('login')) {
            $code = $this->app->cookie->get('login');
        } elseif ($this->app->session->has('login')) {
            $code = $this->app->session->get('login');
        } else {
            $code = NULL;
        }
        $user = $this->db->where('code = ?', $code)->fetch($this->table);
        if (!$user) {
            return FALSE;
        }
        $this->user = $user;
        return TRUE;
    }

}
