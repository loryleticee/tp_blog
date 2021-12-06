<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

$routes = [
    "Accueil" => "WELCOME TO THE API OF BLOG DES TITANS",
    "routes" => [
        "/api/getArticles.php" => [
            "METHOD" => "GET",
            "description" => "GET ALL ARTICLES",
            "required params" => [],
            "return" => [
                "on_success" => "array of object datas",
                "on_failure" => "Object with a key (string) 'message' and a key (bool) 'exist' ",
            ]
        ],
        "/api/getArticle.php" => [
            "METHOD" => "GET",
            "description" => "GET AN ARTICLE",
            "required params" => [
                "id" => "l'identifiant de l'artile"
            ],
            "return" => [
                "on_success" => "array of object datas",
                "on_failure" => "Object with a key (string) 'message' and a key (bool) 'exist' ",
            ]
        ],
        "/api/postArticle.php" => [
            "METHOD" => "POST",
            "description" => "ADD AN ARTICLE",
            "required params" => [
                "categorie" => "L'identifiant de la catégorie de l'article",
                "content" => "Le contenu de l'article",
                "title" => "Le titre de l'article",
                "user_id" => "L'identifiant de l'utilisateur propriétaire de l' article",
            ],
            "return" => [
                "on_success" => "array of object datas with the new post id",
                "on_failure" => "Object with a key (string) 'message' and a key (bool) 'exist' ",
            ]
        ],
        "/api/putArticle.php" => [
            "METHOD" => "POST",
            "description" => "MODIFY AN ARTICLE",
            "required params" => [
                "article_id" => "L'identifiant de l'article",
                "title" => "Le titre de l'article",
                "content" => "Le contenu de l'article",
                "user_id" => "L'identifiant de l'utilisateur propriétaire de l' article",
            ],
            "return" => [
                "on_success" => "array of object datas",
                "on_failure" => "Object with a key (string) 'message' and a key (bool) 'exist' ",
            ]
        ],
        "/api/getCategories.php" => [
            "METHOD" => "GET",
            "description" => "GET ALL CATEGORIES",
            "required params" => [],
            "return" => [
                "on_success" => "array of object datas",
                "on_failure" => "Object with a key (string) 'message' and a key (bool) 'exist' ",
            ]
        ],
        "/api/postCategorie.php" => [
            "METHOD" => "POST",
            "description" => "ADD A CATEGORIE",
            "required params" => [
                "label" => "Le libellé de la catégorie",
            ],
            "return" => [
                "on_success" => "array of object datas with the new categorie id",
                "on_failure" => "Object with a key (string) 'message' and a key (bool) 'exist' ",
            ]
        ],
    ]
];

print(json_encode($routes));
