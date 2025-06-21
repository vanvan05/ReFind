<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReFind</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      align-items: center;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .card-header {
      border-radius: 15px 15px 0 0 !important;
      background-color: #0d6efd !important; 
    }
    .logo {
      font-weight: 700;
      font-size: 2rem;
      color: white !important; 
    }
    .btn-primary {
      background-color: #0d6efd;
      border-color: #0d6efd;
    }
    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-header text-center py-3">
            <span class="logo">ReFind</span>
          </div>
          <div class="card-body p-4">
            <form id="loginForm" action="?c=Auth&m=login" method="post">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="usr" required>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="pwd" required>
              </div>
              <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary py-2">Login</button>
              </div>
            </form>
            <div class="text-center">
              <p class="mb-0">Belum punya akun? <a href="http://localhost/ReFind/index.php?c=Auth&m=signup" class="text-primary">Daftar sini!</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>