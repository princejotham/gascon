<?php
  session_start();
  if(isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Gascon Integrated Business Control System</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <br></br>
    <h1 style="color: #fff;text-align: center;">Welcome to Gascon Integrated Business Control System</h1>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header" style="background: maroon;color: #fff;">Login Here</div>
      <div class="card-body">
        <form action="process/login.php" method="POST">
          <div class="form-group">
            <label for="Username">Username</label>
            <input class="form-control" autofocus name="username" type="text" placeholder="Enter Username" required>
          </div>
          <div class="form-group">
            <label for="Password">Password</label>
            <input class="form-control" name="password" type="password" placeholder="Enter Password" required>
          </div>
<!--           <div class="form-group">
            <label for="UserType">User Type</label>
            <select class="form-control" name="ut">
              <option value="1">Admin</option>
              <option value="2">Pharmacy</option>
              <option value="3">Water Station</option>
            </select>
          </div> -->
          <div class="form-group">
            <input class="btn btn-primary btn-block" type="submit" value="Login" name="admin">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
