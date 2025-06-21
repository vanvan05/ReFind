<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Laporan Temuan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link href="public/style/edittemuan.css" rel="stylesheet" type="text/css">
</head>
<body>
  <nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="http://localhost/ReFind/index.php?c=Findings&m=detailfinding&id=<?php echo $_GET['id']?>">
        <img src="public/images/weui_back-filled.svg" alt="back-icon" width="30" height="24" class="d-inline-block align-text-top me-2">
        Edit Temuan Barang
      </a>
    </div>
  </nav>

  <div class="container mt-2">
    <form id="form-edit" action="?c=Findings&m=update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $finding['finding_id'];?>" />
      <div class="mb-3">
          <label for="nama" class="form-label">Nama Barang</label>
          <input type="text" class="form-control" name="nama-barang" aria-describedby="nama" value="<?php echo $finding['nama_barang'];?>" required>
        </div>
        <div class="mb-3">
          <label for="lokasi" class="form-label">Lokasi</label>
          <input type="text" class="form-control" name="lokasi" aria-describedby="lokasi" value="<?php echo $finding['lokasi'];?>" required>
        </div>
        <div class="mb-3">
          <label for="waktu" class="form-label">Waktu</label>
          <input type="text" class="form-control" name="waktu" value="<?php echo $finding['waktu'];?>" required>
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi Barang</label>
          <input class="form-control" name="deskripsi" rows="3" value="<?php echo $finding['deskripsi'];?>" required></input>
        </div> 
        <div class="mb-3">
          <label for="formFile" class="form-label">Foto Barang</label>
          <div class="gambar-terupload">
            <p class="file-name"><?php echo !empty($finding['foto_url']) ? $finding['foto_url'] : 'No file uploaded.'; ?></p>
            <button class="delete-btn" onclick="location.href='?c=Findings&m=deleteFoto&id=<?php echo $finding['finding_id'];?>'">X</button>
          </div>
          <input class="form-control" type="file" id="formFile" name="foto" <?php echo empty($finding['foto_url']) ? 'required' : ''; ?>>
        </div>
        <button type="submit" class="btn btn-primary">Unggah</button>
    </form>
  </div>

  <div class="modal fade" id="popup-tersimpan" tabindex="-1" aria-labelledby="popup-tersimpan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <h1 class="mb-3">Laporan Berhasil Disimpan</h1>
          <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
          <div class="modal-buttons">
            <button type="button" class="btn btn-secondary" onclick="location.href='?c=Findings&m=detailfinding&id=<?php echo $finding['finding_id'];?>'">Kembali</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  <script>
document.getElementById('form-edit').addEventListener('submit', function(event) {
  event.preventDefault(); 

  var form = event.target;
  var formData = new FormData(form);

  fetch(form.action, {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (response.ok) {
      var tersimpanModal = new bootstrap.Modal(document.getElementById('popup-tersimpan'));
      tersimpanModal.show();
    } 
  })
});


</script>
</body>
</html>