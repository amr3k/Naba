<?php
namespace System;
abstract class Model {
    protected $app;
    protected $table;
    public function __construct(App $app) {
        $this->app = $app;
    }
    public function __get($key) {
        return $this->app->get($key);
    }
    public function __call($method , $args)
    {
        return call_user_func([$this->app->db, $method], $args);
    }
    public function all()
    {
        return $this->fetchAll($this->table);
    }
    public function get($id)
    {
        return $this->where('id = ?', $id)->fetch($this->table);
    }
}
