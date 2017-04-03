<?php
namespace Library;

class Container
{
    //содержит сущности сервисов (DbConnection, Repository, Router etc)
    private $services=array();

    public function get($key)
    {
        if (!$this->services[$key]){
            throw new \Exception("$key not found", 500);//выбрасываем ошибку если не найден сервис
        }
        return $this->services[$key];
    }

    public function set($key, $object)
    {
        $this->services[$key]=$object;
    }
}