<?php

namespace Library;

//прокидываем в массив в config/routes.php
class Route
{
    public $pattern;//хвост адресной строки
    public $controller;//имя контроллера
    public $action;// метод
    public $params;// доп. параметры

    public function __construct($pattern, $controller, $action, array $params = array())
    {
        $this->pattern = $pattern;
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
    }
}
