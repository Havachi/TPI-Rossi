<?php

namespace BioLocalUI;
/**
 * This class represent a simple navbar, with a content
 */
class Navbar
{
  public string $content;
  function __construct($content)
  {
    $this->content = $content;
  }
}
