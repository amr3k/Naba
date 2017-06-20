<?php
namespace System;

use PDO;
use PDOException;

class Database
{
    /**
     * Application object
     * 
     * @var \System\App
     */
    private $app;
    
    /**
     * PDO connection
     * 
     * @var \PDO
     */
    private static $con;
    
    /**
     * Table name
     * 
     * @var string
     */
    private $table;
    
    /**
     * Data container
     * 
     * @var array
     */
    private $data       =   [];
    
    /**
     * Bindings container
     * 
     * @var array
     */
    private $bindings   =   [];
    
    /**
     * Last inserted ID
     * 
     * @var int
     */
    private $lastId;
    
    /**
     * Conditions container used in SQL commands
     * 
     * @var array
     */
    private $where      =   [];
    
    /**
     * Selects container
     * 
     * @var array
     */
    private $selects    =   [];
    
    /**
     * Limit indicator
     * 
     * @var int
     */
    private $limit;
    
    /**
     * Offset
     * 
     * @var int
     */
    private $offset;
    
    /**
     * Total Rows
     * 
     * @var int
     */
    private $rows       =   0;
    
    /**
     * Joins container
     * 
     * @var array
     */
    private $joins      =   [];
    
    /**
     * Order by
     * 
     * @var array
     */
    private $orderBy    =   [];
    
    /**
     * Constructor
     * @param \System\App $app
     */
    public function __construct(App $app)
    {
        $this->app  =   $app;
        if (! $this->isConnected()) {
            $this->connect();
        }
    }
    
    /**
     * Determine if there is any connection to database
     * 
     * @return bool
     */
    private function isConnected ()
    {
        return static::$con instanceof PDO;
    }
    
    /**
     * Connect to database
     * 
     * @return void
     */
    private function connect()
    {
        $con_data    =   $this->app->file->call('config.php');
        extract($con_data);
        try {
            static::$con    =   new PDO('mysql:host=' . $server . ';dbname=' . $dbname, $user,$pass);
            static::$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            static::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            static::$con->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    /**
     * Get database connection object : PDO object
     * 
     * @return PDO
     */
    public function connection()
    {
        return static::$con;
    }
    
    /**
     * Set the table name
     * 
     * @param string $table
     * @return $this
     */
    public function table($table)
    {
        $this->table    =   $table;
        return $this;
    }
    
    /**
     * Set the table name
     * 
     * @param string $table
     * @return $this
     */
    public function from($table)
    {
        return $this->table($table);
    }
    
    /**
     * Add a new Where clause
     * 
     * @param string $bindings
     * @return $this
     */
    public function where(...$bindings)
    {
            $sql    = array_shift($bindings);
        $this->addToBindings($bindings);
        $this->where[]    =   $sql;
        return $this;
    }
    
    /**
     * Set the data that will be stored in database table
     * 
     * @param mixed $key
     * @param mixed $value
     * @return $this
     */
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
    
    /**
     * Add the given value to bindings
     * 
     * @param mixed $value
     * @return voic
     */
    private function addToBindings($value)
    {
        if (is_array($value)){
            $this->bindings =   array_merge($this->bindings, array_values($value));
        } else {
            $this->bindings[] = $value;
        }
    }
    
    /**
     * Get the last inserted ID
     * 
     * @return int
     */
    public function lastId()
    {
        return $this->lastId;
    }
    
    /**
     * Set fields for insert and update
     * 
     * @return string
     */
    private function setFields()
    {
        $sql    =   '';
        foreach (array_keys($this->data) as $key){
            $sql    .=  '`' . $key . '` = ? , ';
        }
        $sql    = rtrim($sql,', ');
        return $sql;
    }
    
    /**
     * Set select clause
     * 
     * @param string $select
     * @return $this
     */
    public function select($select)
    {
        if(is_array($select)){
            $select =   $select[0];
        }
        $this->selects[] =   $select;
        return $this;
    }
    
    /**
     * Set the join clause
     * 
     * @param string $join
     * @return $this
     */
    public function joins($join)
    {
        $this->joins[]  =   $join;
        return $this;
    }
    
    /**
     * Set limit and offset
     * 
     * @param int $limit
     * @param int $offset
     * @return $this
     */
    public function limit($limit, $offset = 0)
    {
        $this->limit    =   $limit;
        $this->offset   =   $offset;
        return $this;
    }
    
    /**
     * Set ORDER BY clause
     * 
     * @param string $orderBy
     * @param string $sort
     * @return $this
     */
    public function orderBy($orderBy, $sort =   'ASC')
    {
        $this->orderBy    =   [$orderBy, $sort];
        return $this;
    }
    
    /**
     * Prepare fetch statement
     * 
     * @return string
     */
    private function fetchStatement()
    {
        $sql    =   'SELECT ';
        if ($this->selects){
                $sql    .= implode(',', $this->selects);
        } else {
            $sql    .=  '*';
        }
            $sql    .=  ' FROM ' . $this->table . ' ';
//        }
        if ($this->joins){
            $sql    .=  implode(' ', $this->joins);
        }
        if ($this->where){
            
                $sql    .=  ' WHERE '   . implode(' ', $this->where);
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
    
    /**
     * Execute the given SQL statement 
     * 
     * @param string $bindings
     * @return \PDOStatement
     */
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
            echo '<b>' . $sql . '</b>';
            pre($this->bindings);
            die($e->getMessage());
        }
    }
    
    /**
     * Fetch table
     * This will only return one record
     * 
     * @param string $table
     * @return \stdClass / NULL
     */
    public function fetch($table = null)
    {
        if ($table){
            $this->table    =   $table;
        }
        $sql    =   $this->fetchStatement();
        $result =   $this->query($sql, $this->bindings)->fetch();
        $this->reset();
        return $result;
    }
    
    /**
     * Fetch all records from the given table
     * 
     * @param string $table
     * @return array
     */
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
    
    /**
     * Get total rows after last fetchAll statement
     * 
     * @return int
     */
    public function rows()
    {
        return $this->rows;
    }
    
    /**
     * Insert data to database
     * 
     * @param string $table
     * @return $this
     */
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
    
    /**
     * Update clause
     * 
     * @param string $table
     * @return $this
     */
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
    
    /**
     * Delete clause
     * 
     * @param string $table
     * @return $this
     */
    public function delete($table = null)
    {
        if ($table){
            $this->table    =   $table;
        }
        $sql    =   'DELETE FROM `' . $this->table . '` ';
        if ($this->where){
            $sql    .=  ' WHERE ' . implode(' ', $this->where);
        }
        $this->query($sql, $this->bindings);
        $this->reset();
        return $this;
    }
    
    /**
     * Reset all data
     * 
     * @return void
     */
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















