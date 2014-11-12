<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 2014-10-08
 * Time: 10:52
 */

class BoatView{
    private $boatType;
    private $length;

    public function boatRegisterForm($end){
        $html = "
             <a href='?$end'>Tillbaka</a>
             <form action='?LaggTill".$end."' method='POST' >
 				 </br>
 				 </br>
 				 <select name='boatType'>
                 <option value='Segelbåt'>Segelbåt</option>
                 <option value='Motorseglare'>Motorseglare</option>
                 <option value='Motorbåt'>Motorbåt</option>
                 <option value='Kajak/Kanot'>Kajak/Kanot</option>
                 <option value='Övrigt'>Övrigt</option>
                 </select>
 				 <label>Längd i meter</label>
 				 <input type='text' name='length'/>
                 <input type='submit' name='registerBoat' value='Registrera Båt'/>
 				 </br>
 				 </br>
 				 </form>
        ";

        return $html;
    }

    public function boatAlterForm($end){
        $html = "
             <a href='?'>Tillbaka</a>
             <form action='?Redigerabat".$end."' method='POST' >
 				 </br>
 				 </br>
 				 <select name='boatType'>
                 <option value='Segelbåt'>Segelbåt</option>
                 <option value='Motorseglare'>Motorseglare</option>
                 <option value='Motorbåt'>Motorbåt</option>
                 <option value='Kajak/Kanot'>Kajak/Kanot</option>
                 <option value='Övrigt'>Övrigt</option>
                 </select>
 				 <label>Längd i meter</label>
 				 <input type='text' name='length'/>
                 <input type='submit' name='alterBoat' value='Ändra Båt'/>
 				 </br>
 				 </br>
 				 </form>
        ";

        return $html;
    }

    public function getBoatInputs(){
        if(isset($_POST['boatType'])){
            $this->boatType = $_POST['boatType'];
        }

        if(isset($_POST['length'])){
            $this->length = $_POST['length'];
        }
    }

    public function userHasPressedRegisterBoat(){
        if(isset($_POST['registerBoat'])){
            return true;
        }
        return false;
    }

    public function userHasPressedAlterBoat(){
        if(isset($_POST['alterBoat'])){
            return true;
        }
        return false;
    }

    public function getBoatType(){
        return $this->boatType;
    }

    public function getBoatLength(){
        return $this->length;
    }
}