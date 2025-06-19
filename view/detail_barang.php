<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/style/styles-claims.css">
</head>
<body>
    <div class="wrapper">
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand" onclick="history.back()">
                <img class="back" src="public/images/back-icon.png" alt="Back Icon">
                Detail Barang
            </a>
        </nav>
        
        <main class="container mt-4">
            <h3><?php echo $barang['nama_barang']; ?></h3>

            <div class="d-flex align-items-start justify-content-start">
                <div>
                    <img src="uploaded_images/<?php echo $barang['foto_url']; ?>" alt="Handphone Samsung S24" class="img-fluid img-thumbnail p-0" style="width: 7.5em; height: auto;">
                </div>
                <div class="ml-3">
                    <p><b>Lokasi ditemukan:</b> <?php echo $barang['lokasi']; ?></p>
                    <p><b>Waktu ditemukan:</b> <?php echo $barang['waktu']; ?></p>
                    <p><b>Ditemukan oleh:</b> <?php echo $barang['reporter_nama']; ?></p>
                </div>
            </div>

            <div class="mt-2">
                <h3>Deskripsi</h3>
                <p><?php echo $barang['deskripsi']; ?></p>
            </div>

            <div>
                <a href="index.php?c=Claim&m=form&item_id=<?= $barang['finding_id'] ?>" class="btn btn-primary">Klaim Barang</a>
            </div>
        </main>
    </div>
</body>
</html>
