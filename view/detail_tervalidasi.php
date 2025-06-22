<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Klaim Tervalidasi</title>
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
            <h3><?php echo $claim['nama_barang']; ?></h3>
            <h5 class="text-success">Tervalidasi</h5>
            <p>Klaim ini telah diverifikasi oleh penemu barang.</p>

            <div class="card align-items-start mb-3 bg-light">
                <div class="d-flex align-items-center justify-content-center m-2">
                    <img src="uploaded_images/<?php echo $claim['barang_foto']; ?>" class="img-thumbnail mr-3" alt="Handphone Samsung S24" style="width: 3.75em; height: auto;">
                    <div>
                        <h5><b><?php echo $claim['reporter_nama']; ?></b></h5>
                        <p><b>Kontak: </b><?php echo $claim['reporter_email']; ?></p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>