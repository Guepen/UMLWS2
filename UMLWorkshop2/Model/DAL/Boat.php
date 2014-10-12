<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 2014-10-08
 * Time: 11:04
 */

class Boat{
    private $type;
    private $length;
    private $memberId;

    public function __construct($type, $length, $memberId){
        $this->type = $type;
        $this->length = $length;
        $this->memberId = $memberId;
    }

    public function getType(){
        return $this->type;
    }

    public function getLength(){
        return $this->length;
    }

    public function getMemberId(){
        return $this->memberId;
    }
}