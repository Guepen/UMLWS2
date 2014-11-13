<?php

require_once("./Model/DAL/BoatRepository.php");

class MemberView{
    private $firstname;
    private $surname;
    private $ssnr;
    private $end;

    public function showMembers($memberList){
        $ret = "";
        foreach($memberList as $member){
                $ret .= "<li><a href='?".$member->getId()."'>" . $member->getId() . " " . $member->getFirstname() . " " . $member->getSurname() . " " . $member->getCount() . "</a></li>";
        }
        $html = "
        <a href='?Fulllista='>Visa fullständig lista med medlemmar</a>
        <a href='?Register'>Registrera medlem</a>
        $ret
        ";

        return $html;
    }

    public function showMembersFull($memberList){
        $boatRepository = new BoatRepository();
        $ret = "";
        foreach($memberList as $member){
            $boatList = $boatRepository->getBoats($member->getId());
            foreach($boatList as $boat){
                $ret .= "<li>" . $member->getId() . " " . $member->getFirstname() . " " . $member->getSurname() . " " . $member->getSsnr() . ", Båttyp: " . $boat->getType() . ", Båtlängd: ". $boat->getLength() ." <a href='?Redigerabat=".$boat->getBoatId()."'>Redigera båt</a> <a href='?Tabortbat=".$boat->getBoatId()."'>Ta bort båt</a></li>";
            }
        }
        $html = "
        <a href='?'>Tillbaka</a>
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
        <a href='?Redigeraanvandare=".$member["id"]."'>Redigera avändare</a>
        <a href='?Tabortanvandare=".$member["id"]."'>Ta bort</a>
        <a href='?LaggTill=".$member["id"]."'>Lägg till båt</a>";

        return $html;
    }

    public function showRegisterForm(){
        $html = "
             <a href='?'>Tillbaka</a>
             <form action='?' method='POST' >
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
             <form action='?Redigeraanvandare".$this->end."' method='POST' >
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
        $id = $this->getUrl();
        $end = $this->getId($id);

        if(isset($_GET[$end])){
            return true;
        }
        return false;
    }

    public function getId($string){
        $this->end = preg_replace("/[^0-9]/", "", $string);
        return $this->end;
    }

    public function getUrl(){
        $request_path = $_SERVER['REQUEST_URI'];
        $path = explode("/", $request_path); // splitting the path
        $last = end($path);
        return $last;
    }

    public function userPressedAlter(){
        if(isset($_GET['Redigeraanvandare'])){
            return true;
        }
        return false;
    }

    public function userPressedRegisterBoat(){
        if(isset($_GET['LaggTill'])){
            return true;
        }
        return false;
    }

    public function userPressedRemoveBoat(){
        if(isset($_GET['Tabortbat'])){
            return true;
        }
        return false;
    }

    public function userPressedRemove(){
        if(isset($_GET['Tabortanvandare'])){
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

    public function userPressedGetFullMemberList(){
        if(isset($_GET['Fulllista'])){
            return true;
        }
        return false;
    }

    public function userHasPressedAlterBoat(){
        if(isset($_GET['Redigerabat'])){
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
}