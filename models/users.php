<?php

require_once('../Global/config.php');

class Users {
  public $id;
  public $name;
  public $username;
  public $password;
  public $token;

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }
  
  public function getUsername() {
    return $this->username;
  }

  public function setUsername($username) {
    $this->username = $username;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getToken() {
    return $this->token;
  }

  public function setToken($token) {
    $this->token = $token;
  }

  public function initObject($results,$Users){

    $id = $results['id'];
    $name = $results['name'];
    $username = $results['username'];
    $password = $results['password'];
    $token = $results['token'];

    return $Users;

  }

  public function getUserDetails($Users) {
    $db = pdoConnect();
    $username = $Users->username;

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $stmt->fetch();
        return 'success';
    } else {
        return false;
    }
}
}

?>
