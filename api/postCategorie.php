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
        $_POST['label']
    )) {
        $error["message"] = "Veuillez remplir le champs label. Merci ! </br>";
        $error["exist"] = true;

        print(json_encode($error));
        die;
    }

    $aReponse = checkAddParams($_POST['label']);
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
function checkAddParams(string $label) : array
{
    global $error;
    $label =  htmlspecialchars(strip_tags($label));

    if ( empty($label) ) {
        $error["message"] = "Veuillez remplir le label. Merci ! </br>";
        $error["exist"] = true;

        return $error;
    }
    
    insertCategorie($label);
    
    return $error;
}

/**
 * @param int $user_id
 * @param string $title
 * @param string $content
 * @param int|bool $categorie
 * @return array Retourne un tableau contenant une clée exist qui vaut FALSE si aucune erreur est survenu , True dans le cas contraire
 */
function insertCategorie($label) : array 
{
    global $connexion;
    global $error;

    try {
        $query = $connexion->prepare("INSERT INTO `categorie` (`label`) VALUES (:label)");
        $response = $query->execute(['label' => $label]);
    } catch ( \PDOException $err) {
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
        $error["exist"] = true;

        return $error;
    }

    if (!$response) {
        $error["message"] =  "Une erreur s'est produite durant l\'ajout de la categorie";
        $error["exist"] = true;
        
        return $error;
    }
    
    $iCategorieID = getLastCategorie();
    $error["categorie_id"] = $iCategorieID;

    return $error;
}

function getLastCategorie() {
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare("SELECT `id` FROM `categorie` WHERE is_deleted=0 ORDER BY id DESC LIMIT 1");
        $response = $query->execute();
    } catch (\PDOException $err) {
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
        $error["exist"] = true;

        return $error;
    }

    if (!$response) {
        $error["message"] = "Un probleme est survenu lors de la recupération de la nouvelle categorie.";
        $error["exist"] = true;

        return $error;
    }

    $aDatas = $query->fetch();


    if (!isset($aDatas['id'])) {
        $error["message"] = "Aucune categorie trouvé";
        $error["exist"] = true;

        return $error;
    }

    return  (int) $aDatas['id'];
}




