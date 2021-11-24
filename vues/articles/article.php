<?php
session_start();
require_once("../../config/mysql.php");
require_once('../../helpers/ArticlesHelper.php');

if (!isset($_GET['id'])) {
    die("Il manque un paramètre");
}
$aArticle = getArticle($_GET['id']);

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('../templates/head.php'); ?>
</head>

<body>
    <?php include_once('../templates/header.php'); ?>
    <main id="main">
        <?php
        if (isset($aArticles['exist']))  {
            echo $aArticles['message'];
        } else {
            echo "<ul>";
            foreach ($aArticles as $key => $array_element) {
                    echo '<li><a href="/controller/ArticleController.php?action=modify&id=' . $array_element['id'] . '">' . $array_element["title"] . '</a></li>';
            }
            echo "</ul>";
        }
        ?>
    </main>
</body>

<?php include_once('../templates/footer.php'); ?>

</html>