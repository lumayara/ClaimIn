<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Patient.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Insurance.class.php';

/**
 * Description of Participant
 *
 * @author Luana
 */
class Patient_Insurance {
    
    private $id;
    private $patient;
    private $insurance;
    private $start_date;
    private $expiration;
    
    function __construct($id, $patient, $insurance, $start_date, $expiration) {
        $this->id = $id;
        $this->patient = $patient;
        $this->insurance = $insurance;
        $this->start_date = $start_date;
        $this->expiration = $expiration;
    }

    public function getId() {
        return $this->id;
    }

    public function getPatient() {
        return $this->patient;
    }

    public function getInsurance() {
        return $this->insurance;
    }
    
    public function getStart_Date() {
        return $this->start_date;
    }

    public function getExpiration() {
        return $this->expiration;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function setInsurance($insurance) {
        $this->insurance = $insurance;
    }
    
    public function setStart_Date($start_date) {
        $this->start_date = $start_date;
    }

    public function setExpiration($expiration) {
        $this->expiration = $expiration;
    }
    
}
