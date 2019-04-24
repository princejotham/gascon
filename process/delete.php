<?php	
	// database connection
	require_once '../database/connection.php';

	// user submit the form
	if(isset($_POST['c_del_btn']))
	{
		$c_id = $_POST['c_id'];
		$sid = $_POST['sid'];
		$qty = $_POST['qty'];

		try {
			$stmt = $PDO->prepare("SELECT * FROM `stock_item` WHERE id = ?");
			$stmt->bindValue(1, $sid, PDO::PARAM_STR);
			$stmt->execute();
            $s = $stmt->fetch(PDO::FETCH_ASSOC);

			$stmt = $PDO->prepare("UPDATE `stock_item` SET `item_qty`=? WHERE id = ?");
			$stmt->bindValue(1, $s['item_qty']+$qty, PDO::PARAM_STR);
			$stmt->bindValue(2, $sid, PDO::PARAM_STR);
			$stmt->execute();

			$stmt = $PDO->prepare("DELETE FROM `cart` WHERE id = ?");
			$stmt->bindValue(1, $c_id, PDO::PARAM_STR);
			$stmt->execute();

			// alert('Item Saved.');
			echo "
			<script>
			window.location = '../pharmacy.php';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	} // if(isset($_POST['c_del_btn'])) END

	if(isset($_POST['cb_del_btn']))
	{
		$cid = $_POST['cid'];
		$sid = $_POST['sid'];
		$qty = $_POST['qty'];
		$c_name = $_POST['c_name'];
		$c_address = $_POST['c_address'];
		$c_id = $_POST['c_id'];

		try {
			$stmt = $PDO->prepare("SELECT * FROM `cart_bottle` WHERE c_id = ?");
			$stmt->bindValue(1, $cid, PDO::PARAM_STR);
			$stmt->execute();
            $cbottle = $stmt->fetch(PDO::FETCH_ASSOC);
            if($cbottle['refill'] == 0) {
				$stmt = $PDO->prepare("UPDATE `stock_bottle` SET `bottle_qty`=? WHERE s_id = ?");
				$stmt->bindValue(1, 1, PDO::PARAM_STR);
				$stmt->bindValue(2, $sid, PDO::PARAM_STR);
				$stmt->execute();
            }

			$stmt = $PDO->prepare("DELETE FROM `cart_bottle` WHERE c_id = ?");
			$stmt->bindValue(1, $cid, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
			window.location = '../ws.php?c_name=" . $c_name . "&c_address=" . $c_address . "&c_id=" . $c_id . "';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	} // if(isset($_POST['cb_del_btn'])) END
?>