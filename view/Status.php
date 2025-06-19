<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Status Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/style/styles.css">
    <style>
        .status-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .status-item {
            display: flex;
            gap: 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 1rem;
            background-color: #fff;
            align-items: center;
            text-decoration: none;
            color: inherit;
            transition: border-color 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .status-item:hover {
            border-color: #4A90E2;
        }

        .foto-barang {
            flex-shrink: 0;
        }

        .foto-barang img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .status-text {
            flex-grow: 1;
        }

        .status-text h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }

        .status-text p {
            margin: 0.25rem 0 0;
            font-size: 0.875rem;
            color: #666;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.found {
            background-color: #E3F2FD;
            color: #1976D2;
        }

        .status-badge.waiting {
            background-color: #FFF3E0;
            color: #F57C00;
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
            .status-item {
                padding: 0.75rem;
            }

            .foto-barang img {
                width: 60px;
                height: 60px;
            }

            .status-text h3 {
                font-size: 0.875rem;
            }

            .status-text p {
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header>
            <span class="back" onclick="history.back()">&#9665;</span>
            <span class="h5 mb-0">Status Barang</span>
        </header>

        <div class="container">
            <div class="status-list">
                <?php if (!empty($laporan)): ?>
                    <?php foreach ($laporan as $item): ?>
                        <a href="<?= $item['is_found'] ? '?c=Lapor&m=dtlTemu&id=' . $item['lost_item_id'] : '?c=Lapor&m=dtlTunggu&id=' . $item['lost_item_id'] ?>" class="status-item">
                            <div class="foto-barang">
                                <img src="<?= htmlspecialchars($item['foto_url']) ?>" alt="Foto <?= htmlspecialchars($item['nama_barang']) ?>">
                            </div>
                            <div class="status-text">
                                <h3><?= htmlspecialchars($item['nama_barang']) ?></h3>
                                <p>
                                    <span class="status-badge <?= $item['is_found'] ? 'found' : 'waiting' ?>">
                                        <?= $item['is_found'] ? 'Ditemukan' : 'Menunggu' ?>
                                    </span>
                                </p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <p>Belum ada laporan barang.</p>
                    </div>
                <?php endif; ?>

                <a href="?c=Lapor&m=dtlTemu" class="status-item">
                    <div class="foto-barang">
                        <img src="IMG_19329402.jpg" alt="Barang 2">
                    </div>
                    <div class="status-text">
                        <h3>Dompet Kulit Hitam</h3>
                        <p>
                            <span class="status-badge found">Ditemukan</span>
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>