<?php

//Solicitar los archivos de clase del modelo
require '../model/user.class.php';

//Recibir los datos del formulario login
$user = trim($_POST['txtUser']);
$pwd = trim($_POST['txtPwd']);

//Validar que los campos del formulario no esten en blanco
//Si traen datos, llama el metodo user_login
if (empty($user) or empty($pwd)) {
    echo 'Todos los campos deben ser diligenciados';
} else {
    $controller = new LoginController($user, $pwd);
    $controller->user_login();
}

class LoginController {
    private $user_class = null;

    function __construct($user, $pwd) {
        $this->user_class = new User($user, $pwd);
    }

    public function user_login() {
        $user_exist = $this->user_class->login();
        echo $user_exist;//Ajax toma esta impresion
    }

}
