<?php

require_once "./View/HTMLView.php";
require_once "./View/MemberView.php";
require_once "./Controller/Controller.php";

$memberView = new MemberView();
$htmlView = new HTMLView();
$controller = new Controller();

$htmlView->echoHTML($controller->doControl());

