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

  /**
   * This is the construct function for the page object
   * @param string $title The title of the page
   * @param string $content The content to display
   * @param array  $data Any optional data can be passed here
   */
  function __construct(string $title, string $content, array $data = array())
  {
    $this->title = $title;
    $this->content = $content;
    $this->data = ($data===null) ? "" : $data;
  }
  /**
   * This function create a navbar from a php file, it also execute any php code in the file
   * @param string $navbarPath The path to the navbar content file
   */
  function addNavbar(string $navbarPath){
    ob_start();
    require $navbarPath;
    $navbar = new Navbar(ob_get_clean());
    $this->navbar = $navbar;
  }
}
