<?php 

session_start();

define("TITLE", "Accueil");

// Controller
require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
// Permet de vérifier si l'employé est bien connecté, et sinon le rediriger vers la page de connexion
$employeeController->verifyLogin();

// Vues
include(__DIR__ . "/assets/inc/header.php");
include(__DIR__ . "/views/index.php");
include(__DIR__ . "/assets/inc/footer.php");