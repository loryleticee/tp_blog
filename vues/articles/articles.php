<?php
session_start();
require_once("../../config/mysql.php");
require_once('../../config/config.php');
require_once('../../helpers/ArticlesHelper.php');

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
    <?php include_once('../templates/header.php'); ?>
    <main id="main">
        <?php
        if (isset($aArticles['exist'])) {
            echo $aArticles['message'];
        } else {?>

           <div class="container-article">
                <?php 
                    foreach ($aArticles as $key => $array_element) {
                            echo '<div class="article-title"><a href="/controller/ArticleController.php?action=show&id=' . $array_element['id'] . '">' . $array_element["title"] . '</a></div>';
                    }
                ?>
           </div>
        <?php
        }
        ?>
    </main>
</body>

<?php include_once('../templates/footer.php'); ?>

</html>