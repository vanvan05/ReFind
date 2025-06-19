<?php

class LaporModel extends Model {

    public function insert($nama, $kategori, $lokasi, $deskripsi, $tanggal, $foto_url) {
        $stmt = $this->db->prepare("INSERT INTO lost_items 
            (nama_barang, deskripsi, last_seen, foto_url, reporter_id, is_found) 
            VALUES (?, ?, ?, ?, 1, 0)");
        $stmt->execute([$nama, $deskripsi, $lokasi, $foto_url]);
    }

    public function getAllReports() {
        $query = "SELECT * FROM lost_items ORDER BY lost_item_id DESC";
        $result = $this->db->query($query);

        $laporan = [];
        while ($row = $result->fetch_assoc()) {
            $laporan[] = $row;
        }

        return $laporan;
    }

    public function getFoundItems() {
        $query = "SELECT * FROM lost_items WHERE is_found = 1 ORDER BY lost_item_id DESC";
        $result = $this->db->query($query);

        $foundItems = [];
        while ($row = $result->fetch_assoc()) {
            $foundItems[] = $row;
        }

        return $foundItems;
    }

    public function getReport($id) {
        $stmt = $this->db->prepare("SELECT * FROM lost_items WHERE lost_item_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $nama, $kategori, $lokasi, $deskripsi, $tanggal, $foto_url = null) {
        if ($foto_url) {
            $stmt = $this->db->prepare("UPDATE lost_items 
                SET nama_barang = ?, deskripsi = ?, last_seen = ?, foto_url = ? 
                WHERE lost_item_id = ?");
            $stmt->execute([$nama, $deskripsi, $lokasi, $foto_url, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE lost_items 
                SET nama_barang = ?, deskripsi = ?, last_seen = ? 
                WHERE lost_item_id = ?");
            $stmt->execute([$nama, $deskripsi, $lokasi, $id]);
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM lost_items WHERE lost_item_id = ?");
        $stmt->execute([$id]);
    }
}
?>
