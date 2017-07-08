<?php

namespace System;

abstract class Model
{

    /**
     * Application Object
     *
     * @var \System\App
     */
    protected $app;

    /**
     * Table name
     *
     * @var string
     */
    protected $table;

    /**
     * Constructor
     *
     * @param \System\App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Call shared application objects dynamically
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->app->get($key);
    }

    /**
     * Call database methods dynamically
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func([$this->app->db, $method], $args);
    }

    /**
     * Get all model data
     *
     * @return array
     */
    public function all()
    {
        return $this->db->fetchAll($this->table);
    }

    /**
     * Get record by ID
     *
     * @param int $id
     * @return \stdClass
     */
    public function get($id)
    {
        return $this->db->where('id= ?', $id)->fetch($this->table);
    }

    /**
     * Get record by ID
     *
     * @param int $id
     * @return \stdClass
     */
    public function fetch($value, $column)
    {
        return $this->db->where($column . '= ?', $value)->fetch($this->table);
    }

    /**
     * Determine if the given value of the key exists in table
     *
     * @param mixed $value
     * @param string $key
     * @return bool
     */
    public function exists($value, $key = 'id')
    {
        return (bool) $this->db->select($key)->where($key . ' = ?', $value)->fetch($this->table);
    }

    /**
     * Deleting a record
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->where('id = ?', $id)->delete($this->table);
    }

}
