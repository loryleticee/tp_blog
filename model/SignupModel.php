<?php
require_once("../config/mysql.php");
require_once("../config/config.php");

$error = [
    "message" => "",
    "exist" => false
];

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
        $error["message"] .= "Veuillez remplir tous les champs. Merci ! </br>";
        $error["exist"] = true;

        return $error;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error["message"] .= "Saisissez un adresse email valide";
        $error["exist"] = true;

        return $error;
    }
    var_dump($password);exit();
    $password = passwordHash($password);

    addUser($pseudo, $email, $password, $user_type, $accepted);

    return $error;
}

function addUser($pseudo, $email, $password, $user_type, $accepted)
{
    global $connexion;
    global $error;

    $query = $connexion->prepare("INSERT INTO `user`(`pseudo`, `email`, `password`, `accepted`)  VALUES (:pseudo, :email, :pwd, :accepted);");
    $response = $query->execute(["pseudo" => $pseudo,  "email" => $email, "pwd" => $password, "accepted" => $accepted]);
    if (!$response) {
        $error["message"] .= "Une erreur s'est produite durant l'insertion";
        $error["exist"] = true;
    }
}

function passwordHash($password) {
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    return $hash_password;
}