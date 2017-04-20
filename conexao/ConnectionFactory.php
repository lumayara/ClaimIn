<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConnectionFactory
 *
 * @author Luana
 */
class ConnectionFactory {
    
    private static $user = "root";
    private static $password = "";
    private static $pdo;
    
    public static function getInstance(){
        if(self::$pdo == null){
            self::$pdo = new PDO('mysql:host=localhost;dbname=claimin', self::$user, self::$password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
    

}
