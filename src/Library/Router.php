<?php

namespace Library;

class Router
{
    private $routes;
    private $currentRoute;
    
    public function __construct($file)
    {
        //при создании обьекта Router берёт роуты из config/routes.php
        // - прокидывает в приватную $routes. TODO: принимать не файл.php а $config(в нем распарсенные файлы.) Перебор массива в конструкторе, создание роута.

        $this->routes = require $file;
    }
    
    public function getCurrentRoute()
    {
        return $this->currentRoute;
    }
    
    /**
     * @param $uri
     * @return bool
     */
    private function isAdminUri($uri)
    {
        return strpos($uri, '/admin') === 0;
    }
    
    public function match(Request $request)
    {
        $uri = $request->getUri(); // берем URL из адресной строки
        
        if ($this->isAdminUri($uri)) {
            Controller::setAdminLayout(); // проверка на админку
        }
        
        foreach ($this->routes as $route) { // перебор роутов
            $pattern = $route->pattern;
            
            foreach ($route->params as $key => $value) {
                $pattern = str_replace('{' . $key . '}', "($value)", $pattern); // тут меняется то что в фигурных скобках на регулярку
            }
            
            $pattern = '@^' . $pattern . '$@'; // @ - delimiter, @^book-([0-9]+)\.html$@ //запись регулярного выражения в переменную
            
            if (preg_match($pattern, $uri, $matches)) { // preg_match отдает 0 (нет соответствия) или  1 (есть соостветсвие в массиве)
                $this->currentRoute = $route;
                array_shift($matches);
                $getParams = array_combine(array_keys($route->params), $matches);
                $request->mergeGet($getParams); //передача в глобальный гет id книги
                
                break;
            }
        }
        
        if (!$this->currentRoute) {
            throw new \Exception('Page not found', 404);
        }
    }
    
    public function getUri($routeName, array $params = array())
    {

        // todo сгенерировать Uri - обратное действие
    }
    
    public function redirect($to)
    {
        header('Location: ' . $to);
        die;
    }
}