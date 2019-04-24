<?php	
	// database connection
	require_once '../database/connection.php';

	// user submit the form
	if(isset($_POST['ci']))
	{
	
		$cn = $_POST['cn'];

		try {
			$stmt = $PDO->prepare("INSERT INTO `category`(`name`)  
									VALUES (?);");
			$stmt->bindValue(1, $cn, PDO::PARAM_STR);
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

	} // if(isset($_POST['ci'])) END

	// user submit the form
	if(isset($_POST['bi']))
	{
	
		$in = $_POST['in'];
		$it = $_POST['it'];
		$sp = $_POST['sp'];
		$bp = $_POST['bp'];
		$icat = $_POST['icat'];

		try {
			$stmt = $PDO->prepare("INSERT INTO `item`(`item_name`, `type`, `sell_price`, `buy_price`, `category_id`) 
									VALUES (?, ?, ?, ?, ?);");
			$stmt->bindValue(1, $in, PDO::PARAM_STR);
			$stmt->bindValue(2, $it, PDO::PARAM_STR);
			$stmt->bindValue(3, $sp, PDO::PARAM_STR);
			$stmt->bindValue(4, $bp, PDO::PARAM_STR);
			$stmt->bindValue(5, $icat, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
			alert('Item Saved.');
			window.location = '../items_pharmacy.php';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	} // if(isset($_POST['bi'])) END

	// user submit the form
	if(isset($_POST['ibs']))
	{
		$i_id = $_POST['i_id'];
		$sq = $_POST['sq'];
		$sm = $_POST['sm'];
		$spd = $_POST['spd'];
		$sed = $_POST['sed'];

		try {
            $stmt = $PDO->prepare("SELECT * FROM item i INNER JOIN stock_item s ON i.id=s.item_id WHERE i.id = ? AND s.item_ex= ?");
            $stmt->bindValue(1, $i_id, PDO::PARAM_STR);
            $stmt->bindValue(2, $sed, PDO::PARAM_STR);
            $stmt->execute();
            $all_stocks = $stmt->fetch(PDO::FETCH_ASSOC);
            $row_num = $stmt->rowCount();
            
            if ($row_num == 0) {
            	if($sed==date("Y-m-d")) {
            		echo "
					<script>
					alert('The stock is expired, please add stock does not expire.');
					window.location = '../stocks_pharmacy.php';
					</script>
            		";
            	} else {
	            	$stmt = $PDO->query("SELECT * FROM `item` WHERE id = '{$i_id}'");
	            	$item = $stmt->fetch(PDO::FETCH_ASSOC);
					$stmt = $PDO->prepare("INSERT INTO `stock_item`(`item_qty`, `item_man`, `item_pur`, `item_ex`, `sell_price`, `buy_price`, `item_id`)
											VALUES (?, ?, ?, ?, ?, ?, ?);");
					$stmt->bindValue(1, $sq, PDO::PARAM_STR);
					$stmt->bindValue(2, $sm, PDO::PARAM_STR);
					$stmt->bindValue(3, $spd, PDO::PARAM_STR);
					$stmt->bindValue(4, $sed, PDO::PARAM_STR);
					$stmt->bindValue(5, $item['sell_price'], PDO::PARAM_STR);
					$stmt->bindValue(6, $item['buy_price'], PDO::PARAM_STR);
					$stmt->bindValue(7, $i_id, PDO::PARAM_STR);
					$stmt->execute();

					echo "
					<script>
					alert('Stock Saved.');
					window.location = '../stocks_pharmacy.php';
					</script>
					";	
            	}
            } else {
            	if($sed==date("Y-m-d")) {
            		echo "
					<script>
					alert('The stock is expired, please add stock does not expire.');
					window.location = '../stocks_pharmacy.php';
					</script>
            		";
            	} else {
	            	$sq = $all_stocks['item_qty']+$sq;
					$stmt = $PDO->prepare("UPDATE `stock_item` SET `item_qty`=?, `item_man`=?, `item_pur`=?, `item_ex`=? WHERE `item_id`=?;");
					$stmt->bindValue(1, $sq, PDO::PARAM_STR);
					$stmt->bindValue(2, $sm, PDO::PARAM_STR);
					$stmt->bindValue(3, $spd, PDO::PARAM_STR);
					$stmt->bindValue(4, $sed, PDO::PARAM_STR);
					$stmt->bindValue(5, $i_id, PDO::PARAM_STR);
					$stmt->execute();

					echo "
					<script>
					alert('Stock Saved.');
					window.location = '../stocks_pharmacy.php';
					</script>
					";	
            	}
            }

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	} // if(isset($_POST['ibs'])) END

	if (isset($_POST['a_cart'])) {
		$iid = $_POST['iid'];
		$ip = $_POST['ip'];
		$iex = $_POST['iex'];
		$sid = $_POST['sidv'];
		$iname = $_POST['iname'];
		$item_qty = $_POST['item_qty'];

		try {
			// get stock
			$stmt = $PDO->prepare("SELECT * FROM `stock_item` WHERE item_id = ? AND item_ex = ?");
			$stmt->bindValue(1, $iid, PDO::PARAM_STR);
			$stmt->bindValue(2, $iex, PDO::PARAM_STR);
			$stmt->execute();
			$s_item = $stmt->fetch(PDO::FETCH_ASSOC);

			
			if($stmt) {
				// update stock
				$sub_qty = $s_item['item_qty']-$item_qty;
				$stmt = $PDO->prepare("UPDATE `stock_item` SET `item_qty`=? WHERE item_id = ? AND item_ex = ?");
				$stmt->bindValue(1, $sub_qty, PDO::PARAM_STR);
				$stmt->bindValue(2, $iid, PDO::PARAM_STR);
				$stmt->bindValue(3, $iex, PDO::PARAM_STR);
				$stmt->execute();
			}

			$stmt = $PDO->prepare("SELECT * FROM `cart` WHERE stock_id = ?");
			$stmt->bindValue(1, $sid, PDO::PARAM_STR);
			$stmt->execute();
			$c_item = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($sid == $c_item['stock_id']) {
				$add_qty = $c_item['qty']+$item_qty;
				$stmt = $PDO->prepare("UPDATE `cart` SET `qty`=? WHERE stock_id=?;");
				$stmt->bindValue(1, $add_qty, PDO::PARAM_STR);
				$stmt->bindValue(2, $sid, PDO::PARAM_STR);
				$stmt->execute();
				/*echo "
				<script>
				window.location = '../pharmacy.php';
				</script>
				";*/
			} else {
				$stmt = $PDO->prepare("INSERT INTO `cart`(`stock_id`, `price`, `qty`, `i_code`, `i_name`) VALUES (?, ?, ?, ?, ?);");
				$stmt->bindValue(1, $sid, PDO::PARAM_STR);
				$stmt->bindValue(2, $ip, PDO::PARAM_STR);
				$stmt->bindValue(3, $item_qty, PDO::PARAM_STR);
				$stmt->bindValue(4, $iid, PDO::PARAM_STR);
				$stmt->bindValue(5, $iname, PDO::PARAM_STR);
				$stmt->execute();
				/*echo "
				<script>
				window.location = '../pharmacy.php';
				</script>
				";*/
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	} // End a_cart

	if (isset($_POST['btn_confirm'])) {
		try {
			// get all purchase
			$stmt = $PDO->prepare("SELECT * FROM cart");
			$stmt->execute();
			$purchase_set = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if($purchase_set)
			{
			    $stmt = $PDO->prepare("SELECT * FROM sales_trans");
			    $stmt->execute();
			    $row_num = $stmt->rowCount();

				foreach($purchase_set as $row)
				{
					$stmt = $PDO->prepare("INSERT INTO item_sales (item_code, price, qty, sub_total, tran_id, item_name) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt->bindValue(1, $row['i_code'], PDO::PARAM_STR);
					$stmt->bindValue(2, $row['price'], PDO::PARAM_STR);
					$stmt->bindValue(3, $row['qty'], PDO::PARAM_STR);
					$stmt->bindValue(4, $row['qty']*$row['price'], PDO::PARAM_STR);
					$stmt->bindValue(5, $row_num+1, PDO::PARAM_STR);
					$stmt->bindValue(6, $row['i_name'], PDO::PARAM_STR);
					$stmt->execute();
				}

				$stmt = $PDO->prepare("INSERT INTO sales_trans (trans_no) VALUES (?)");
				$stmt->bindValue(1, $row_num+1, PDO::PARAM_STR);
				$stmt->execute();

				$stmt = $PDO->prepare("DELETE FROM cart");
				$stmt->execute();

				echo "
				<script>
				alert('Item(s) checked out.');
				window.location = '../pharmacy.php';
				</script>
				";
			}
			else
			{
				echo "
				<script>
				alert('Please select an item to check out.');
				window.location = '../pharmacy.php';
				</script>
				";
			}

		} catch (PDOException $e) {
			echo $e->getMessage();

			header("Location: ../pharmacy.php");
			exit();
		}

	} // end btn_confirm
?>
<?php
	// Bottle
	if (isset($_POST['bb'])) {
		$bn = $_POST['bn'];
		$bp = $_POST['bp'];

		try {
			$stmt = $PDO->prepare("INSERT INTO `bottle`(`bottle_name`, `price`) 
									VALUES (?, ?);");
			$stmt->bindValue(1, $bn, PDO::PARAM_STR);
			$stmt->bindValue(2, $bp, PDO::PARAM_STR);
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
	} // end bb

	// start sbb
	if (isset($_POST['sbb'])) {
		$sq = $_POST['sq'];
		$b_id = $_POST['b_id'];

		try {
		    for($i=1;$i<=$sq;$i++) {
				$stmt = $PDO->prepare("INSERT INTO `stock_bottle`(`bottle_qty`, `bottle_id`) 
										VALUES (?, ?);");
				$stmt->bindValue(1, 1, PDO::PARAM_STR);
				$stmt->bindValue(2, $b_id, PDO::PARAM_STR);
				$stmt->execute();
		    }

			echo "
			<script>
			alert('Stock Saved.');
			window.location = '../stocks_ws.php';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}		
	} // end sbb

	if (isset($_POST['select_cus'])) {
		$c_id = $_POST['customer'];
		
		try {
			$stmt = $PDO->prepare("SELECT * FROM `customer` WHERE `id`=?;");
			$stmt->bindValue(1, $c_id, PDO::PARAM_STR);
			$stmt->execute();
		    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

		echo "
		<script>
		window.location = '../ws.php?c_name=" . $customer['c_name'] . "&c_address=" . $customer['c_address'] . "&c_id=" . $customer['id'] . "';
		</script>
		";
	} // end select_cus

	if (isset($_POST['ba_cart_refill'])) {
		$bname = $_POST['bname'];
		$sbid = $_POST['sbid'];
		$bp = $_POST['bp'];
		
		$c_name = $_POST['c_name'];
		$c_address = $_POST['c_address'];
		$c_id = $_POST['c_id'];

		try {
			$stmt = $PDO->prepare("INSERT INTO `cart_bottle` (`b_name`, `b_no`, `price`, `qty`, `stock_id`, `refill`) 
									VALUES (?, ?, ?, ?, ?, ?);");
			$stmt->bindValue(1, $bname, PDO::PARAM_STR);
			$stmt->bindValue(2, 1, PDO::PARAM_STR);
			$stmt->bindValue(3, $bp, PDO::PARAM_STR);
			$stmt->bindValue(4, 1, PDO::PARAM_STR);
			$stmt->bindValue(5, $sbid, PDO::PARAM_STR);
			$stmt->bindValue(6, 1, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
				window.location = '../ws.php?c_name=" . $c_name . "&c_address=" . $c_address . "&c_id=" . $c_id . "&r_id=1';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	} // end ba_cart refill

	if (isset($_POST['ba_cart'])) {
		$bname = $_POST['bname'];
		$bp = $_POST['bp'];
		$sbid = $_POST['sbid'];
		$c_name = $_POST['c_name'];
		$c_address = $_POST['c_address'];
		$c_id = $_POST['c_id'];

		try {
			$stmt = $PDO->prepare("UPDATE `stock_bottle` SET `bottle_qty`=? WHERE s_id = ?");
			$stmt->bindValue(1, 0, PDO::PARAM_STR);
			$stmt->bindValue(2, $sbid, PDO::PARAM_STR);
			$stmt->execute();

			$stmt = $PDO->prepare("INSERT INTO `cart_bottle` (`b_name`, `b_no`, `price`, `qty`, `stock_id`, `refill`) 
									VALUES (?, ?, ?, ?, ?, ?);");
			$stmt->bindValue(1, $bname, PDO::PARAM_STR);
			$stmt->bindValue(2, 1, PDO::PARAM_STR);
			$stmt->bindValue(3, $bp, PDO::PARAM_STR);
			$stmt->bindValue(4, 1, PDO::PARAM_STR);
			$stmt->bindValue(5, $sbid, PDO::PARAM_STR);
			$stmt->bindValue(6, 0, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
				window.location = '../ws.php?c_name=" . $c_name . "&c_address=" . $c_address . "&c_id=" . $c_id . "';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	} // end ba_cart

	if (isset($_POST['bottle_btn_confirm'])) {
		try {
			// get all purchase
			$stmt = $PDO->prepare("SELECT * FROM cart_bottle");
			$stmt->execute();
			$purchase_set = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if($purchase_set)
			{
			    $stmt = $PDO->prepare("SELECT * FROM sales_trans");
			    $stmt->execute();
			    $row_num = $stmt->rowCount();

				foreach($purchase_set as $row)
				{
					$stmt = $PDO->prepare("INSERT INTO bottle_sales (stock_id, b_name, qty, price, sub_total, tran_id, refill, return_bot) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
					$stmt->bindValue(1, $row['stock_id'], PDO::PARAM_STR);
					$stmt->bindValue(2, $row['b_name'], PDO::PARAM_STR);
					$stmt->bindValue(3, $row['qty'], PDO::PARAM_STR);
					$stmt->bindValue(4, $row['price'], PDO::PARAM_STR);
					$stmt->bindValue(5, $row['qty']*$row['price'], PDO::PARAM_STR);
					$stmt->bindValue(6, $row_num+1, PDO::PARAM_STR);
					$stmt->bindValue(7, $row['refill'], PDO::PARAM_STR);
					$stmt->execute();
				}

				$stmt = $PDO->prepare("INSERT INTO sales_trans (trans_no, cus_id) VALUES (?, ?)");
				$stmt->bindValue(1, $row_num+1, PDO::PARAM_STR);
				$stmt->bindValue(2, $_POST['c_id'], PDO::PARAM_STR);
				$stmt->execute();

				$stmt = $PDO->prepare("DELETE FROM cart_bottle");
				$stmt->execute();

				echo "
				<script>
				alert('Bottle(s) checked out.');
				window.location = '../ws.php';
				</script>
				";
			}
			else
			{
				echo "
				<script>
				alert('Please select an bottle to check out.');
				window.location = '../ws.php';
				</script>
				";
			}

		} catch (PDOException $e) {
			echo $e->getMessage();

			echo "
			<script>
			alert('Database connection failed, please see your web master.');
			window.location = '../ws.php';
			</script>
			";
		}

	} // end bottle_btn_confirm
?>
<?php
	// user expenses
	if(isset($_POST['eb']))
	{
		$ed = $_POST['ed'];
		$ep = $_POST['ep'];

		try {
			$stmt = $PDO->prepare("INSERT INTO `expenses`(`expense`, `price`) VALUES (?, ?)");
			$stmt->bindValue(1, $ed, PDO::PARAM_STR);
			$stmt->bindValue(2, $ep, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
			alert('Expenses Saved.');
			window.location = '../expenses_ws.php';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	} // if(isset($_POST['eb'])) END
?>
<?php
// customer_btn
	if(isset($_POST['customer_btn']))
	{
		$customer_name		= $_POST['customer_name'];
		$customer_address 	= $_POST['customer_address'];

		try {
			$stmt = $PDO->prepare("INSERT INTO `customer`(`c_name`, `c_address`) VALUES (?, ?)");
			$stmt->bindValue(1, $customer_name, PDO::PARAM_STR);
			$stmt->bindValue(2, $customer_address, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
			alert('Customer Saved.');
			window.location = '../ws.php';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}
// customer_btn - end
// client_btn
	if(isset($_POST['client_btn']))
	{
		$customer_name		= $_POST['customer_name'];
		$customer_address 	= $_POST['customer_address'];

		try {
			$stmt = $PDO->prepare("INSERT INTO `customer`(`c_name`, `c_address`) VALUES (?, ?)");
			$stmt->bindValue(1, $customer_name, PDO::PARAM_STR);
			$stmt->bindValue(2, $customer_address, PDO::PARAM_STR);
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

// expense_btn
	if(isset($_POST['expense_btn']))
	{
		$expense_desc		= $_POST['expense_desc'];
		$expense_price 		= $_POST['expense_price'];

		try {
			$stmt = $PDO->prepare("INSERT INTO `expenses`(`expense`, `price`) VALUES (?, ?)");
			$stmt->bindValue(1, $expense_desc, PDO::PARAM_STR);
			$stmt->bindValue(2, $expense_price, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
			alert('Expense Saved.');
			window.location = '../ws.php';
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
// expense_btn - end

	// ba_cart_return
	if (isset($_POST['ba_cart_return'])) {
		$sbid = $_POST['sbid'];
		$id = $_POST['id'];

		$c_name = $_POST['c_name'];
		$c_address = $_POST['c_address'];
		$c_id = $_POST['c_id'];

		try {
			$stmt = $PDO->prepare("UPDATE `stock_bottle` SET `bottle_qty`=1 WHERE `s_id`=?;");
			$stmt->bindValue(1, $sbid, PDO::PARAM_STR);
			$stmt->execute();

			$stmt = $PDO->prepare("UPDATE `bottle_sales` SET `return_bot`=1 WHERE `id`=?;");
			$stmt->bindValue(1, $id, PDO::PARAM_STR);
			$stmt->execute();

			echo "
			<script>
				alert('The bottle has been returned.');
				
			</script>
			";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	} // end ba_cart_return end

?>