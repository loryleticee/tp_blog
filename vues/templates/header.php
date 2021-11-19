<header>
    <h1 id="title">Blog des titans</h1>
    <nav id="nav">
        <a href="/vues/articles/articles.php">Articles</a>
        <a href="/vues/articles/add.php">Ajouter un article</a>
        <?php if (!isset($_SESSION['user'])) : ?>
            <a href="/vues/account/signup.php">Inscription</a>
            <a href="/vues/account/login.php">Connexion</a>
        <?php endif ?>
        <?php if (isset($_SESSION['user'])) : ?>
            <a href="/vues/account/logout.php">Déconnexion</a>
            <span><?=$_SESSION['user']['pseudo']?></span>
        <?php endif ?>
    </nav>
</header>