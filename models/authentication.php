<?php
namespace BioLocal;
require_once "DBConnection.class.php";

class Login
{
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
class Register
{
  public Account $account;

  function createAccount(array $userDataArray){
      $account = new Account($userDataArray);
      if ($account->registerAccount()) {
        $account->createSession();
        return true;
      }
  }
}

class Account {
  public string $firstName;
  public string  $lastName;
  public string  $addressRoad;
  public int $addressRoadNumber;
  public string $addressPostalCode;
  public string $phoneNumber;
  public string $emailAddress;
  public string $passwordHash;
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
  function RegisterAccount(){
    $db = new DBConnection();
    $query = "INSERT INTO users (userFirstName,userLastName,userAddressRoad,userAddressRoadNumber,userAddressPostalCode,userPhoneNumber,userEmailAddress,userPassword)
              VALUES (:userFirstName,:userLastName,:userAddressRoad,:userAddressRoadNumber,:userAddressPostalCode,:userPhoneNumber,:userEmailAddress,:userPassword)";
    $params = array('userFirstName' => $this->firstName, 'userLastName' => $this->lastName,'userAddressRoad' => $this->addressRoad,'userAddressRoadNumber' => $this->addressRoadNumber,'userAddressPostalCode' => $this->addressPostalCode,'userPhoneNumber' => $this->phoneNumber,'userEmailAddress' => $this->emailAddress ,'userPassword' => $this->passwordHash);
    try {
      $db -> query($query,$params);
    } catch (\Exception $e) {
      return false;
    }
    return true;
  }
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
  function createSession(){
    $_SESSION['Token'] = hash('sha256', $this->emailAddress.$this->passwordHash);
    return true;
  }
  function verifySession(){
    if ($_SESSION['Token'] == hash('sha256', $this->emailAddress.$this->passwordHash)) {
      return true;
    }else {
      return false;
    }
  }
  static function logout(){
    unset($_SESSION['Account']);
    unset($_SESSION['Token']);
    header('Location: /');
  }

}
