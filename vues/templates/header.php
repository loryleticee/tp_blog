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

    <nav id="nav-mobile">
        <div class="menu-btn">
            <div class="menu-btn__burger"></div>
        </div>
        <div id="nav-mobile_item">
            <ul>
                <li><a href="/controller/ArticleController.php?action=show">Articles</a></li>
                <?php if (isset($_SESSION['id'])) : ?>
                    <li><a href="/vues/articles/add.php">Ajouter un article</a></li>
                <?php endif ?>

                <?php if (!isset($_SESSION['id'])) : ?>
                    <li><a href="/vues/account/signup.php">Inscription</a></li>
                    <li><a href="/vues/account/login.php">Connexion</a></li>
                <?php endif ?>

                <?php if (isset($_SESSION['id'])) : ?>
                    <li><a href="/vues/account/logout.php">Déconnexion</a></li>
                    <span class="blue"><?= $_SESSION['pseudo'] ?></span>
                <?php endif ?>
            </ul>
        </div>
    </nav>
</header>

<script>
    const menuBtn = document.querySelector('.menu-btn');
    const navMobile = document.querySelector('#nav-mobile_item');
    let menuOpen = false;
    menuBtn.addEventListener('click', () => {
        if (!menuOpen) {
            menuBtn.classList.add('open');
            navMobile.classList.add('open');

            menuOpen = true;
        } else {
            menuBtn.classList.remove('open');
            navMobile.classList.remove('open');
            menuOpen = false;
        }
    })
</script>