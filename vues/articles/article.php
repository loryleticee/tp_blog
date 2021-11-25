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
    <main id="main">
        <?php
        if (isset($aArticle['exist'])) {
            echo $aArticle['message'];
        } else { 
            ?>
            <div>
                <div class="container-article">
                    <div class="article-title">
                        <span><strong><?=$aArticle["title"]?></strong></span>
                    </div>
                    <div class="article-content">
                        <?=$aArticle["content"]?>
                    </div>
                    <div>
                        <button class="action-button"><a href=<?='/controller/ArticleController.php?action=modify&id='.$aArticle['id']?>>Modifier</a></button>
                        <button  class="action-button" onclick="_delete()">Supprimer</button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </main>
</body>

<?php include_once('../templates/footer.php'); ?>
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