<?php

namespace BioLocal;
class Order
{
  var $fromAccount;
  var $orderPrice;
  var $date;
  public Cart $currentCart;

  function __construct($fromAccount, Cart $currentCart)
  {
    $this->fromAccount = $fromAccount;
    $this->date = date('Y-m-d H:i:s',time());
    $this->currentCart = $currentCart;
    $this->orderPrice = $currentCart->cartTotal;
  }

  public function writeOrder(){
    require_once "DBConnection.class.php";
    $db = new DBConnection();
    $query = "INSERT INTO orders (userID,orderPrice,orderDate) VALUES (:userID,:orderPrice,:orderDate)";
    $param = array('userID' => $this->fromAccount, 'orderPrice' => $this->orderPrice ,'orderDate' => $this->date);
    $db->query($query,$param);
    $this->writeProductsOrder();
  }
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
