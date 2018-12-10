<?php
include('template_parts/header.php');
?>
 <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- sidebar -->
        <?php include('template_parts/sidebar.php');?>
        <!-- /sidebar -->

        <!-- top navigation -->
         <?php include('template_parts/top_nav.php');?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <?php
                         $moniter = $auth_user->runQuery("SELECT * FROM `Device`");
                         $moniter->execute();
                         $moniterRow=$moniter->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                <h4>Monitor : <select name="device" id="choose_device">
                              <?php
                                foreach($moniterRow as $row)
                                {
                                  ?>php
                                   <option value="<?php echo $row['Device_id']; ?>"> 
                                      <?php echo $row['Device_name']; ?>
                                   </option>
                                <?php
                                }
                              ?>
                            </select></h4>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="container-fluid">
            <div class="row" id="ajax_value">
                  
            </div>

           

               <div class="container row text-center" style="background: #fff;">
                 
                       <div class="table-responsive">
                          <table class="table">
                            <tr>
                            <td> <input type="radio" name="time_interval" value="interval" class="interval" checked="checked"> <strong> Interval </strong></td>
                            <td> <input type="radio" name="time_interval" value="hourly" class="interval"> <strong> Hourly  </strong></td>
                            <td> <input type="radio" name="time_interval" value="daily" class="interval"> <strong> Daily  </strong></td>
                            <td> <input type="radio" name="time_interval" value="weekly" class="interval"> <strong> Weekly  </strong></td>
                            <td> <input type="radio" name="time_interval" value="monthly" class="interval"> <strong> Monthly </strong></td>
                          </tr>
                          </table>
                        </div>
        
              </div>
            
          </div>


            </div>

            <div class="clearfix"></div>



            <div class="container-fluid " style="margin-top: 50px;">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                   <div class="x_title">
                    <h2>Moniter Data <small>Export</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <div class="row text-center">
                            <button class="btn"> <strong> Copy </strong> </button>
                            <button class="btn"> <strong>  CSV </strong> </button>
                            <button class="btn"> <strong> Excel </strong> </button>
                            <button class="btn"> <strong> Print </strong> </button>
                        </div>

                         <div class="clearfix"></div>

                         <?php
                             $stmt = $auth_user->runQuery("SELECT * FROM `Int_Report`");
                             $stmt->execute();
                             $userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
                         ?>

                         <div class="row">
                          <div class="table-responsive">
                      <table id="datatable" class="table table-striped table-bordered table-responsive">
                        <thead>
                          <tr class="headings">
                                <th class="column-title">Monitor Name </th>
                                <th class="column-title">Time</th>
                                <th class="column-title">Date </th>
                                <th class="column-title">Temperature </th>
                                <th class="column-title">Humidity </th>
                                <th class="column-title">co2 </th>
                                <th class="column-title">TVOC </th>
                                <th class="column-title">PM25 </th>
                                <th class="column-title">PM10 </th>
                                <th class="column-title">Air Quality Index </th>
                                <th class="column-title">Air Quality Value </th>
                          </tr>
                        </thead>
                        <?php
                         if($userRow){
                            foreach ($userRow as $row) 
                            {
                              ?>
                              <tr>

                                <td> <?php echo $row['mon_num']; ?> </td>
                                <td> <?php echo $row['mtime']; ?> </td>
                                <td> <?php echo $row['mdate']; ?> </td>
                                <td> <?php echo $row['temp']; ?> </td>
                                <td> <?php echo $row['humidity']; ?> </td>
                                <td> <?php echo $row['co2']; ?> </td>
                                <td> <?php echo $row['tvoc']; ?> </td>
                                <td> <?php echo $row['pm25']; ?> </td>
                                <td> <?php echo $row['pm10']; ?> </td>
                                <td> <?php echo $row['aqi']; ?> </td>
                                <td> <?php echo $row['aqv']; ?> </td>

                              </tr>
                            <?php
                          }
                        }
                        ?>
                    
                        <tbody>


                          
                        </tbody>
                      </table>
               
                    </div>
                         </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="clearfix"></div>
            
          </div>
        </div>
        <!-- page content -->

        <!-- footer content -->
       <?php 
          include('template_parts/footer_scripts.php'); 
        ?>
        <!-- footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <!-- datatable -->
     <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

     <!-- jQuery Sparklines -->
    <script src="vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
     <script>

      function by_default_graph_and_table_val()
      {
        var val = $('input[name=time_interval]:checked').val();
            var moniter_room = $('#choose_device').val();
            $.ajax({
                url:'ajax_chart.php',
                type:'post',
                data : { time_interval : val ,
                          moniter : moniter_room 
                        },

                success: function(data)
                {
                  //console.log(data);
                 
                 $("#ajax_value").html(data);
                 /* $("#chart").html(data);*/
                  lingraph();
                }
            });
      }

      by_default_graph_and_table_val();

      function lingraph()
       {
           if ($("#linegraph").length) 
           {
                var f = document.getElementById("linegraph");

                var co1 = $("#co2-1").val();
                var co2 = $("#co2-2").val();                
                var co3 = $("#co2-3").val();
                var co4 = $("#co2-4").val();
                var co5 = $("#co2-5").val();
                var co6 = $("#co2-6").val();
                var co7 = $("#co2-7").val();


                var pm1 = $("#pm-1").val();
                var pm2 = $("#pm-2").val();
                var pm3 = $("#pm-3").val();
                var pm4 = $("#pm-4").val();
                var pm5 = $("#pm-5").val();
                var pm6 = $("#pm-6").val();
                var pm7 = $("#pm-7").val();


                new Chart(f, {
                    type: "line",
                    data: {
                        labels: ["1", "2", "2:30", "3", "3:30", "4", "4:30"],
                        datasets: [{
                            label: "co2",
                            backgroundColor: "rgba(38, 185, 154, 0.31)",
                            borderColor: "rgba(38, 185, 154, 0.7)",
                            pointBorderColor: "rgba(38, 185, 154, 0.7)",
                            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointBorderWidth: 1,
                            data: [co1 ,co2, co3, co4, co5, co6, co7]
                        }, {
                            label: "pm 2.5",
                            backgroundColor: "rgba(3, 88, 106, 0.3)",
                            borderColor: "rgba(3, 88, 106, 0.70)",
                            pointBorderColor: "rgba(3, 88, 106, 0.70)",
                            pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(151,187,205,1)",
                            pointBorderWidth: 1,
                            data: [pm1 ,pm2, pm3, pm4, pm5, pm6, pm7]
                        }]
                    }
                })
            }
      }

      lingraph();



    $(".sparkline_li").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5], {
        type: "line",
        lineColor: "#26B99A",
        fillColor: "#ffffff",
        width: 85,
        spotColor: "#34495E",
        minSpotColor: "#34495E"
    });



        $(".interval").on('click',function()
        {
            by_default_graph_and_table_val();
        });


        $("#choose_device").on('change',function()
        {
            var val = $('input[name=time_interval]:checked').val();
            var moniter_room = $('#choose_device').val();
            $.ajax({
                url:'ajax_chart.php',
                type:'post',
                data : { time_interval : val ,
                          moniter : moniter_room 
                        },

                success: function(data)
                {
                  //console.log(data);
                 
                 $("#ajax_value").html(data);
                 /* $("#chart").html(data);*/
                  lingraph();
                }
            });
        });


     </script>
  
    
<?php    
include('template_parts/footer.php'); 
?>