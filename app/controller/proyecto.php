<?php

include_once "./app/controller/controller.php";
include_once "./app/model/proyecto.php";
class Proyecto extends Controller {

    private $view;
    private $num_proyectos_pagina;
    private $proyectoModel;


    public function __construct() {
        $this->view = $this->getTemplate("./app/views/index.html");
        $this->num_proyectos_pagina=8;
        $this->proyectoModel=new ProyectoModel();
    }

    public function cargarHtmlProyectos() {
        $proyectoHtml = $this->getTemplate("./app/views/proyecto/proyecto.html");
        $this->view = $this->renderView($this->view, "{{TITULO}}","Proyectos");
        $this->view = $this->renderView($this->view, "{{CONTENIDO}}", $proyectoHtml);
        $this->showView($this->view);            
    }

    public function registrarProyecto($nombreProyecto, $gerenteProyecto){

        $rel=$this->proyectoModel->registrarProyecto($nombreProyecto, $gerenteProyecto);
        echo $rel;
    }

    public function obtenerCantPag($busqueda){
        $cantReg=$this->proyectoModel->obtenerCantPag($busqueda);
        $totalPaginas=ceil($cantReg/$this->num_proyectos_pagina);
        echo $totalPaginas;
    }

    public function cargarProyectosPagina($busqueda, $pagina){
        $inicio=($pagina-1)*$this->num_proyectos_pagina;
        $array=$this->proyectoModel->cargarProyectosPagina($busqueda, $inicio,$this->num_proyectos_pagina);
        echo json_encode($array);
    }


    public function borrarProyecto($id_proyecto){
        $rel=$this->proyectoModel->borrarProyecto($id_proyecto);
        echo $rel;
    }

    public function cargarRiesgosHtml($id_proyecto){
        $proyectoHtml = $this->getTemplate("./app/views/riesgos/riesgos.html");
        $proyecto=$this->proyectoModel->cargarInfoProyecto($id_proyecto);
        $proyectoHtml = $this->renderView($proyectoHtml, "{{ID_PROYECTO}}",$id_proyecto);
        $proyectoHtml = $this->renderView($proyectoHtml, "{{NOMBRE_PROYECTO}}",$proyecto['nombre']);
        $proyectoHtml = $this->renderView($proyectoHtml, "{{GERENTE}}",$proyecto['gerente']);
        $proyectoHtml = $this->renderView($proyectoHtml, "{{FECHA_REGISTRO}}",$proyecto['fecha_registro']);
        $this->view = $this->renderView($this->view, "{{TITULO}}","Identificación De Riesgos");
        $this->view = $this->renderView($this->view, "{{CONTENIDO}}", $proyectoHtml);
        $this->showView($this->view);  
    }

    public function registrarRiesgo($id_proyecto,$riesgo,$causas,$efectos,$como_impacta,$impacto,$probabilidad){
        $rel=$this->proyectoModel->registrarRiesgo($id_proyecto,$riesgo,$causas,$efectos,$como_impacta,$impacto,$probabilidad);
        echo $rel;
    }

    public function cargarRiesgos($id_proyecto){
        $array=$this->proyectoModel->cargarRiesgos($id_proyecto);
        echo json_encode($array);
    }
   

    public function borrarRiesgo($id_proyecto, $id_riesgo){
        $rel=$this->proyectoModel->borrarRiesgo($id_proyecto,$id_riesgo);
        echo $rel;
    }

    public function registrarRespuestaRiesgo($id_proyecto, $id_riesgo,$acciones,$responsable,$cronograma,$indicador){
        $rel=$this->proyectoModel->registrarRespuestaRiesgo($id_proyecto, $id_riesgo,$acciones,$responsable,$cronograma,$indicador);
        echo $rel;
    }


}

?>