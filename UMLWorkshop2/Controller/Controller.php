<?php

require_once "./Model/DAL/Member.php";
require_once "./Model/DAL/Boat.php";
require_once "./Model/DAL/MemberRepository.php";
require_once "./Model/DAL/BoatRepository.php";
require_once "./View/BoatView.php";

class Controller{
    private $memberView;
    private $boatView;
    private $memberRepository;
    private $boatRepository;

    public function __construct(){
        $this->memberView = new MemberView();
        $this->boatView = new BoatView();
        $this->memberRepository = new MemberRepository();
        $this->boatRepository = new BoatRepository();
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

        if($this->memberView->userPressedRegisterBoat()){
            $id = $this->memberView->getMemberId();
            $end = str_replace("?L%C3%A4ggTill=", "", $id);
            return $this->boatView->boatRegisterForm($end);
        }

        if($this->boatView->userHasPressedRegisterBoat()){
            $id = $this->memberView->getMemberId();
            $memberId = str_replace("?L%C3%A4ggTill", "", $id);
            $this->boatView->getBoatInputs();
            $type = $this->boatView->getBoatType();
            $length = $this->boatView->getBoatLength();

            $boat = new Boat($type, $length, $memberId);
            $this->boatRepository->addBoat($boat);
        }

        if($this->memberView->userHasPressedAlterBoat()){
            $id = $this->memberView->getMemberId();
            $boatId = str_replace("?Redigerab%C3%A5t=", "", $id);
            return $this->boatView->boatAlterForm($boatId);
        }

        if($this->boatView->userHasPressedAlterBoat()){
            $id = $this->memberView->getMemberId();
            $boatId = str_replace("?Redigerab%C3%A5t", "", $id);
            $this->boatView->getBoatInputs();
            $type = $this->boatView->getBoatType();
            $length = $this->boatView->getBoatLength();

            $boat = new Boat($type, $length, $boatId);
            $this->boatRepository->alterBoat($boat);
        }

        if($this->memberView->userPressedRemoveBoat()){
            $id = $this->memberView->getMemberId();
            $boatId = str_replace("?Tabortb%C3%A5t=", "", $id);

            $this->boatRepository->removeBoat($boatId);
        }

        if($this->memberView->userPressedGetFullMemberList()){
            return $this->memberView->showMembersFull($this->memberRepository->getFullMembers());
        }

        return $this->memberView->showMembers($this->memberRepository->getMembers());
    }

}