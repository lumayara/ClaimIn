<?php

/**
 * Description of Employee
 *
 * @author Luana
 */
class Employee{
    
    private $id;
    private $username;
    private $password;

    
    function __construct($id, $username, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;              
    }
    
    public function getID() {
        return $this->id;
    }
 
    public function getUsername() {
        return $this->username;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
 
    public function setUsername($username) {
        $this->username = $username;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    
}
