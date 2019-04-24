<?php
session_start();
 if(isset($_SESSION["ut"])) {
 	if($_SESSION["ut"] == "index") {
		session_destroy();
		header("location: login.php?logout=1");
		exit();
 	} elseif($_SESSION["ut"] == "pharmacy") {
		session_destroy();
		header("location: login.php?logout=1");
		exit();
 	} else {
		session_destroy();
		header("location: login.php?logout=1");
		exit();
 	}
 }
?>