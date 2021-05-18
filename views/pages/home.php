<div class="homePage">
  <div class="left-container">
    <div class="filters">
      <h2>Filtres</h2>
      <ul class="filters-shop-list">
        <li class ="filters-shop-list-item">
          <!--The max value should be automaticaly calculated from the biggest price in db, same for the min-->
          <label for="priceFilter">Prix</label>
          <input type="range" name="priceFilter" min="0" max="50">
        </li>
        <li class ="filters-shop-list-item">
          <!--The max value should be automaticaly calculated from the biggest price in db, same for the min-->
          <label for="supplyerFilter">Producteur</label>
          <select name="supplyerFilter">
            <option value=""></option>
            <?php foreach ($pageData['supplyers'] as $supplyer): ?>
              <option value=""><?php echo $supplyer['supplyerName'] ?></option>
            <?php endforeach; ?>
          </select>
        </li>
      </ul>
    </div>
  </div>
  <div class="center-container">
    <div class="products-list">
    <?php foreach ($pageData['products'] as $product): ?>
      <!--Single item-->
      <div class="products-list-item">
        <div class="card">
          <div class="card-header">
            <div class="card-header-image">
              <?php if (file_exists("content\assets\products\\".$product['productID'] . ".jpg")): ?>
                <img src="content\assets\products\<?php echo $product['productID'] ?>.jpg" alt="">
                <?php else: ?>
                <img src="content\assets\products\<?php echo $product['productID'] ?>.png" alt="">
              <?php endif; ?>
            </div>
          </div>
          <div class="card-separator"></div>
          <div class="card-body">
            <div class="card-body-title">
              <?php echo $product['productName'] ?>
            </div>
            <div class="product-price">
              <?php echo $product['productPrice'] ?> / pièce
            </div>
            <div class="product-rate">
              <span class="material-icons">star_outline</span>
              <span class="material-icons">star_outline</span>
              <span class="material-icons">star_outline</span>
              <span class="material-icons">star_outline</span>
              <span class="material-icons">star_outline</span>
            </div>
            <div class="product-btns">
              <a class="btn btn-light" href="index.php">Ajouter au panier</a>
            </div>
          </div>
        </div>
      </div>
      <?php // TODO: do that now ?>
      <!--This single item will be the template for the future dinamically generated list-->
      <?php endforeach; ?>
    </div>
  </div>
  <div class="right-container">
    <div class="cart">
      <h2 class="cart-title">Panier <?php if (!isset($_SESSION['cart']) && empty($_SESSION['cart'])): ?>Vide<?php endif; ?>
      <a href="index.php"><span class="material-icons">arrow_forward</span></h2></a>
      <table class="cart-list" cellpadding="10">
        <thead class="cart-list-header">
          <tr>
            <th>Article</th>
            <th>Quantitée</th>
            <th>Prix</th>
          </tr>
        </thead>
        <tbody class="cart-list-body">
          <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart']) ): ?>
            <?php foreach ($_SESSION['cart'] as $key => $value): ?>

            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
