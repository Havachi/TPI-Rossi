<div class="checkout-title">
  <h1>Vérification finale</h1>
</div>
<div class="checkout-container">

  <div class="checkout-final">
    <div class="checkout-final-container">
      <div class="checkout-final-container-cart">
        <div class="container-title">
          <h2>Panier</h2>
        </div>
        <?php foreach ($_SESSION['Cart']->cartContent as $item): ?>
          <div class="cart-item">
            <div class="cart-item-name">
              <?php echo $item['product']->name ?>
            </div>
            <div class="cart-item-qty">
              <?php echo $item['product']->stock ?>
            </div>
            <div class="cart-item-price">
              <?php echo $item['product']->price ?>
            </div>
          </div>
          <?php endforeach; ?>
      </div>
      <div class="checkout-final-container-address">
        <div class="container-title">
          <h2>Adresse</h2>
        </div>
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
      </div>
      <div class="checkout-final-container-pay">
        <div class="container-title">
          <h2>Payement</h2>
        </div>
        <div class="pay-disabled">
          Les payements ne sont pas implémenté
        </div>
      </div>

    </div>



  </div>
</div>
<div class="checkout-btns">
  <a href="index.php?action=checkout&step=3" class="btn btn-back">Retour</a>
  <a href="index.php?action=checkout&step=end" class="btn btn-next">Suivant</a>
</div>
