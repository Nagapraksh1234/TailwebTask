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

    $sql = "SELECT * FROM tw_users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $stmt->fetch();
        return 'SUCCESS';
    } else {
        return false;
    }
}


 public function insertUsers($userObject){
    try {
        $db = pdoConnect();

        $hashedPassword = password_hash($userObject->password, PASSWORD_DEFAULT);

        $insert_sql = "INSERT INTO 
                                  tw_users 
                                  (
                                    name, 
                                    username,
                                    password
                                   ) 
                            VALUES (
                                    :name,
                                    :username, 
                                    :password
                                    )"
                                    ;

        $stmt = $db->prepare($insert_sql);

        $stmt->bindParam(':name', $userObject->name, PDO::PARAM_STR);
        $stmt->bindParam(':username', $userObject->username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        $stmt->execute();

        return 'SUCCESS';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
 }

}

?>
