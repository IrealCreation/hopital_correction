<?php 

define("TITLE", "Inscription");

require_once(__DIR__ . "/controllers/employeeController.php");

$employeeController = new EmployeeController;
$messages = $employeeController->signUp();

include(__DIR__ . "/assets/inc/header.php");
include(__DIR__ . "/views/signUp.php");
include(__DIR__ . "/assets/inc/footer.php");