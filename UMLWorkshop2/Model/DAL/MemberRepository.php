<?php

require_once "./Model/DAL/Repository.php";
require_once "./Model/MemberModel.php";

class MemberRepository extends Repository
{
    private static $firstname = 'firstname';
    private static $surname = 'surname';
    private static $ssnr = 'ssnr';
    private static $id = 'id';
    private static $memberId = 'memberId';
    private $db;
    private $memberList;
    private $memberModel;

    public function __construct(){
        $this->dbTable = 'member';
        $this->dbTable2 = 'boat';
        $this->db = $this->connection();
        $this->memberList = array();
        $this->memberModel = new MemberModel();
    }

    public function add(Member $member){
        try{
            $sql = "INSERT INTO $this->dbTable (" . self::$firstname . ", " . self::$surname . ",". self::$ssnr .") VALUES (?,?,?)";
            $params = array($member->getFirstname(), $member->getSurname(), $member->getSsnr());

            $query = $this->db->prepare($sql);
            $query->execute($params);

        }catch (\PDOException $e){

            var_dump($e->getMessage());

        }
    }

    public function getMembers(){
        try {
            $sql = "SELECT $this->dbTable." .self::$id. ", " .self::$firstname. ", ".self::$surname.", " .self::$ssnr. ", COUNT($this->dbTable2.".self::$memberId.") as count
            FROM $this->dbTable2
            RIGHT OUTER JOIN $this->dbTable
                ON $this->dbTable2.".self::$memberId."=$this->dbTable.".self::$id."
            GROUP BY $this->dbTable.".self::$id."";

            $query = $this->db->prepare($sql);
            $query->execute();

            foreach($query->fetchAll() as $member){
                $firstname = $member['firstname'];
                $surname = $member['surname'];
                $ssnr = $member['ssnr'];
                $unique = $member['id'];
                $count = $member['count'];

                $memb = new Member($firstname, $surname, $ssnr, $unique, $count);

                $this->memberList[] = $memb;
            }

            return $this->memberList;

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function getFullMembers(){
        try {
            $sql = "SELECT *
            FROM $this->dbTable
            LEFT JOIN $this->dbTable2
            ON $this->dbTable.".self::$id."= $this->dbTable2.".self::$memberId."";

            $query = $this->db->prepare($sql);
            $query->execute();

            foreach($query->fetchAll() as $member){
                $firstname = $member['firstname'];
                $surname = $member['surname'];
                $ssnr = $member['ssnr'];
                $unique = $member['id'];
                $type = $member['type'];
                $length = $member['length'];
                $boatId = $member['boatId'];

                $memb = new Member($firstname, $surname, $ssnr, $unique, $type, $length, $boatId);

                $this->memberList[] = $memb;
            }

            return $this->memberList;

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function getMember($id){
        try {
            $sql = "SELECT ".self::$id.", ".self::$firstname.", ".self::$surname.", ".self::$ssnr."
            FROM $this->dbTable
            WHERE $this->dbTable." . self::$id . "= $id";

            $query = $this->db->prepare($sql);
            $query->execute();

            $result = $query->fetch();
            return $result;

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function alterMember(Member $member){
        try {
            $sql = "UPDATE $this->dbTable SET ". self::$firstname ."=?, ". self::$surname ."=?, ". self::$ssnr ."=? WHERE " . self::$id . "=?";

            $params = array($member->getFirstname(), $member->getSurname(), $member->getSsnr(), $member->getId());

            $query = $this->db->prepare($sql);
            $query->execute($params);

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function deleteMember($id){
        try{
            $sql = "DELETE FROM $this->dbTable WHERE $this->dbTable.". self::$id ."=?";
            $params = array($id);

            $query = $this->db->prepare($sql);
            $query->execute($params);
        }
        catch(\PDOException $e){
            var_dump($e->getMessage());
        }
    }
}