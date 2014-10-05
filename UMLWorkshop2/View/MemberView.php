<?php

class MemberView{
    private $firstname;
    private $surname;
    private $ssnr;
    private $end;

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
        <a href='?Redigeraanvändare=".$member["id"]."'>Redigera användare</a>
        <a href='?Tabortanvändare=".$member["id"]."'>Ta bort</a>
        <a href='?LäggTill=".$member["id"]."'>Lägg till båt</a>";

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

    public function showAlterForm(){
        $html = "
             <a href='?$this->end'>Tillbaka</a>
             <form action='?Redigeraanvändare".$this->end."' method='POST' >
 				 <h1>Den glada piraten</h1>
 				 </br>
 				 </br>
 				 <label>Förnamn</label>
 				 <input type='text' name='firstname'/>
 				 <label>Efternamn</label>
 				  <input type='text' name='surname'/>
 				  <label>Personnummer</label>
 				  <input type='text' name='ssnr'/>
 				   <input type='submit' name='Alter' value='Uppdatera'/>
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
        $end = $this->getUserId();

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
        $request_path = $_SERVER['REQUEST_URI'];
        $path = explode("/", $request_path); // splitting the path
        $last = end($path);
        $this->end = str_replace("?Redigeraanv%C3%A4ndare=", "", $last);
        if(isset($_GET['Redigeraanvändare'])){
            return true;
        }
        return false;
    }

    public function userPressedRemove(){
        if(isset($_GET['Tabortanvändare'])){
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

    public function userHasPressedAlter(){
        if(isset($_POST['Alter'])){
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

    public function getMemberId(){
        return $this->end;
    }
}