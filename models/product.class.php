<?php

namespace BioLocal;
class Product
{
  /**
   * [public description]
   * @var [type]
   */
  public string $name;
  public int $stock;
  public float $price;
  public int $supplyerID;

  function __construct(string $name, int $initStock, float $initPrice, int $supplyerID)
  {
    $this->name = $name;
    $this->stock =$initStock;
    $this->price = $initPrice;
    $this->supplyerID = $supplyerID;
  }
}
