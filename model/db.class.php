<?php

class Database {

    //Declaración de variables
    private $file_json = null;
    private $data = null;

    function __construct() {
        $this->file_json = file_get_contents("../db/data.json");
        $this->data = json_decode($this->file_json, true);
    }

    public function executeQuery($data_array) {

        $response = null;

        if ($data_array["clase"] == "users" && $data_array["tipo"] == "login") {
            $exist = false;
            $i = 0;
            $user = $data_array["data"]["usr"];
            $pass = $data_array["data"]["pwd"];

            while (!$exist and $i < count($this->data["users"])) {
                $json_user = $this->data["users"][$i]["usr"];
                $json_pwd = $this->data["users"][$i]["pwd"];

                if ($user == $json_user && $pass == $json_pwd) {
                    $exist = true;
                }
                $i++;
            }
            $response = $exist;
        } else if ($data_array["clase"] == "contacts") {
            switch ($data_array["tipo"]) {
                case "create":
                    try {
                        $length = count($this->data["contacts"]);
                        $this->data["contacts"][$length]["id"] = "cnt".$length;
                        $this->data["contacts"][$length]["name"] = $data_array["data"]["name"];
                        $this->data["contacts"][$length]["lastname"] = $data_array["data"]["lastname"];
                        $this->data["contacts"][$length]["phone"] = $data_array["data"]["phone"];
                        $this->data["contacts"][$length]["mobile"] = $data_array["data"]["mobile"];
                        $this->data["contacts"][$length]["email"] = $data_array["data"]["email"];
                        $this->data["contacts"][$length]["address"] = $data_array["data"]["address"];
                        $this->data["contacts"][$length]["birthday"] = $data_array["data"]["birthday"];
                        //Abre el archivo json en modo escritura
                        $file = fopen("../db/data.json", 'w') or die("Error al abrir el archivo");
                        //Almacena la matriz data en formato json
                        //JSON_UNESCAPED_UNICODE -> Evita que se conviertan los caracteres especiales y los deja en UTF-8
                        fwrite($file, json_encode($this->data));
                        fclose($file);
                        
                        $response = "Creado correctamente";
                    } catch (Exception $exc) {
                        $response = $exc->getTraceAsString();
                        $response = "Error";
                    }
                    break;
                case "search":
                    $exist = false;
                    $i = 0;
                    $filter = key($data_array["data"]);
                    $value = $data_array["data"][$filter];
                    $contact_data = array();

                    while ($i < count($this->data["contacts"])) {
                        $json_value = $this->data["contacts"][$i][$filter];

                        if ($value == $json_value) {
                            array_push($contact_data, $this->data["contacts"][$i]);
                        }
                        $i++;
                    }
                    $response = $contact_data;
                    break;
                case "update":
                    try {
                        for ($i = 0; $i < count($data_array["data"]); $i++) {
                            $str = $data_array["data"][$i]["id"];
                            $index = (int)substr($str,3, strlen($str));
                            $this->data["contacts"][$index]["name"] = $data_array["data"][$i]["name"];
                            $this->data["contacts"][$index]["lastname"] = $data_array["data"][$i]["lastname"];
                            $this->data["contacts"][$index]["phone"] = $data_array["data"][$i]["phone"];
                            $this->data["contacts"][$index]["mobile"] = $data_array["data"][$i]["mobile"];
                            $this->data["contacts"][$index]["email"] = $data_array["data"][$i]["email"];
                            $this->data["contacts"][$index]["address"] = $data_array["data"][$i]["address"];
                            $this->data["contacts"][$index]["birthday"] = $data_array["data"][$i]["birthday"];
                        }
                        //Abre el archivo json en modo escritura
                        $file = fopen("../db/data.json", 'w') or die("Error al abrir el archivo");
                        //Almacena la matriz data en formato json
                        fwrite($file, json_encode($this->data));
                        fclose($file);
                        
                        $response = "La actualizacion se ha realizado correctamente";
                    } catch (Exception $exc) {
                        $response = $exc->getTraceAsString();
                    }
                    break;
                case "delete":
                    break;
                default:
                    break;
            }
        }
        return $response;
    }

    public function closeConnection() {
        fclose($this->file);
    }

}
