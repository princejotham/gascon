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
        <li class="nav-item" title="Monthly Sales">
          <a class="nav-link" href="sales_pharmacy_monthly.php">
            <span class="nav-link-text">Monthly Sales</span>
          </a>
        </li>
        <li class="nav-item active" title="Yearly Sales">
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
              <div class="col-sm-5" style="text-align: right;">
                <form id="select-year">
                  <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                      <strong>Yealy Sales:</strong>
                    </div>

                    <div class="col-sm-3" style="padding-right: 0;padding-left: 0;">
                      <select class="form-control" name="year" id="year">
                          <option value="2018" <?php if(date("y") == "2018") { echo "selected"; } ?>>2018</option>
                          <option value="2019" <?php if(date("y") == "2019") { echo "selected"; } ?>>2019</option>
                          <option value="2020" <?php if(date("y") == "2020") { echo "selected"; } ?>>2020</option>
                          <option value="2021" <?php if(date("y") == "2021") { echo "selected"; } ?>>2021</option>
                          <option value="2022" <?php if(date("y") == "2022") { echo "selected"; } ?>>2022</option>
                      </select>
                    </div>

                  </div><!-- ./row -->
                </form>
              </div>
            </div>


          <!-- All Items -->
          <!-- <div id="sales_table"></div> -->
          <div class="row">
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none" id="january">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">January</div>
                </div>
              </a>
            </div>

            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">February</div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">March</div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">April</div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">May</div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">June</div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">July</div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">August</div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">September</div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">October</div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">November</div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-2 mb-3">
              <a href="#" class="text-decoration-none">
                <div class="card chover">
                  <div class="card-body display-4 text-center" style="font-size: 1.5rem;">December</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div><!--<div class="row">-->
<?php require 'includes/footer.php'; ?>