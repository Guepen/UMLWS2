<?php


class Member{
    private $firstname;
    private $surname;
    private $ssnr;
    private $id;
    private $count;

    public function __construct($firstname, $surname, $ssnr, $id = null, $count = null){
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->ssnr = $ssnr;
        $this->id = $id;
        $this->count = $count;
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

    public function getId(){
        return $this->id;
    }

    public function getCount(){
        return $this->count;
    }
}