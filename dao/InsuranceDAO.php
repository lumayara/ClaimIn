<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InsuranceDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Insurance.class.php';

class InsuranceDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Insurance $insurance) {
        $adicionado = 0;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Insurance (classification, coverage) "
                    . "VALUES (:classification, :coverage)");
            $vetorUser = array($insurance->getType(), $insurance->getCoverage());

            $stmt->bindParam(":classification", $vetorUser[0]);
            $stmt->bindParam(":coverage", $vetorUser[1]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = $this->conexao->lastInsertId();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Insurance $insurance) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Insurance SET classification = :classification, "
                    . "coverage = :coverage "
                    . "WHERE id = :id");

            $vetorUser = array($insurance->getType(), $insurance->getCoverage(),
                $insurance->getId());

            $stmt->bindParam(":classification", $vetorUser[0]);
            $stmt->bindParam(":coverage", $vetorUser[1]);
            $stmt->bindParam(":id", $vetorUser[2]);

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
            $stmt = $this->conexao->prepare("DELETE FROM Insurance WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT classification, coverage FROM Insurance WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
       
        if ($result) {
            return new Insurance($id, $result['classification'], $result['coverage']);
        } else {
            return FALSE;
        }
    }

    public function listInsurances() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, classification, coverage FROM Insurance ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $insurances = array();
        for ($i = 0; $i < count($result); $i++) {
            $insurances[$i] = new Insurance($result[$i]['id'], $result[$i]['classification'], $result[$i]['coverage']);
        }
        return $insurances;
    }


}
