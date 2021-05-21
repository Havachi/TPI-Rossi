<?php
namespace BioLocal;

/**
 * THis class represent a single Product, with all atributs needed for the site
 */
class Product
{
  public int $productID;
  public int $supplyerID;

  public string $name;
  public int $stock;
  public float $price;

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
