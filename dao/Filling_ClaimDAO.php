<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClaimDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/dao/PatientDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Filling_Claim.class.php';

class Filling_ClaimDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Filling_Claim $filling_claim) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Filling_Claim (patient_id, registration_date, status, amount, attachment) "
                    . "VALUES (:patient_id, CURRENT_TIMESTAMP, :status, :amount, :attachment)");

            $properties = array($filling_claim->getPatient()->getId(), 
               // $filling_claim->getRegistrationDate(),
                $filling_claim->getStatus(), $filling_claim->getAmount(), $filling_claim->getAttachment());

            $stmt->bindParam(":patient_id", $properties[0]);
            //$stmt->bindParam(":registration_date", $properties[1]);
            $stmt->bindParam(":status", $properties[1]);
            $stmt->bindParam(":amount", $properties[2]);
            $stmt->bindParam(":attachment", $properties[3]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Filling_Claim $filling_claim) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Filling_Claim SET patient_id = :patient_id, "
                    . "registration_date = :registration_date, status = :status, amount = :amount, attachment = :attachment WHERE id = :id");

            $properties = array($filling_claim->getPatient()->getId(), 
                $filling_claim->getRegistrationDate(),
                $filling_claim->getStatus(), $filling_claim->getAmount(), $filling_claim->getAttachment(), $filling_claim->getId());

            $stmt->bindParam(":patient_id", $properties[0]);
            $stmt->bindParam(":registration_date", $properties[1]);
            $stmt->bindParam(":status", $properties[2]);
            $stmt->bindParam(":amount", $properties[3]);
            $stmt->bindParam(":attachment", $properties[4]);
            $stmt->bindParam(":id", $properties[5]);

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
            $stmt = $this->conexao->prepare("DELETE FROM Filling_Claim WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT patient_id, registration_date, status, amount, attachment FROM Filling_Claim WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $patientDAO = new PatientDAO();

        if ($result) {
            return new Filling_Claim($id, $patientDAO->get($result['patient_id']), $result['registration_date'], $result['status'], $result['amount'], $result['attachment']);
        } else {
            return FALSE;
        }
    }

    public function listByPatient($patient_Id) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM Filling_Claim WHERE patient_id = :patient_Id ORDER BY id DESC");
            $stmt->bindParam(":patient_Id", $patient_Id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $claims = array();
        $patientDAO = new PatientDAO();

        
        for ($i = 0; $i < count($result); $i++) {
            $claims[$i] = new Filling_Claim($result[$i]['id'], $patientDAO->get($result[$i]['patient_id']), $result[$i]['registration_date'], $result[$i]['status'], $result[$i]['amount'], $result[$i]['attachment']);
        }
        return $claims;
    }
    
    public function listAll() {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM Filling_Claim ORDER BY id DESC");
            
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $claims = array();
        $patientDAO = new PatientDAO();

        
        for ($i = 0; $i < count($result); $i++) {
            $claims[$i] = new Filling_Claim($result[$i]['id'], $patientDAO->get($result[$i]['patient_id']), $result[$i]['registration_date'], $result[$i]['status'], $result[$i]['amount'], $result[$i]['attachment']);
        }
        return $claims;
    }
    
    
    public function listPending() {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM Filling_Claim WHERE status = 'pending' ORDER BY id DESC");
            
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $claims = array();
        $patientDAO = new PatientDAO();

        
        for ($i = 0; $i < count($result); $i++) {
            $claims[$i] = new Filling_Claim($result[$i]['id'], $patientDAO->get($result[$i]['patient_id']), $result[$i]['registration_date'], $result[$i]['status'], $result[$i]['amount'], $result[$i]['attachment']);
        }
        return $claims;
    }
    
    public function listApproved() {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM Filling_Claim WHERE status = 'approved' ORDER BY id DESC");
            
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $claims = array();
        $patientDAO = new PatientDAO();

        
        for ($i = 0; $i < count($result); $i++) {
            $claims[$i] = new Filling_Claim($result[$i]['id'], $patientDAO->get($result[$i]['patient_id']), $result[$i]['registration_date'], $result[$i]['status'], $result[$i]['amount'], $result[$i]['attachment']);
        }
        return $claims;
    }
    
    public function approve(Filling_Claim $filling_claim) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Filling_Claim SET status = 'approved' WHERE id = :id");

            $properties = array($filling_claim->getId());

            $stmt->bindParam(":id", $properties[0]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $atualizado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $atualizado;
    }
    
    
//    
//    public function removeListParticipant($participantId) {
//        $removido = false;
//        try {
//            $stmt = $this->conexao->prepare("DELETE FROM Filling_Claim WHERE patient_id = :participantId");
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
