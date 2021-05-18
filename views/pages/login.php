<div class="login">
  
<?php if (isset($error)): ?>
  <div class="error-container">
    <div class="error">

        <div class="error-text">
          <p><?php echo $error; ?></p>
        </div>

    </div>
  </div>
<?php endif; ?>

  <div class="login-container">
    <form class="login-form" action="index.php?action=login" method="post">
        <h2 class="login-form-label">Connexion</h2>
        <div class="login-form-inputGroup">
          <label for="emailAddress">Adresse E-mail</label>
          <input class="login-form-inputGroup-item" type="text" name="userEmailAddress">
        </div>
        <div class="login-form-inputGroup">
          <label for="password">Mot de passe</label>
          <input class="login-form-inputGroup-item" type="password" name="userPassword">
        </div>
      <div class="login-form-btns">
        <button class="btn btn-primary" id="submitBtn" name="action" value="login" type="submit" href="index.php?action=login">Connexion</button>
      </div>
      <div class="login-form-links">
        <div class="forgotPassword"><a href="#">Mot de passe oublié?</a></div>
        <div class="linkToRegister"><a href="index.php?action=register">Inscription gratuite</a></div>
      </div>
    </form>
  </div>
</div>
