<header>
    <h1 id="title">Blog des titans</h1>
    <nav id="nav">
        <a href="/controller/ArticleController.php?action=show">Articles</a>
        <?php if (isset($_SESSION['id'])) : ?>
            <a href="/vues/articles/add.php">Ajouter un article</a>
        <?php endif ?>
        
        <?php if (!isset($_SESSION['id'])) : ?>
            <a href="/vues/account/signup.php">Inscription</a>
            <a href="/vues/account/login.php">Connexion</a>
        <?php endif ?>

        <?php if (isset($_SESSION['id'])) : ?>
            <a href="/vues/account/logout.php">Déconnexion</a>
            <span class="blue"><?= $_SESSION['pseudo'] ?></span>
        <?php endif ?>

    </nav>
</header>