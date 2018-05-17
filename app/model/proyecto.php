<?php
require_once "./app/model/model.php";

class ProyectoModel extends Model {


    public function registrarProyecto($nombreProyecto, $nombreGerente){
        $this->connect();
        $insert = "INSERT INTO proyecto (nombre, gerente) values ('$nombreProyecto', '$nombreGerente')";
        $query = $this->query($insert);
        $this->terminate();
        return $query;
    }

    public function obtenerCantPag($busqueda){
        $this->connect();
        $consulta="SELECT count(*) total from proyecto where nombre like '%$busqueda%'";
        $total=mysqli_fetch_array($this->query($consulta));
        $this->terminate();
        return $total['total'];
    }

    public function cargarProyectosPagina($busqueda,$inicio, $num_proyecto_pagina){
        $array= array();
        $this->connect();
        $consulta="SELECT nombre, id_proyecto, gerente, fecha_registro from proyecto where nombre like '%$busqueda%' limit $inicio,$num_proyecto_pagina";  
        $consulta=$this->query($consulta);
         while($row = mysqli_fetch_array($consulta)){
            array_unshift($array, $row);
        }
        $this->terminate();
        return $array;
    }


   public function  borrarProyecto($id_proyecto){
    $this->connect();
    $delete = "delete from proyecto where id_proyecto=$id_proyecto";
    $query = $this->query($delete);
    $this->terminate();
    return $query;
   }

   public function registrarRiesgo($id_proyecto,$riesgo,$causas,$efectos,$como_impacta,$impacto,$probabilidad){
    $this->connect();
    $causas=nl2br($causas);
    $efectos=nl2br($efectos);
    $insert = "INSERT INTO riesgo (id_proyecto,riesgo,causas,efectos,como_impacta,impacto,probabilidad) values ('$id_proyecto','$riesgo','$causas','$efectos','$como_impacta',$impacto,$probabilidad)";
    $query = $this->query($insert);
    $this->terminate();
    return $query;
   }

   public function cargarRiesgos($id_proyecto){
    $array= array();
    $this->connect();
    $consulta="SELECT id_proyecto, id_riesgo, riesgo,causas,efectos,como_impacta,impacto,probabilidad,(impacto*probabilidad) total, acciones, responsable, cronograma, indicador from riesgo where id_proyecto=$id_proyecto";  
    $consulta=$this->query($consulta);
     while($row = mysqli_fetch_array($consulta)){
        array_push($array, $row);
    }
    $this->terminate();
    return $array;
}

public function cargarRiesgoID($id_proyecto, $id_riesgo){
    $array= null;
    $this->connect();
    $consulta="SELECT id_proyecto, id_riesgo, riesgo,causas,efectos,como_impacta,impacto,probabilidad,(impacto*probabilidad) total, acciones, responsable, cronograma, indicador from riesgo where id_proyecto=$id_proyecto and id_riesgo=$id_riesgo";  
    $consulta=$this->query($consulta);
     while($row = mysqli_fetch_array($consulta)){
       $array=$row;
    }
    $this->terminate();
    return $array;
}

  public function cargarInfoProyecto($id_proyecto){
    $array=null;
    $this->connect();
    $consulta="SELECT * from proyecto where id_proyecto=$id_proyecto";  
    $consulta=$this->query($consulta);
     while($row = mysqli_fetch_array($consulta)){
        $array=$row;
    }
    $this->terminate();
    return $array;
  }

  public function borrarRiesgo($id_proyecto, $id_riesgo){
    $this->connect();
    $delete = "delete from riesgo where id_proyecto=$id_proyecto and id_riesgo=$id_riesgo";
    $query = $this->query($delete);
    $this->terminate();
    return $query;
}

public function registrarRespuestaRiesgo($id_proyecto, $id_riesgo,$acciones,$responsable,$cronograma,$indicador){
    $this->connect();
    $acciones=nl2br($acciones);
    $update = "UPDATE  riesgo set acciones='$acciones', responsable='$responsable', cronograma='$cronograma', indicador='$indicador' where id_proyecto=$id_proyecto and id_riesgo=$id_riesgo";
    $query = $this->query($update);
    $this->terminate();
    return $query;
}

}

?>