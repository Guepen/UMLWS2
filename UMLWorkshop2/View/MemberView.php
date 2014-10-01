<?php

class MemberView{
    private $firstname;
    private $surname;
    private $ssnr;

    public function showMembers($memberList){
        $ret = "";

        foreach($memberList as $member){
                $ret .= "<li><a href='?".$member->getId()."'>" . $member->getId() . " " . $member->getFirstname() . " " . $member->getSurname() . "</a></li>";
        }
        $html = "
        <a href='?Register'>Registrera medlem</a>
        $ret
        ";

        return $html;
    }

    public function showRegisterForm(){
        $html = "
             <form action='?' method='POST' >
 				 <h1>Den glada piraten</h1>
 				 </br>
 				 </br>
 				 <label>Förnamn</label>
 				 <input type='text' name='firstname'/>
 				 <label>Efternamn</label>
 				  <input type='text' name='surname'/>
 				  <label>Personnummer</label>
 				  <input type='text' name='ssnr'/>
 				   <input type='submit' name='register' value='Registrera'/>
 				 </br>
 				 </br>
 				 </form>
        ";

        return $html;
    }

    public function getInputs(){
        if(isset($_POST['firstname'])){
            $this->firstname = $_POST['firstname'];
        }

        if(isset($_POST['surname'])){
            $this->surname = $_POST['surname'];
        }

        if(isset($_POST['ssnr'])){
            $this->ssnr = $_POST['ssnr'];
        }
    }

    public function userPressedMember(){
        if(isset($_GET[''])){

        }
    }

    public function userHasPressedRegister(){
        if(isset($_GET['Register'])){
           return true;
        }
        return false;
    }

    public function userHasPressedRegisterMember(){
        if(isset($_POST['register'])){
            return true;
        }
        return false;
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
}