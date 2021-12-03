<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

$routes = [
    "Accueil" => "WELCOME TO THE API OF BLOG DES TITANS",
    "routes" => [
        "/api/getArticles.php" => [
            "description" => "GET ALL ARTICLES",
            "required params" => []
        ],
        "/api/postArticle.php" => [
            "description" => "ADD AN ARTICLE",
            "required params" => [
                "categorie" => "L'identifiant de la catégorie de l'article",
                "content" => "Le contenu de l'article",
                "title" => "Le titre de l'article",
                "user_id" => "L'identifiant de l'utilisateur propriétaire de l' article",
            ]
        ],
        "/api/putArticle.php" => [
            "description" => "MODIFY AN ARTICLE",
            "required params" => [
                "article_id" => "L'identifiant de l'article",
                "title" => "Le titre de l'article",
                "content" => "Le contenu de l'article",
                "user_id" => "L'identifiant de l'utilisateur propriétaire de l' article",
            ]
        ],
        "/api/getCategories.php" => [
            "description" => "GET ALL CATEGORIES",
            "required params" => [],
        ],
        "/api/postCategorie.php" => [
            "description" => "ADD A CATEGORIE",
            "required params" => [
                "label" => "Le libellé de la catégorie",
            ]
        ],
    ]
];

print(json_encode($routes));
