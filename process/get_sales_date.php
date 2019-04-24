<?php 
require_once '../database/connection.php';
	try {
	    $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales");
	    $stmt->execute();
	    $btp = $stmt->fetch(PDO::FETCH_ASSOC);

	    $return['total_price'] = $btp["ST"];

	    echo json_encode($return);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
?>