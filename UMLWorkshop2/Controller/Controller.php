<?php

require_once "./Model/DAL/Member.php";
require_once "./Model/DAL/MemberRepository.php";

class Controller{
    private $memberView;
    private $memberRepository;
    private $memberList;

    public function __construct(){
        $this->memberView = new MemberView();
        $this->memberRepository = new MemberRepository();
        $this->memberList = new MemberList();
    }

    public function doControl(){
        if($this->memberView->userHasPressedRegister()){
            return $this->memberView->showRegisterForm();
        }
        if($this->memberView->userHasPressedRegisterMember()){
            $this->memberView->getInputs();
            $firstname = $this->memberView->getFirstname();
            $surname = $this->memberView->getSurname();
            $ssnr = $this->memberView->getSsnr();

            $member = new Member($firstname, $surname, $ssnr );
            $this->memberRepository->add($member);
        }
            return $this->memberView->showMembers($this->memberRepository->getMembers());
    }

}