<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, , maximum-scale=1"
    />
    <meta name="description" content="Le blog des titans" />
    <meta
      name="keywords"
      content="blog, titans, héros, discution, jeux, génie"
    />
    <meta name="author" content="Lory LÉTICÉE" />
    <link rel="stylesheet" href="../../assets/style/main.css" />
    <link rel="stylesheet" href="../../assets/style/burger-menu.css" />

    <title>Accueil - Blog</title>
  </head>

  <body>
    <header>
      <h1 id="title">Blog des titans</h1>
      <nav id="nav">
        <a href="/vues/articles/articles.html">Articles</a>
        <div class="dropdown">
          <a href="/vues/articles/categories.html">Catégories</a>
          <div class="dropdown-content">
            <a href="/vues/articles/categories.html">Héros</a>
            <a href="/vues/articles/categories.html">Légendes</a>
            <a href="/vues/articles/categories.html">Monstre</a>
          </div>
        </div>

        <a href="/vues/articles/add.html">Ajouter un article</a>
        <a href="/vues/account/signup.html">Inscription</a>
        <a href="/vues/account/login.html">Connexion</a>
        <a href="/vues/account/logout.html">Déconnexion</a>
      </nav>
    </header>

    <main id="main">
      <form action="../../controller/AccountController.php" method="POST" id="form-control">
        <div>
          <label for="pseuso">Pseudo : </label>
          <input
            type="text"
            name="pseudo"
            id="pseudo"
            required
          />
        </div>
        <div>
          <label for="email">Email :</label>
          <input type="email" name="email" id="email" />
        </div>
        <div>
          <label for="password">Mot de passe : </label>
          <input type="password" name="password" id="password" />
        </div>
        <div>
          <label for="comfirm_password">Confirmer votre mot de passe </label>
          <input
            type="password"
            name="comfirm_password"
            id="comfirm_password"
          />
        </div>
        <div>
          <label for="user_type">Choissisez votre catégorie </label>
          <select name="user_type" id="user_type">
            <optgroup label="Administrateurs">
              <option value="Admin">Admin</option>
              <option value="Moderator">Moderator</option>
            </optgroup>
            <optgroup label="Clients">
              <option value="Auteur">Auteur</option>
              <option value="Éditeur">Éditeur</option>
              <option value="Maison éditorial">Maison éditorial</option>
              <option value="Imprésario">Imprésario</option>
            </optgroup>
          </select>
        </div>
        <div>
          <label for="accepted">En cochant cette case, j'accepte que mes données soient exploitées par ....</label>
          <input type="checkbox" name="accepted" id="accepted" required>
        </div>
        <div id="signup_button">
          <input type="submit" value="S'inscrire" />
        </div>
      </form>
    </main>
  </body>

  <footer id="footer">
    <div>
      <span><small>&#169; 2021 Lory LÉTICÉE</small></span>
    </div>
  </footer>
</html>
