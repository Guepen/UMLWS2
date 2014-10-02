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

    public function showMember($member){
        $html = "
        <a href='?'>Tillbaka</a>
        <li>Medlemsnummer: ".$member["id"]."</li>
        <li>Förnamn: ".$member["firstname"]."</li>
        <li>Efternamn: ".$member["surname"]."</li>
        <li>Personnummer: ".$member["ssnr"]."</li>
        <a href='?Redigera'>Redigera användare</a>
        <a href='?'>Ta bort användare</a>
        <a href='?LäggTill'>Lägg till båt</a>";

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
        $request_path = $_SERVER['REQUEST_URI'];
        $path = explode("/", $request_path); // splitting the path
        $last = end($path);
        $end = str_replace("?", "", $last);

        if(isset($_GET[$end])){
            return true;
        }
        return false;
    }

    public function getUserId(){
        $request_path = $_SERVER['REQUEST_URI'];
        $path = explode("/", $request_path); // splitting the path
        $last = end($path);
        $end = str_replace("?", "", $last);
        return $end;
    }

    public function userPressedAlter(){
        if(isset($_GET['Medlem'])){
            return true;
        }
        return false;
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