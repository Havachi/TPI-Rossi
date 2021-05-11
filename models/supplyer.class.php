<?php
namespace BioLocal;
class Supplyer
{
  public int $supplyerID;
  public string $supplyerName;
  function __construct(int $supplyerID,string $supplyerName)
  {
    $this->supplyerID = $supplyerID;
    $this->supplyerName = $supplyerName;
  }
}
