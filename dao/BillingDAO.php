<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HospitalDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/dao/PatientDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/dao/HospitalDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/dao/InsuranceDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Billing.class.php';

class BillingDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Billing $billing) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Billing (patient_id, hospital_id, insurance_id, registration_date, status, amount) "
                    . "VALUES (:patient_id, :hospital_id, :insurance_id, registration_date = :registration_date, status = :status, amount = :amount)");

            $properties = array($billing->getPatient()->getId(), $billing->getHospital()->getId(),
                $billing->getInsurance()->getId(), $billing->getRegistrationDate(),
                $billing->getStatus(), $billing->getAmount());

            $stmt->bindParam(":patient_id", $properties[0]);
            $stmt->bindParam(":hospital_id", $properties[1]);
            $stmt->bindParam(":insurance_id", $properties[2]);
            $stmt->bindParam(":registration_date", $properties[3]);
            $stmt->bindParam(":status", $properties[4]);
            $stmt->bindParam(":amount", $properties[5]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Billing $billing) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Billing SET patient_id = :patient_id, "
                    . "hospital_id = :hospital_id, insurance_id = :insurance_id, registration_date = :registration_date, status = :status, "
                    . "amount = :amount WHERE id = :id");

            $properties = array($billing->getPatient()->getId(), $billing->getHospital()->getId(),
                $billing->getInsurance()->getId(), $billing->getRegistrationDate(),
                $billing->getStatus(), $billing->getAmount(), $billing->getId());

            $stmt->bindParam(":patient_id", $properties[0]);
            $stmt->bindParam(":hospital_id", $properties[1]);
            $stmt->bindParam(":insurance_id", $properties[2]);
            $stmt->bindParam(":registration_date", $properties[3]);
            $stmt->bindParam(":status", $properties[4]);
            $stmt->bindParam(":amount", $properties[5]);
            $stmt->bindParam(":id", $properties[6]);

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
            $stmt = $this->conexao->prepare("DELETE FROM Billing WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT patient_id, hospital_id, insurance_id, registration_date, status, amount FROM Billing WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $hospitalDAO = new HospitalDAO();
        $patientDAO = new PatientDAO();
        $insuranceDAO = new InsuranceDAO();
        if ($result) {
            return new Billing($id, $patientDAO->get($result['patient_id']), $hospitalDAO->get($result['hospital_id']), $insuranceDAO->get($result['insurance_id']), $result['registration_date'], $result['status'], $result['amount']);
        } else {
            return FALSE;
        }
    }

    public function listBilling($hospitalId) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM Billing WHERE hospital_id = :hospital_id ORDER BY id DESC");
            $stmt->bindParam(":hospital_id", $hospital_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $billings = array();
        $hospitalDAO = new HospitalDAO();
        $patientDAO = new PatientDAO();
        $insuranceDAO = new InsuranceDAO();

        
        for ($i = 0; $i < count($result); $i++) {
            $billings[$i] = new Billing($result[$i]['id'], $patientDAO->get($result[$i]['patient_id']), $hospitalDAO->get($result[$i]['hospital_id']), $insuranceDAO->get($result[$i]['insurance_id']), $result[$i]['registration_date'], $result[$i]['status'], $result[$i]['amount']);
        }
        return $billings;
    }
//    
//    public function removeListParticipant($participantId) {
//        $removido = false;
//        try {
//            $stmt = $this->conexao->prepare("DELETE FROM Billing WHERE patient_id = :participantId");
//            $stmt->bindParam(":participantId", $participantId);
//
//            $resultado = $stmt->execute();
//
//            if ($resultado) {
//                $removido = true;
//            }
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//        return $removido;
//    }
//    
//     public function markFinalized($id) {
//        $removido = false;
//     try{
//         $stmt = $this->conexao->prepare("UPDATE TEST_PARTICIPANT SET FINALIZED=1 WHERE id = :id");
//         $stmt->bindParam(":id", $id);
//         
//         $resultado = $stmt->execute();
//         if($resultado){
//             $removido = true;
//         }
//     } catch (Exception $ex) {
//         echo $ex->getMessage();
//     }    
//        return $removido;
//    }


}
