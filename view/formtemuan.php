<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Temuan Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link href="public/style/formtemuan.css" rel="stylesheet" type="text/css">
</head>
<body>
  <nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="http://localhost/ReFind/index.php?c=Home&m=beranda">
        <img src="public/images/weui_back-filled.svg" alt="back-icon" width="30" height="24" class="d-inline-block align-text-top me-2">
        Form Temuan Barang
      </a>
    </div>
  </nav>
  
  <div class="container mt-2">
      <form id="temuanForm" action="?c=Findings&m=add" method="post" enctype="multipart/form-data" required>
        <input type="hidden" name="id">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Barang</label>
          <input type="text" class="form-control" name="nama-barang" placeholder="Masukkan nama barang Anda" aria-describedby="nama" required>
        </div>
        <div class="mb-3">
          <label for="lokasi" class="form-label">Lokasi</label>
          <input type="text" class="form-control" name="lokasi" placeholder="Masukkan lokasi penemuan barang" aria-describedby="lokasi" required>
        </div>
        <div class="mb-3">
          <label for="waktu" class="form-label">Waktu</label>
          <input type="text" class="form-control" name="waktu" placeholder="Masukkan waktu penemuan barang" required>
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi Barang</label>
          <textarea class="form-control" name="deskripsi" rows="3" placeholder="Masukkan deskripsi barang" required></textarea>
        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">Foto Barang</label>
            <div class="file-input-container">
              <input type="file" id="fileInput" name="foto" class="file-input" accept="image/*" onchange="previewFile(event)" required />
              <label for="fileInput" class="file-input-label">
                  <div class="file-info">
                      <div class="file-name" id="fileName">📁 Upload Foto Barang</div>
                      <div class="file-remove" id="removeBtn" style="display: none;">×</div>
                  </div>
              </label>
              <div class="file-preview-container" id="previewContainer">
                  <img id="previewImage" class="file-preview-img" src="" alt="Preview" />
              </div>
          </div>
          </div>
        <button type="submit" class="btn btn-primary" id="submit-btn">Unggah</button>
      </form>
  </div>

</div>

<div class="modal fade" id="popup-terkirim" tabindex="-1" aria-labelledby="popup-terkirim" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <h1 class="mb-3">Laporan Berhasil Dikirim</h1>
        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
        <div class="modal-buttons">
          <button type="button" class="btn btn-secondary" onclick="window.location.href='http://localhost/ReFind/index.php?c=Home&m=beranda'">Kembali</button>
          <button type="button" class="btn btn-primary" onclick="window.location.href='http://localhost/ReFind/index.php?c=Findings&m=statustemuan'">Lihat Status</button>
        </div>
      </div>
    </div>
  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  <script>
    function previewFile(event) {
      const input = event.target;
      const previewContainer = document.getElementById("previewContainer");
      const fileNameElement = document.getElementById("fileName");
      const removeBtn = document.getElementById("removeBtn");

      if (input.files.length > 0) {
          const file = input.files[0];
          fileNameElement.textContent = file.name;
          removeBtn.style.display = "block";

          const reader = new FileReader();
          reader.onload = function(e) {
              const previewImage = document.getElementById("previewImage");
              previewImage.src = e.target.result;
              previewContainer.style.display = "block";
          };
          reader.readAsDataURL(file);
      }
    }

    document.getElementById('temuanForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch('?c=Findings&m=add', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (response.ok) {
        const modal = new bootstrap.Modal(document.getElementById('popup-terkirim'));
        modal.show();
      } 
    })
  });
</script>

</body>
</html>