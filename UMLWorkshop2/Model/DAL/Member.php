<?php


class Member{
    private $firstname;
    private $surname;
    private $ssnr;
    private $id;

    public function __construct($firstname, $surname, $ssnr, $id = null){
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->ssnr = $ssnr;
        $this->id =  $id;
    }

    public function getFirstname(){
        return $this->firstname;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function getSsnr(){
        return $this->ssnr;
    }

    public function setId(){
       return $this->id = \uniqid();
    }

    public function getId(){
        return $this->id;
    }
}