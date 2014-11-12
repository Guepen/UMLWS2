<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 2014-10-08
 * Time: 10:25
 */

require_once("Repository.php");

class BoatRepository extends Repository{
    private static $type = 'type';
    private static $length = 'length';
    private static $meberId = 'memberId';
    private static $boatId = 'boatId';
    private $db;

    public function __construct(){
        $this->dbTable = 'boat';
        $this->db = $this->connection();
    }


    public function addBoat(Boat $boat, $memberId){
        try{
            $sql = "INSERT INTO $this->dbTable (" . self::$type . ", " . self::$length . ",". self::$meberId .") VALUES (?,?,?)";
            $params = array($boat->getType(), $boat->getLength(), $memberId);

            $query = $this->db->prepare($sql);
            $query->execute($params);

        }catch (\PDOException $e){

            var_dump($e->getMessage());

        }
    }

    public function alterBoat(Boat $boat){
        try {
            $sql = "UPDATE $this->dbTable SET ". self::$type ."=?, ". self::$length ."=? WHERE " . self::$boatId . "=?";

            $params = array($boat->getType(), $boat->getLength(), $boat->getBoatId());

            $query = $this->db->prepare($sql);
            $query->execute($params);

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function removeBoat($boatId){
        try{
            $sql = "DELETE FROM $this->dbTable WHERE ". self::$boatId ."=?";
            $params = array($boatId);

            $query = $this->db->prepare($sql);
            $query->execute($params);
        }
        catch(\PDOException $e){
            var_dump($e->getMessage());
        }
    }

    public function getBoats($id){
        $boats = array();
        try{
            $sql = "SELECT *
            FROM $this->dbTable
            WHERE ".self::$meberId." = ?";

            $params = array($id);

            $query = $this->db->prepare($sql);
            $query->execute($params);

            foreach($query->fetchAll() as $boat){
                $boatId = $boat["boatId"];
                $type = $boat["type"];
                $length = $boat["length"];

                $boatObj = new Boat($type, $length, $boatId);
                $boats[] = $boatObj;
            }
            return $boats;
        }
        catch(\PDOException $e){

        }
    }
}