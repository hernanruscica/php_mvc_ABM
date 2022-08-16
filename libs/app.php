<?php

require_once 'controllers/error.php';

class App{
    function __construct(){
        //echo "Nueva App ";
        $url = $_GET['url'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);  
        $nombreController = $url[0];
        $nombreMetodo = isset($url[1]) ? $url[1] : null;
        //var_dump($url);
        $archivoController = 'controllers/' . $nombreController . '.php';
        //echo $archivoController;

        if (file_exists($archivoController)){
            require_once $archivoController;
            $controller = new $nombreController;

            if (isset($nombreMetodo)){
                //echo 'tiene un metodo : ';
                //echo $nombreMetodo;
                $controller->{$nombreMetodo}();
            }else{
                //echo 'No tiene un metodo';
                $controller = new ErrorPersonalizado();
            }
        }else{
            $controller = new ErrorPersonalizado();
        }

        
    }
}

?>