<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Patient.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Hospital.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Insurance.class.php';
/**
 * Description of TestParticipant
 *
 * @author Luana
 */
class Billing {
    
    private $id;
    private $patient;
    private $hospital;
    private $insurance;
    private $registrationDate;
    private $status;
    private $amount;
    
    function __construct($id, $patient, $hospital, $insurance, $registrationDate, $status, $amount) {
        $this->id = $id;
        $this->patient = $patient;
        $this->hospital = $hospital;
        $this->insurance = $insurance;
        $this->registrationDate = $registrationDate;
        $this->status = $status;
        $this->amount = $amount;
    }

    public function getId() {
        return $this->id;
    }

    public function getPatient() {
        return $this->patient;
    }

    public function getHospital() {
        return $this->hospital;
    }

    public function getInsurance() {
        return $this->insurance;
    }

    public function getRegistrationDate() {
        return $this->registrationDate;
    }

    public function getStatus() {
        return $this->status;
    }
    
    public function getAmount() {
        return $this->amount;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function setHospital($hospital) {
        $this->hospital = $hospital;
    }

    public function setInsurance($insurance) {
        $this->insurance = $insurance;
    }

    public function setRegistrationDate($registrationDate) {
        $this->registrationDate = $registrationDate;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function setAmount($amount) {
        $this->amount = $amount;
    }
    
}
