<?php
require_once("../config/mysql.php");
require_once("../config/config.php");

print(__DIR__);
die('tt');

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

function insertArticle($user_id, $title, $content, $categorie) : array {
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

        return $error;
    }

    if (!$response) {
        $error["message"] .= "Une erreur s'est produite durant l'ajout de l'article'";
        $error["exist"] = true;
        return $error;
    }

    return $error;
}

function modifyArticle($article_id, $title, $content, $user_id) {
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare("UPDATE `article` SET `title` = :title , `content`= :content  WHERE `user_id` = :user_id AND `id`= :article_id ");
        $response = $query->execute(['article_id' => $article_id, 'content' => $content, 'title' => $title, 'user_id' => $user_id]);
    } catch ( \PDOException $err) {
        $error_code = $err->getCode();
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
        $error["exist"] = true;

        return $error;
    }

    if (!$response) {
        $error["message"] .= "Une erreur s'est produite durant la mofication de l'article'";
        $error["exist"] = true;
        return $error;
    }

    return $error;
}