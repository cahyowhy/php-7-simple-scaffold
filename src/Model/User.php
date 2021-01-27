<?php

namespace Php7Scafold\Model;

use Php7Scafold\Model\Model;

class User extends Model
{

    public $table_name = "users";

    public $fields = ["username", "password", "ip_address", "reg_date", "reg_time"];

    function login($username, $password)
    {
        return $this->count(array("username" => $username, "password" => $password));
    }
}
