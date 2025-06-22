<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/style/styles-claims.css">
    <title>Status Klaim</title>
</head>
<body>
    <div class="wrapper">
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand" href="http://localhost/ReFind/index.php?c=Home&m=beranda">
                <img class="back" src="public/images/back-icon.png" alt="Back Icon">
                Status Klaim
            </a>
        </nav>

        <main class="container mt-4">
            <?php foreach ($claims as $claim): ?>
                <div class="card align-items-start mb-3 bg-light" 
                    onclick="window.location.href='<?php echo ($claim['is_validated'] == 1) ? 'index.php?c=Claim&m=detail_tervalidasi&id=' . $claim['claim_id'] : 'index.php?c=Claim&m=detail_onprocess&id=' . $claim['claim_id']; ?>'" 
                    style="cursor: pointer;">
                    <div class="d-flex align-items-center justify-content-center m-2">
                        <img src="uploaded_images/<?php echo htmlspecialchars($claim['barang_foto']); ?>" class="img-thumbnail mr-3" alt="<?php echo htmlspecialchars($claim['nama_barang']); ?>" style="width: 5em; height: auto;">
                        <div>
                            <h5 class="mb-0"><b><?php echo htmlspecialchars($claim['nama_barang']); ?></b></h5>
                            <p class="mb-0 <?php echo ($claim['is_validated'] == 0) ? 'text-warning' : 'text-success'; ?>">
                                <?php echo ($claim['is_validated'] == 1) ? 'Tervalidasi' : 'Diproses'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>