<?php
require_once("../config/mysql.php");
require_once("../config/config.php");

function checkAddParams($user_id, $title, $content, $categorie) {
    global $error;
    $user_id =  htmlspecialchars(strip_tags($user_id));
    $title =  htmlspecialchars(strip_tags($title));
    $content =  htmlspecialchars(strip_tags($content));
    $categorie =  htmlspecialchars(strip_tags($categorie));

    if ( empty($user_id) ||  empty($title) ||  empty($content) || empty($categorie)) {
        $error["message"] .= "Veuillez remplir tous les champs. Merci ! </br>";
        $error["exist"] = true;

        return $error;
    }

    insertArticle($user_id, $title, $content, $categorie);
    
    return $error;
}

function insertArticle($user_id, $title, $content, $categorie) {
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare("INSERT INTO `article` (`title`, `content`, `user_id`) VALUES (:title, :content, :user_id)");
        $response = $query->execute(['title' => $title, 'content' => $content, 'user_id' => $user_id]);
    } catch ( \PDOException $err) {
        $error_code = $err->getCode();
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
        $error["exist"] = true;

        var_dump($error_msg);
        exit();
        return $error;
    }

    if (!$response) {
        $error["message"] .= "Une erreur s'est produite durant l'ajout de l'article'";
        $error["exist"] = true;
        return $error;
    }

    return $error;
}