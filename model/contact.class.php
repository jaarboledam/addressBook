<?php
require 'db.class.php';
class Contact{
	//Declaración de variables
	private $name = null;
	private $lastname = null;
	private $phone = null;
	private $mobile = null;
	private $email = null;
	private $address = null;
	private $birthday = null;
        private $db_class = null;

        public function __construct($name,$lastname,$phone,$mobile,$email,$address,$birthday){
        $this->name = $name;
        $this->lastname = $lastname;
        $this->phone = $phone;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->address = $address;
        $this->birthday = $birthday;
        $this->db_class = new Database();
    }

    public function create(){
        $data_array = array(
            "clase" => "contacts",
            "tipo" => "create",
            "data" => array(
                "name" => $this->name,
                "lastname" => $this->lastname,
                "phone" => $this->phone,
                "mobile" => $this->mobile,
                "email" => $this->email,
                "address" => $this->address,
                "birthday" => $this->birthday
            )
        );
        
        $response = $this->db_class->executeQuery($data_array);

        return $response;
    }

    public function search(){
        $filter = null;
        $value = null;
        
        if (empty($this->name)) {
            $filter = "phone";
            $value = $this->phone;
        }  else {
            $filter = "name";
            $value = $this->name;
        }
        
        $data_array = array(
            "clase" => "contacts",
            "tipo" => "search",
            "data" => array(
                $filter => $value
            )
        );
        
        $response = $this->db_class->executeQuery($data_array);

        return $response;
    }

    public function update($data){
        $data_array = array(
            "clase" => "contacts",
            "tipo" => "update",
            "data" => json_decode($data,true)
        );
        $response = $this->db_class->executeQuery($data_array);
        return $response;
    }

    public function delete(){
        $search = $this->search();
        //$response = $this->db_class->executeQuery($data_array);
        
        return $search;
    }
}
