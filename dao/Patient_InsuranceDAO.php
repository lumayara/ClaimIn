<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Patient_InsuranceDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Patient_Insurance.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/dao/PatientDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/dao/InsuranceDAO.php';



class Patient_Insurance_InsuranceDAO {
  
    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Patient_Insurance $patient_insurance) {
        $adicionado = 0;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Patient_Insurance (insurance_id, patient_id, start_date, expiration)"
                    . "VALUES (:insurance_id, :patient_id, :start_date, :expiration)");
            $vetorUser = array($patient_insurance->getInsurance()->getId(), $patient_insurance->getPatient()->getId(), 
                $patient_insurance->getStart_Date(), $patient_insurance->getExpiration());

            $stmt->bindParam(":insurance_id", $vetorUser[0]);
            $stmt->bindParam(":patient_id", $vetorUser[1]);
            $stmt->bindParam(":start_date", $vetorUser[2]);
            $stmt->bindParam(":expiration", $vetorUser[3]);
            
            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = $this->conexao->lastInsertId();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Patient_Insurance $patient_insurance) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Patient_Insurance SET insurance_id = :insurance_id, "
                    . "patient_id = :patient_id, start_date = :start_date, "
                    . "expiration = :expiration "
                    . "WHERE id = :id");

            $vetorUser = array($patient_insurance->getPatient()->getId(), $patient_insurance->getInsurance()->getId(),
                $patient_insurance->getStart_Date(), $patient_insurance->getExpiration(), $patient_insurance->getId());

            $stmt->bindParam(":insurance_id", $vetorUser[0]);
            $stmt->bindParam(":patient_id", $vetorUser[1]);
            $stmt->bindParam(":start_date", $vetorUser[2]);
            $stmt->bindParam(":expiration", $vetorUser[3]);
            $stmt->bindParam(":id", $vetorUser[4]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $atualizado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $atualizado;
    }

    public function remove($id) {
        $removido = false;
        try {
            $stmt = $this->conexao->prepare("DELETE FROM Patient_Insurance WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $resultado = $stmt->execute();

            if ($resultado) {
                $removido = true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $removido;
    }

    public function get($id) {
        try {
            $stmt = $this->conexao->prepare("SELECT insurance_id, patient_id, start_date, expiration FROM Patient_Insurance WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $patientDAO = new PatientDAO();
        $insuranceDAO = new InsuranceDAO();

        if ($result) {
            return new Patient_Insurance($id, $patientDAO->get($result['patient_id']), $insuranceDAO->get($result['insurance_id']), $result['start_date'], $result['expiration']);
        } else {
            return FALSE;
        }
    }

    public function listPatient_Insurances() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, insurance_id, patient_id, start_date, expiration FROM Patient_Insurance ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $patient_insurances = array();
        $insuranceDAO = new InsuranceDAO();
        $patientDAO = new PatientDAO();
        for ($i = 0; $i < count($result); $i++) {
            $patient_insurances[$i] = new Patient_Insurance($result['id'], $patientDAO->get($result['patient_id']), $insuranceDAO->get($result['insurance_id']), $result['start_date'], $result['expiration']);
        }
        return $patient_insurances;
    }
    
    public function find($patient_id) {
        try {
            $stmt = $this->conexao->prepare("SELECT id, insurance_id, start_date, expiration FROM Patient_Insurance WHERE patient_id = :patient_id");
            $stmt->bindParam(":patient_id", $patient_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $insuranceDAO = new InsuranceDAO();
        
        if ($result) {
            return new Patient_Insurance($result['id'], $patient_id, $insuranceDAO->get($result['insurance_id']), $result['start_date'], $result['expiration']);
            
        } else {
            return FALSE;
        }
    }

   

}
