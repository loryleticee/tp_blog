<?php
require_once("../config/mysql.php");
require_once("../config/config.php");
require_once("../helpers/ArticlesHelper.php");

/**
 * Filtre les données passées en paramètre contre les injection SQL et verifie si elles sont vides
 * @param int $user_id
 * @param string $title
 * @param string $content
 * @param int|bool $categorie
 * @return array Retourne un tableau contenant une clée exist qui vaut FALSE  si aucune erreur est survenu , True dans le cas contraire
 */
function checkAddParams(int $user_id, string $title, string $content, $categorie) : array
{
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

/**
 * @param int $user_id
 * @param string $title
 * @param string $content
 * @param int|bool $categorie
 * @return array Retourne un tableau contenant une clée exist qui vaut FALSE si aucune erreur est survenu , True dans le cas contraire
 */
function insertArticle($user_id, $title, $content, $categorie) : array 
{
    global $connexion;
    global $error;
    $user_id = (int) $user_id;
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
        $error["message"] =  "Une erreur s'est produite durant l\'ajout de l\'article'";
        $error["exist"] = true;
        
        return $error;
    }
    
    $iArticleID = getLastUserArticle($user_id);
    $error["article_id"] = $iArticleID;

    return $error;
}


function modifyArticle($article_id, $title, $content, $user_id) 
{
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

function deleteArticle($article_id, $user_id) 
{
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare("UPDATE `article` SET `is_deleted` = 1  WHERE `user_id` = :user_id AND `id`= :article_id ");
        $response = $query->execute(['user_id' => $user_id, "article_id" => $article_id]);
    } catch ( \PDOException $err) {
        $error_code = $err->getCode();
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
        $error["exist"] = true;

        return $error;
    }

    if (!$response) {
        $error["message"] = "Une erreur s'est produite durant la suppression de l'article'";
        $error["exist"] = true;
        return $error;
    }

    return $error;
}

