<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PatientDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Patient.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/dao/InsuranceDAO.php';



class PatientDAO {
  
    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Patient $patient) {
        $adicionado = 0;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Patient (name, email, password, birthDate, gender) "
                    . "VALUES (:name, :email, :password, :birthDate, :gender)");
            $vetorUser = array($patient->getName(), $patient->getEmail(),
                $patient->getPassword(), $patient->getBirthdate(),
                $patient->getGender());

            $stmt->bindParam(":name", $vetorUser[0]);
            $stmt->bindParam(":email", $vetorUser[1]);
            $stmt->bindParam(":password", $vetorUser[2]);
            $stmt->bindParam(":birthDate", $vetorUser[3]);
            $stmt->bindParam(":gender", $vetorUser[4]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = $this->conexao->lastInsertId();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Patient $patient) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Patient SET name = :name, "
                    . "email = :email, password = :password, "
                    . "birthDate = :birthDate, gender = :gender "
                    . "WHERE id = :id");

            $vetorUser = array($patient->getName(), $patient->getEmail(),
                $patient->getPassword(), $patient->getBirthdate(), $patient->getGender(), $patient->getId());

            $stmt->bindParam(":name", $vetorUser[0]);
            $stmt->bindParam(":email", $vetorUser[1]);
            $stmt->bindParam(":password", $vetorUser[2]);
            $stmt->bindParam(":birthDate", $vetorUser[3]);
            $stmt->bindParam(":gender", $vetorUser[4]);
            $stmt->bindParam(":id", $vetorUser[5]);

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
            $stmt = $this->conexao->prepare("DELETE FROM Patient WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT name, email, password, birthDate, gender FROM Patient WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Patient($id, $result['name'], $result['email'], $result['password'], $result['birthDate'], $result['gender']);
        } else {
            return FALSE;
        }
    }

    public function listPatients() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, name, email, password, birthDate, gender FROM Patient ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $patients = array();
        for ($i = 0; $i < count($result); $i++) {
            $patients[$i] = new Patient($result[$i]['id'], $result[$i]['name'], $result[$i]['email'], $result[$i]['password'], $result[$i]['birthDate'], $result[$i]['gender']);
        }
        return $patients;
    }

    public function patientValidation($email, $password) {
        try {
            $stmt = $this->conexao->prepare("SELECT id, name, birthDate, gender FROM Patient WHERE email = :email and password = :password");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Patient($result['id'], $result['name'], $email, $password, $result['birthDate'], $result['gender']);
        } else {
            return FALSE;
        }
    }

}
