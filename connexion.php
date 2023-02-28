<?php 

session_start();
define("TITLE", "Connexion");

require_once(__DIR__ . "/controllers/employeeController.php");

$employeeController = new EmployeeController;
$messages = $employeeController->signIn();

include(__DIR__ . "/assets/inc/header.php");
include(__DIR__ . "/views/signIn.php");
include(__DIR__ . "/assets/inc/footer.php");