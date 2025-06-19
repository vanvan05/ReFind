<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/style/styles.css">
    <link rel="stylesheet" href="public/style/styles-claims.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .foto-barang img {
            width: 100%;
            max-width: 100px;
            border-radius: 10px;
        }

        .text-bold {
            font-weight: bold;
        }

        .wrapper {
            width: 100% !important;
            max-width: 100vw !important;
            padding: 0 !important;
        }

        .container {
            width: 100% !important;
            max-width: 100vw !important;
            padding-left: 2vw !important;
            padding-right: 2vw !important;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header>
            <span class="back" onclick="history.back()">&#9665;</span>
            <span class="h5 mb-0">Detail Barang</span>
        </header>

        <div class="container">
            <div class="fw-bold mb-3"><?= htmlspecialchars($lapor['nama_barang']) ?></div>

            <div class="d-flex gap-3 mb-3">
                <div class="foto-barang">
                    <img src="<?= htmlspecialchars($lapor['foto_url']) ?>" alt="<?= htmlspecialchars($lapor['nama_barang']) ?>" />
                </div>

                <div>
                    <p class="mb-1 text-bold">Status:</p>
                    <p><?= $lapor['is_found'] ? 'Ditemukan' : 'Menunggu' ?></p>
                    <p class="mb-1 text-bold">Terakhir Dilihat:</p>
                    <p><?= htmlspecialchars($lapor['last_seen']) ?></p>
                </div>
            </div>

            <div class="mb-3">
                <p class="text-bold">Deskripsi:</p>
                <p><?= htmlspecialchars($lapor['deskripsi']) ?></p>
            </div>  
        </div>

        <div class="footer-button">
            <button class="btn btn-bordered" onclick="window.location.href='?c=Lapor&m=edit&id=<?= $lapor['lost_item_id'] ?>'">Edit</button>
            <button class="btn btn-bordered" onclick="showDeletePopup()">Hapus</button>
        </div>
    </div>

    <div class="overlay" id="overlay-delete"></div>
    <div class="pop-up" id="pop-up-delete">
        <h2>Yakin Hapus Laporan?</h2>
        <p>Apakah Anda yakin ingin menghapus laporan ini?</p>
        <section class="d-flex justify-content-around">
            <button type="button" onclick="hidePopupDelete()" class="btn btn-secondary w-100 mr-1">Kembali</button>
            <button type="button" id="confirmDelete" class="btn btn-danger w-100">Hapus</button>
        </section>
    </div>

    <div class="overlay" id="overlay-success"></div>
    <div class="pop-up" id="pop-up-success">
        <h2>Laporan Berhasil Dihapus!</h2>
        <p>Laporan Anda telah berhasil dihapus.</p>
        <section class="d-flex justify-content-center">
            <button type="button" id="backToStatus" class="btn btn-secondary w-100">Kembali</button>
        </section>
    </div>

    <script>
        function showDeletePopup() {
            document.getElementById("overlay-delete").classList.add("active");
            document.getElementById("pop-up-delete").classList.add("active");
        }
        function hidePopupDelete() {
            document.getElementById("overlay-delete").classList.remove("active");
            document.getElementById("pop-up-delete").classList.remove("active");
        }
        document.getElementById("confirmDelete").addEventListener("click", function() {
            const id = "<?= $lapor['lost_item_id'] ?>";
            window.location.href = '?c=Lapor&m=delete&id=' + id;
        });
        document.getElementById("backToStatus").addEventListener("click", function() {
            window.location.href = '?c=Lapor&m=status'; 
        });
    </script>
</body>
</html>
