<?php

abstract class Model
{
    protected $dbh;
    protected $stmt;

    public function __construct()
    {
        $this->dbh = Singleton::getInstance();
        $this->dbh->query('SET NAMES UTF8');
    }
    public function query($query)
    {
        if ($this->dbh == null)
            $this->dbh = Singleton::getInstance();
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type))
        {
            switch(true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastIndexId()
    {
        return $this->dbh->lastInsertId();
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function startTransaction()
    {
        Singleton::getInstance()->beginTransaction();
    }
    public function rollBack()
    {
        Singleton::getInstance()->rollBack();
    }
    public function commit()
    {
        Singleton::getInstance()->commit();
    }
    public function close()
    {
        $this->stmt->closeCursor();
        $this->stmt = null;
        $this->dbh = null;
    }

    public function returnToPage($path)
    {
        header('Location: '.ROOT_URL.$path);
    }

}
?>