<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReFind</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link href="public/style/beranda.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar bg-primary">
      <div class="container-fluid">
        <button class="icon-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
          <img src="public/images/menu-icon.svg" alt="Menu">
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Menu ReFind</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <a href="http://localhost/ReFind/index.php?c=Findings&m=statustemuan">
              <i class="bi bi-clipboard-check me-2"></i> Status Laporan Temuan
            </a>
            <a href="http://localhost/ReFind/index.php?c=Claim&m=status">
              <i class="bi bi-card-checklist me-2"></i> Status Klaim Temuan
            </a>
            <a href="http://localhost/ReFind/index.php?c=Lapor&m=status">
              <i class="bi bi-search me-2"></i> Status Laporan Hilang
            </a>
            <a href="http://localhost/ReFind/index.php?c=Auth&m=logout">
              <i class="bi bi-box-arrow-right me-2"></i> Log Out
            </a>
          </div>
        </div>
        <h1>ReFind</h1>
        <button class="icon-btn">
          <img src="public/images/profile-icon.svg" alt="Profile">
        </button>
      </div>
    </nav>

  <div class="container mt-2">
      <div id="search-container">
        <input type="text" placeholder="Cari">
      </div>
  
      <div id="mainmenu-container">
        <button class="menu" onclick="window.location.href='http://localhost/ReFind/index.php?c=Findings&m=form'">
          Temuan Barang
        </button>
        <button class="menu" onclick="window.location.href='http://localhost/ReFind/index.php?c=Lapor&m=form'">
          Lapor Kehilangan
        </button>
      </div>
      
      <div id="temuanbaru-container">
        <h2>Temuan Terbaru</h2>
        <?php foreach ($findings as $finding): ?>
          <div class="temuan-barang-container">
            <img src="uploaded_images/<?php echo $finding['foto_url']; ?>" alt="Gambar Barang" />
            <div class="info">
              <h3><?php echo $finding['nama_barang']; ?></h3>
              <p><?php echo $finding['deskripsi']; ?></p>
              <button class="detail-btn" onclick="window.location.href='http://localhost/ReFind/index.php?c=Detail&m=barang&id=<?php echo $finding['finding_id']; ?>'">Detail</button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
  </div>
</body>
</html>