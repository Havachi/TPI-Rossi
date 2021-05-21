<?php
/**
 * This file is the CRUD implementation for Products in Bio-Local
 *
 */
namespace BioLocal;
require_once "models/DBConnection.class.php";
require_once "models/product.class.php";

use BioLocal\DBConnection as DB;
use BioLocal\Product;
/**
 * This function fetch all product in the database
 * @return array The full list of products in the database
 */
function getProductsList(array $supplyerList = array()){
  $db = new DB();
  if (count($supplyerList) == 1) {
      $query ="SELECT * FROM `products` INNER JOIN `supplyers` ON `products`.`supplyerID`=`supplyers`.`supplyerID` WHERE `supplyerCP` = :supplyerCP";
      $result = $db->query($query,array('supplyerCP'=>$supplyerList[0]['supplyerCP']));
  }elseif(count($supplyerList) <= 0){
    $query ="SELECT * FROM `products`";
    $result = $db->query($query);
  }else {
    foreach ($supplyerList as $supplyer) {
      $query ="SELECT * FROM `products` INNER JOIN `supplyers` ON `products`.`supplyerID`=`supplyers`.`supplyerID` WHERE `supplyerCP` = :supplyerCP";
      $result[$supplyer['supplyerCP']] = $db->query($query,array('supplyerCP'=>$supplyer['supplyerCP']));
    }
  }

  return $result;
}
function getProductById(int $id){
  $db = new DB();
  $query = "SELECT * FROM products WHERE productID = :id";
  $product = $db->row($query,array('id'=>$id));
  $product = new Product($product['productID'],$product['supplyerID'],$product['productName'], $product['productStock'], $product['productPrice']);
  return $product;
}

/**
 * This function add a product to the database
 * @param Product $productToAdd The product Object to add
 */
function addProduct(Product $productToAdd){
  $db = new DB();
  $query ="INSERT INTO products (supplyerID1,productName,productPrice,productStock) VALUES (:supplyerID,:productName,:productPrice,:productStock)";
  $params = array('supplyerID' => $productToAdd->supplyerID,'productName' => $productToAdd->name,'productPrice' => $productToAdd->price,'productStock' => $productToAdd->stock);
  $db->query($query,$params);
}
/**
 * This function remove a product from the database
 * @param Product $productToAdd The product ID to remove
 */
function removeProduct(int $IDToDelete){
  $db = new DB();
  $query = "DELETE FROM products WHERE productID = :IDToDelete";
  $params = array('IDToDelete' =>$IDToDelete);
}

/**
 * This function update a product in the database
 * @param  Product $updatedProduct The product Object, how it should be after update
 * @param  int  $databaseID  The ID of the product to update
 */
function updateProduct(Product $updatedProduct,int $databaseID){
  $db = new DB();
  $query = "UPDATE products SET
  supplyerID1 = :supplyerID,
  productName = :productName,
  productPrice = :productPrice,
  productStock = :productStock
  WHERE productID = :productID";
  $params = array('supplyerID' => $updatedProduct->supplyerID,'productName' => $updatedProduct->name,'productPrice' => $updatedProduct->price,'productStock' => $updatedProduct->stock, 'productID'=>$databaseID);
  $db->query($query,$params);
}
