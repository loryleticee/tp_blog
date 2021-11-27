<?php
session_start();
require_once("../../config/mysql.php");
require_once('../../helpers/ArticlesHelper.php');

if (!isset($_GET['id'])) {
    die("Il manque un paramètre");
}
if (empty($_GET['id'])) {
    die("Il manque un paramètre");
}

$article_id = htmlspecialchars(strip_tags($_GET['id']));
$aArticle = getArticle($article_id);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('../templates/head.php'); ?>
    <link rel="stylesheet" href="../../assets/style/main.css" />
    <link rel="stylesheet" href="../../assets/style/burger-menu.css" />
</head>

<body>
    <?php include_once('../templates/header.php'); ?>
    <main class="main-center">
        <?php
        if (isset($aArticle['exist'])) {
            echo $aArticle['message'];
        } else { 
            ?>
            <div class="flex-container">
                <div class="container-article">
                    <div class="article-title">
                        <span><strong><?=$aArticle["title"]?></strong></span>
                    </div>
                    <div class="article-content">
                        <?=$aArticle["content"]?>
                    </div>
                    <div>
                        <span class="action-button" title="modifier l'article"><a href=<?='/controller/ArticleController.php?action=modify&id='.$aArticle['id']?>><i class="far fa-edit"></i></a></span>
                        <span class="action-button" title="Supprimer l'article" onclick="_delete()"><i class="fas fa-trash-alt"></i></span>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </main>
    <?php include_once('../templates/footer.php'); ?>
</body>

<script>
    function _delete () {
        article_id = <?php print($aArticle['id']) ?>;
        if( confirm('Etes vous sur de vouloir supprimer cet article ? ')) {
            $.ajax({

            })
        }
    }
</script>
</html>