<?php

namespace Library;

class RepositoryManager
{
    private $pdo;
    private $repositories = array();
    
    public function setPDO(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $pdo->exec("set names utf8");// хардкодим кодировку для PDO TODO: check (чтоб не было иероглифов?)

        return $this;
    }

    public function getRepository($entity) // 'Book' => BookRepository
    {
        if (empty($this->repositories[$entity])) {
            $repository = "\\Model\\Repository\\{$entity}Repository";
            // todo: create specific exception if file not found
            $repository = new $repository();
            $repository->setPDO($this->pdo);
            $this->repositories[$entity] = $repository;
        }
        
        return $this->repositories[$entity];
    }
}