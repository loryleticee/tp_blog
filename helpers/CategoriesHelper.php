<?php
function getCategories(): array
{
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare("SELECT * FROM `categorie` WHERE is_deleted=0 ORDER BY label ASC");
        $response = $query->execute();
    } catch (\PDOException $err) {
        $error_code = $err->getCode();
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
        $error["exist"] = true;

        return $error;
    }

    if (!$response) {
        $error["message"] .= "Une erreur s'est produite durant la recherche des categories '";
        $error["exist"] = true;
        return $error;
    }

    $aDatas = $query->fetchAll();

    if (!isset($aDatas[0]['id'])) {
        $error["message"] = "Aucune categorie trouvé";
        $error["exist"] = true;

        return $error;
    }

    return $aDatas;
}