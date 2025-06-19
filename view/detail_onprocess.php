<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Klaim on Process</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/style/styles-claims.css">
</head>
<body>
    <div class="wrapper">
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand" href="index.php?c=Claim&m=status">
                <img class="back" src="public/images/back-icon.png" alt="Back Icon">
                Detail Klaim
            </a>
        </nav>

        <main class="container mt-4">
            <?php if ($claim): ?>
                <h3><?php echo htmlspecialchars($claim['nama_barang']); ?></h3>
                <h5 class="text-warning">Klaim sedang Diproses</h5>
                <p>Klaim yang Anda ajukan sedang divalidasi oleh penemu barang.</p>
                <div class="card mb-4 mt-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Bukti Gambar Kepemilikan</b></h5>
                        <p class="card-text">Ini merupakan bukti yang telah Anda unggah.</p>
                        <div class="text-center">
                            <img src="uploaded_images/<?php echo $claim['foto_url']; ?>" class="img-fluid img-thumbnail" alt="Bukti Gambar Kepemilikan">
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><b>Pernyataan Pendukung</b></h5>
                        <p class="card-text">Ini merupakan pernyataan yang telah Anda buat.</p>
                        <div class="statement-box p-2 bg-light border rounded">
                            <p><?php echo htmlspecialchars($claim['pernyataan_pendukung']); ?></p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>Data klaim tidak ditemukan.</p>
            <?php endif; ?>
        </main>

        <div class="d-flex justify-content-between">
            <button type="button" id="delete-claim" class="btn btn-danger w-100 mr-2">Hapus</button>
            <a href="index.php?c=Claim&m=edit&id=<?php echo $claim['claim_id']; ?>" class="btn btn-warning">Edit</a>
        </div>
    </div>

    <!-- Overlay -->
    <div class="overlay <?= isset($_GET['status']) ? 'active' : '' ?>" id="overlay"></div>

    <!-- Pop-up Konfirmasi -->
    <div class="pop-up" id="confirm-pop-up">
        <h2>Hapus Klaim?</h2>
        <p>Apakah Anda yakin ingin menghapus klaim ini? Tindakan ini tidak dapat dibatalkan.</p>
        <section class="d-flex justify-content-around">
            <button type="button" id="cancel-delete" class="btn btn-secondary w-100 mr-1">Batal</button>
            <button type="button" id="confirm-delete" class="btn btn-danger">Hapus</button>
        </section>
    </div>

    <!-- Pop-up Hasil -->
    <div class="overlay <?= $_GET['status'] === 'berhasil' ? 'active' : '' ?>" id="overlay"></div>
    <div class="pop-up <?= $_GET['status'] === 'berhasil' ? 'active' : '' ?>" id="pop-up">
        <h2>Berhasil Dihapus</h2>
        <p>Klaim Anda telah berhasil dihapus.</p>
        <section class="d-flex justify-content-around">
            <button type="button" onclick="window.location.href='index.php?c=Claim&m=status'" class="btn btn-primary">Kembali</button>
        </section>
    </div>

    <div class="overlay <?= $_GET['status'] === 'gagal' ? 'active' : '' ?>" id="overlay"></div>
    <div class="pop-up <?= $_GET['status'] === 'gagal' ? 'active' : '' ?>" id="pop-up">
        <h2>Gagal Dihapus</h2>
        <p>Terjadi kesalahan saat menghapus klaim Anda.</p>
        <section class="d-flex justify-content-around">
            <button type="button" onclick="window.location.href='index.php?c=Claim&m=status'" class="btn btn-primary">Kembali</button>
        </section>
    </div>

    <script>
        document.getElementById('delete-claim').addEventListener('click', function () {
            document.getElementById('overlay').classList.add('active');
            document.getElementById('confirm-pop-up').classList.add('active');
        });

        document.getElementById('cancel-delete').addEventListener('click', function () {
            document.getElementById('overlay').classList.remove('active');
            document.getElementById('confirm-pop-up').classList.remove('active');
        });

        document.getElementById('confirm-delete').addEventListener('click', function () {
            window.location.href = 'index.php?c=Claim&m=delete&id=<?php echo $claim['claim_id']; ?>';
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>