<?php require_once "models/gravatar.php"; ?>
<div class="userspace">
  <div class="userspace-container">
    <div class="userspace-personnal">
      <div class="userspace-personnal-avatar">
        <img src="<?=get_gravatar($_SESSION['Account']->emailAddress,80,'identicon','g',false) ; ?>" alt="">
      </div>
      <div class="userspace-personnal-info">
        <div class="userspace-personnal-info-name">
          <h1><?php echo $_SESSION['Account']->lastName . " " .  $_SESSION['Account']->firstName?></h1>

        </div>
        <div class="userspace-personnal-info-address">
          <?php echo $_SESSION['Account']->emailAddress?>
        </div>

      </div>
      <div class="userspace-personnal-changebtn">
        <a class="btn btn-primary" href="#">Changer</a>
      </div>
    </div>
    <div class="userspace-address">
      <div class="userspace-address-road">
        <div class="userspace-address-road-name">
          <?php echo $_SESSION['Account']->addressRoad ?>
        </div>
        <div class="userspace-address-road-number">
          <?php echo $_SESSION['Account']->addressRoadNumber ?>
        </div>
      </div>
      <div class="userspace-address-city">
        <div class="userspace-address-city-name">

        </div>
        <div class="userspace-address-city-code">
          <?php echo $_SESSION['Account']->addressRoadNumber ?>
        </div>
      </div>
      <div class="userspace-address-changebtn">
        <a class="btn btn-primary" href="#">Changer</a>
      </div>
    </div>
    <div class="userspace-password">
      <div class="userspace-password-changebtn">
        <a class="btn btn-primary" href="#">Changer</a>
      </div>
    </div>
  </div>
</div>
