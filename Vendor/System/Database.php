<?php
namespace System;
use PDO;
use PDOException;
class Database
{
    private $app;
    private static $con;
    private $table;
    private $data       =   [];
    private $bindings   =   [];
    private $lastId;
    private $where      =   [];
    private $selects    =   [];
    private $limit;
    private $offset;
    private $rows       =   0;
    private $joins      =   [];
    private $orderBy    =   [];
    public function __construct(App $app) {
        $this->app  =   $app;
        if (! $this->isConnected()) {
            $this->connect();
        }
    }
    private function isConnected ()
    {
        //return ! is_null(static::$con);
        return static::$con instanceof PDO;
    }
    private function connect()
    {
        $con_data    =   $this->app->file->call('config.php');
        extract($con_data);
        $option =   array(PDO::MYSQL_ATTR_INIT_COMMAND    =>  'SET NAMES utf8');
        try {
            static::$con    =   new PDO('mysql:host=' . $server . ';dbname=' . $dbname, $user,$pass,$option);
            static::$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            static::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function connection()
    {
        return static::$con;
    }
    public function table($table)
    {
        $this->table    =   $table;
        return $this;
    }
    public function from($table)
    {
        return $this->table($table);
    }
    public function where(...$bindings)
    {
        $sql    =   array_shift($bindings);
        $this->addToBindings($bindings);
        $this->where[]    =   $sql;
        return $this;
    }
    public function data($key, $value   =   null)
    {
        if (is_array($key)){
            $this->data =   array_merge($this->data, $key);
            $this->addToBindings($key);
        }else {
            $this->data[$key]   =   $value;
            $this->addToBindings($value);
        }
        return $this;
    }
    private function addToBindings($value)
    {
        if (is_array($value)){
            $this->bindings =   array_merge($this->bindings, array_values($value));
        } else {
            $this->bindings[] = $value;
        }
    }
    public function lastId()
    {
        return $this->lastId;
    }
    private function setFields()
    {
        $sql    =   '';
        foreach (array_keys($this->data) as $key){
            $sql    .=  '`' . $key . '` = ? , ';
        }
        $sql    = rtrim($sql,', ');
        return $sql;
    }
    public function select($select)
    {
        $this->selects[] =   $select;
        return $this;
    }
    public function joins($join)
    {
        $this->joins[]  =   $join;
        return $this;
    }
    public function limit($limit, $offset = 0)
    {
        $this->limit    =   $limit;
        $this->offset   =   $offset;
        return $this;
    }
    public function orderBy($orderBy, $sort =   'ASC')
    {
        $this->orderBy    =   [$orderBy, $sort];
        return $this;
    }
    private function fetchStatement()
    {
        $sql    =   'SELECT ';
        if ($this->selects){
            $sql    .= implode(',', $this->selects);
        } else {
            $sql    .=  '*';
        }
        if (is_array($this->table)){
            $sql    .=  ' FROM ' . implode(' ', $this->table) . ' ';
        } else{
            $sql    .=  ' FROM ' . $this->table . ' ';
        }
        if ($this->joins){
            $sql    .= implode(' ', $this->joins);
        }
        if ($this->where){
            if (is_array($this->where[0])){
                $sql    .=  ' WHERE '   . implode(' ', array_slice($this->where[0], 1));
            } else{
                $sql    .=  ' WHERE '   . implode(' ', $this->where);
            }
        }
        if ($this->limit){
            $sql    .=  ' LIMIT ' . $this->limit;
        }
        if ($this->offset){
            $sql    .=  ' OFFSET ' . $this->offset;
        }
        if ($this->orderBy){
            $sql    .=  ' ORDER BY ' . implode(' ', $this->orderBy);
        }
        return $sql;
    }
    public function query(...$bindings)
    {
        $sql    =   array_shift($bindings);
        if (count($bindings) == 1 && is_array($bindings[0])) {
            $bindings   =   $bindings[0];
        }
        try {
            $query  = $this->connection()->prepare($sql);
            foreach ($bindings  as  $key => $value){
                $query->bindValue($key + 1, _e($value));
            }
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            echo $sql;
            pre($this->bindings);
            die($e->getMessage());
        }
    }
    public function fetch($table = null)
    {
        if ($table){
            $this->table    =   $table;
        }
        $sql    =   $this->fetchStatement();
        $result = $this->query($sql, $this->bindings)->fetch();
        $this->reset();
        return $result;
    }
    public function fetchAll($table = null)
    {
        if ($table){
            $this->table    =   $table;
        }
        $sql        =   $this->fetchStatement();
        $query      =   $this->query($sql, $this->bindings);
        $results    =   $query->fetchAll();
        $this->rows =   $query->rowCount();
        $this->reset();
        return $results;
    }
    public function rows()
    {
        return $this->rows;
    }
    public function insert($table   =   null)
    {
        if ($table){
            $this->table($table);
        }
        $sql    =   'INSERT INTO `' . $this->table . '` SET ';
        $sql    .=   $this->setFields();
        $this->query($sql, $this->bindings);
        $this->lastId  = $this->connection()->lastInsertId();
        $this->reset();
        return $this;
    }
    public function update($table = null)
    {
        if ($table){
            $this->table    =   $table;
        }
        $sql    =   'UPDATE `' . $this->table . '` SET ';
        $sql    .=  $this->setFields();
        if ($this->where){
            $sql    .=  ' WHERE ' . implode(' ', $this->where);
        }
        $this->query($sql, $this->bindings);
        $this->reset();
        return $this;
    }
    public function delete($table = null)
    {
        if ($table){
            $this->table    =   $table;
        }
        $sql    =   'DELETE FROM `' . $this->table . '`';
        $sql    .=  ' WHERE ' . implode(' ', $this->where);
        $this->query($sql, $this->bindings);
        $this->reset();
        return $this;
    }
    private function reset()
    {
    $this->table    =   NULL;
    $this->data     =   [];
    $this->bindings =   [];
    $this->where    =   [];
    $this->selects  =   [];
    $this->limit    =   NULL;
    $this->offset   =   NULL;
    $this->joins    =   [];
    $this->orderBy  =   [];
    }
}















