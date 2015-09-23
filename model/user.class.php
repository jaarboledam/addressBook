<?php
require 'db.class.php';
class User{
    //Declaración de variables
    private $file_json = null;
    private $data = null;
    private $user = null;
    private $pwd = null;
    private $db_class = null;
    
    /* Al ser instanciado un objeto de la clase, 
     * carga el archivo json que contiene los datos
       e inicializa variables, recibe user y pwd del form*/ 
    public function __construct($user,$pwd){
        $this->file_json = file_get_contents("../db/data.json");
        $this->data = json_decode($this->file_json,true);
        $this->db_class = new Database();
        $this->user = $user;
        $this->pwd = $pwd;
    }
    
    //Retorna true = 1 si existe de lo contrario false = 0
    public function login() {
        $data_array = array(
            "clase" => "users",
            "tipo" => "login",
            "data" => array(
                "usr" => $this->user,
                "pwd" => $this->pwd
            )
        );
        
        $response = $this->db_class->executeQuery($data_array);
        
        if ($response){
            session_start();
            $_SESSION['login'] = $this->user;
        }
        return $response;
    }
    
    /*public function newUser() {
        $exist = $this->login();
        $length = count($this->data["users"]);
        if ($exist) {
            echo 'EL usuario ya existe';
        }else{
            $this->data["users"][$length]["usr"] = $this->user;
            $this->data["users"][$length]["pwd"] = $this->pwd;
            //Abre el archivo json en modo escritura
            $file = fopen("../db/data.json", 'w') or die("Error al abrir el archivo");
            //Almacena la matriz data en formato json
            //JSON_UNESCAPED_UNICODE -> Evita que se conviertan los caracteres especiales y los deja en UTF-8
            fwrite($file, json_encode($this->data, JSON_UNESCAPED_UNICODE));
            fclose($file);
            echo 'Usuario creado en la posicion '.$length;
        }
    }
    
    public function updateUser() {
        
    }
    
    public function searchUser() {
        
    }
    
    public function deleteUser() {
        
    }*/
}

