<?php

namespace BioLocal;
/**
 * This class represent a single order placed by a user
 */
class Order
{
  /**
   * This is the account placing the order
   * @var string
   */
  public string $fromAccount;

  /**
   * This is the total order price to pay
   * @var float
   */
  public float $orderPrice;
  /**
   * This is the date at which the order was placed
   * @var string
   */
  public string $date;
  /**
   * This is the entire cart
   * @var Cart
   */
  public Cart $currentCart;

  /**
   * This is the contruct funtion for the order class
   * @param string $fromAccount
   * @param Cart $currentCart
   */
  function __construct($fromAccount, Cart $currentCart)
  {
    $this->fromAccount = $fromAccount;
    $this->date = date('Y-m-d H:i:s',time());
    $this->currentCart = $currentCart;
    $this->orderPrice = $currentCart->cartTotal;
  }

  /**
   * This function write the order in the database
   */
  public function writeOrder(){
    require_once "DBConnection.class.php";
    $db = new DBConnection();
    $query = "INSERT INTO orders (userID,orderPrice,orderDate) VALUES (:userID,:orderPrice,:orderDate)";
    $param = array('userID' => $this->fromAccount, 'orderPrice' => $this->orderPrice ,'orderDate' => $this->date);
    $db->query($query,$param);
    $this->writeProductsOrder();
  }
  /**
   * This function write the products that are in the order in the database
   * @return [type] [description]
   */
  private function writeProductsOrder(){
    require_once "DBConnection.class.php";
    $db = new DBConnection();
    $queryID = "SELECT orderID FROM orders WHERE orderDate = :orderDate";
    $orderID=$db->single($queryID,array('orderDate' => $this->date));
    foreach ($this->currentCart->cartContent as $cartItem) {
      $query = "INSERT INTO order_products (productID,orderID,orderProductQuantity,orderProductPrice) VALUES (:productID,:orderID,:orderProductQuantity,:orderProductPrice)";
      $param = array('productID' => $cartItem['product']->productID, 'orderID' => $orderID, 'orderProductQuantity' => $cartItem['quantity'], 'orderProductPrice' => $cartItem['product']->price);
      $db->query($query,$param);
    }
  }

}
