<?php

class Auth extends Controller {
  function signup(){
    $this->loadView('signup.php');
  }

  function addUser(){
    $username = $_POST['usr'];
    $password = $_POST['pwd'];
    $email = $_POST['email'];
    $model = $this->loadModel('UserModel');
    $model->newUser($username, $password, $email);
    $user = $model->getUserByUsername($username);
    session_start();
    $user_id = $user['user_id'];
    $_SESSION['id'] = $user_id;
    header('Location: ?c=Home&m=beranda');
  }

  function login(){
    session_start();
    $usr = $_POST['usr'];
    $pwd = $_POST['pwd'];

    $model = $this->loadModel('UserModel');
    $user = $model->getUserByUsername($usr);
    if ($user && $pwd === $user['password']) {
        $_SESSION['id'] = $user['user_id'];
        header('Location: ?c=Home&m=beranda');
        exit;
    } else {
        session_unset();
        session_destroy();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );   
        }
        echo "Login gagal: username atau password salah.";       
    } 
  }

  function logout(){
    session_start();
    session_unset();
    session_destroy();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    header('Location: ?index.php');
    exit;
  }
}