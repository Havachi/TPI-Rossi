<div class="checkout-title">
  <h1>Vérification du panier</h1>
</div>
<div class="checkout-container">

  <div class="cart-content">
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
    <div class="checkout-btns">
      <a href="index.php?action=home" class="btn btn-back">Retour</a>
      <a href="index.php?action=checkout&step=2" class="btn btn-next">Suivant</a>
    </div>
  </div>
</div>
