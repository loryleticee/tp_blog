<?php
function getArticle($article_id): array
{
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare("SELECT * FROM `article` WHERE id=:id AND is_deleted=0");
        $response = $query->execute(['id' => $article_id]);
    } catch (\PDOException $err) {
        $error_code = $err->getCode();
        $error_msg = $err->getMessage();
        $error["message"] .= $error_msg;
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

function getLastUserArticle($title, $user_id) {
    global $connexion;
    global $error;
    try {
        $query = $connexion->prepare("SELECT `id` FROM `article` WHERE user_id=:id AND title=:title AND is_deleted=0");
        $response = $query->execute(['user_id' => $user_id, 'title' => $title]);
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