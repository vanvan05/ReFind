<?php

class Detail extends Controller {
    private $claimModel;

    public function __construct() {       
        $this->claimModel = $this->loadModel('ClaimModel');
    }

    // Menampilkan detail barang
    function barang() {
        $id = $_GET['id'] ?? null;
        $barang = $this->claimModel->getBarangById($id);
        $this->loadView('detail_barang.php', ['barang' => $barang]);
    }
}