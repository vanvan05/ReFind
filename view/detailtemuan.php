<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Laporan Temuan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link href="public/style/detailtemuan.css" rel="stylesheet" type="text/css">
</head>
<body>
  <nav class="navbar bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="http://localhost/ReFind/index.php?c=Findings&m=statustemuan">
        <img src="public/images/weui_back-filled.svg" alt="back-icon" width="30" height="24" class="d-inline-block align-text-top">
        Detail Temuan Barang
      </a>
    </div>
  </nav>

  <div class="container mt-2">
    <h2><?php echo $finding['nama_barang'];?></h2>
    <div id="info-section">
    <img src="uploaded_images/<?php echo $finding['foto_url']; ?>" alt="Gambar Barang" />
      <div id="info"> 
        Lokasi: <?php echo $finding['lokasi'];?><br>
        Waktu: <?php echo $finding['waktu'];?><br>
        Penemu: <?php echo $finding['username'];?><br>
      </div>
    </div>
    <div id="description-section">
      <h3>Deskripsi</h3>
      <p><?php echo $finding['deskripsi'];?></p>
    </div>
    <button class="btn-claims">Lihat Klaim</button>
    <div class="buttons">
      <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#popup-konfirmhapus">Hapus</button>
      <button class="btn btn-edit" onclick="location.href='?c=Findings&m=edit&id=<?php echo $finding['finding_id'];?>'">Edit</button>
    </div>
  </div>

  <div class="modal fade" id="popup-konfirmhapus" tabindex="-1" aria-labelledby="popup-konfirmhapus" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <h1 class="mb-3">Yakin untuk <br>Hapus Laporan?</h1>
          <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
          <div class="modal-buttons">
            <button type="button" class="btn btn-secondary" onclick="location.href='?c=Findings&m=detailfinding&id=<?php echo $finding['finding_id'];?>'">Kembali</button>
            <button type="button" class="btn btn-primary" onclick="deleteFinding(<?php echo $finding['finding_id'];?>)">Hapus</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="popup-terhapus" tabindex="-1" aria-labelledby="popup-terhapus" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <h1 class="mb-3">Laporan Berhasil Dihapus</h1>
          <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
          <div class="modal-buttons">
            <button type="button" class="btn btn-secondary" onclick="location.href='?c=Findings&m=statustemuan'">Kembali</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

  <script>
    function deleteFinding(id) {
      fetch(`?c=Findings&m=delete&id=${id}`, {
        method: 'GET',
      })
      .then(response => {
        if (response.ok) {
          var konfirmModal = bootstrap.Modal.getInstance(document.getElementById('popup-konfirmhapus'));
          konfirmModal.hide();

          var hapusModal = new bootstrap.Modal(document.getElementById('popup-terhapus'));
          hapusModal.show();
        } 
      })
    }
  </script>
</body>
</html>