<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Detail Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/style/styles.css">
    <style>
        .detail-header {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }

        .status-section {
            margin-bottom: 1.5rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            background-color: #E3F2FD;
            color: #1976D2;
            margin-bottom: 0.5rem;
        }

        .status-desc {
            color: #666;
            font-size: 0.875rem;
            margin-bottom: 0;
        }

        .info-box {
            display: flex;
            gap: 1rem;
            align-items: center;
            background-color: #fff;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: border-color 0.3s ease;
            margin-bottom: 1rem;
        }

        .info-box:hover {
            border-color: #4A90E2;
        }

        .info-box img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .info-text {
            flex-grow: 1;
        }

        .info-text strong {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .info-text p {
            margin: 0;
            color: #666;
            font-size: 0.875rem;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #4A90E2;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .contact-info i {
            font-size: 1rem;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #666;
        }

        .empty-state p {
            margin: 1rem 0;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .detail-header {
                font-size: 1.25rem;
            }

            .info-box {
                padding: 1rem;
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
            <?php if (isset($lapor)): ?>
                <div class="detail-header"><?= htmlspecialchars($lapor['nama_barang']) ?></div>

                <div class="status-section">
                    <span class="status-badge">Ditemukan</span>
                    <p class="status-desc">Barang ini telah ditemukan dan siap diambil</p>
                </div>

                <div class="info-box">
                    <img src="<?= htmlspecialchars($lapor['foto_url']) ?>" alt="<?= htmlspecialchars($lapor['nama_barang']) ?>" />
                    <div class="info-text">
                        <strong>Deskripsi</strong>
                        <p><?= htmlspecialchars($lapor['deskripsi']) ?></p>
                        <div class="contact-info">
                            <i class="fas fa-envelope"></i>
                            <span>nama@gmail.com</span>
                        </div>
                    </div>
                </div>

                <div class="footer-button">
                    <button class="btn btn-bordered" onclick="window.location.href='?c=Lapor&m=edit&id=<?= $lapor['lost_item_id'] ?>'">Edit</button>
                    <button class="btn btn-bordered" onclick="window.location.href='?c=Lapor&m=delete&id=<?= $lapor['lost_item_id'] ?>'">Hapus</button>
                </div>
            <?php else: ?>

                <?php if (!empty($foundItems)): ?>
                    <?php foreach ($foundItems as $item): ?>
                        <a href="?c=Lapor&m=dtlTemu&id=<?= $item['lost_item_id'] ?>" class="info-box" style="text-decoration: none; color: inherit;">
                            <img src="<?= htmlspecialchars($item['foto_url']) ?>" alt="<?= htmlspecialchars($item['nama_barang']) ?>" />
                            <div class="info-text">
                                <strong><?= htmlspecialchars($item['nama_barang']) ?></strong>
                                <p><?= htmlspecialchars($item['deskripsi']) ?></p>
                                <div class="contact-info">
                                    <i class="fas fa-envelope"></i>
                                    <span>nama@gmail.com</span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <p>Belum ada barang yang ditemukan.</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>