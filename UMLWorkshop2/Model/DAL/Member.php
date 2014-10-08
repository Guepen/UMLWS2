<?php


class Member{
    private $firstname;
    private $surname;
    private $ssnr;
    private $id;
    private $count;
    private $type;
    private $boatId;

    public function __construct($firstname, $surname, $ssnr, $id = null, $count = null, $type = null, $boatId = null){
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->ssnr = $ssnr;
        $this->id = $id;
        $this->count = $count;
        $this->type = $type;
        $this->boatId = $boatId;
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

    public function getType(){
        return $this->type;
    }

    public function getBoatId(){
        return $this->boatId;
    }
}