<?php

class Claim extends Controller {
    private $claimModel;

    public function __construct() {
        $this->claimModel = $this->loadModel('ClaimModel');
    }

    // Menampilkan form klaim barang
    function form() {
        // Cek status yang dikirim lewat URL untuk menampilkan pop-up
        $status = $_GET['status'] ?? null;
        $item_id = $_GET['item_id'] ?? null;
        $this->loadView('form_klaim.php', ['status' => $status, 'item_id' => $item_id]);
    }

    // Menangani pengiriman form klaim
    function submit() {
        session_start();
        $ownershipImage = $_FILES['ownership_image'] ?? null;
        $claimStatement = $_POST['claim_statement'] ?? '';
        $itemId = $_POST['item_id'] ?? null;
        $claimerId = $_SESSION['id'];

        if ($this->claimModel->createClaim($ownershipImage, $claimStatement, $itemId, $claimerId)) {
            header('Location: index.php?c=Claim&m=form&status=berhasil');
        } else {
            header('Location: index.php?c=Claim&m=form&status=gagal');
        }
        exit;
    }

    // Menampilkan status klaim
    function status() {
        $claims = $this->claimModel->getClaims();
        $this->loadView('status_klaim.php', ['claims' => $claims]);
    }
    
    // Menampilkan detail klaim yang sedang diproses
    function detail_onprocess() {
        $id = $_GET['id'] ?? null;
        $claim = $this->claimModel->getClaimById($id);

        if ($claim) {
            $this->loadView('detail_onprocess.php', ['claim' => $claim]);
        } else {
            echo "Data klaim tidak ditemukan.";
        }
    }

    // Simulasi aksi hapus klaim
    function delete() {
        $id = $_GET['id'];
        if ($this->claimModel->deleteClaim($id)) {
            header('Location: index.php?c=Claim&m=status&status=berhasil');
        } else {
            header('Location: index.php?c=Claim&m=status&status=gagal');
        }
        exit;
    }

    // Menampilkan detail klaim yang tervalidasi
    function detail_tervalidasi() {
        $id = $_GET['id'] ?? null;
        $claim = $this->claimModel->getValidatedClaimById($id);
        if ($claim) {
            $this->loadView('detail_tervalidasi.php', ['claim' => $claim]);
        } else {
            echo "Data klaim tervalidasi tidak ditemukan.";
        }
    }

    function edit() {
        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;
        $claim = $this->claimModel->getClaimById($id);

        if ($claim) {
            $this->loadView('edit_klaim.php', ['claim' => $claim, 'status' => $status]);
        } else {
            echo "ID klaim tidak ditemukan.";
        }
    }  

    function update() {
        $id = $_POST['id'] ?? null;
        $statement = $_POST['claim_statement'] ?? '';
        $ownershipImage = $_FILES['ownership_image'] ?? null;

        $oldClaim = $this->claimModel->getClaimById($id);
        $oldImage = $oldClaim['foto_url'] ?? null; // gunakan kolom foto_url

        $result = $this->claimModel->updateClaim($id, $ownershipImage, $statement, $oldImage);

        if ($result) {
            header("Location: index.php?c=Claim&m=edit&id=$id&status=berhasil");
        } else {
            header("Location: index.php?c=Claim&m=edit&id=$id&status=gagal");
        }
        exit;
    }
}