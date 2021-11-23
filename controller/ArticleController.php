<?php
require_once("../config/config.php");
require_once("../model/ArticleModel.php");
require_once("../helpers/redirect.php");

if (!isset($_GET['action'])) {
    die("Params needed");
}

$action = $_GET['action'];

switch ($action) {
    case 'add':
        add();
        break;
    default:
        die("no action provide");
        break;
}

function add() {
    global $domaine;
    if ($_GET['action'] === "add") {
        if(!isset(
            $_POST['user_id'],
            $_POST['title'],
            $_POST['content'],
            $_POST['categorie'],
            )) {
                redirect($domaine . "/vues/article/add.php?error=un parametre manque à la requete");
        }
    
        $isValid = checkAddParams($_POST['user_id'], $_POST['title'],  $_POST['content'], $_POST['categorie']);
    
    }
}
