<?php

namespace Php7Scafold\Core;

use \PDO;
use \PDOException;

class DatabaseConnection
{
    private static $instance;
    private $db_conn;
    private $db_name = "todo";
    private $db_user = "root";
    private $db_password = "";
    private $db_host = "localhost";

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    function __construct()
    {
        try {
            $this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);

            return $this->db_conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    public function getConnection(): PDO
    {
        return $this->db_conn;
    }
}
