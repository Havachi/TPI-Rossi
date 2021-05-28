<?php

/**
 * The Page class, the object it creates contains everything a page usualy contains (content, title,etc..)
 */
namespace BioLocalUI;
class Page
{
  /**
   * The title of the page
   * @var string
   */
  public string $title;
  /**
   * The content of the page
   * @var string
   */
  public string $content;
  /**
   * this represent the navbar of the page, can be empty
   * @var Footer
   */
  public Navbar $navbar;
  /**
   * Any optional data can be passed here, not yet in use
   * @var array
   */
  public array $data;

  function __construct($title, $content, $data = array())
  {
    $this->title = $title;
    $this->content = $content;
    $this->data = ($data===null) ? "" : $data;
  }
  function addNavbar(string $navbarPath){
    ob_start();
    require $navbarPath;
    $navbar = new Navbar(ob_get_clean());
    $this->navbar = $navbar;
  }
}
