<?php

/**
 * Class Repository
 * @package model
 * This code is taken from https://github.com/gingerswede/1dv408-HT14/blob/master/Portfolio/src/model/Repository.php
 */
abstract class Repository{
    protected  $dbUsername =  'root';
    protected  $dbPassword = '';
    protected  $dbConnectionString = 'mysql:host=127.0.0.1;dbname=umlws2';
    protected  $dbConnection;
    protected  $dbTable;

    protected function connection(){
        if($this->dbConnection == null){
            $this->dbConnection = new \PDO($this->dbConnectionString, $this->dbUsername, $this->dbPassword);

            $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $this->dbConnection;
        }
    }
}