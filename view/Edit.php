<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Barang Hilang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/style/styles.css">
    <style>
        form {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 12px;
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
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 12px;
            background-color: #fff;
            cursor: pointer;
            min-height: 44px;
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
            margin-top: 8px;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            max-height: 200px;
        }

        .file-preview-img {
            width: 100%;
            max-height: 200px;
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
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex-grow: 1;
        }

        .file-remove {
            width: 20px;
            height: 20px;
            background: #000;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            font-size: 14px;
            margin-left: 8px;
            cursor: pointer;
            flex-shrink: 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header>
            <span class="back" onclick="history.back()">&#9665;</span>
            <span>Edit Barang Hilang</span>
        </header>

        <form action="?c=Lapor&m=update" method="POST" enctype="multipart/form-data">
            <div class="container">
                <input type="hidden" name="id" value="<?= htmlspecialchars($lapor['lost_item_id']) ?>" />

                <div class="mb-3">
                    <label for="brg" class="form-label"><strong>Nama Barang:</strong></label>
                    <input type="text" class="form-control" name="brg" id="brg" value="<?= htmlspecialchars($lapor['nama_barang']) ?>" required />
                </div>

                <div class="mb-3">
                    <label for="desc" class="form-label"><strong>Deskripsi Barang:</strong></label>
                    <textarea class="form-control" name="desc" id="desc" rows="3" required><?= htmlspecialchars($lapor['deskripsi']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="last" class="form-label"><strong>Terakhir Dilihat:</strong></label>
                    <input type="text" class="form-control" name="last" id="last" value="<?= htmlspecialchars($lapor['last_seen']) ?>" required />
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Foto Barang (opsional):</strong></label>
                    <div class="file-input-container">
                        <input type="file" name="foto" id="fileInput" class="file-input" accept="image/*" onchange="previewFile(event)" />
                        <label for="fileInput" class="file-input-label">
                            <div class="file-info">
                                <div class="file-name" id="fileName">Pilih file gambar</div>
                                <div class="file-remove" id="removeBtn" style="display: none;">×</div>
                            </div>
                        </label>
                        <div class="file-preview-container" id="previewContainer">
                            <img id="previewImage" class="file-preview-img" src="<?= htmlspecialchars($lapor['foto_url']) ?>" alt="Preview" />
                        </div>
                    </div>
                </div>

                <input type="hidden" name="old_foto_url" value="<?= htmlspecialchars($lapor['foto_url']) ?>">

                <div class="footer-button">
                    <button type="submit" class="btn-bordered">Simpan</button>
                </div>
            </div>
        </form>

        <?php if (isset($_SESSION['popup_success_edit']) && $_SESSION['popup_success_edit'] === true): ?>
        <div class="popup active" id="popupSuccess">
            <h4>Laporan<br>Berhasil Diperbarui</h4>
            <div class="d-flex justify-content-center gap-3 mt-3">
                <button class="btn btn-bordered" onclick="hidePopup()">Kembali</button>
                <button class="btn btn-bordered" onclick="location.href='?c=Lapor&m=status'">Lihat Status</button>
            </div>
        </div>
        <?php unset($_SESSION['popup_success_edit']); ?>
        <?php endif; ?>
        </div>

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
            document.getElementById("fileName").textContent = "Pilih file gambar";
            document.getElementById("previewImage").src = "";
            document.getElementById("previewContainer").style.display = "none";
            this.style.display = "none";
        });

        window.addEventListener('DOMContentLoaded', () => {
            const previewImage = document.getElementById("previewImage");
            const previewContainer = document.getElementById("previewContainer");
            const fileName = document.getElementById("fileName");
            const removeBtn = document.getElementById("removeBtn");

            if (previewImage.src && !previewImage.src.endsWith('/')) {
                previewContainer.style.display = "block";
                const srcParts = previewImage.src.split('/');
                fileName.textContent = decodeURIComponent(srcParts[srcParts.length - 1]);
                removeBtn.style.display = "block";
            }
        }); 
    </script>
</body>
</html>