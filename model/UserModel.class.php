<?php

class UserModel extends Model {
  function getUserByUsername($username){
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $this->db->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return $rows[0] ?? null;
  }

  function newUser ($usr, $pwd, $email) {
    $sql = "INSERT INTO users (username, password, email) " 
    . "VALUES ('$usr', '$pwd', '$email')";
    return $this->db->query($sql);
  } 
}