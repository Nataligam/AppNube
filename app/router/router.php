<?php

include_once "./app/controller/user.php";
include_once "./app/controller/proyecto.php";


class Router
{

    private $user;
    private $proyecto;

    public function __construct(){
        $this->user = new User();
        $this->proyecto=new Proyecto();

    }

    public function router()
    {

        if (isset($_GET["mode"])) {
            if (isset($_SESSION["user_id"])) {

                switch ($_GET["mode"]) {

                    case "cerrar-sesion":
                        session_destroy();
                        header("Location:index.php");
                        break;

                    case "proyectos":
                        $this->proyecto->cargarHtmlProyectos();
                        break;

                    case "riesgos":
                    if(isset($_GET['id'])){
                        $this->proyecto->cargarRiesgosHtml($_GET['id']);
                    }else{
                        $this->proyecto->cargarHtmlProyectos();
                    }
                        break;
                    default:
                        header("Location:index.php");
                        break;
                }
            }else{
                $this->user->inicioSesion();
            }
        } else if (isset($_POST["mode"])) {
            switch ($_POST["mode"]) {
                case "login":
                    $this->user->login($_POST["username"], $_POST["password"]);
                    break;

                case "registrar-proyecto":
                    $this->proyecto->registrarProyecto($_POST["nombre-proyecto"], $_POST["gerente-proyecto"]);
                    break;

                case "obtener-cantidad-pag-tabla-proyecto":
                    $this->proyecto->obtenerCantPag($_POST['busqueda']);
                    break;
                    
                case "cargar-proyecto-pagina":
                    $this->proyecto->cargarProyectosPagina($_POST['busqueda'],$_POST['pagina']);
                    break;

                case "borrar-proyecto":
                    $this->proyecto->borrarProyecto($_POST['id_proyecto']);
                    break;

                case "registrar-riesgo":
                    $this->proyecto->registrarRiesgo($_POST['id_proyecto'], $_POST['riesgo'],$_POST['causas'],$_POST['efectos'],$_POST['como_impacta'],$_POST['impacto'],$_POST['probabilidad']);
                    break;

                case "cargar-riesgos":
                    $this->proyecto->cargarRiesgos($_POST['id_proyecto']);
                    break;

                case "borrar-riesgo":
                $this->proyecto->borrarRiesgo($_POST['id_proyecto'], $_POST['id_riesgo']);
                    break;

                case "registrar-respuesta-riesgo":
                $this->proyecto->registrarRespuestaRiesgo($_POST['id_proyecto'], $_POST['id_riesgo'],$_POST['acciones'],$_POST['responsable'],$_POST['cronograma'],$_POST['indicador']);
                    break;

            default:
                    header("Location:index.php");
                    break;
            }
        } else {
           if (isset($_SESSION["user_id"])) {
                $this->proyecto->cargarHtmlProyectos();
           }else{
                $this->user->inicioSesion();
           }
        }
    }


}

?>