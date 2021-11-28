<?php
session_start();
require_once("../../config/mysql.php");
require_once('../../config/config.php');
require_once('../../helpers/ArticlesHelper.php');
require_once('../../helpers/CategoriesHelper.php');

$aCategories = getCategories();
$aArticles = getArticles();

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('../templates/head.php'); ?>
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
            <?php
            if (isset($aArticles['exist'])) {
                echo $aArticles['message'];
            } else { ?>
                <div class="container-article">
                    <?php
                    foreach ($aArticles as $key => $array_element) {
                        echo '<div class="article-title"><a href="/controller/ArticleController.php?action=show&id=' . $array_element['id'] . '">' . $array_element["title"] . '</a></div>';
                    }
                    ?>
                </div>
            <?php } ?>
        </main>
        <div>
            <?php include_once('../templates/footer.php'); ?>
        </div>
    </div>
</body>


</html>