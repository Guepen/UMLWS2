<?php

require_once "./Model/DAL/Repository.php";
require_once "./Model/DAL/MemberList.php";
require_once "./Model/MemberModel.php";

class MemberRepository extends Repository {
    private static $firstname = 'firstname';
    private static $surname = 'surname';
    private static $ssnr = 'ssnr';
    private static $unique = 'unique';
    private $db;
    private $memberList;
    private $memberModel;

    public function __construct(){
        $this->dbTable = 'member';
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

            $sql = "SELECT * FROM $this->dbTable";

            $query = $this->db->prepare($sql);
            $query->execute();

           foreach($query->fetchAll() as $member){
               $firstname = $member['firstname'];
               $surname = $member['surname'];
               $ssnr = $member['ssnr'];
               $unique = $member['id'];

               $memb = new Member($firstname, $surname, $ssnr, $unique);

               $this->memberList[] = $memb;
           }

            return $this->memberList;

        } catch (\PDOException $e) {
            die("Ett oväntat fel inträffade");
        }
    }
}