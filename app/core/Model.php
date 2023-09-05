<?php

declare(strict_types=1);

namespace Model;

use Core\Database;

defined("ROOT") or dd("Direct script access denied");

class Model extends Database
{
    public $order           = "desc";
    public $order_column    = "id";
    public $primary_key     = "id";

    public $limit           = 10;
    public $offset          = 0;
    public $errors          = [];

    public function where(array $in_array = [], array $not_in_array, string $data_type = "object"): array|bool
    {
        $query = "SELECT * FROM $this->table WHERE ";

        if (!empty($in_array)) {
            foreach ($in_array as $key => $value) {
                $query .= $key . "= :" . $key . "&& ";
            }
        }

        if (!empty($not_in_array)) {
            foreach ($not_in_array as $key => $value) {
                $query .= $key . "!= :" . $key . "&& ";
            }
        }

        $query = trim($query, " && ");
        $query .= " ORDER BY $this->order_column $this->order LIMIT $limit offset $offset";

        $data = array_merge($in_array, $not_in_array);

        return $this->query($query, $data);
    }

    public function first(array $in_array = [], array $not_in_array, string $data_type = "object"): array|bool
    {
        $rows = $this->where($in_array, $not_in_array, $data_type);

        if (!empty($rows)) {
            return $rows[0];
        }

        return false;
    }

    public function getAll(string $data_type = "object"): array|bool
    {
        $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order LIMIT $limit offset $offset";

        return $this->query($query, [], $data_type);
    }

    public function insert(array $data)
    {
        if(!empty($this->allowedInsertColumns)) {
            foreach($data as $key => $value) {
                if(!in_array($key, $this->allowedInsertColumns)) {
                    unset($data[$key]);
                }
            }
        }

        if (!empty($data)) {
            $keys = array_keys($data);

            $query = "INSERT INTO $this->table (".implode(",", $keys).") VALUES (:".implode(",:", $keys).")";
            return $this->query($query,$data);
        }
        return false;
    }

    public function update(string|int $v_id, array $data)
    {
        if(!empty($this->allowedUpdateColumns)) {
            foreach($data as $key => $value) {
                if(!in_array($key, $this->allowedUpdateColumns)) {
                    unset($data[$key]);
                }
            }
        }
        
        if (!empty($data)) {
            $query = "UPDATE $this->table SET ";

            foreach($data as $key => $value) {
                $query .= $key . "= :" . $key . ",";
            }

            $query = trim($query, ",");
            $data["v_id"] = $_v_id;
            $query .= "WHERE $this->primary_key = :v_id";

            return $this->query($query,$data);
        }
        return false;
    }

    public function delete(string|int $v_id)
    {   
        $query = "DELETE FROM $this->table ";

        $query .= "WHERE $this->primary_key = :v_id LIMIT 1";

        return $this->query($query);
    }
}
