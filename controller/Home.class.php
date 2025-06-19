<?php

class Home extends Controller {
  function index(){
    $this->loadView('index.php');
  }

  function beranda(){
    
    $model = $this->loadModel('FindingModel');
    $findings = $model->getLatestFindings();
    $this->loadView('beranda.php', ['findings'=>$findings]);
  }
}