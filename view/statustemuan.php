<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Laporan Temuan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link href="public/style/statustemuan.css" rel="stylesheet" type="text/css">
</head>
<body>
  <nav class="navbar bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="http://localhost/ReFind/index.php?c=Home&m=beranda">
        <img src="public/images/weui_back-filled.svg" alt="back-icon" width="30" height="24" class="d-inline-block align-text-top">
        Status Temuan Barang
      </a>
    </div>
  </nav>
  <div class="container mt-2">
    <?php foreach ($findings as $finding): ?>
      <div class="item-status" onclick="location.href='?c=Findings&m=<?php echo $finding['is_claimed'] ? 'detailclaim' : 'detailfinding'; ?>&id=<?php echo $finding['finding_id']; ?>'">
        <img src="uploaded_images/<?php echo $finding['foto_url']; ?>" alt="Gambar barang" />
        <div class="word-content">
          <h2><?php echo $finding['nama_barang']; ?></h2>
          <p class="<?php echo $finding['is_claimed'] ? 'text-success' : 'text-warning'; ?>">
            <?php echo $finding['is_claimed'] ? 'Tervalidasi' : 'Diproses'; ?>
          </p>
        </div> 
      </div>
    <?php endforeach; ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>