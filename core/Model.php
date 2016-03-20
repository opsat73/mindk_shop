<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 19.03.16
 * Time: 12:54
 */

namespace core;

class Model
{
    private $fields = array();
    private $keyField = array();
    private $db = null;

    public function __construct()
    {
        $this->db = ServiceLocator::get('serv:db');
    }

    public function executeSelectQuery($q) {
        $statement = $this->db->prepare($q);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function executeUpdateQuery($q) {
        $this->db->beginTransaction();
        $statement = $this->db->prepare($q);
        $statement->execute();
        $this->db->commit();
        return $statement;
    }

    public function getItem() {
        $statement = $this->buildSelectQuery();
        $statement->execute();
        return $statement->fetch();
    }

    public function getList() {
        $statement = $this->buildSelectQuery();
        $statement -> execute();
        $row = $statement->fetchAll();
        return $row;
    }

    public function getTableName() {
        $reflection = new \ReflectionClass($this);
        return strtolower($reflection->getShortName());
    }

    public function save() {
    }

    public function delete() {
    }

    public function __set($name, $value) {
        $this->fields[$name] = $value;
        return $this;
    }

    public function __get($name)
    {
        if (isset($this->fields[$name])) {
            return $this->fields[$name];
        } else {
            return null;
        }
    }

    private function buildSelectQuery() {
        $q = "SELECT * FROM ". $this->getTableName().' ';
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