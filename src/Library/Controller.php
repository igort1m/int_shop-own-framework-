<?php

namespace Library;

abstract class Controller
{
    protected $container;

//    делаем статичным private $layout
    private static $layout = 'default_layout.phtml';
    
    public function setContainer(Container $container)
    {
        $this->container = $container;
        
        return $this;
    }
    
    public static function setAdminLayout() //выбор админ лэйаута
    {
        self::$layout = 'admin_layout.phtml';
    }
    
    protected function render($view, array $args = array())
    {
        extract($args);
        $classname = str_replace(['Controller', '\\'], ['', DS], get_class($this));
        $classname = trim($classname, DS);
        $file = VIEW_DIR . $classname . DS . $view; //вычисляем путь к темплэйту во вьюшке
        if (!file_exists($file)) {
            throw new \Exception("Template {$file} not found");
        }

        ob_start();
        require VIEW_DIR . $classname . DS . $view;
        $content = ob_get_clean(); // середина страницы, без шапки и футера
        
        ob_start();
        require VIEW_DIR . self::$layout;
        return ob_get_clean(); // в $content рендерится вся страница с серединой, футером и шапкой
    }

}