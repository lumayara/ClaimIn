<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Patient.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Insurance.class.php';
/**
 * Description of TestParticipant
 *
 * @author Luana
 */
class Filling_Claim {
    
    private $id;
    private $patient;
    private $registrationDate;
    private $status;
    private $amount;
    private $attachment;

    
    function __construct($id, $patient, $registrationDate, $status, $amount, $attachment) {
        $this->id = $id;
        $this->patient = $patient;
        $this->registrationDate = $registrationDate;
        $this->status = $status;
        $this->amount = $amount;
        $this->attachment = $attachment;
    }

    public function getId() {
        return $this->id;
    }

    public function getPatient() {
        return $this->patient;
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
    
    public function getAttachment() {
        return $this->attachment;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
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
    
    public function setAttachment($attachment) {
        $this->attachment = $attachment;
    }
}
