<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmployeeDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ClaimIn/modelo/Employee.class.php';

class EmployeeDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Employee $admin) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Employee (username, password) "
                    . "VALUES (:username, :password)");

            $properties = array($admin->getUsername(), $admin->getPassword());

            $stmt->bindParam(":username", $properties[0]);
            $stmt->bindParam(":password", $properties[1]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Employee $admin) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Employee SET username = :username, "
                    . "password = :password WHERE id = :id");

            $properties = array($admin->getUsername(), $admin->getPassword(), $admin->getId());

            $stmt->bindParam(":username", $properties[0]);
            $stmt->bindParam(":password", $properties[1]);
            $stmt->bindParam(":id", $properties[2]);

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
            $stmt = $this->conexao->prepare("DELETE FROM Employee WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT username, password FROM Employee WHERE id = :id");
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Employee($id, $result['username'], $result['password']);
        } else {
            return FALSE;
        }
    }
    
    public function listAdmins() {
        try {
            $stmt = $this->conexao->prepare("SELECT username, id FROM Employee ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $admins = array();
        for ($i = 0; $i < count($result); $i++) {
            $admins[$i] = new Employee($result[$i]['id'], $result[$i]['username'], NULL);
        }
        return $admins;
    }

    public function userValidate($username, $password) {
        try {
            $stmt = $this->conexao->prepare("SELECT id FROM Employee WHERE username = :username and password = :password");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Employee($result['id'], $username, NULL);
        } else {
            return FALSE;
        }
    }

}
