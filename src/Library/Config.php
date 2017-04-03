<?php

namespace Library;

class Config
{
    public function __construct()
    {
            //конф. файл xml в обьект со свойствами и значениями согласно тегам
            $file = CONFIG_DIR . 'db.xml';
            $xmlObject = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOWARNING);
            // проверка. если не xml выбрасываем ошибку
            if (!$xmlObject) {
                throw new \Exception('Config file not found');
            }

            //создание метода на лету
            foreach ($xmlObject as  $key => $value) {
                $this->$key = (string)$value;
            }
    }

//    обработка вызова несуществующего свойства
    public function __get($name)
    {
        throw new \Exception('Param not found');
    }
}
