<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/style/styles.css">
    <style>
        .foto-barang img {
            width: 100%;
            max-width: 100px;
            border-radius: 10px;
        }

        .text-bold {
            font-weight: bold;
        }

        .container {
            padding: 1rem;
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

    <div class="popup" id="popupDelete">
        <h4 class="text-center mb-4">Yakin Hapus Laporan?</h4>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-bordered" onclick="hidePopup()">Kembali</button>
            <button class="btn btn-bordered" id="confirmDelete">Hapus</button>
        </div>
    </div>

    <div class="popup" id="popupSuccess">
        <h4 class="text-center mb-4">Laporan<br>Berhasil Dihapus!</h4>
        <div class="d-flex justify-content-center">
            <button class="btn btn-bordered" id="backToStatus">Kembali</button>
        </div>
    </div>

    <script>
        function showDeletePopup() {
            document.getElementById("popupDelete").classList.add("active");
        }

        function hidePopup() {
            document.getElementById("popupDelete").classList.remove("active");
            document.getElementById("popupSuccess").classList.remove("active");
        }

        document.getElementById("confirmDelete").addEventListener("click", function() {
            const id = "<?= $lapor['lost_item_id'] ?>";
            const xhr = new XMLHttpRequest();
            
            xhr.open('GET', '?c=Lapor&m=delete&id=' + id, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("popupDelete").classList.remove("active");
                    document.getElementById("popupSuccess").classList.add("active");
                } else {
                    alert('Gagal menghapus laporan');
                }
            };
            xhr.send();
        });

        document.querySelector("#backToStatus").addEventListener("click", function() {
            window.location.href = '?c=Lapor&m=status'; 
        });
    </script>
</body>
</html>
