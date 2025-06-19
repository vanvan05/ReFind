<?php

require_once 'Model.class.php';

class ClaimModel extends Model {
    
    public function getBarangById($id) {
        $stmt = $this->db->prepare(
            "SELECT findings.*, users.username AS reporter_nama, users.email AS reporter_email
            FROM findings
            JOIN users ON findings.reporter_id = users.user_id
            WHERE findings.finding_id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Ambil semua klaim
    public function getClaims() {
        $sql = "SELECT claims.*, 
                    findings.nama_barang, findings.foto_url AS barang_foto
                FROM claims
                JOIN findings ON claims.item_id = findings.finding_id";
        $result = $this->db->query($sql);
        $claims = [];
        while ($row = $result->fetch_assoc()) {
            $claims[] = $row;
        }
        return $claims;
    }

    // Ambil klaim berdasarkan ID
    public function getClaimById($id) {
        $stmt = $this->db->prepare(
            "SELECT claims.*, 
                findings.nama_barang
            FROM claims
            JOIN findings ON claims.item_id = findings.finding_id
            WHERE claims.claim_id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Ambil klaim tervalidasi berdasarkan ID
    public function getValidatedClaimById($id) {
        $stmt = $this->db->prepare(
            "SELECT 
                claims.claim_id,
                claims.is_validated,
                findings.nama_barang,
                findings.foto_url AS barang_foto,
                users.username AS reporter_nama,
                users.email AS reporter_email
            FROM claims
            JOIN findings ON claims.item_id = findings.finding_id
            JOIN users ON findings.reporter_id = users.user_id
            WHERE claims.claim_id = ? AND claims.is_validated = 1"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Simpan klaim baru
    public function createClaim($ownershipImage, $claimStatement, $itemId, $claimerId) {
        $imagePath = null;
        if ($ownershipImage && $ownershipImage['tmp_name']) {
            $imagePath = 'uploaded_images/' . basename($ownershipImage['name']);
            move_uploaded_file($ownershipImage['tmp_name'], $imagePath);
        }
        $stmt = $this->db->prepare(
            "INSERT INTO claims (item_id, claimer_id, foto_url, pernyataan_pendukung) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("iiss", $itemId, $claimerId, basename($ownershipImage['name']), $claimStatement);
        if (!$stmt->execute()) {
            die("Error: " . $stmt->error);}
        return true;
    }

    // Update klaim
    public function updateClaim($id, $ownershipImage, $statement, $oldImage = null) {
        $imagePath = $oldImage;
        if ($ownershipImage && $ownershipImage['tmp_name']) {
            $imagePath = 'uploaded_images' . basename($ownershipImage['name']);
            move_uploaded_file($ownershipImage['tmp_name'], $imagePath);
        }
        $stmt = $this->db->prepare(
            "UPDATE claims SET pernyataan_pendukung = ?, foto_url = ? WHERE claim_id = ?"
        );
        $stmt->bind_param("ssi", $statement, basename($ownershipImage['name']), $id);
        return $stmt->execute();
    }

    // Hapus klaim
    public function deleteClaim($id) {
        $stmt = $this->db->prepare("DELETE FROM claims WHERE claim_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}