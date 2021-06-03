<?php
require_once "models/gravatar.php";

?>

  <div class="navbar">
    <div class="navbar-list">

      <div class="navbar-list-brand">
        <div class="navbar-list-brand-logobrand">
          <a href="index.php">
            <img class="logo" src="/content/assets/logo/logo.png" alt="BioLocal Logo">
            <span class="brand">Bio-local</span>
          </a>
        </div>
      </div>
      <div class="navbar-list-nav">

        <div class="productFullList">
          <a href="index.php?action=userspace&display=info">Informations</a>
        </div>
        <div class="productDiscountList">
          <a href="index.php?action=userspace&display=order">Commandes</a>
        </div>
      </div>
      <?php if (isset($_SESSION['Account'])): ?>
        <div class="navbar-list-user">
          <div class="user-name">
            <a href="#">
              <?php echo $_SESSION['Account']->firstName?>
              <?php echo $_SESSION['Account']->lastName ?>
            </a>
          </div>
          <div class="user-avatar">
              <img onclick="toggleMenu()" src="<?=get_gravatar($_SESSION['Account']->emailAddress,50,'identicon','g',false) ; ?>" alt="">
          </div>
        </div>
        <div id="menu" class="navbar-list-menu" style="display:none;">
          <div class="menu">
            <div class="menu-container">
              <div class="menu-list">
                <div class="menu-list-item">
                  <a href="index.php?action=clientzone">Espace Client</a>
                </div>
                <div class="menu-list-item">
                  <a href="index.php?action=logout">Se déconnecter</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="navbar-list-auth">
          <div class="auth-login">
            <a class="btn btn-primary" href="index.php?action=login">Se connecter</a>
          </div>
          <div class="auth-register">
            <a class="btn btn-secondary" href="index.php?action=register">Créer un compte</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="sm-navbar">

    <div class="sm-navbar-container">
    <a nohref name="sidebar-icon" onclick="showSMNavbar()" class="sidebar-btnCollapse">
      <span class="material-icons md-48 menu-icon">menu</span>
    </a>
      <div class="sidebar" id="sidebar">
            <button type="button" onclick="hideSMNavbar()" class="sidebar-quit "><span class="material-icons md-36">clear</span></button>
            <a class="highlightLink" href="index.php?action=home">
              <img class="logo" src="/content/assets/logo/logo.png" alt="BioLocal Logo">
              <span>Bio Local</span>
            </a>

            <?php if (isset($_SESSION['Token']) && !empty($_SESSION['Token'])): ?>
              <a href="index.php?action=userspace&display=info">Informations</a>
              <a href="index.php?action=userspace&display=order">Commandes</a>
              <a href="index.php?action=logout">Se Deconnecter</a>
            <?php else: ?>
              <a href="index.php?action=login">Se Connecter</a>
              <a href="index.php?action=register">Créer un compte</a>
            <?php endif; ?>
      </div>
    </div>
  </div>
