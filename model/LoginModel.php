<?php
session_start();
require_once("../config/mysql.php");
require_once("../config/config.php");


function checkLogin($email, $password)
{
    global $error;
    $email =  htmlspecialchars(strip_tags($email));
    $password =  htmlspecialchars(strip_tags($password));

    if ( empty($email) || empty($password)) {
        $error["message"] .= "Veuillez remplir tous les champs. Merci ! </br>";
        $error["exist"] = true;

        return $error;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error["message"] .= "Saisissez un adresse email valide";
        $error["exist"] = true;

        return $error;
    }

    getPasswordUser($email, $password);

    return $error;
}

function getPasswordUser($email, $password)
{
    global $connexion;
    global $error;

    $query = $connexion->prepare("SELECT `id`, `password`, `pseudo`  FROM `user` WHERE email=:email;");
    $response = $query->execute(["email" => $email]);
    if (!$response) {
        $error["message"] .= "Une erreur s'est produite durant la recherche du mot de passe";
        $error["exist"] = true;
        return $error;
    }

    $aDatas = $query->fetchAll();

    verifyPassword($aDatas, $password);

    return $error;
}

function verifyPassword($aDatas, $password) {
    global $error;
    $aDatas = $aDatas[0];

    if(!isset($aDatas['password'])) {
        $error["message"] .= "L’adresse e-mail que vous avez saisie n’est pas associée à un compte. <a href='/vues/account/signup.php'>Céer votre compte</a>";
        $error["exist"] = true;

        return $error;
    }
    
    $passwordVerified = password_verify($password, $aDatas['password']);

    if (!$passwordVerified) {
        $error["message"] .= "Mot de passe incorrect.";
        $error["exist"] = true;

        return $error;
    }

    createSession($aDatas);
}

function createSession($aDatas) {
    $_SESSION['user']['id'] = $aDatas['id'];
    $_SESSION['user']['pseudo'] = $aDatas['pseudo'];
}