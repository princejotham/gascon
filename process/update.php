<?php	
	// database connection
	require_once '../database/connection.php';

	// user submit the form
	if(isset($_POST['ciu']))
	{	
		$cn = $_POST['cn'];
		$cid = $_POST['cid'];

		try {
			$stmt = $PDO->prepare("UPDATE `category` SET `name`=?
													WHERE `id`=?;");
			$stmt->bindValue(1, $cn, PDO::PARAM_STR);
			$stmt->bindValue(2, $cid, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
			alert('Category Saved.');
			window.location = '../category_pharmacy.php';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	} // if(isset($_POST['ciu'])) END

	// user submit the form
	if(isset($_POST['biu']))
	{
	    $errors = array(); // validation errors array
	
		$ic = $_POST['ic'];
		$in = $_POST['in'];
		$it = $_POST['it'];
		$sp = $_POST['sp'];
		$bp = $_POST['bp'];
		$icat = $_POST['icat'];

		try {
			$stmt = $PDO->prepare("UPDATE `item` SET `item_name`=?,
													`type`=?,
													`sell_price`=?,
													`buy_price`=?,
													`category_id`=?
													WHERE `id`=?;");
			$stmt->bindValue(1, $in, PDO::PARAM_STR);
			$stmt->bindValue(2, $it, PDO::PARAM_STR);
			$stmt->bindValue(3, $sp, PDO::PARAM_STR);
			$stmt->bindValue(4, $bp, PDO::PARAM_STR);
			$stmt->bindValue(5, $icat, PDO::PARAM_INT);
			$stmt->bindValue(6, $ic, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
			alert('Item Saved.');
			window.location = '../items_pharmacy.php?catid={$_POST['icat']}';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	} // if(isset($_POST['biu'])) END
?>
<?php
	if(isset($_POST['ubb']))
	{
	    $errors = array(); // validation errors array
	
		$id = $_POST['id'];
		$bn = $_POST['bn'];
		$bp = $_POST['bp'];

		try {
			$stmt = $PDO->prepare("UPDATE `bottle` SET `bottle_name`=?,
													`price`=? 
													WHERE `id`=?;");
			$stmt->bindValue(1, $bn, PDO::PARAM_STR);
			$stmt->bindValue(2, $bp, PDO::PARAM_STR);
			$stmt->bindValue(3, $id, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
			alert('Bottle Saved.');
			window.location = '../items_ws.php';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	} // if(isset($_POST['ubb'])) END

// client_btn
	if(isset($_POST['client_btn']))
	{
		$customer_name		= $_POST['customer_name'];
		$customer_address 	= $_POST['customer_address'];
		$customer_id	 	= $_POST['customer_id'];

		try {
			$stmt = $PDO->prepare("UPDATE `customer` SET `c_name`=?, `c_address`=? WHERE `id`=?");
			$stmt->bindValue(1, $customer_name, PDO::PARAM_STR);
			$stmt->bindValue(2, $customer_address, PDO::PARAM_STR);
			$stmt->bindValue(3, $customer_id, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
			alert('Customer Saved.');
			window.location = '../clients.php';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}
// client_btn - end 
?>