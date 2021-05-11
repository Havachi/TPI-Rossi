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
            <option value="">Jean-marc Quennoz</option>
            <option value="">Gilbert Francois</option>
            <option value="">Michel Justemichel</option>
          </select>
        </li>
      </ul>
    </div>
  </div>
  <div class="center-container">
    <div class="products-list">

      <!--Single item-->
      <div class="products-list-item">
        <div class="card">
          <div class="card-header">
            <div class="card-header-image">
              <img src="content\assets\products\krot.jpg" alt="">
            </div>
          </div>
          <div class="card-separator"></div>
          <div class="card-body">
            <div class="card-body-title">
              Carottes
            </div>
            <div class="product-price">
              1.5 / pièce
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
      <!--This single item will be the template for the future dinamically generated list-->
      <?php foreach ($productsList as $product): ?>
        <?php echo $product ?>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="right-container">
    <div class="cart">
      <h2 class="cart-title">Panier vide<a href="index.php"><span class="material-icons">arrow_forward</span></h2></a>
      <table class="cart-list" cellpadding="10">
        <thead class="cart-list-header">
          <tr>
            <th>Article</th>
            <th>Quantitée</th>
            <th>Prix</th>
          </tr>
        </thead>
        <tbody class="cart-list-body">
          <tr>
            <td>test1</td>
            <td>1</td>
            <td>1.-</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
