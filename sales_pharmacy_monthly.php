<?php require_once 'includes/sessionsp.php'; ?>
<?php require 'includes/header_pharmacy.php'; ?>



  <!-- Navigation-->  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">AJ JR Pharmacy</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" title="Daily Sales">
          <a class="nav-link" href="sales_pharmacy.php">
            <span class="nav-link-text">Daily Sales</span>
          </a>
        </li>
        <li class="nav-item active" title="Monthly Sales">
          <a class="nav-link" href="sales_pharmacy_monthly.php">
            <span class="nav-link-text">Monthly Sales</span>
          </a>
        </li>
        <li class="nav-item" title="Yearly Sales">
          <a class="nav-link" href="sales_pharmacy_yearly.php">
            <span class="nav-link-text">Yearly Sales</span>
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
          <a class="nav-link" href="pharmacy.php">Transaction</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="stocks_pharmacy.php">Inventory</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="sales_pharmacy.php">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">



      

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="pharmacy.php">Pharmacy</a>
        <li class="breadcrumb-item active">Sales</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
              <div class="row" style="padding-top: 1em;padding-bottom: 1em;">
              <div class="col-sm-7">
                <a class="btn btn-primary d-none" href="#" id="sale-report_pharmacy">
                  <span class="nav-link-text">Print Sales</span>
                </a>
              </div>
              <div class="col-sm-5 d-none" style="text-align: right;">
                <form id="select-month">
                  <div class="row">
                    <div class="col-sm-4">
                      <strong>Monthly Sales:</strong>
                    </div>

                    <div class="col-sm-4" style="padding-left: 0;">
                      <select class="form-control" name="month" id="month">
                          <option value="01" <?php if(date("m") == "01") { echo "selected"; } ?>>January</option>
                          <option value="02" <?php if(date("m") == "02") { echo "selected"; } ?>>Febuary</option>
                          <option value="03" <?php if(date("m") == "03") { echo "selected"; } ?>>March</option>
                          <option value="04" <?php if(date("m") == "04") { echo "selected"; } ?>>April</option>
                          <option value="05" <?php if(date("m") == "05") { echo "selected"; } ?>>May</option>
                          <option value="06" <?php if(date("m") == "06") { echo "selected"; } ?>>June</option>
                          <option value="07" <?php if(date("m") == "07") { echo "selected"; } ?>>July</option>
                          <option value="08" <?php if(date("m") == "08") { echo "selected"; } ?>>August</option>
                          <option value="09" <?php if(date("m") == "09") { echo "selected"; } ?>>September</option>
                          <option value="10" <?php if(date("m") == "10") { echo "selected"; } ?>>October</option>
                          <option value="11" <?php if(date("m") == "11") { echo "selected"; } ?>>November</option>
                          <option value="12" <?php if(date("m") == "12") { echo "selected"; } ?>>December</option>
                      </select>
                    </div>

                    <div class="col-sm-3" style="padding-right: 0;padding-left: 0;">
                      <select class="form-control" name="year" id="year">
                          <option value="2018" <?php if(date("Y") == "2018") { echo "selected"; } ?>>2018</option>
                          <option value="2019" <?php if(date("Y") == "2019") { echo "selected"; } ?>>2019</option>
                          <option value="2020" <?php if(date("Y") == "2020") { echo "selected"; } ?>>2020</option>
                          <option value="2021" <?php if(date("Y") == "2021") { echo "selected"; } ?>>2021</option>
                          <option value="2022" <?php if(date("Y") == "2022") { echo "selected"; } ?>>2022</option>
                      </select>
                    </div>

                  </div><!-- ./row -->
                </form>
              </div>
            </div>

          <!-- All Items -->

<?php
  $daten = date("Y-m-d");
  if(isset($_GET['y'])) {
    $daten = $_GET['y'];
  }
?>
    
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendarmonth');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid' ],
      defaultDate: '<?=$daten;?>',
      editable: false,
      showNonCurrentDates: false,
      eventLimit: false // allow "more" link when too many events
      // events: [
      //   {
      //     title: 'All Day Event',
      //     start: '2019-04-01'
      //   },
      //   {
      //     title: 'Long Event',
      //     start: '2019-04-07',
      //     end: '2019-04-10'
      //   },
      //   {
      //     groupId: 999,
      //     title: 'Repeating Event',
      //     start: '2019-04-09T16:00:00'
      //   },
      //   {
      //     groupId: 999,
      //     title: 'Repeating Event',
      //     start: '2019-04-16T16:00:00'
      //   },
      //   {
      //     title: 'Conference',
      //     start: '2019-04-11',
      //     end: '2019-04-13'
      //   },
      //   {
      //     title: 'Meeting',
      //     start: '2019-04-12T10:30:00',
      //     end: '2019-04-12T12:30:00'
      //   },
      //   {
      //     title: 'Lunch',
      //     start: '2019-04-12T12:00:00'
      //   },
      //   {
      //     title: 'Meeting',
      //     start: '2019-04-12T14:30:00'
      //   },
      //   {
      //     title: 'Happy Hour',
      //     start: '2019-04-12T17:30:00'
      //   },
      //   {
      //     title: 'Dinner',
      //     start: '2019-04-12T20:00:00'
      //   },
      //   {
      //     title: 'Birthday Party',
      //     start: '2019-04-13T07:00:00'
      //   },
      //   {
      //     title: 'Click for Google',
      //     url: 'http://google.com/',
      //     start: '2019-04-28'
      //   }
      // ]
    });

    calendar.render();
  });

</script>
<div class="row">
  <dic class="col-12">
    <div id="calendarmonth" style="margin-bottom: 30px;"></div>
  </dic>
</div>
        </div>
      </div><!--<div class="row">-->
<?php require 'includes/footer.php'; ?>