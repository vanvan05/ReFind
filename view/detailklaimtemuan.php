<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Klaim</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link href="public/style/detailklaim.css" rel="stylesheet" type="text/css">
</head>
<body>
  <nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="http://localhost/ReFind/index.php?c=Findings&m=statustemuan">
        <img src="public/images/weui_back-filled.svg" alt="back-icon" width="30" height="24" class="d-inline-block align-text-top me-2">
        Detail Klaim Temuan
      </a>
    </div>
  </nav>
  
  <div class="container mt-2">
    <h2><?php echo $finding['nama_barang'];?></h2>
    <h3>Tervalidasi</h3>
    <p><?php echo $finding['deskripsi'];?></p>    
    <div class="owner-card">
      <img src="public/images/gg_profile.svg" alt="Foto Profil Pemilik">
      <div class="owner-info">
        <strong><?php echo $finding['username'];?></strong>
        <p><?php echo $finding['email'];?></p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>