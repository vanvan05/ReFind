<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/style/styles-claims.css">
    <title>Status Barang</title>
</head>
<body>
    <div class="wrapper">
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand" href="http://localhost/ReFind/index.php?c=Home&m=beranda">
                <img class="back" src="public/images/back-icon.png" alt="Back Icon">
                Status Barang
            </a>
        </nav>

        <main class="container mt-4">
            <?php if (!empty($laporan)): ?>
                <?php foreach ($laporan as $item): ?>
                    <div class="card align-items-start mb-3 bg-light"
                        onclick="window.location.href='<?php echo ($item['is_found'] ? 'index.php?c=Lapor&m=dtlTemu&id=' . $item['lost_item_id'] : 'index.php?c=Lapor&m=dtlTunggu&id=' . $item['lost_item_id']); ?>'"
                        style="cursor: pointer;">
                        <div class="d-flex align-items-center justify-content-center m-2">
                            <img src="<?php echo htmlspecialchars($item['foto_url']); ?>" class="img-thumbnail mr-3" alt="<?php echo htmlspecialchars($item['nama_barang']); ?>" style="width: 5em; height: auto;">
                            <div>
                                <h5 class="mb-0"><b><?php echo htmlspecialchars($item['nama_barang']); ?></b></h5>
                                <p class="mb-0 <?php echo ($item['is_found'] == 0) ? 'text-warning' : 'text-success'; ?>">
                                    <?php echo ($item['is_found'] == 1) ? 'Ditemukan' : 'Menunggu'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="card align-items-start mb-3 bg-light"
                onclick="window.location.href='index.php?c=Lapor&m=dtlTemu&id=9999'"
                style="cursor: pointer;">
                <div class="d-flex align-items-center justify-content-center m-2">
                    <img src="uploaded_images/lara.jpeg" class="img-thumbnail mr-3" alt="Dompet Kulit Hitam" style="width: 5em; height: auto;">
                    <div>
                        <h5 class="mb-0"><b>Dompet Kulit Hitam</b></h5>
                        <p class="mb-0 text-success">Ditemukan</p>
                    </div>
                </div>
            </div>
            <?php if (empty($laporan)): ?>
                <div class="text-center p-4 text-muted">
                    <p>Belum ada laporan barang.</p>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
