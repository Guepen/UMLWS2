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

        if($this->memberView->userPressedMember()){
            $id = $this->memberView->getUserId();
            $member = $this->memberRepository->getMember($id);
            return $this->memberView->showMember($member);
        }

        if($this->memberView->userPressedAlter()){
            return $this->memberView->showAlterForm();
        }

        if($this->memberView->userHasPressedAlter()){
            $id = $this->memberView->getMemberId();
            $end = str_replace("?Redigeraanv%C3%A4ndare", "", $id);

            $this->memberView->getInputs();
            $firstname = $this->memberView->getFirstname();
            $surname = $this->memberView->getSurname();
            $ssnr = $this->memberView->getSsnr();

            $member = new Member($firstname, $surname, $ssnr, $end);
            $this->memberRepository->alterMember($member);
        }

        if($this->memberView->userPressedRemove()){
            $id = $this->memberView->getMemberId();
            $end = str_replace("?Tabortanv%C3%A4ndare=", "", $id);

            $this->memberRepository->deleteMember($end);
        }

        return $this->memberView->showMembers($this->memberRepository->getMembers());
    }

}