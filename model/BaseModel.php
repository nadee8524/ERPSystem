<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseModel
 *
 * @author Nadeeshani
 */
class BaseModel
{

    //put your code here
    protected $con;

    public function __construct()
    {
        $this->con = new mysqli("localhost", "root", "", "assignment", "3306");
    }

    public function save($element = NULL)
    {
        if (!isset($element)) {
            $element = $this;
        }

        $properties = $this->getFieldValueMap($this);

        $nonEmptyProperties = array_filter($properties, function ($v, $k) {
            return $v != NULL;
        }, ARRAY_FILTER_USE_BOTH);


        $fields = array_keys($nonEmptyProperties);
        $values = array_map(
            array($this, 'flatten'),
            array_values($nonEmptyProperties)
        );

        $fieldList = implode(",", $fields);
        $valueList = implode(",", $values);

        $tableName = get_class($element);

        $query = "INSERT INTO $tableName($fieldList)VALUES ($valueList)";
        $res = $this->con->query($query);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }

    public function update($updatedElement = NULL, $idField = 'id')
    {
        $tableName = get_class($this);

        if (!isset($updatedElement)) {
            $updatedElement = $this;
        }

        $fieldValueMap = array_map(
            array($this, 'flatten'),
            $this->getFieldValueMap($updatedElement)
        );

        $generateSqlKeyValuePairs = function ($k, $v) {
            return "$k=$v";
        };

        $valueString = implode(',', $this->array_map_asoc($generateSqlKeyValuePairs, $fieldValueMap));

        $query = "UPDATE $tableName SET $valueString WHERE "
            . "$idField='" . $this->$idField . "'";
        $res = $this->con->query($query);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }

    public function getRelationalFields($res)
    {
        $relationalFields = array();

        while ($field = $res->fetch_field()) {
            $relationalFields[$field->name] = $field->type;
        }

        return $relationalFields;
    }

    protected function select($query)
    {
        $res =  $this->con->query($query);

        if ($res->num_rows < 0) {
            return NULL;
        }

        $record = $res->fetch_assoc();

        $fields =  $this->getRelationalFields($res);

        foreach ($fields as $name => $type) {
            switch ($type) {
                case MYSQL_TYPES['DATETIME']:
                    try {
                        $this->$name = new DateTime($record[$name]);
                    } catch (Exception $ex) {
                    }
                    break;
                default:
                    $this->$name = $record[$name];
                    break;
            }
        }
        return $this;
    }

    private function getFieldValueMap($element)
    {
        $reflect = new ReflectionClass($element);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC |
            ReflectionProperty::IS_PROTECTED |
            ReflectionProperty::IS_PRIVATE);
        $values = array();

        foreach ($properties as $k) {
            if ($k->getName() === "con") {
                continue;
            }
            $k->setAccessible(true);

            $name = $k->getName();
            $val = $k->getValue($element);
            $values[$name] = $val;
            $k->setAccessible(FALSE);
        }
        return $values;
    }

    protected function exists($query)
    {
        $res = $this->con->query($query);
        return $res->num_rows > 0;
    }

    private function array_map_asoc($callback, $array)
    {
        $r = array();
        foreach ($array as $key => $value) {
            $r[$key] = $callback($key, $value);
        }
        return $r;
    }

    private function flatten($value)
    {
        switch (gettype($value)) {
            case 'object':
                switch (get_class($value)) {
                    case 'DateTime':
                        return "'" . $value->format(MYSQL_DATETIME_FORMAT) . "'";
                    default:
                }
            case 'string':
            case 'boolean':
                return "'$value'";
                break;
            case 'integer':
                return $value;
            default:
        }
    }
}
