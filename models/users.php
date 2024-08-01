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

    $Users->id = $results['id'];
    $Users->name = $results['name'];
    $Users->username = $results['username'];
    $Users->password = $results['password'];
    $Users->token = $results['token'];

    return $Users;

  }

  public function getUserDetails($Users) {
    try {
        $db = pdoConnect();
        $sql = "SELECT username, password FROM tw_users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $Users->username);
        $stmt->execute();

        $user = $stmt->fetch();
        if ($user && password_verify($Users->password, $user['password'])) {
            return 'SUCCESS';
        } else {
            return 'FAILURE';
        }
    } catch (PDOException $e) {
        error_log('Database Error: ' . $e->getMessage());
        return 'ERROR';
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
