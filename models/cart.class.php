<?php
namespace BioLocal;
require_once "models/product.class.php";
use BioLocal\Product;
/**
 * This class represent the any user's cart
 *
 * Theorical structure of the cart
 *
 * $cart [BioLocal\Cart]
 * |----> $cartContent
 *        |---->0
 *        |     |---->$product [BioLocal\Product]
 *        |     |---->$quantity [int]
 *        |
 *        |---->1
 *              |---->$product [BioLocal\Product]
 *              |---->$quantity [int]
 */
class Cart
{
  /**
   * This is the content of the cart
   * @var array
   */
  public Array $cartContent;
  /**
   * This is the total (money) that the user must pay
   * @var float
   */
  public float $cartTotal = 0;
  /**
   * This function is for adding item to the cart
   * @param Product $productToAdd The product to add
   * @param integer $quantity The quantity of product to add (1 by default)
   */
  public function addToCart(Product $productToAdd, int $quantity = 1){
    $idInCart = false;
    if (!empty($this->cartContent)) {
      $idInCart = $this->contains($productToAdd);
    }
    if ($idInCart !== false) {
      $this->cartContent[$idInCart]['quantity'] += $quantity;
    }else {
      $item = array('product' => $productToAdd, 'quantity' => $quantity);
      $this->cartContent[] = $item;
    }
    $this->calculateTotal();
  }
  /**
   * This function is for removing item to the cart
   * @param Product $productToAdd The product to remove
   * @param integer $quantity The quantity of product to remove (1 by default)
   */
  public function removeFromCart(Product $productToAdd, int $quantity = 1){
    $idInCart = self::contains($productToAdd);
    if ($idInCart != false) {
      $this->cartContent[$idInCart]['quantity'] -= $quantity;
    }
    $this->calculateTotal();
  }
  /**
   * This function reset the entire cart
   */
  public function deleteCart(){
    $this->cartContent = array();
  }
  /**
   * This function check if the any product is already in the
   * @param  Product $product [description]
   * @return int the key of the product if the cart contains said product
   * @return bool false if the cart doesn't contains the product
   */
  public function contains(Product $product){

    $ID = $product->productID;
    foreach ($this->cartContent as $key => $productInCart) {
      if ($productInCart['product']->productID == $ID) {
        return $key;
      }
    }
    return false;
  }
  /**
   * This function calculate the total that the user must pay
   */
  public function calculateTotal(){
    $total = 0;
    foreach ($this->cartContent as $item) {
      $total += $item['product']->price * $item['quantity'];
    }
    $this->cartTotal = $total;
  }
}
