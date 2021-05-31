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
  /**
   * All data passed with the page, it usualy contains database entry, like the name of the user of products list.
   * @var array
   */
  public array $pageData = array();
  /**
   * This core function is used to display page easyily
   *
   * @param  string $pageName the name of the page to display(filename w/out extention)
   */
  static function displayPage(string $pageName){
    ob_start();
    self::loadPageModels();
    $page = new Page($pageName,self::getPageContent("views/pages/" . $pageName . ".php"));
    if ($pageName == "userspaceInfo" || $pageName == "userspaceOrder") {
      $page->addNavbar("views/pageModules/navbarUserspace.php");
    }elseif ($pageName == "login" || $pageName == "register") {
      $page->addNavbar("views/pageModules/navbarLogReg.php");
    }else {
      $page->addNavbar("views/pageModules/navbar.php");
    }

    ob_get_clean();
    require_once "views/layout.php";
  }
  /**
   * This function load all page module, like navbar and footer
   */
  static function loadPageModels(){
    require_once "models/pageModels/page.class.php";
    require_once "models/pageModels/navbar.class.php";
  }
  /**
   * Check if the page exist
   * @param  string $page
   * @return true if the page exist ; false if the page doesn't exist
   */
  static function pageExist(string $page){
    if (file_exists("views/pages/".$page.".php")) {
      return true;
    }else {
      return false;
    }
  }
  /**
   * This function products from the data base, the results can be precised by a supplyers list
   * @param  array  $supplyerList Optional supplyers list, the site will only return products from those supplyers
   * @return array the list of products found.
   */
  static function loadProducts(array $supplyerList = array()){
    // TODO: Should load only the products from supplyers within the range
    require_once "models/CRUD/productCRUD.php";
    $productList = getProductsList($supplyerList);
    return $productList;
  }
  /**
   * This function load all supplyers in database, it can be precised with a postal code array.
   * @param  array  $pcList Optional, the postal code array used to select only supplyers within a range of postal codes
   * @return array the supplyers list
   */
  static function loadSupplyers(array $pcList = array()){
    require_once "models/CRUD/supplyerCRUD.php";
    $supplyerList = getSupplyersList($pcList);
    return $supplyerList;
  }
  /**
   * This function return the list of orders passed by a user
   * @param  int $userID
   * @return array the list of orders passed by a user
   */
  static function loadUserOrder(int $userID){
    require_once "models/CRUD/userCRUD.php";
    $userOrder = getUserOrdersList($userID);
    return $userOrder;
  }
  /**
   * This function load and execute a single page, then return the full content of the page
   * @param  string path, the path where the file to load is
   * @return string the content of the page, loaded and ready to be displayed
   */
  static function getPageContent(string $path){
    $pageData = self::getPageData(basename($path,".php"));
    ob_start();
    require $path;
    $content = ob_get_clean();
    return $content;
  }

  /**
   * This function get the page Data (e.g Products list, supplyer list etc..) that are evaluated before the page is send to the browser
   * It is only used by two page that need special treatment
   * @var string the name of the page
   * @return array All needed data
   */
  static function getPageData(string $pageName){
    $pageData = array();
    switch ($pageName) {
      //home page case
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
      //userspace/Order case
      case 'userspaceOrder':
      if (isset($_SESSION['Account']) && !empty($_SESSION['Account'])) {
        $pageData['userOrders']=self::loadUserOrder($_SESSION['Account']->getUserID());
      }
      break;
    }
    return $pageData;
  }
  /**
   * This is a controller function for the cart
   * @param  string  $getCode   This code define what we want to do with the cart
   * @param  int $productId The optional productID, to know which item in cart we want to modify
   */
  static function cartControl($getCode = null, int $productId = 0, int $quantity = 0){
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
  /**
   * This function is a controller for the checkout process, it display pages in order, and validate the process
   * @param  integer $step at which step the user is, 1,2,3, 4 and end
   */
  static function checkoutControl($step = 1){
    require_once "models/checkout.php";
    $validationTokens = array('cart'=>0,'address'=>0,'payment'=>0,'final'=>0);
    if (isset($_SESSION) && !empty($_SESSION)) {
      if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart'])) {
        $cart = $_SESSION['Cart']->cartContent;
        switch ($step) {
          case 1:
          self::displayPage("checkout1");
            break;
          case 2:
          $validationTokens['cart'] = 1;
          self::displayPage("checkout2");
            break;
          case 3:
          $validationTokens['address'] = 1;
          self::displayPage("checkout3");
            break;
          case 4:
          $validationTokens['payment'] = 1;
          self::displayPage("checkout4");
            break;
          case 'end':
            createOrder();
            $_SESSION['Cart'] = new Cart;
            header('Location: /');
            break;
        }

        if (array_sum($validationTokens) == 4)
        {
          echo "Tout bon!";
        }
      }
    }
  }
}
