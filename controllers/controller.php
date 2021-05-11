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
    self::loadPageModels();
    if ($pageName == 'home') {
      $pageData['products'] = self::loadProducts();
    }
    $page = new Page($pageName,file_get_contents("views/pages/" . $pageName . ".php"));
    $page->addNavbar(new Navbar(file_get_contents("views/pageModules/navbar.php")));
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
  static function loadProducts(){
    require_once "models/productCRUD.php";
    $productList = getProductsList();
    return $productList;
  }
}
