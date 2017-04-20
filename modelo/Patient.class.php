<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Insurance.class.php';

/**
 * Description of Participant
 *
 * @author Luana
 */
class Patient {
    
    private $id;
    private $name;
    private $email;
    private $password;
    private $birthDate;
    private $gender;
    
    function __construct($id, $name, $email, $password, $birthDate, $gender) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getBirthdate() {
        return $this->birthDate;
    }

     public function getGender() {
        return $this->gender;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }
    
    public function setGender($gender) {
        $this->gender = $gender;
    }

    
}
