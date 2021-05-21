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
      <?php if (isset($_SESSION['Token']) && !empty($_SESSION['Token'])): ?>
        <?php foreach ($pageData['products'] as $postalCode => $products): ?>
          <?php foreach ($products as $product): ?>


          <!--Single item-->
          <div class="products-list-item">
            <div class="card">
              <div class="card-header">
                <div class="card-header-image">
                  <?php if (file_exists("content/assets/products". $product['productImagePath'] . ".jpg")): ?>
                    <img src="content/assets/products<?php echo  $product['productImagePath'] ?>.jpg" alt="">
                    <?php else: ?>
                    <img src="content/assets/products<?php echo$product['productImagePath']  ?>.png" alt="">
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
                  <?php echo $postalCode . " - " . $product['supplyerName']?>
                </div>
                <div class="product-btns">
                  <a class="btn btn-light" href="index.php?action=aTC&product=<?php echo $product['productID'] ?>" >Ajouter au panier</a>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        <?php endforeach; ?>

        <?php else: ?>
          <?php foreach ($pageData['products'] as $products): ?>
              <?php foreach ($products as $product): ?>
                <!--Single item-->
                <div class="products-list-item">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-header-image">
                        <?php if (file_exists("content/assets/products". $product['productImagePath'] . ".jpg")): ?>
                          <img src="content/assets/products<?php echo  $product['productImagePath'] ?>.jpg" alt="">
                          <?php else: ?>
                          <img src="content/assets/products<?php echo $product['productImagePath']  ?>.png" alt="">
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="card-separator"></div>
                    <div class="card-body">
                      <div class="card-body-title">
                        <?php echo $product['productName'] ?>
                      </div>
                      <div class="product-price">
                        <?php echo $product['productPrice'] ?> CHF / pièce
                      </div>
                      <div class="product-rate">
                        <?php echo $product['supplyerCP'] ?>
                      </div>
                      <div class="product-btns">
                        <a class="btn btn-disabled" nohref>Ajouter au panier</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
          <?php endforeach; ?>
      <?php endif; ?>


    </div>
  </div>
  <div class="right-container">
    <div class="cart">
      <h2 class="cart-title">Panier <?php if (!isset($_SESSION['Cart']) || empty($_SESSION['Cart']->cartContent)): ?>Vide<?php endif; ?>
      <a href="#" onclick="toggleCart();return false;"><span class="material-icons">arrow_forward</span></h2></a>
      <table class="cart-list" cellpadding="10">
        <thead class="cart-list-header">
          <tr>
            <th>Article</th>
            <th>Quantitée</th>
            <th>Prix</th>
          </tr>
        </thead>
        <tbody class="cart-list-body">
          <?php if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart']->cartContent) ): ?>
            <?php foreach ($_SESSION['Cart']->cartContent as $key => $itemInCart): ?>
              <tr>
                <td><?php echo $itemInCart['product']->name ?></td>
                <td><?php echo $itemInCart['quantity'] ?></td>
                <td><?php echo $itemInCart['product']->price ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <?php if (isset($_SESSION['Token'])): ?>
          <tfoot class="cart-list-foot">
            <tr class="cart-list-foot-row">
              <td class="cart-list-foot-cell"><b>Total</b></td>
              <td class="cart-list-foot-cell"></td>
              <td class="cart-list-foot-cell">
              <?php if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart']->cartContent)): ?>
                <?php echo $_SESSION['Cart']->cartTotal . "CHF"?>
              <?php else: ?>
                <?='0.- CHF'?>
              <?php endif; ?>
              </td>
              <td></td>
            </tr>
          </tfoot>
        <?php endif; ?>
      </table>

    </div>
  </div>
</div>
