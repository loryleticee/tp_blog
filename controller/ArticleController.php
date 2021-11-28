<?php
session_start();
require_once("../config/config.php");
require_once("../model/ArticleModel.php");
require_once("../helpers/RedirectHelper.php");

if (!isset($_GET['action'])) {
    die("Params needed");
}

$action = $_GET['action'];

switch ($action) {
    case 'add':
        add();
        break;
    case 'show':
        show();
        break;
    case 'modify':
        modify();
        break;
    case 'delete':
        _delete();
        break;
    default:
        die("no action provide");
        break;
}

/**
 * @return void
 */
function add(): void
{
    global $domaine;
    if (!isset(
        $_POST['user_id'],
        $_POST['title'],
        $_POST['content'],
        $_POST['categorie']
    )) {
        redirect($domaine . "/vues/article/add.php?error=un parametre manque à la requete");
    }

    $isValid = checkAddParams($_POST['user_id'], $_POST['title'],  $_POST['content'], $_POST['categorie']);

    if ($isValid['exist']) {
        redirect($domaine . "/vues/articles/add.php?error=".$isValid['message']);
    }
 
    redirect($domaine . "/vues/articles/article.php?id=". $isValid['article_id']);
}

/**
 * @return void
 */
function show(): void
{
    global $domaine;
    if(isset($_GET["id"])) {
        if(empty($_GET["id"])) {
            die("Aucun article trouvé");
        }
        $article_id = htmlspecialchars(strip_tags($_GET["id"]));
        redirect($domaine . "/vues/articles/article.php?id=" . $article_id);
    }
    redirect($domaine . "/vues/articles/articles.php");
}

/**
 * @return void
 */
function modify(): void
{
    global $domaine;
    if (empty($_POST)) {
        if (!isset($_GET['id'])) {
            die('missed parameters');
        }

        $article_id =  htmlspecialchars(strip_tags($_GET['id']));

        redirect($domaine . "/vues/articles/modify.php?id=" . $article_id);
    }

    if (isset($_POST['article_id'], $_POST['title'], $_POST['content'])) {
        $isModify = modifyArticle($_POST['article_id'], $_POST['title'], $_POST['content'], $_SESSION['id']);

        if (!$isModify['exist']) {
            redirect($domaine . "/vues/articles/article.php?id=". $_POST['article_id']);
        }
    }

    redirect($domaine . "/vues/articles/articles.php");
}

/**
 * @return void
 */
function _delete(): void
{
    global $domaine;
    if (empty($_POST)) {
        if (empty($_GET['id'])) {
            die('missed parameters');
        }
        
        $article_id =  htmlspecialchars(strip_tags($_GET['id']));
        $isDelete = deleteArticle($article_id, $_SESSION['id']);

        if ($isDelete['exist']) {
            redirect($domaine . "/vues/articles/article.php?id=". $article_id . "&error=" . $isDelete['message']);
        }
    }

    redirect($domaine . "/vues/articles/articles.php");
}

