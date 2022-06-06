<?php

class Singleton
{
    private static $instance = null;
    private $dbname;
    private $dbuser;
    private $dbpdo;

    private function __construct()
    {
        try
        {
            $this->dbpdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD);
            $this->dbname = DB_NAME;
            $this->dbuser = DB_USER;
        }
        catch (PDOException $e)
        {
            print "Unable to connect to the database ".DB_NAME."<br/>";
            print $e->getMessage()."<br/>";
            die();
        }
    }

    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new Singleton();
        }
        return self::$instance->dbpdo;
    }
}


?>