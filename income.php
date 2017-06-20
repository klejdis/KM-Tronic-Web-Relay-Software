<?php require_once 'api/check_login.php' ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/js/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/js/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/js/plugins/ionicons-2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.css">
  <link rel="stylesheet" href="assets/css/skin-blue.css">

  <link rel="stylesheet" href="assets/js/plugins/daterangepicker/daterangepicker.css">

  <style type="text/css">
    .table-bordered thead tr td{
      font-weight: bold;
    }
    #chartContainer{
      min-height: 500px;
    }
  </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
      <li><a href="logout.php"><i class="fa fa-circle-o text-aqua"></i> <span>Logout</span></a></li>

        <li class="header">MAIN NAVIGATION</li>
        <li><a href="income.php"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
     <div class="col-sm-3">
          <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control pull-right" id="daterange-table">
        </div>
        <br>
     </div>

     <div class="col-sm-2">
        <button class='btn btn-default' id="daterange-table-btn">Kerko</button>
     </div>
   </div>
  
 <div class="table-responsive">
     <table style="background-color:#fff" class="table table-bordered table-hover">
   <thead>
     <tr>
       <td> #</td>
       <td>Start Time</td>
       <td>End Time</td>
       <td>Playstation</td>
       <td>Leva</td>
       <td>Totali</td>
     </tr>
   </thead>

   <tbody>
     
   </tbody>
    
  </table>
 </div>



      
   <div class="row">
     <div class="col-sm-3">
          <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control pull-right" id="daterange">
        </div>
        <br>
     </div>

     <div class="col-sm-2">
        <button class='btn btn-default' id="daterange-btn">Kerko</button>
     </div>
   </div>

    
  

      <div class="box">
        <div class="box-header with-border">
        </div>
        <div class="box-body">

           <div id="chartContainer"></div>

        </div>
        <!-- /.box-body -->

      </div>




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.11
    </div>
    <strong>Copyright &copy; 2017<a href="#"></a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/js/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/momentjs/moment.js"></script>
<script src="assets/js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="assets/js/plugins/canvasjs/canvasjs.min.js"></script>

<script type="text/javascript">
  $('document').ready(function(){

   var currentTime = new Date();
    
    //Date range as a button
    $('#daterange').daterangepicker(
        {

          startDate: moment([currentTime.getFullYear(), currentTime.getMonth()]),
          endDate: moment(moment([currentTime.getFullYear(), currentTime.getMonth()])).endOf('month'),
         locale: {
            format: 'YYYY-MM-DD',
            separator: ' to ',
          },
              opens: 'right',
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          
        },
    );


    $('#daterange-btn').on('click' , function(e){

      var period = $('#daterange').val();

      $.ajax({
        url : 'api/get.chart.php',
        type : 'post',
        data : { period : period },
        success : function(data){
          var data = JSON.parse(data);
           console.log( data['data']);
      
           var chart = new CanvasJS.Chart("chartContainer",
            {
              title:{
                text: ""    
              },
              animationEnabled: true,
              axisY: {
                title: ""
              },
              legend: {
                verticalAlign: "bottom",
                horizontalAlign: "center"
              },
              theme: "theme2",
              data: [
              data['data']
              ]
            });
           chart.render();
        },
        error: function(msg){
          conole.log(msg);
        }
      });

    });

    $('#daterange-btn').click();










        //Date range as a button
    $('#daterange-table').daterangepicker(
        {

          startDate: moment(),
          endDate: moment(),
         locale: {
            format: 'YYYY-MM-DD',
            separator: ' to ',
          },
              opens: 'right',
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          
        },
    );




    $('#daterange-table-btn').on('click', function(e){
        $('tbody').empty();

        var period = $('#daterange-table').val();
        $.ajax({
          url : 'api/get.jornal.php',
          type : 'post',
          data : { period : period },
          success : function(data){
            var data = JSON.parse(data);
             console.log( data );

             data['data'].forEach( function(element, index) {
               var html = '<tr>';
                    html += '<td>';
                    html += index;
                    html += '</td>';

                    html += '<td>';
                    html += element.pc_start_time;
                    html += '</td>';

                    html += '<td>';
                    html += element.pc_end_time;
                    html += '</td>';


                    html += '<td>';
                    html += element.playstation_number;
                    html += '</td>';

                    html += '<td>';
                    html += element.leva;
                    html += '</td>';

                    html += '<td>';
                    html += element.totali_lek;
                    html += '</td>';


                   html += '</tr>';

                   $('tbody').append(html);

             });


             var html = '<tr>';
                    html += '<td>';
                   
                    html += '</td>';

                    html += '<td>';
                    
                    html += '</td>';

                    html += '<td>';
                  
                    html += '</td>';


                    html += '<td>';
                    
                    html += '</td>';

                    html += '<td>';
                   
                    html += '</td>';

                    html += '<td>';
                    html += data.total + ' LEK';
                    html += '</td>';


                   html += '</tr>';

                   $('tbody').append(html);



             
        
            
          },
          error: function(msg){
            conole.log(msg);
          }
        });



    });









    





  });
</script>

</body>
</html>
