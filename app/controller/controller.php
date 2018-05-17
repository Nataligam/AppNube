<?php

class Controller {
    
    public function getTemplate($route){
        return file_get_contents($route);
    }

    public function showView($view){
        echo $view;
    }

    public function renderView($ubicacion, $cadenaReemplazar, $reemplazo){
        return str_replace($cadenaReemplazar, $reemplazo, $ubicacion);
    }


}
?>