<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 19.03.16
 * Time: 12:54
 */

namespace core;

/**
 * Class Model
 * Model with base fuctnion for model
 *
 * @package core
 */
class Model
{
    private $fields = array();
    private $keyField = array();
    private $db = null;

    public function __construct()
    {
        $this->db = ServiceLocator::get('serv:db');
    }

    /**
     * @param $q query
     *           execute select query
     *
     * @return mixed return result of query
     */
    public function executeSelectQuery($q)
    {
        $statement = $this->db->prepare($q);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * execute update query inseparated transaction
     *
     * @param $q query
     *
     * @return mixed return result of execution
     */
    public function executeUpdateQuery($q)
    {
        $this->db->beginTransaction();
        $statement = $this->db->prepare($q);
        $statement->execute();
        $this->db->commit();
        return $statement;
    }

    /**
     * get Item
     *
     * @return mixed one record from table
     */
    public function getItem()
    {
        $statement = $this->buildSelectQuery();
        $statement->execute();
        return $statement->fetch();
    }

    /**
     * get list of items
     *
     * @return mixed all records from table
     */
    public function getList()
    {
        $statement = $this->buildSelectQuery();
        $statement->execute();
        $row = $statement->fetchAll();
        return $row;
    }

    /**
     * get table nafe ustin name of Class
     *
     * @return string name of table
     */
    public function getTableName()
    {
        $reflection = new \ReflectionClass($this);
        return strtolower($reflection->getShortName());
    }

    /**
     * set field to mode
     *
     * @param $name  field name
     * @param $value field value
     *
     * @return $this model
     */
    public function __set($name, $value)
    {
        $this->fields[$name] = $value;
        return $this;
    }

    /**
     * get model field by name
     *
     * @param $name name of field
     *
     * @return field name
     */
    public function __get($name)
    {
        if (isset($this->fields[$name])) {
            return $this->fields[$name];
        } else {
            return null;
        }
    }

    /**
     * build selection query
     *
     * @return mixed statement for execution
     */
    private function buildSelectQuery()
    {
        $q = "SELECT * FROM ".$this->getTableName().' ';
        if (sizeof($this->fields) != 0) {
            if (isset($this->fields[$this->keyField])) {
                $q .= 'WHERE '.$this->getTableName().'_'.$this->keyField.' = '.$this->fields[$this->keyField];
                $statement = $this->db->prepare($q);
            } else {
                $q .= ' WHERE 1 = 1';
                foreach ($this->fields as $k => $v) {
                    $q .= 'AND '."$k = :$k";
                }
                $statement = $this->db->prepare($q);
                foreach ($this->fields as $k => $v) {
                    $statement->bindParam(':'.$k, $v);
                }
            }
        }
        $statement = $this->db->prepare($q);
        return $statement;
    }
}