<?php
session_start();
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

    if(!isset($_POST['user_id'])) {
        $error["message"] = "Le paramètre user_id est manquant, veuillez l\'envoyer dans votre requete";
        $error["exist"] = true;

        print(json_encode($error));
        die;
    }

    if (!isset($_POST['article_id'], $_POST['title'], $_POST['content'], $_POST['user_id'] )) {
        $error["message"] = "Un paramètre est manquant, veuillez remplir tous les champs";
        $error["exist"] = true;

        print(json_encode($error));
        die;
    }
    $aReponse = modifyArticle($_POST['article_id'], $_POST['title'], $_POST['content'], $_POST['user_id']);
}

print(json_encode($aReponse));

function modifyArticle($article_id, $title, $content, $user_id) 
{
    $user_id = htmlspecialchars(strip_tags($user_id));
    $article_id = htmlspecialchars(strip_tags($article_id));
    $title = htmlspecialchars(strip_tags($title));
    $content = htmlspecialchars(strip_tags($content));
    
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

    $error["message"] = 'Modification effectué';

    return $error;
}