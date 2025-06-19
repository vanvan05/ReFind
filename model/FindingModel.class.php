<?php

class FindingModel extends Model {
  function insert($id, $nama, $lokasi, $waktu, $deskripsi, $nama_foto){
    $sql = "INSERT INTO findings (reporter_id, nama_barang, lokasi, waktu, deskripsi, foto_url) " 
    . "VALUES ($id, '$nama', '$lokasi', '$waktu', '$deskripsi', '$nama_foto')";
    $result = $this->db->query($sql);
    return $result;
  }

  function update($nama, $lokasi, $waktu, $deskripsi, $nama_foto, $id){
    $sql = "UPDATE findings SET nama_barang = '$nama', lokasi = '$lokasi', waktu = '$waktu', deskripsi='$deskripsi', foto_url='$nama_foto' WHERE finding_id = '$id'";
    return $this->db->query($sql);
  }

  function getFinding($id) {
    $sql = "SELECT findings.*, u.*
            FROM findings 
            JOIN users u ON findings.reporter_id = u.user_id
            WHERE findings.finding_id = '$id'";
    $result = $this->db->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return $rows[0];
  }
  
  function getClaims($id){
     $sql = "SELECT claims.*, f.*, u.*
            FROM claims 
            JOIN findings f ON claims.item_id = f.finding_id
            JOIN users u ON claims.claimer_id = u.user_id
            WHERE claims.item_id = '$id'";
    $result = $this->db->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return $rows[0];
  }

  function getLatestFindings() {
    $sql = "SELECT * FROM findings ORDER BY finding_id DESC LIMIT 3";
    return $this->db->query($sql);
  }

  function getFindingsByUser() {
    session_start();
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM findings WHERE reporter_id = $id";
    $result = $this->db->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  function delete($id){
    $sql = "DELETE FROM findings WHERE finding_id = '$id'";
    return $this->db->query($sql);
  }

  function deleteFoto($id){
    $sql = "UPDATE findings SET foto_url = NULL WHERE finding_id = '$id'";
    return $this->db->query($sql);
  }
}