<?php

//Solicitar los archivos de clase del modelo
require '../model/contact.class.php';

$form = filter_input(INPUT_POST, 'form');
$data = filter_input(INPUT_POST, 'data');
$name = trim(filter_input(INPUT_POST, 'txtName', FILTER_SANITIZE_STRING));
$lastname = trim(filter_input(INPUT_POST, 'txtLastName', FILTER_SANITIZE_STRING));
$phone = trim(filter_input(INPUT_POST, 'txtPhone', FILTER_SANITIZE_NUMBER_INT));
$mobile = trim(filter_input(INPUT_POST, 'txtMobile', FILTER_SANITIZE_NUMBER_INT));
$email = trim(filter_input(INPUT_POST, 'txtEmail', FILTER_VALIDATE_EMAIL));
$address = filter_input(INPUT_POST,'txtAddress');
$birthday = filter_input(INPUT_POST,'txtBirthday');

//Validar desde que formulario se hizo el submit
if (!empty($form)) {
    $controller = new MainController($name, $lastname, $phone, $mobile, $email, $address, $birthday);
    switch ($form) {
        case "frmCreateContact":
            //Validar que los campos requeridos no esten en blanco
            if (empty($name) or empty($phone)) {
                echo 'Para agregar un contacto debe ingresar al menos un nombre y un teléfono!';
            }else{
                $contact = $controller->contact_create();
            }
            break;
        case "frmSearchContact":
            $contact = $controller->contact_search();
            echo $contact;
            break;
        case "frmUpdateContact":
            $contact = $controller->contact_search();
            echo $contact;
            break;
        case "frmExecUpdate":
            $contact = $controller->contact_update($data);
            echo $contact;
            break;
        case "frmDeleteContact":
            $contact = $controller->contact_delete();
            echo $contact;
            break;
        default:
            # code...
            break;
    };
}

class MainController{
    private $contact_class = null;
    
    function __construct($name, $lastname, $phone, $mobile, $email, $address, $birthday) {
        $this->contact_class = new Contact($name, $lastname, $phone, $mobile, $email, $address, $birthday);
    }

    public function contact_create() {
        $response = $this->contact_class->create();
        echo $response;
    }
    
    public function contact_search() {
        $response = $this->contact_class->search();
        $js_object = json_encode($response);
        echo $js_object;
    }
    
    public function contact_update($data) {
        $response = $this->contact_class->update($data);
        $js_object = json_encode($response);
        echo $js_object;
    }
    
    public function contact_delete() {
        $response = $this->contact_class->delete();
        $js_object = json_encode($response);
        echo $js_object;
    }
}
