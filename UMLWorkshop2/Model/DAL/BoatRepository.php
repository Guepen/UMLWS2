<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 2014-10-08
 * Time: 10:25
 */

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


    public function addBoat(Boat $boat){
        try{
            $sql = "INSERT INTO $this->dbTable (" . self::$type . ", " . self::$length . ",". self::$meberId .") VALUES (?,?,?)";
            $params = array($boat->getType(), $boat->getLength(), $boat->getMemberId());

            $query = $this->db->prepare($sql);
            $query->execute($params);

        }catch (\PDOException $e){

            var_dump($e->getMessage());

        }
    }

    public function alterBoat(Boat $boat){
        try {
            $sql = "UPDATE $this->dbTable SET ". self::$type ."=?, ". self::$length ."=? WHERE " . self::$boatId . "=?";

            $params = array($boat->getType(), $boat->getLength(), $boat->getMemberId());

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
}