<!DOCTYPE html>
<html lang="fr">

<head>
  <?php include_once('../templates/head.php'); ?>
  <link rel="stylesheet" href="../../assets/style/main.css" />
</head>

<body>
  <?php include_once('../templates/header.php'); ?>
  <main class="main-center">
    <form action="../../controller/AccountController.php?action=login" method="POST" id="form-control">
      <div>
        <label for="email">Email :</label>
      </div>
      <div>
        <input type="email" name="email" id="email" autofocus required />
      </div>
      <div>
        <label for="password">Mot de passe : </label>
      </div>
      <div>
        <input type="password" name="password" id="password" required />
      </div>
      <div id="login_button">
        <input type="submit" value="Se connecter" />
      </div>
      <span>
        <small id="error">
          <?php
          if (isset($_GET['error'])) {
            echo $_GET['error'];
          } ?>
        </small>
      </span>
    </form>
  </main>
</body>
<?php include_once('../templates/footer.php'); ?>

</html>