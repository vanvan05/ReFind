<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form id="loginForm" action="?c=Auth&m=login" method="post">
    User: <input type="text" name="usr" required /><br>
    Pass: <input type="password" name="pwd" required/><br>
    <button>Login</button>
  </form>
  <p>Belum punya akun?</p><a href="http://localhost/ReFind/index.php?c=Auth&m=signup">Daftar sini!</a>

</body>
</html>