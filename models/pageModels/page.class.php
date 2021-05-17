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

  public array $data;

  function __construct($title, $content, $data = array())
  {
    $this->title = $title;
    $this->content = $content;
    $this->data = ($data===null) ? "" : $data;
  }
  function addNavbar(Navbar $navbar){
    $this->navbar = $navbar;
  }
}
