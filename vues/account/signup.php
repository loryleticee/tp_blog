<!DOCTYPE html>
<html lang="fr">
  <head>
    <?php include_once('../templates/head.php'); ?>
  </head>

  <body>
    <?php include_once('../templates/header.php'); ?>
    <main id="main">
      <form action="../../controller/AccountController.php?action=signup" method="POST" id="form-control">
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

  <?php include_once('../templates/footer.php'); ?>
</html>
