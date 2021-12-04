<?php
require_once '../config/mysql.php';
require_once '../config/config.php';

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if($_SERVER['REQUEST_METHOD'] !== "GET") {
    $error['message'] = "cannot ".$_SERVER['REQUEST_METHOD']." /  method not allowed";
    $error['exist'] = true;
    
    print(json_encode($error));
    die;
}

$aReponse = [];
if (in_array($contentType, $aACCEPTED_FORM_DATA )) {
    $aReponse = getArticles();
} else {
    $error['message'] = "Mauvais type de corps de page, form-data est interdit ici";
    $error['exist'] = true;
    print(json_encode($error));
}

print(json_encode($aReponse));

function getArticles(): array
{
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare("SELECT * FROM `article` WHERE is_deleted=0");
        $response = $query->execute();
    } catch (\PDOException $err) {
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

    $aDatas = $query->fetchAll();

    if (!isset($aDatas[0]['id'])) {
        $error["message"] = "Aucun article trouvé";
        $error["exist"] = true;

        return $error;
    }

    $aDatas = getCategoriesArticles($aDatas);

    return $aDatas;
}


function getCategoriesArticles($aDatas): array {
    global $connexion;
    global $error;
    $aDatasWithCats = [];
    foreach ($aDatas as $value) {
        try {
            $query = $connexion->prepare("SELECT categorie_id FROM `categorie_article` WHERE article_id = :article_id");
            $response = $query->execute(['article_id' => $value['id']]);
        } catch (\PDOException $err) {
            $error_msg = $err->getMessage();
            $error["message"] .= $error_msg;
            $error["exist"] = true;
    
            return $error;
        }

        if (!$response) {
            $error["message"] .= "Une erreur s'est produite durant la recuperation des categorie d'article'";
            $error["exist"] = true;
            return $error;
        }
    
        $aCategoriesIDS = $query->fetchAll();

        $value["categories"] = $aCategoriesIDS;
        $aDatasWithCats[] = $value;
       
    }

    return $aDatasWithCats;
}



