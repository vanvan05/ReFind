<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lapor Barang Hilang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/style/styles.css">
    <style>
        form {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        textarea {
            resize: none;
        }

        .file-input-container {
            position: relative;
            margin-top: 8px;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            border: 2px dashed #4A90E2;
            border-radius: 12px;
            padding: 1rem;
            background-color: rgba(74, 144, 226, 0.05);
            cursor: pointer;
            min-height: 44px;
            transition: background-color 0.3s ease;
        }

        .file-input-label:hover {
            background-color: rgba(74, 144, 226, 0.1);
        }

        .file-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .file-preview-container {
            display: none;
            width: 100%;
            margin-top: 1rem;
            border-radius: 12px;
            overflow: hidden;
            max-height: 300px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .file-preview-img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            display: block;
        }

        .file-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .file-name {
            font-size: 0.875rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex-grow: 1;
            color: #4A90E2;
            font-weight: 500;
        }

        .file-remove {
            width: 24px;
            height: 24px;
            background: #4A90E2;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            font-size: 16px;
            margin-left: 8px;
            cursor: pointer;
            flex-shrink: 0;
            transition: background-color 0.3s ease;
        }

        .file-remove:hover {
            background: #357ABD;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid #e0e0e0;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4A90E2;
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
        }

        @media (max-width: 768px) {
            .wrapper {
                border-radius: 0;
                min-height: 100vh;
            }

            .container {
                padding: 1rem;
            }

            .file-preview-container {
                max-height: 200px;
            }

            .file-preview-img {
                max-height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header>
            <span class="back" onclick="history.back()">&#9665;</span>
            <span class="h5 mb-0">Lapor Barang Hilang</span>
        </header>

        <form action="index.php?c=lapor&m=add" method="POST" enctype="multipart/form-data">
            <div class="container">
                <div class="mb-4">
                    <label for="brg" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="nama" id="brg" placeholder="Masukkan nama barang" required />
                </div>

                <div class="mb-4">
                    <label for="desc" class="form-label">Deskripsi Barang</label>
                    <textarea class="form-control" name="deskripsi" id="desc" rows="3" placeholder="Jelaskan detail barang yang hilang" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="last" class="form-label">Terakhir Dilihat</label>
                    <input type="text" class="form-control" name="lokasi" id="last" placeholder="Masukkan lokasi terakhir barang" required />
                </div>

                <div class="mb-4">
                    <label class="form-label">Foto Barang</label>
                    <div class="file-input-container">
                        <input type="file" id="fileInput" name="foto" class="file-input" accept="image/*" onchange="previewFile(event)" required />
                        <label for="fileInput" class="file-input-label">
                            <div class="file-info">
                                <div class="file-name" id="fileName">📁 Upload Foto Barang</div>
                                <div class="file-remove" id="removeBtn" style="display: none;">×</div>
                            </div>
                        </label>
                        <div class="file-preview-container" id="previewContainer">
                            <img id="previewImage" class="file-preview-img" src="" alt="Preview" />
                        </div>
                    </div>
                </div>

                <div class="footer-button">
                    <button type="submit" class="btn-bordered">Kirim Laporan</button>
                </div>
            </div>
        </form>

        <?php if (isset($_SESSION['popup_success']) && $_SESSION['popup_success'] === true): ?>
            <div class="popup active" id="popupSuccess">
                <h4 class="text-center mb-4">Laporan<br>Berhasil Dibuat</h4>
                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-bordered" onclick="hidePopup()">Kembali</button>
                    <button class="btn btn-bordered" onclick="location.href='?c=Lapor&m=status'">Lihat Status</button>
                </div>
            </div>
            <?php unset($_SESSION['popup_success']);?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showSuccessPopup() {
            document.getElementById("popupSuccess").classList.add("active");
        }

        function hidePopup() {
            document.getElementById("popupSuccess").classList.remove("active");
        }

        function previewFile(event) {
            const input = event.target;
            const previewContainer = document.getElementById("previewContainer");
            const fileNameElement = document.getElementById("fileName");
            const removeBtn = document.getElementById("removeBtn");

            if (input.files.length > 0) {
                const file = input.files[0];
                fileNameElement.textContent = file.name;
                removeBtn.style.display = "block";

                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById("previewImage");
                    previewImage.src = e.target.result;
                    previewContainer.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        }

        document.getElementById("removeBtn").addEventListener("click", function(e) {
            e.stopPropagation();
            document.getElementById("fileInput").value = "";
            document.getElementById("fileName").textContent = "📁 Upload Foto Barang";
            document.getElementById("previewImage").src = "";
            document.getElementById("previewContainer").style.display = "none";
            this.style.display = "none";
        });
    </script>
</body>
</html>
