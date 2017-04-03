<?php

namespace Library;

abstract class EntityRepository // абстрактный класс для моделей репозиториев, которые работают с БД
{
    protected $pdo;
    
    public function setPDO(\PDO $pdo)
    {
        $this->pdo = $pdo;
        
        return $this;
    }
}