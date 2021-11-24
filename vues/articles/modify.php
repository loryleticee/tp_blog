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
        <form action="../../controller/ArticleController.php?action=modify" method="POST" id="form-control">
            <div>
                <input type="hidden" name="article_id" id="article_id" value="<?=$aArticle['id']?>">
            </div>        

            <div>
                <label for="title">Titre</label>
            </div>
            <div>
                <input type="text" name="title" id="title" value="<?=$aArticle['title']?>" required />
            </div>
            <div>
                <label for="content">Ici le contenu de l'article </label>
            </div>
            <div>
                <textarea name="content" id="content" required>
                    <?=$aArticle['content']?>
                </textarea>
            </div>
            
            <div id="login_button">
                <input type="submit" value="Modifier l'article" />
            </div>
            <span>
                <small id="error">
                    <?php if (isset($_GET['error'])) {
                        echo $_GET['error'];
                    } ?>
                </small>
            </span>
        </form>
    </main>

</body>

<?php include_once('../templates/footer.php'); ?>

</html>