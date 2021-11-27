<?php
function getArticle($article_id): array
{
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare(
            "SELECT `article`.* , `user`.`pseudo` 
            FROM `article`
            INNER JOIN `user` ON `article`.`user_id` = `user`.`id`
            WHERE `article`.`id` = :id AND `article`.is_deleted=0"
        );
        $response = $query->execute(['id' => $article_id]);
    } catch (\PDOException $err) {
        $error_code = $err->getCode();
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
        $error["exist"] = true;

        return $error;
    }
    if (!$response) {
        $error["message"] .= "Une erreur s'est produite durant la recherche d'article'";
        $error["exist"] = true;
        return $error;
    }
    $aDatas = $query->fetch();

    if (!isset($aDatas['id'])) {
        $error["message"] = "Aucun article trouvé";
        $error["exist"] = true;

        return $error;
    }

    return $aDatas;
}

function getArticles(): array
{
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare("SELECT * FROM `article` WHERE is_deleted=0");
        $response = $query->execute();
    } catch (\PDOException $err) {
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

    $aDatas = $query->fetchAll();

    if (!isset($aDatas[0]['id'])) {
        $error["message"] = "Aucun article trouvé";
        $error["exist"] = true;

        return $error;
    }

    return $aDatas;
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