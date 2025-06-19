<?php

class Findings extends Controller {
  function form(){
    $this->loadView('formtemuan.php');
  }

  function add() {
    session_start();
    $id = $_SESSION['id'];
    $nama = $_POST['nama-barang'];
    $lokasi = $_POST['lokasi'];
    $waktu = $_POST['waktu'];
    $deskripsi = $_POST['deskripsi'];
    $file = $_FILES['foto'];
  
    $uploadDir = 'uploaded_images/';
    $nama_foto = ''; 
  
    if ($file['error'] == UPLOAD_ERR_OK) {
        $tempFile = $file['tmp_name'];
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nama_foto = uniqid('img_', true) . '.' . $fileExt;
        $targetPath = $uploadDir . $nama_foto;
        move_uploaded_file($tempFile, $targetPath);
    }
  
    $model = $this->loadModel('FindingModel');
    $model->insert($id, $nama, $lokasi, $waktu, $deskripsi, $nama_foto);
  }

  function statustemuan(){
    $model = $this->loadModel('FindingModel');
    $data = $model->getFindingsByUser(); 
    $this->loadView('statustemuan.php', ['findings'=>$data]);
  }

  function detailfinding(){   
    $id = $_GET['id'];
    $model = $this->loadModel('FindingModel');
    $finding = $model->getFinding($id);
    $this->loadView('detailtemuan.php', ['finding' => $finding]);
  }

  function detailclaim(){   
    $item_id = $_GET['id'];
    $model = $this->loadModel('FindingModel');
    $finding = $model->getClaims($item_id);
    $this->loadView('detailklaimtemuan.php', ['finding' => $finding]);
  }

  function edit(){
    $id = $_GET['id'];
    $model = $this->loadModel('FindingModel');
    $finding = $model->getFinding($id);
    $this->loadView('edittemuan.php', ['finding' => $finding]);
  }

  function update() {
    $id = $_POST['id'];
    $nama = $_POST['nama-barang'];
    $lokasi = $_POST['lokasi'];
    $waktu = $_POST['waktu'];
    $deskripsi = $_POST['deskripsi'];
    $file = $_FILES['foto'];

    $uploadDir = 'uploaded_images/';
    $model = $this->loadModel('FindingModel');

    $old_finding = $model->getFinding($id);
    $oldFoto = $old_finding['foto_url'];

    $nama_foto = $oldFoto;

    if ($file['error'] == UPLOAD_ERR_OK) {
        if (!empty($oldFoto) && file_exists($uploadDir . $oldFoto)) {
            unlink($uploadDir . $oldFoto);
        }

        $tempFile = $file['tmp_name'];
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nama_foto = uniqid('img_', true) . '.' . $fileExt;
        $targetPath = $uploadDir . $nama_foto;

        move_uploaded_file($tempFile, $targetPath);
    }
    $model->update($nama, $lokasi, $waktu, $deskripsi, $nama_foto, $id);
    var_dump($nama, $lokasi, $waktu, $deskripsi, $nama_foto, $id);
  }

  function delete (){
    $id = $_GET['id'];
    $model = $this->loadModel('FindingModel');
    $finding = $model->getFinding($id);
    
    $model->delete($id);
    $filePath = 'uploaded_images/' . $finding['foto_url'];
    unlink($filePath);
  }

  function deleteFoto (){
    $id = $_GET['id'];
    $model = $this->loadModel('FindingModel');
    $finding = $model->getFinding($id);

    $model->deleteFoto($id); 
    $filePath = 'uploaded_images/' . $finding['foto_url'];
    unlink($filePath);
    header('location:index.php?c=Findings&m=edit&id='. $id);
    exit;
  }
}