<?php

class MemberList {
    private $members;

    public function __construct() {
        $this->members = array();
    }

    public function toArray() {
        return $this->members;
    }

    public function add(Member $member) {
        $this->members[] = $member;
    }

}