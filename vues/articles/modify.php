<?php
session_start();
require_once("../../config/mysql.php");
require_once('../../helpers/RedirectHelper.php');
require_once('../../helpers/ArticlesHelper.php');

if (empty($_GET['id'])) {
    redirect("/vues/articles/articles.php");
}
$aArticle = getArticle($_GET['id']);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('../templates/head.php'); ?>
    <link rel="stylesheet" href="../../assets/style/main.css" />
</head>

<body>
    <?php include_once('../templates/header.php'); ?>
    <main class="main-center">
        <form action="../../controller/ArticleController.php?action=modify" method="POST" id="form-control">
            <div>
                <input type="hidden" name="article_id" id="article_id" value="<?= $aArticle['id'] ?>">
            </div>

            <div>
                <label for="title">Titre</label>
            </div>
            <div>
                <input type="text" name="title" id="title"  size="10" value="<?= $aArticle['title'] ?>" required />
            </div>
            <div>
                <label for="content">Ici le contenu de l'article </label>
            </div>
            <div>
                <textarea name="content" id="content"  autofocus required>
                    <?= trim($aArticle['content']); ?>
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
    <?php include_once('../templates/footer.php'); ?>
</body>

</html>