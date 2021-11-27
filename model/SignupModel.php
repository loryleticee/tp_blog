<?php
require_once("../config/mysql.php");
require_once("../config/config.php");

function checkSignUp($pseudo, $email, $password, $comfirm_password, $user_type, $accepted)
{

    global $error;
    $pseudo =  htmlspecialchars(strip_tags($pseudo));
    $email =  htmlspecialchars(strip_tags($email));
    $password =  htmlspecialchars(strip_tags($password));
    $comfirm_password =  htmlspecialchars(strip_tags($comfirm_password));
    $user_type =  htmlspecialchars(strip_tags($user_type));
    $accepted =  htmlspecialchars(strip_tags($accepted));
    $accepted =  $accepted === "on" ? 1 : 0;

    if (
        empty($pseudo) || empty($email) || empty($password)
        || empty($comfirm_password) || empty($user_type)
    ) {
        $error["message"] = "Veuillez remplir tous les champs. Merci ! </br>";
        $error["exist"] = true;

        return $error;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error["message"] = "Saisissez un adresse email valide";
        $error["exist"] = true;

        return $error;
    }

    $password = passwordHash($password);

    addUser($pseudo, $email, $password, $user_type, $accepted);

    return $error;
}

function addUser($pseudo, $email, $password, $user_type, $accepted)
{
    global $connexion;
    global $error;
    try {
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $connexion->prepare("INSERT INTO `user`(`pseudo`, `email`, `password`, `accepted`)  VALUES (:pseudo, :email, :pwd, :accepted)");
        $response = $query->execute(["pseudo" => $pseudo,  "email" => $email, "pwd" => $password, "accepted" => $accepted]);
    } catch(\PDOException $_error ) {
        $msg = $_error->getMessage();
        $c = (int) $_error->getCode();
        switch ($c) {
            case 23000:
                $error["message"] = "Un compte existe déjà avec cet email.";
                $error["exist"] = true;

                return $error;
                break;
            
            default:
                # code...
                break;
        }
    }
    if (!$response) {
        $error["message"] = "Une erreur s'est produite durant l'insertion";
        $error["exist"] = true;
    }
}

function passwordHash($password) {
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    return $hash_password;
}