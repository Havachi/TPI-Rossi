<?php

/**
 * The Page class, the object it creates contains everything a page usualy contains (content, title,etc..)
 */
namespace BioLocal;
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
   * this represent the footer of the page, can be empty
   * @var Footer
   */
  public Navbar $navbar;

  function __construct($title, $content)
  {
    $this->title = $title;
    $this->content = $content;
  }
  function addNavbar(Navbar $navbar){
    $this->navbar = $navbar;
  }
}
