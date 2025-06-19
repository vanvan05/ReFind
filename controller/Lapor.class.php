<?php

class lapor extends Controller {

    function form() {
        $this->loadView('Lapor.php');
    }

    function add() {
        session_start();

        $nama       = $_POST['nama'];
        $kategori   = $_POST['kategori'] ?? '';
        $lokasi     = $_POST['lokasi'];
        $deskripsi  = $_POST['deskripsi'];  
        $tanggal    = $_POST['tanggal'] ?? '';

        $foto_url = '';
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $targetDir = 'uploaded_images/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $foto_name = basename($_FILES['foto']['name']);
            $foto_path = $targetDir . time() . '_' . $foto_name;
            move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path);
            $foto_url = $foto_path;
        }

        $model = $this->loadModel('LaporModel');
        $model->insert($nama, $kategori, $lokasi, $deskripsi, $tanggal, $foto_url);
        $_SESSION['popup_success'] = true;

        header('Location: index.php?c=lapor&m=form');
        exit;
    }

    function status() {
        $model = $this->loadModel('LaporModel');
        $data  = $model->getAllReports();
        $this->loadView('status.php', ['laporan' => $data]);
    }

    function edit() {
        $id     = $_GET['id'];
        $model  = $this->loadModel('LaporModel');
        $lapor  = $model->getReport($id);
        $this->loadView('Edit.php', ['lapor' => $lapor]);
    }

    function update() {
        session_start();
        $id = $_POST['id'];
        $nama = $_POST['brg'];
        $kategori = $_POST['kategori'] ?? '';
        $lokasi = $_POST['last'];
        $deskripsi = $_POST['desc'];
        $tanggal = $_POST['tanggal'] ?? '';
        $old_foto_url = $_POST['old_foto_url'] ?? '';

        $foto_url = $old_foto_url;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $targetDir = 'uploaded_images/';
            $foto_name = basename($_FILES['foto']['name']);
            $foto_path = $targetDir . time() . '_' . $foto_name;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path)) {
                $foto_url = $foto_path;
            }
        }

        $model = $this->loadModel('LaporModel');
        $model->update($id, $nama, $kategori, $lokasi, $deskripsi, $tanggal, $foto_url);

        $_SESSION['popup_success_edit'] = true;
        header("Location: index.php?c=Lapor&m=edit&id=$id");
        exit;

    }

    function delete() {
        $id = $_GET['id'];
        $model = $this->loadModel('LaporModel');

        $isDeleted = $model->delete($id);

        if ($isDeleted) {
            $_SESSION['delete_success'] = true;
        } else {
            $_SESSION['delete_success'] = false;
        }

        header('Location: index.php?c=Lapor&m=status');
        exit;
    }

    function dtlTunggu() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID tidak ditemukan.";
            return;
        }

        $model = $this->loadModel('LaporModel');
        $lapor = $model->getReport($id);

        if (!$lapor) {
            echo "Data tidak ditemukan.";
            return;
        }

        $this->loadView('detailTunggu.php', ['lapor' => $lapor]);
    }

    function dtlTemu() {
        $id = $_GET['id'] ?? null;
        $model = $this->loadModel('LaporModel');

        if ($id) {

            $lapor = $model->getReport($id);
            if (!$lapor) {
                echo "Data tidak ditemukan.";
                return;
            }
            $this->loadView('detailTemu.php', ['lapor' => $lapor]);
        } else {

            $foundItems = $model->getFoundItems();
            $this->loadView('detailTemu.php', ['foundItems' => $foundItems]);
        }
    }
}
