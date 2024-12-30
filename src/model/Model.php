<?php

namespace App\model;

defined("ROOTPATH") or exit("access Denied");


use App\core\Db;

abstract class Model
{
    private $db;

    protected $limit         = 10;
    protected $offset         = 0;
    protected $order_type     = "desc";
    protected $order_column = "id";
    public $errors         = [];


    /**
     * function whitch prepare query if values is not null
     *
     * @param string $query
     * @param array $values
     * @return void
     */
    public function querys(string $query,  $values = [])
    {
        $this->db = Db::getInstance();
        if (!is_null($values)) {
            $response = $this->db->prepare($query);
            $response->execute($values);
            return $response;
        } else {
            $response = $this->db->query($query);
            return $response;
        }
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }
    /**
     * function to insert thinks in database
     *
     * @return void
     */
    public function insert($data)
    {
        /** remove unwanted data **/
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {

                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
        $this->querys($query, $data);

        return false;
    }

    public function findAll()
    {

        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        return $this->querys($query);
    }


    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        return $this->querys($query, $data);
    }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $query .= " limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        $result = $this->querys($query, $data);
        if ($result)
            return $result[0];

        return false;
    }

    public function update($id, $data, $id_column = 'id')
    {

        /** remove unwanted data **/
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {

                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = trim($query, ", ");

        $query .= " where $id_column = :$id_column ";

        $data[$id_column] = $id;

        $this->querys($query, $data);
        return false;
    }


    public function delete($id, $id_column = 'id')
    {

        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column ";
        $this->querys($query, $data);

        return false;
    }
}
