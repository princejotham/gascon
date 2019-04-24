<?php
	
	session_start();
	
	// database connection
	require_once '../database/connection.php';

	if(isset($_POST['admin'])) {
		/*$ut = $_POST['ut'];*/
		$u = $_POST['username'];
		$p = md5($_POST['password']);

		try {
			$stmt = $PDO->prepare("SELECT * FROM `users` WHERE `username`=? AND `password`=?/* AND user_type=?*/;");
			$stmt->bindValue(1, $u, PDO::PARAM_STR);
			$stmt->bindValue(2, $p, PDO::PARAM_STR);
			/*$stmt->bindValue(3, $ut, PDO::PARAM_STR);*/
			$stmt->execute();
			$user_row = $stmt->fetch(PDO::FETCH_ASSOC);
			$no_row = $stmt->rowCount();

			if($no_row == 1) {
				if($user_row['id'] == 1) {
					$_SESSION['id'] = $user_row['id'];
					$_SESSION['ut'] = "index";
					echo "
					<script>
					alert('Login Successfull.');
					window.location = '../index.php';
					</script>
					";
				} elseif($user_row['id'] == 2) {
					$_SESSION['id'] = $user_row['id'];
					$_SESSION['ut'] = "pharmacy";
					echo "
					<script>
					alert('Login Successfull.');
					window.location = '../pharmacy_page.php';
					</script>
					";
				} else {
					$_SESSION['id'] = $user_row['id'];
					$_SESSION['ut'] = "ws";
					echo "
					<script>
					alert('Login Successfull.');
					window.location = '../water_page.php';
					</script>
					";
				}
			} else {
				echo "
				<script>
				alert('Login failed, please try again.');
				window.location = '../login.php';
				</script>
				";
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	} // end if admin


	if(isset($_POST['pharmacy'])) {
		$ut = $_POST['ut'];
		$u = $_POST['username'];
		$p = md5($_POST['password']);

		try {
			$stmt = $PDO->prepare("SELECT * FROM `users` WHERE `username`=? AND `password`=? AND user_type=?;");
			$stmt->bindValue(1, $u, PDO::PARAM_STR);
			$stmt->bindValue(2, $p, PDO::PARAM_STR);
			$stmt->bindValue(3, $ut, PDO::PARAM_STR);
			$stmt->execute();
			$user_row = $stmt->fetch(PDO::FETCH_ASSOC);
			$no_row = $stmt->rowCount();

			if($no_row == 1) {
				$_SESSION['id'] = $user_row['id'];
				$_SESSION['ut'] = "pharmacy";
				echo "
				<script>
				alert('Login Successfull.');
				window.location = '../pharmacy.php';
				</script>
				";
			} else {
				echo "
				<script>
				alert('Login failed, please try again.');
				window.location = '../loginp.php';
				</script>
				";
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	} // end if pharmacy


	if(isset($_POST['ws'])) {
		$ut = $_POST['ut'];
		$u = $_POST['username'];
		$p = md5($_POST['password']);

		try {
			$stmt = $PDO->prepare("SELECT * FROM `users` WHERE `username`=? AND `password`=? AND user_type=?;");
			$stmt->bindValue(1, $u, PDO::PARAM_STR);
			$stmt->bindValue(2, $p, PDO::PARAM_STR);
			$stmt->bindValue(3, $ut, PDO::PARAM_STR);
			$stmt->execute();
			$user_row = $stmt->fetch(PDO::FETCH_ASSOC);
			$no_row = $stmt->rowCount();

			if($no_row == 1) {
				$_SESSION['id'] = $user_row['id'];
				$_SESSION['ut'] = "ws";
				echo "
				<script>
				alert('Login Successfull.');
				window.location = '../ws.php';
				</script>
				";
			} else {
				echo "
				<script>
				alert('Login failed, please try again.');
				window.location = '../loginw.php';
				</script>
				";
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	} // end if ws
?>