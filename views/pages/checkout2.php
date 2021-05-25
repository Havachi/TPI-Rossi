<div class="checkout-title">
  <h1>Vérification de l'adresse</h1>
</div>
<div class="checkout-container">

  <div class="checkout-address">
    <div class="address">
      <div class="address-name">
        <?php echo $_SESSION['Account']->firstName ?>
        <?php echo $_SESSION['Account']->lastName ?>
      </div>
      <div class="address-road">
        <?php echo $_SESSION['Account']->addressRoad ?>
        <?php echo $_SESSION['Account']->addressRoadNumber ?>
      </div>
      <div class="address-city">
        <?php echo $_SESSION['Account']->addressPostalCode ?>
      </div>
    </div>


    <div class="checkout-btns">
      <a href="index.php?action=checkout&step=1" class="btn btn-back">Retour</a>
      <a href="index.php?action=checkout&step=3" class="btn btn-next">Suivant</a>
    </div>
  </div>
</div>
