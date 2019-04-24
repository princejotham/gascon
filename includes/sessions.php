<?php
  session_start();
  if(!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
  }
  if(isset($_SESSION['ut'])) {
  	if($_SESSION['ut'] != "index") {
      header("Location: " . $_SESSION['ut'] . ".php");
      exit();
    }
  }
?>