<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Hospital.class.php';

class HospitalDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Hospital $hospital) {
        $adicionado = 0;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Hospital (name, username, password)"
                    . "VALUES (:name, :username, :password)");
            $vetorUser = array($hospital->getName(), $hospital->getUsername(),
                $hospital->getPassword());

            $stmt->bindParam(":name", $vetorUser[0]);
            $stmt->bindParam(":username", $vetorUser[1]);
            $stmt->bindParam(":password", $vetorUser[2]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = $this->conexao->lastInsertId();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Hospital $hospital) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Hospital SET name = :name, "
                    . "username = :username, password = :password "
                    . "WHERE id = :id");

            $vetorUser = array($hospital->getName(), $hospital->getUsername(),
                $hospital->getPassword(), $hospital->getId());

            $stmt->bindParam(":name", $vetorUser[0]);
            $stmt->bindParam(":username", $vetorUser[1]);
            $stmt->bindParam(":password", $vetorUser[2]);
            $stmt->bindParam(":id", $vetorUser[3]);

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
            $stmt = $this->conexao->prepare("DELETE FROM Hospital WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT name, username, password FROM Hospital WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
       
        if ($result) {
            return new Hospital($id, $result['name'], $result['username'], $result['password']);
        } else {
            return FALSE;
        }
    }

    public function listHospitals() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, name, username FROM Hospital ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $hospitals = array();
        for ($i = 0; $i < count($result); $i++) {
            $hospitals[$i] = new Hospital($result[$i]['id'], $result[$i]['name'], $result[$i]['username'], $result[$i]['password']);
        }
        return $hospitals;
    }
    
    public function validation($username, $password) {
        try {
            $stmt = $this->conexao->prepare("SELECT id, name, username FROM Participant WHERE username = :username and password = :password");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Hospital($result['id'], $result['name'], $username, $password);
        } else {
            return FALSE;
        }
    }
//    public function listTestsByCompetition($competitionId) {
//            try{
//        $stmt = $this->conexao->prepare("SELECT id, classification, start_date, end_date FROM Test WHERE competition_id = :competition_id ORDER BY id DESC");
//        $stmt->bindParam(":competition_id", $competitionId);
//        $stmt->execute();
//        }catch (PDOException $e){
//            echo $e->getMessage();
//        }
//        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
//        $tests = array();
//        $competitionDAO = new CompetitionDAO();
//        for ($i = 0; $i < count($result); $i++) {
//            $tests[$i] = new Test($result[$i]['id'], $result[$i]['classification'], 
//                    $result[$i]['start_date'], $result[$i]['end_date'], $competitionDAO->get($competitionId));
//        }
//        return $tests;
//            
// } 

}
