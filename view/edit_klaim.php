<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Klaim</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/style/styles-claims.css">
</head>
<body>
    <div class="wrapper">
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand" onclick="history.back()">
                <img class="back" src="public/images/back-icon.png" alt="Back Icon">
                Edit Klaim
            </a>
        </nav>

        <main>
        <form id="claim-form" action="index.php?c=Claim&m=update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $claim['claim_id'] ?>">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><b>Bukti Gambar Kepemilikan</b></h5>
                        <p class="card-text">Unggah bukti kepemilikan barang Anda.</p>
                        <div id="image-preview">
                            <div class="preview-container">
                                <img src="uploaded_images/<?= $claim['foto_url'] ?>" class="upload-preview" alt="Gambar Saat Ini">
                                <span class="file-name"><?= basename($claim['foto_url']) ?></span>
                            </div>
                        </div>
                        <div class="upload-box mt-2">
                            <input type="file" id="upload" name="ownership_image" class="form-control-file">
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Pernyataan Pendukung</b></h5>
                        <p class="card-text">Masukkan pernyataan yang mendukung klaim Anda.</p>
                        <textarea id="claim-statement" name="claim_statement" placeholder="Ketik di sini..." class="form-control" required><?= $claim['pernyataan_pendukung'] ?></textarea>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" id="submit-update" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </main>
    </div>

    <!-- Overlay dan Pop-up -->
    <div class="overlay <?= $status === 'berhasil' ? 'active' : '' ?>" id="overlay"></div>
    <div class="pop-up <?= $status === 'berhasil' ? 'active' : '' ?>" id="pop-up">
        <h2>Perubahan Berhasil Disimpan</h2>
        <p>Perubahan yang Anda lakukan telah berhasil disimpan.</p>
        <section class="d-flex justify-content-around">
            <button type="button" onclick="window.location.href='index.php?c=Claim&m=detail_onprocess&id=<?= $claim['claim_id'] ?>'" class="btn btn-secondary w-100 mr-1">Kembali</button>
            <button type="button" onclick="window.location.href='index.php?c=Claim&m=status'" class="btn btn-primary">Lihat Status</button>
        </section>
    </div>

    <!-- Overlay dan Pop-up Gagal -->
    <div class="overlay <?= $status === 'gagal' ? 'active' : '' ?>" id="overlay-failed"></div>
    <div class="pop-up <?= $status === 'gagal' ? 'active' : '' ?>" id="pop-up-failed">
        <h2>Gagal Menyimpan Perubahan</h2>
        <p>Terjadi kesalahan saat menyimpan perubahan Anda. Silakan coba lagi.</p>
        <section class="d-flex justify-content-center">
            <button type="button" onclick="document.getElementById('overlay-failed').classList.remove('active'); document.getElementById('pop-up-failed').classList.remove('active');" class="btn btn-secondary w-100">Tutup</button>
        </section>
    </div>

    <script>
        // Preview gambar
        document.getElementById('upload').addEventListener('change', function(event) {
            const files = event.target.files;
            const previewWrapper = document.getElementById('image-preview');
            previewWrapper.innerHTML = ''; // Reset preview area

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.createElement('div');
                    previewContainer.classList.add('preview-container');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('upload-preview');

                    const fileName = document.createElement('span');
                    fileName.textContent = file.name;
                    fileName.classList.add('file-name');

                    const deleteButton = document.createElement('button');
                    deleteButton.innerHTML = 'Delete';
                    deleteButton.classList.add('delete-image-btn');
                    deleteButton.onclick = () => previewWrapper.removeChild(previewContainer);

                    previewContainer.appendChild(img);
                    previewContainer.appendChild(fileName);
                    previewContainer.appendChild(deleteButton);
                    previewWrapper.appendChild(previewContainer);
                }
                reader.readAsDataURL(file);
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>