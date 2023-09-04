<?php

declare(strict_types=1);

namespace Core;

use PDO;
use PDOException;

defined("ROOT") or dd("Direct script access denied");

class Database
{
    private static string $query_id = "";

    private function connect()
    {
        $VARS['DB_NAME']       = DB_NAME;
        $VARS['DB_USER']       = DB_USER;
        $VARS['DB_PASSWORD']   = DB_PASSWORD;
        $VARS['DB_HOST']       = DB_HOST;
        $VARS['DB_DRIVER']     = DB_DRIVER;

        $VARS = do_filter("before_db_connect", $VARS);

        $conn_string = "$VARS[DB_DRIVER]:hostname=$VARS[DB_HOST];dbname=$VARS[DB_NAME]";
        try {
            $conn = new PDO($conn_string, $VARS['DB_USER'], $VARS['DB_PASSWORD']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            dd("Failed to connect to database with error " . $e->getMessage());
        }
        return $conn;
    }

    public function query(string $query, array $data = [], string $data_type = 'object')
    {
        $query = do_filter("before_query", $query);

        $data = do_filter("before_query_data", $data);

        $conn = $this->connect();

        $stmt = $conn->prepare($query);

        $results = $stmt->execute($data);

        if($results) {
            if($data_type === 'object') {
                $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        $arr = [];
        $arr["query"] = $query;
        $arr["data"] = $data;
        $arr["result"] = $rows ?? [];
        $arr["query_id"] = self::$query_id;

        /**
         * Empty query_id once used once.
         */
        self::$query_id = "";

        $result = do_filter("after_query", $arr);

        if(is_array($result) && count($result) > 0) {
            return $result;
        }

        return false;
    }

    public function get_row(string $query, array $data = [], string $data_type = 'object')
    {
        $result = $this->query($query, $data, $data_type);

        if(is_array($result) && count($result) > 0) {
            return $result[0];
        }

        return false;
    }
}