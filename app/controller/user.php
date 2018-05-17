<?php

include_once "./app/controller/controller.php";
include_once "./app/model/user.php";

class User extends Controller {

    private $userModel;
    private $view;


    public function __construct() {
        $this->userModel = new UserModel();
        $this->view = $this->getTemplate("./app/views/index.html");
    }


    public function inicioSesion() {
        $login = $this->getTemplate("./app/views/login.html");
        $this->showView($login);
    }

    public function login($user, $password) {
        $pass = sha1($password);
        $log = $this->userModel->login($user, $pass);
        echo $log;
    }
}

?>