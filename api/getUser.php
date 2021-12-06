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
    if (empty($_GET["id"])) {
        $error['message'] = "Aucun utilisateur n’a été ciblé, veuillez passer en paramètre un id d'utilisateur";
        $error['exist'] = true;
        print(json_encode($error));
        die;
    } 

    $aReponse = getUser($_GET["id"]);
} else {
    $error['message'] = "Mauvais type de corps de page, form-data est interdit ici";
    $error['exist'] = true;
    print(json_encode($error));
    die;
}

print(json_encode($aReponse));

function getUser($iUser): array
{
    global $connexion;
    global $error;

    $iUser = htmlspecialchars(strip_tags($iUser));

    if (empty($iUser)) {
        $error['message'] = "Aucun utilisateur n’a été ciblé, veuillez passer en paramètre un id d'utilisateur";
        $error['exist'] = true;
        print(json_encode($error));
        die;
    } 

    try {
        $query = $connexion->prepare("SELECT `pseudo`, `email` FROM `user` WHERE is_deleted=0 AND id=:id");
        $response = $query->execute(["id" => $iUser]);
    } catch (\PDOException $err) {
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
        $error["exist"] = true;

        return $error;
    }

    if (!$response) {
        $error["message"] .= "Une erreur s'est produite durant l'ajout de l'utilisateur'";
        $error["exist"] = true;
        return $error;
    }

    $aDatas = $query->fetchAll();

    if (!isset($aDatas[0]['id'])) {
        $error["message"] = "Aucun utilisateur trouvé";
        $error["exist"] = true;

        return $error;
    }

    return $aDatas;
}



