<?php
namespace BioLocal;

/**
 * This class represent a single Product, with all atributs needed for the site
 */
class Product
{
  /**
   * This is the product ID
   * @var int
   */
  public int $productID;
  /**
   * This is the product supplyer ID
   * @var int
   */
  public int $supplyerID;

  /**
   * This is the product name
   * @var int
   */
  public string $name;
  /**
   * This is the product total stock
   * @var int
   */
  public int $stock;
  /**
   * This is the product price
   * @var int
   */
  public float $price;
  /**
   * This is the constructor for the product class
   * @param int    $productID
   * @param int    $supplyerID
   * @param string $name
   * @param int    $initStock
   * @param float  $initPrice
   */
  function __construct(int $productID,int $supplyerID ,string $name, int $initStock, float $initPrice )
  {
    $this->productID = $productID;
    $this->supplyerID = $supplyerID;
    $this->name = $name;
    $this->stock = $initStock;
    $this->price = $initPrice;
  }
  // TODO: Transfert product CRUD Funtion here
}
