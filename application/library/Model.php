<?php

require_once(__DIR__ . "/../conf/database.php");

class Model {

    protected $_db = False;

    public function __construct() 
    {
        $mysqli = new mysqli (DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->_db = new MysqliDb ($mysqli);

        $this->Response = new Response();
    }

}
