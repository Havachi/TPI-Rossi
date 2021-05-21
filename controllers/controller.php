<?php

/**
 * This class represent the usual controller we see, but in Poo to optimize this part.
 */
namespace BioLocal;
use BioLocalUI\Page as Page;
use BioLocalUI\Navbar as Navbar;
class Controller
{
  /**
   * This var represent the entire page to display
   * It is of type Page, which is explained in the declaration of the type
   * @var Page $page
   */
  public Page $page;
  public array $pageData = array();
  function __construct()
  {

  }
  /**
   * This core function is used to display page easyily
   *
   * @param  string $pageName the name of the page to display(filename w/out extention)
   */
  static function displayPage($pageName){
    ob_start();
    self::loadPageModels();
    $page = new Page($pageName,self::getPageContent("views/pages/" . $pageName . ".php"));
    $page->addNavbar("views/pageModules/navbar.php");
    ob_get_clean();
    require "views/layout.php";
  }
  static function loadPageModels(){
    require "models/pageModels/page.class.php";
    require "models/pageModels/navbar.class.php";
  }
  static function pageExist($page){
    if (file_exists("views/pages/".$page.".php")) {
      return true;
    }else {
      return false;
    }
  }
  static function loadProducts(array $supplyerList = array()){
    // TODO: Should load only the products from supplyers within the range
    require_once "models/CRUD/productCRUD.php";
    $productList = getProductsList($supplyerList);
    return $productList;
  }
  static function loadSupplyers(array $pcList = array()){
    require_once "models/CRUD/supplyerCRUD.php";
    $supplyerList = getSupplyersList($pcList);
    return $supplyerList;
  }
  static function getPageContent($path){
    $pageData = self::getPageData(basename($path,".php"));
    ob_start();
    require $path;
    $content = ob_get_clean();
    return $content;
  }
  /**
   * This function get the page Data (e.g Products list, supplyer list etc..) that are evaluated before the page is send to the browser
   * @var [type]
   */
  static function getPageData($pageName){
    $pageData = array();
    switch ($pageName) {
      case 'home':
        if (isset($_SESSION['Account']) && !empty($_SESSION['Account'])) {
          require_once "models/distanceCalculation.php";
          $PClist = getNearbyPostalCode($_SESSION['Account']->addressPostalCode);
          $pageData['supplyers']=self::loadSupplyers($PClist);
          $pageData['products']=self::loadProducts($pageData['supplyers']);
        }else {
          $pageData['supplyers']=self::loadSupplyers();
          $pageData['products']=self::loadProducts($pageData['supplyers']);
        }

        break;
    }
    return $pageData;
  }
  static function cartControl($getCode = null, $productId = 0){
    require_once "models/CRUD/productCRUD.php";
    if ($getCode != null) {
      if ($productId != 0) {
        switch ($getCode) {
          //Add To Cart
          case 'aTC':
          $_SESSION['Cart']->addToCart(getProductById((int)$productId));
            break;
          //Remove From Cart
          case 'rFC':
            $_SESSION['Cart']->removeFromCart(getProductById((int)$productId,$quantity));
            break;
          //Delete From Cart
          case 'dC':
            $_SESSION['Cart']->deleteCart();
            break;
        }
      }else {
        $_SESSION['Cart']->deleteCart();
      }
    }
  }

}
