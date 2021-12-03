<?php
session_start();
require_once("../../config/mysql.php");
require_once('../../config/config.php');
require_once('../../helpers/ArticlesHelper.php');
require_once('../../helpers/CategoriesHelper.php');

$aCategories = getCategories();
// $aArticles = getArticles();

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('../templates/head.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../assets/style/main.css" />
    <link rel="stylesheet" href="../../assets/style/burger-menu.css" />
</head>

<body>
    <div id="page">
        <?php include_once('../templates/header.php'); ?>
        <main id="main">
            <aside id="categorie-aside">
                <?php
                foreach ($aCategories as $cat) : ?>
                    <div>
                        <span><?= $cat['label'] ?></span>
                    </div>
                <?php endforeach ?>
            </aside>
            <div id="error"></div>
            <div class="container-article"></div>
        </main>
        <div>
            <?php include_once('../templates/footer.php'); ?>
        </div>
    </div>
    <script>
        $.ajax({
            type: 'GET',
            url: "https://blog.loryleticee.fr/api/getArticles.php",
            dataType: 'json',
            success: function(e) {
                showArticleTitle(e)
            },
            error: function(d) {
                console.log(d.datas)
            }
        });

        function showArticleTitle(datas) {
            datas.forEach( (data) => {
                $(".container-article").append('<a href="/controller/ArticleController.php?action=show&id=' + data['id'] + '"><div class="article-title">' + data["title"] + '</div></a>')
            });
        }
    </script>
</body>


</html>