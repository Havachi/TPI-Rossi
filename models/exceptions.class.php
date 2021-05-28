<?php


/**
 * This exception is trown in any low level function in Authentication.php file
 */
class authenticationException extends \Exception{
  public function __construct($message, $code = 0, Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
  }

  public function __toString() {
    return $this->message;
  }
}

/**
 * This exception is trown when a function catch an authenticationException in login scenario
 */
class loginError extends authenticationException{
  public function __construct($message, $code = 0, Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
  }

  public function __toString() {
    return "Erreur de Connexion:".$this->message;
  }
}

/**
 * This exception is trown when a function catch an authenticationException in register scenario
 */
class registerError extends authenticationException{
  public function __construct($message, $code = 0, Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
  }

  public function __toString() {
    return "Erreur de Création du compte:".$this->message;
  }
}
