<?php
namespace BioLocal;
require_once "DBConnection.class.php";
require_once "cart.class.php";
require_once 'exceptions.class.php';

/**
 * This class contain function for the login process
 */
class Login
{
  /**
   * This is the main function in the login process, it do all the main work
   * @param  string the email address entered in the login form
   * @param  string the password entered in the login form
   */
  static function loginAccount($emailAddress,$password){
    if (self::isLoginCorrect($emailAddress,$password)) {
      $db = new DBConnection();
      $query = "SELECT userFirstName,userLastName,userAddressRoad,userAddressRoadNumber,userAddressPostalCode,userPhoneNumber,userEmailAddress,userPassword FROM users WHERE userEmailAddress = :userEmailAddress";
      $params = array('userEmailAddress' => $emailAddress);
      $account = new Account($db->query($query,$params)[0]);
      $account->createSession();
      //I unset the password here, for security purpose.
      unset($account->userPassword);
      $_SESSION['Account'] = $account;
    }
  }
  /**
   * This function check all require critera to allow or not an user to login
   * @param  string the email address entered in the login form
   * @param  string the password entered in the login form
   * @return boolean The answer to the question, is login correct ? true if it is ok, and false if not
   */
  static function isLoginCorrect($emailAddress,$password){
    try {
      $db = new DBConnection;
      $dbpsw = $db->single("SELECT userPassword FROM users WHERE userEmailAddress = :userEmailAddress",array("userEmailAddress"=>$emailAddress));
      if ($dbpsw != false && !empty($dbpsw)) {
        if (password_verify($password,$dbpsw)) {
          return true;
        }else {
          return false;
        }
      }
    }
    catch (PDOException $e) {
      return false;
    }
  }
}
/**
 * This class contains all function for the register process
 */
class Register
{
  /**
   * This var represent an entire account, explained in "Account" class
   * @var Account
   */
  public Account $account;

  /**
   * This function create an account
   * @param  array  $userDataArray All the inputs from the register form
   * @return bool true if every thing is ok
   */
  public function createAccount(array $userDataArray){
      $account = new Account($userDataArray);
      try {
        if (!userExist($userDataArray['userEmailAddress'])) {
          if ($account->registerAccount()) {
            $account->createSession();
            return true;
          }
        }
      } catch (authenticationException $e) {
        throw registerError('Erreur durant la creation du compte.');
      }
    }
    /**
     * This function check if an email address is in use
     * @param  string $userEmailAddress the email address to check
     * @return bool the answer to the quetion that this function is
     */
    private function userExist(string $userEmailAddress)
    {
      $result = null;
      $query = "SELECT userID FROM users WHERE userEmailAddress = :userEmailAddress";
      $db = new DBConnection();
      try {
        $result = $db->single($query,array('userEmailAddress'=>$userEmailAddress));
      } catch (\Exception $e) {

      }
      if ($result === null) {
        return false;
      }
      return true;
    }
  }

/**
 * This class represent an Account
 */
class Account {
  /**
   * The user ID
   * @var int
   */
  public int $ID;
  /**
   * The Account firstname
   * @var string
   */
  public string $firstName;
  /**
   * The Account lastname
   * @var string
   */
  public string  $lastName;
  /**
   * The Account address road
   * @var string
   */
  public string  $addressRoad;
  /**
   * The Account address road number
   * @var int
   */
  public int $addressRoadNumber;
  /**
   * The Account postal code
   * @var string
   */
  public string $addressPostalCode;
  /**
   * The Account phone number
   * @var string
   */
  public string $phoneNumber;
  /**
   * The Account email address
   * @var string
   */
  public string $emailAddress;
  /**
   * The Account temporary stored password hash
   * @var string
   */
  private string $passwordHash;
  /**
   * This is the constructor for the Account class
   * @param array $userDataArray All data entered in the register form
   */
  function __construct(array $userDataArray){
    $this->firstName = $userDataArray['userFirstName'];
    $this->lastName = $userDataArray['userLastName'];
    $this->addressRoad = $userDataArray['userAddressRoad'];
    $this->addressRoadNumber = (int)$userDataArray['userAddressRoadNumber'];
    $this->addressPostalCode = $userDataArray['userAddressPostalCode'];
    $this->phoneNumber = $userDataArray['userPhoneNumber'];
    $this->emailAddress = $userDataArray['userEmailAddress'];
    $this->hashword($userDataArray['userPassword']);
  }
  /**
   * This function register the account in database
   */
  function RegisterAccount(){
    $db = new DBConnection();
    $query = "INSERT INTO users (userFirstName,userLastName,userAddressRoad,userAddressRoadNumber,userAddressPostalCode,userPhoneNumber,userEmailAddress,userPassword)
              VALUES (:userFirstName,:userLastName,:userAddressRoad,:userAddressRoadNumber,:userAddressPostalCode,:userPhoneNumber,:userEmailAddress,:userPassword)";
    $params = array('userFirstName' => $this->firstName, 'userLastName' => $this->lastName,'userAddressRoad' => $this->addressRoad,'userAddressRoadNumber' => $this->addressRoadNumber,'userAddressPostalCode' => $this->addressPostalCode,'userPhoneNumber' => $this->phoneNumber,'userEmailAddress' => $this->emailAddress ,'userPassword' => $this->passwordHash);
    try {
      $db -> query($query,$params);
    } catch (\Exception $e) {
      throw new authenticationException('Error while entering account in Database',1);
    }
    return true;
  }
  /**
   * This function hash the user password, also check which cost to use depending on the hardware
   * @param string $clearPassword The user inputed password
   */
  function Hashword($clearPassword){
    $timeTarget = 0.1; // 50 millisecondes
    $cost = 4;
    do {
        $cost++;
        $start = microtime(true);
        password_hash($clearPassword, PASSWORD_BCRYPT, ["cost" => $cost]);
        $end = microtime(true);
    } while (($end - $start) < $timeTarget);

    $this->passwordHash = password_hash($clearPassword,PASSWORD_BCRYPT,["cost" => $cost]);
  }
  /**
   * This function create a session and store a token inside the $_SESSION superglobal
   * @return bool, true if everythings ok, false if not
   */
  function createSession(){
    try {
      $_SESSION['Token'] = hash('sha256', $this->emailAddress.$this->passwordHash);
      $_SESSION['Cart'] = new Cart();
    } catch (\Exception $e) {
      return false;
    }
    return true;
  }
  /**
   * This function verify if the current session token is correct
   * @return bool, true if correct, false if not
   */
  function verifySession(){
    if ($_SESSION['Token'] == hash('sha256', $this->emailAddress.$this->passwordHash)) {
      return true;
    }else {
      return false;
    }
  }
  /**
   * This function return the user ID
   * @return int the user ID
   */
  function getUserID(){
    $db = new DBConnection();
    $query = "SELECT userID FROM users WHERE userEmailAddress = :email";
    return $db->single($query,array('email' =>$_SESSION['Account']->emailAddress));
  }
  /**
   * This is the logout function, nothing to say it deletes everything in $_SESSION and redirect the user to the root page
   */
  static function logout(){
    unset($_SESSION['Account']);
    unset($_SESSION['Token']);

    unset($_SESSION['Cart']);
    header('Location: /');
  }

}
