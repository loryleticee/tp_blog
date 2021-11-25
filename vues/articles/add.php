<?php 
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('../templates/head.php'); ?>
    <link rel="stylesheet" href="../../assets/style/main.css" />
</head>

<body>
    <?php include_once('../templates/header.php'); ?>
    <main id="main">
        <form action="../../controller/ArticleController.php?action=add" method="POST" id="form-control">
            <div>
                <input type="hidden" name="user_id" id="user_id" value="<?php if (isset($_SESSION['id'])) { echo $_SESSION['id']; }?>">
            </div>        

            <div>
                <label for="title">Titre</label>
            </div>
            <div>
                <input type="text" size="100" name="title" id="title" required />
            </div>
            <div>
                <label for="content">Ici le contenu de l'article </label>
            </div>
            <div>
                <textarea name="content" id="content" rows="10" cols="100" required></textarea>
            </div>
            <div>
                <label for="categorie">Catégorie</label>
            </div>
            <div>
                <select name="categorie" id="categorie">
                    <option value="1">Héros</option>
                    <option value="2">Avengers</option>
                    <option value="3">Méchants</option>
                </select>
            </div>
            <div id="login_button">
                <input type="submit" value="Ajouter l'article" />
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