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
    private $boatId;

    public function __construct($type, $length, $boatId = null){
        $this->type = $type;
        $this->length = $length;
        $this->boatId = $boatId;
    }

    public function getType(){
        return $this->type;
    }

    public function getLength(){
        return $this->length;
    }

    public function getBoatId(){
        return $this->boatId;
    }
}