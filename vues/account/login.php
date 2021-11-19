<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('../templates/head.php'); ?>
</head>

<body>
    <?php include_once('../templates/header.php'); ?>
    <main id="main">
      <form action="../../controller/AccountController.php" method="POST" id="form-control">
        <div>
          <label for="email">Email :</label>
          <input type="email" name="email" id="email" required />
        </div>
        <div>
          <label for="password">Mot de passe : </label>
          <input type="password" name="password" id="password" required />
        </div>
       <div>
         <small><?php  if( isset($_GET['error'])) { echo $_GET['error'];  } ?></small>
       </div>
        <div id="login_button">
          <input type="submit" value="Se connecter" />
        </div>
      </form>
    </main>
</body>
<?php include_once('../templates/footer.php'); ?>

</html>