<?php
session_start();
require_once '../config/mysql.php';
require_once '../config/config.php';

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error['message'] = "cannot " . $_SERVER['REQUEST_METHOD'] . " /  method not allowed";
    $error['exist'] = true;

    print(json_encode($error));
    die;
}

$aReponse = [];
$isFormData = stripos($contentType, "form-data");

if (in_array($contentType, $aACCEPTED_FORM_DATA) || $isFormData) {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);
    $_i = empty($input) ? "_POST" : "input";

    if (empty($$_i['categorie_id'])) {
        $error["message"] = "Le paramètre categorie_id est manquant, veuillez l\'envoyer dans votre requete";
        $error["exist"] = true;

        print(json_encode($error));
        die;
    }

    $aArgs = array_flip(array_keys($$_i));
    foreach ($aArgs as $k => $v) {
        $aArgs[$k] = $$_i[$k];
    }

    $aReponse = deleteCategorie($aArgs);
}

function filter_array( string $a) : string
{
    $v = htmlspecialchars(strip_tags($a));
    return $v;
}

function filter_array_empty(string $a) : bool 
{
    return empty($a) ? false : true;
}

function deleteCategorie(array $aArgs): array
{
    global $connexion;
    global $error;
    
    $re = array_filter(array_map("filter_array", $aArgs), "filter_array_empty");
    $q = "DELETE FROM `categorie` ";
    $r = array_filter(array_keys($re), function ($e) {
        return  $e !== "categorie_id";
    });
    $i = 0;

    foreach ($r as $v) {
        $q .= "`$v` = :$v " . (count($r) - 1 > $i ? "," : "");
        $i++;
    }

    $q .= "WHERE `id`= :categorie_id; DELETE FROM categorie_article WHERE categorie_id=".$re['categorie_id'].";";

    if (empty($re['categorie_id'])) {
        $error["message"] = "Un paramètre est manquant, veuillez remplir tous les champs";
        $error["exist"] = true;

        print(json_encode($error));
        die;
    }
    
    try {
        $query = $connexion->prepare($q);
        $response = $query->execute($re);
    } catch (\PDOException $err) {
        $error_code = $err->getCode();
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
        $error["exist"] = true;
        
        return $error;
    }
    
    if (!$response) {
        $error["message"] .= "Une erreur s'est produite durant la suppression de la categorie'";
        $error["exist"] = true;
        return $error;
    }
    
    $error["message"] = 'Suppression effectué';
    
    return $error;
}

print(json_encode($aReponse));