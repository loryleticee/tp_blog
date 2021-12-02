<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

$routes = [
    "Accueil" => "WELCOME TO THE API OF BLOG DES TITANS",
    "routes" => [
        "/api/getArticles" => [
            "description" => "GET ALL ARTICLES"
        ],
        "/api/postArticle" => [
            "description" => "ADD AN ARTICLE"
        ],
        "/api/putArticle" => [
            "description" => "MODIFY AN ARTICLE"
        ],
        "/api/getCategories" => [
            "description" => "GET ALL CATEGORIES"
        ],
        "/api/postCategorie" => [
            "description" => "ADD A CATEGORIE"
        ],
    ]
    ];

print(json_encode($routes));