<?php 

require_once(__DIR__ . "/../models/employee.php");

class EmployeeController {
    // Méthode d'inscription
    public function signUp(): array {
        $messages = [];

        if(isset($_POST["submit"])) {

            // Vérification du nom d'utilisateur
            if(!isset($_POST["username"]) || strlen($_POST["username"]) == 0 || strlen($_POST["username"]) > 50) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer un nom d'utilisateur entre 1 et 50 caractères"
                ];
            }
            else {
                // Vérification que le nom d'utilisateur ne soit pas en doublon
                if(Employee::readOne($_POST["username"]) != false) {
                    $messages[] = [
                        "success" => false,
                        "text" => "Ce nom d'utilisateur est déjà pris"
                    ];
                }
            }

            // Vérification du mot de passe
            $uppercase = preg_match('@[A-Z]@', $_POST["password"]);
            $lowercase = preg_match('@[a-z]@', $_POST["password"]);
            $number = preg_match('@[0-9]@', $_POST["password"]);

            if(!isset($_POST["password"]) || 
                !$uppercase || !$lowercase || !$number || 
                strlen($_POST["password"]) < 8) 
            {
                $messages[] = [
                    "success" => false,
                    "text" => "Votre mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule et un chiffre."
                ];
            }

            // Vérification de la concordance des mots de passe
            if(!isset($_POST["passwordVerify"]) || $_POST["password"] != $_POST["passwordVerify"]) {
                $messages[] = [
                    "success" => false,
                    "text" => "Les deux mots de passe ne correspondent pas"
                ];
            }

            // S'il n'y a pas d'erreurs, on peut créer l'employé
            if(count($messages) == 0) {
                $messages[] = [
                    "success" => true,
                    "text" => "Employé enregistré"
                ];

                // Préparation des données
                $username = htmlspecialchars($_POST["username"]);
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                // Envoi des informations au modèle
                Employee::create($username, $password);
            }
        }

        return $messages;
    }

    // Méthode de connexion
    public function signIn(): array {
        $messages = [];

        if(isset($_POST["submit"])) {
            // Vérification du nom d'utilisateur
            if(!isset($_POST["username"])) {
                $messages[] = [
                    "success" => false,
                    "text" => "Indiquez un nom d'utilisateur"
                ];
            }

            // Vérification du mot de passe
            if(!isset($_POST["password"])) {
                $messages[] = [
                    "success" => false,
                    "text" => "Indiquez un mot de passe"
                ];
            }

            if(count($messages) == 0) {
                // Essayons de récupérer un employé avec ce nom
                $employee = Employee::readOne($_POST["username"]);

                if($employee == false) {
                    $messages[] = [
                        "success" => false,
                        "text" => "Aucun employé avec ce nom trouvé"
                    ];
                }
                else {
                    // Vérification du mot de passe de l'employé
                    if(!password_verify($_POST["password"], $employee->password)) {
                        $messages[] = [
                            "success" => false,
                            "text" => "Mot de passe incorrect"
                        ];
                    }
                    else {
                        // Bravo, vous êtes connecté !
                        $messages[] = [
                            "success" => true,
                            "text" => "Vous êtes désormais connecté !"
                        ];

                        $_SESSION["username"] = $_POST["username"];
                        
                        // Redirection
                        header("Location: /index.php");
                    }
                }
            }
        }

        return $messages;
    }
}