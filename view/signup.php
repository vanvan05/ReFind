<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form id="loginForm" action="?c=Auth&m=addUser" method="post">
    User: <input type="text" name="usr" required/><br>
    Pass: <input type="password" name="pwd" required /><br>
    Email: <input type="email" name="email"  required/><br>
    <button type="submit">Sign UP</button>
  </form>
</body>
</html>