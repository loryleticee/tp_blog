<?php
require_once '../config/mysql.php';
require_once '../config/config.php';

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if($_SERVER['REQUEST_METHOD'] !== "POST") {
    $error['message'] = "cannot ".$_SERVER['REQUEST_METHOD']." /  method not allowed";
    $error['exist'] = true;

    print(json_encode($error));
    die;
}

$aReponse = [];

$isFormData = stripos($contentType, "form-data");
if (in_array($contentType, $aACCEPTED_FORM_DATA) || $isFormData) {
    if (!isset(
        $_POST['user_id'],
        $_POST['title'],
        $_POST['content'],
        $_POST['categorie']
    )) {
        $error["message"] = "Veuillez remplir tous les champs. Merci ! </br>";
        $error["exist"] = true;

        print(json_encode($error));
        die;
    }

    $aReponse = checkAddParams($_POST['user_id'], $_POST['title'],  $_POST['content'], $_POST['categorie']);
}

print(json_encode($aReponse));

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

function getLastUserArticle($user_id) {
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare("SELECT `id` FROM `article` WHERE `user_id` = :u_id AND is_deleted=0 ORDER BY id DESC LIMIT 1");
        $response = $query->execute(['u_id' => $user_id]);
    } catch (\PDOException $err) {
        $error_code = $err->getCode();
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
        $error["exist"] = true;

        return $error;
    }

    if (!$response) {
        $error["message"] = "Un probleme est survenu lors de la recupération du nouvel article.";
        $error["exist"] = true;

        return $error;
    }

    $aDatas = $query->fetch();


    if (!isset($aDatas['id'])) {
        $error["message"] = "Aucun article trouvé";
        $error["exist"] = true;

        return $error;
    }

    return  (int) $aDatas['id'];
}




