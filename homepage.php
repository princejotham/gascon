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
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="homepage.php">Gascon Integrated Business Control System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Home">
          <a class="nav-link" href="homepage.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="login.php">
            <i class="fa fa-fw fa-sign-in"></i>Login</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">

    <h1>Welcome!</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->
    
    
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Gascon Integrated Business Control System</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Login modal -->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script type="text/javascript">
      // Call the dataTables jQuery plugin
      $(document).ready(function() {
        $('#items').DataTable();
      });
      $(document).ready(function() {
        $('#pos').DataTable();
      });

      //stock report print
      $('#stock-report').click(function(event) {
        window.open('print_stock_pharmacy.php','name','width=auto,height=auto');
      });

      //stock-report_ws print
      $('#stock-report_ws').click(function(event) {
        window.open('print_stock_ws.php','name','width=auto,height=auto');
      });

      //sale-report_pharmacy admin print
      $('#sale-report').click(function(event) {
        var date = $('#date').val();
        window.open('admin_financial_pharmacy_print.php?date='+date,'name','width=auto,height=auto');
      });
      $('#sale-reportm').click(function(event) {
        var month = $('#month').val();
        var year = $('#year').val();
        var date = year+"-"+month;
        window.open('admin_financial_pharmacy_print.php?date='+date,'name','width=auto,height=auto');
      });
      $('#sale-reporty').click(function(event) {
        var date = $('#year').val();
        window.open('admin_financial_pharmacy_print.php?date='+date,'name','width=auto,height=auto');
      });

      //sale-report_ws print
      $('#sale-report_ws').click(function(event) {
        var date = $('#date').val();
        window.open('admin_financial_ws_print.php?date='+date,'name','width=auto,height=auto');
      });
      $('#sale-report_wsm').click(function(event) {
        var month = $('#month').val();
        var year = $('#year').val();
        var date = year+"-"+month;
        window.open('admin_financial_ws_print.php?date='+date,'name','width=auto,height=auto');
      });
      $('#sale-report_wsy').click(function(event) {
        var date = $('#year').val();
        window.open('admin_financial_ws_print.php?date='+date,'name','width=auto,height=auto');
      });

      $('#report_expenses').click(function(event) {
        window.open('admin_expenses_ws_print.php','name','width=auto,height=auto');
      });
      


      //sale-report_pharmacy print
      $('#sale-report_pharmacy').click(function(event) {
        var date = $('#date').val();
        window.open('sales_pharmacy_print.php?date='+date,'name','width=auto,height=auto');
      });

      //sale-report_pharmacy month print
      $('#sale-report_pharmacym').click(function(event) {
        var month = $('#month').val();
        var year = $('#year').val();
        var date = year+"-"+month;
        window.open('sales_pharmacy_print.php?date='+date,'name','width=auto,height=auto');
      });

      //sale-report_pharmacy year print
      $('#sale-report_pharmacyy').click(function(event) {
        var date = $('#year').val();
        window.open('sales_pharmacy_print.php?date='+date,'name','width=auto,height=auto');
      });



      //sale-report_ws print
      $('#sale-report_ws_daily').click(function(event) {
        var date = $('#date').val();
        window.open('sales_ws_print_cu.php?date='+date,'name','width=auto,height=auto');
      });

      //sale-report_ws_monthly month print
      $('#sale-report_ws_monthly').click(function(event) {
        var month = $('#month').val();
        var year = $('#year').val();
        var date = year+"-"+month;
        window.open('sales_ws_print_cu.php?date='+date,'name','width=auto,height=auto');
      });

      //sale-report_ws_yearly  print
      $('#sale-report_ws_yearly').click(function(event) {
        var date = $('#year').val();
        window.open('sales_ws_print_cu.php?date='+date,'name','width=auto,height=auto');
      });
    </script>
    <script src="js/sb-admin-charts.min.js"></script>
</body>

</html>