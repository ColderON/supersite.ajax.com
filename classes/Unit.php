<?php

class Unit
{
    private static $instance = null;
    private $personRepository;
    private $pdo;
    private function __construct(){

        $this->pdo = new PDO("mysql:host=".Config::databaseServer."; dbname=".Config::databaseName,
            Config::databaseUser, Config::databasePasswd);

        $this->personRepository = new PersonRepository($this->pdo);
    }

    public static function GetInstance(){
        if(self::$instance ===null){
            self::$instance = new Unit();
        }

        return self::$instance;
    }

    public static function GetPdo(){
        if(self::$instance ===null){
            self::$instance = new Unit();
        }

        return self::$instance ->pdo;
    }

    public static function GetPersonRep(){
        if(self::$instance ===null){
            self::$instance = new Unit();
        }

        return self::$instance ->personRepository;
    }
}