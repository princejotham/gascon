

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
      // document.querySelectorAll('.fc-next-button')
      $(document).ready(function() {
        $('#items').DataTable();
        $('.fc-today-button.fc-button.fc-button-primary').attr("onclick", "btnClickP()");
        var i;
        for(i in document.querySelectorAll("td.fc-day-top")) {
          var mydiv = document.querySelectorAll("td.fc-day-top")[i];
          var aTag = document.createElement('a');
          var ddate = mydiv.getAttribute("data-date");

          var d1 = new Date();  
          var datey1 = d1.getFullYear();
          var datem1 = d1.getMonth() + 1;
          var dated1 = d1.getDate();
          
          var d2 = new Date(ddate);
          var datey2 = d2.getFullYear();
          var datem2 = d2.getMonth() + 1;
          var dated2 = d2.getDate();
          
          var n1 = datey1 + "-"  + datem1 + "-" + dated1;
          var n2 = datey2 + "-"  + datem2 + "-" + dated2;

          var dateOne = new Date(datey1, datem1, dated1); //Year, Month, Date  
          var dateTwo = new Date(datey2, datem2, dated2); //Year, Month, Date  
          if (dateOne >= dateTwo) {  
            console.log("Date One is greater than Date Two.");  
            aTag.setAttribute('href',"sales_pharmacy_selectby_month.php?ymd="+ddate);
            aTag.innerHTML = "View Sales";
            aTag.setAttribute("class", "btn btn-primary seldate")
            mydiv.appendChild(aTag);
          }else {  
            console.log("Date Two is greater than Date One.");  
          }

        }
      });

      $('#stock-report').click(function(event) {
        window.open('print_stock_pharmacy.php','name','width=auto,height=auto');
      });
      $(document).ready(function() {
        $('#expenses').DataTable();
      });
      $(document).ready(function() {
        $('#refill_cus').DataTable();
      });

      //stock report print
      $('#stock-report').click(function(event) {
        window.open('print_stock_pharmacy.php','name','width=auto,height=auto');
      });

      function math_rd(t) {
        var total = parseFloat(Math.round(t * 100) / 100).toFixed(2);
        return total;
      }

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
        var date = $('#sd').val();
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


      // report_ws_all
      $('#report_ws_all').click(function(event) {
        window.open('sales_ws_print_all.php','name','width=auto,height=auto');
      });

      //sale-report_ws print
      $('#sale-report_ws_daily').click(function(event) {
        var date = $('#sd').val();
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

// Select Daily Sales = Water
$(document).on('change', '#select-date-water', function(event) {
  event.preventDefault();
  /* Act on the event */
  var sd = $('#sd').val();

  $.ajax({
      url: 'includes/select_sales_ws.php',
      type: 'post',
      data: {
        sd:sd
      },
      success: function (data) {
        $('#sales_table_water').html(data);
      },
      error: function(){
        alert('Error: L17+');
      }
    });
});

// Select Month Sales = Water
$(document).on('change', '#select-month-water', function(event) {
  event.preventDefault();
  /* Act on the event */
  var sm = $('#month').val();
  var sy = $('#year').val();
  var sd = sy+"-"+sm;
  $.ajax({
      url: 'includes/select_sales_ws.php',
      type: 'post',
      data: {
        sd:sd
      },
      success: function (data) {
        $('#sales_table_water').html(data);
      },
      error: function(){
        alert('Error: L17+');
      }
    });
});

// Select Yearly Sales = Water
$(document).on('change', '#select-year-water', function(event) {
  event.preventDefault();
  /* Act on the event */
  var sd = $('#year').val();
  $.ajax({
      url: 'includes/select_sales_ws.php',
      type: 'post',
      data: {
        sd:sd
      },
      success: function (data) {
        $('#sales_table_water').html(data);
      },
      error: function(){
        alert('Error: L17+');
      }
    });
});

// Select Daily Sales = Pharmacy
$(document).on('change', '#select-date', function(event) {
  event.preventDefault();
  /* Act on the event */
  var sd = $('#sd').val();

  $.ajax({
      url: 'includes/select_sales.php',
      type: 'post',
      data: {
        sd:sd
      },
      success: function (data) {
        $('#sales_table').html(data);
      },
      error: function(){
        alert('Error: L17+');
      }
    });
});

// Select Month Sales = Pharmacy
$(document).on('change', '#select-month', function(event) {
  event.preventDefault();
  /* Act on the event */
  var sm = $('#month').val();
  var sy = $('#year').val();
  var sd = sy+"-"+sm;
  $.ajax({
      url: 'includes/select_sales.php',
      type: 'post',
      data: {
        sd:sd
      },
      success: function (data) {
        $('#sales_table').html(data);
      },
      error: function(){
        alert('Error: L17+');
      }
    });
});

// Select Year Sales = Pharmacy
$(document).on('change', '#select-year', function(event) {
  event.preventDefault();
  /* Act on the event */
  var sd = $('#year').val();

  $.ajax({
      url: 'includes/select_sales.php',
      type: 'post',
      data: {
        sd:sd
      },
      success: function (data) {
        $('#sales_table').html(data);
      },
      error: function(){
        alert('Error: L17+');
      }
    });
});

function eMsg(params){
  alert("Error: L"+params+"+");
}//end eMsg

function showSales(){
  $.ajax({
      url: 'includes/sales_pharmacy_table.php',
      type: 'post',
      success: function (data) {
        $('#sales_table').html(data);
      },
      error: function(){
        eMsg('297');
      }
    });
}//end showSales
showSales();
function showSales_month(){
  $.ajax({
      url: 'includes/sales_pharmacy_table_month.php',
      type: 'post',
      success: function (data) {
        $('#sales_table_month').html(data);
      },
      error: function(){
        eMsg('297');
      }
    });
}//end showSales
showSales_month();

function showSalesWater(){
  $.ajax({
      url: 'includes/sales_water_table.php',
      type: 'post',
      success: function (data) {
        $('#sales_table_water').html(data);
      },
      error: function(){
        eMsg('297');
      }
    });
}//end showSalesWater
showSalesWater();

function showExpensesWater(){
  $.ajax({
      url: 'expenses/expenses_water_table.php',
      type: 'post',
      success: function (data) {
        $('#expenses_table_water').html(data);
      },
      error: function(){
        eMsg('297');
      }
    });
}//end showSalesWater
showExpensesWater();

// Select Daily Expenses = Water
$(document).on('change', '#select-date-water-ex', function(event) {
  event.preventDefault();
  /* Act on the event */
  var ed = $('#ed').val();

  $.ajax({
      url: 'includes/select_expenses_ws.php',
      type: 'post',
      data: {
        ed:ed
      },
      success: function (data) {
        $('#expenses_table_water').html(data);
      },
      error: function(){
        alert('Error: L17+');
      }
    });
});

// Select Month Sales = Pharmacy
$(document).on('change', '#select-month-ex', function(event) {
  event.preventDefault();
  /* Act on the event */
  var sm = $('#month').val();
  var sy = $('#year').val();
  var sd = sy+"-"+sm;
  $.ajax({
      url: 'includes/select_expenses_ws.php',
      type: 'post',
      data: {
        sd:sd,
        month:'month'
      },
      success: function (data) {
        $('#expenses_table_water').html(data);
      },
      error: function(){
        alert('Error: L17+');
      }
    });
});

// Select Year Sales = Pharmacy
$(document).on('change', '#select-year-water-ex', function(event) {
  event.preventDefault();
  /* Act on the event */
  var sd = $('#year').val();

  $.ajax({
      url: 'includes/select_expenses_ws.php',
      type: 'post',
      data: {
        sd:sd,
        year:'year'
      },
      success: function (data) {
        $('#expenses_table_water').html(data);
      },
      error: function(){
        alert('Error: L17+');
      }
    });
});

//expenses-report_ws print
$('#expenses-report_ws_daily').click(function(event) {
  var date = $('#sd').val();
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

      function btnClickP() {
        setTimeout(function(){
          var i;
          for (i = 0; i < document.querySelectorAll("td.fc-day-top").length; i++) {
            var id = ".btn.btn-primary.seldate"+i;
            if(document.querySelectorAll(id).length == 0) {
              var mydiv = document.querySelectorAll("td.fc-day-top")[i];
              var ddate = mydiv.getAttribute("data-date");

              var d1 = new Date();  
              var datey1 = d1.getFullYear();
              var datem1 = d1.getMonth() + 1;
              var dated1 = d1.getDate();
              
              var d2 = new Date(ddate);
              var datey2 = d2.getFullYear();
              var datem2 = d2.getMonth() + 1;
              var dated2 = d2.getDate();
              
              var n1 = datey1 + "-"  + datem1 + "-" + dated1;
              var n2 = datey2 + "-"  + datem2 + "-" + dated2;
              
              var dateOne = new Date(datey1, datem1, dated1); //Year, Month, Date  
              var dateTwo = new Date(datey2, datem2, dated2); //Year, Month, Date  
              if (dateOne >= dateTwo) {
                var aTag = document.createElement('a');
                aTag.setAttribute('href',"sales_pharmacy_selectby_month.php?ymd="+ddate);
                aTag.innerHTML = "View Sales";
                aTag.setAttribute("class", "btn btn-primary seldate seldate" + i);
                mydiv.appendChild(aTag);
              }else {  
                console.log("Date Two is greater than Date One.");  
              }             
            }
          }
        }, 500);
      }

$(document).on('change', '#year', function(event) {
  event.preventDefault();
  var letyear = $("#year").val();
  $("#january").attr("href", "sales_pharmacy_monthly.php?y="+letyear+"-"+"01");
});
var letyear = $("#year").val();
$("#january").attr("href", "sales_pharmacy_monthly.php?y="+letyear+"-"+"01");
    </script>
    <script src="js/transaction.js"></script>
    <script src="js/sb-admin-charts.js"></script>

  </div>
</body>

</html>