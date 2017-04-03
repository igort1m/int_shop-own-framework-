<?php

namespace Library;

class DbConnection // класс выполняет подключение к БД согласно данных из Library/Config.php
{
    private $pdo;
    
    public function __construct(Config $config)
    {
        $dsn = 'mysql: host=' . $config->dbhost . '; dbname='. $config->dbname;    
        $this->pdo = new \PDO($dsn, $config->dbuser, $config->dbpass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    
    public function getPDO()
    {
        return $this->pdo;
    }
}