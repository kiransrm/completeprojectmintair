<?php

  require_once("inc/session.php");

  require_once("inc/class.user.php");
  $auth_user = new USER();

 $user_id = $_SESSION['user_session'];

  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));

  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <style>
    .gaugescharts {
    width: 100%;
    height: 200px;
    margin: auto;
  }
  .gaugescharts a {
    display: none!important;
}
  select#device {
    background: #c00000;
    border: 1px solid none!important;
    border: 1;
    border: 1px border none!important;
    color: white;
    text-align: center;
  }
  .devices {
    /* text-align: center; */
    width: 56%;
    display: block;
    text-align: center;
    margin: 0 auto;
}
    </style>
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
     <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    
    <!-- Custom Theme Scripts -->
 
  <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
  <script src="https://www.amcharts.com/lib/3/gauge.js"></script>
  <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
  <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
  <script>
  	function gaugechange(id)
  	{
  		var value=$("#device").val();
      $.ajax({
            type: "POST",
            url: "getresult.php",
            data: {id:value},
            dataType: "JSON",
            success: function(data) {
            	console.log("kkk" +data.temp);
            	var temp=data.temp;
              	var humidity=data.humidity;
              	var co2=data.co2;
              	var tvoc=data.tvoc;
              	var pm2_5=data.pm2_5;
              	var pm10=data.pm10;
              	var aqi=data.aqi; 
              	var aqv=data.aqv;
              	gaugechart(id,temp,humidity,co2,tvoc,pm2_5,pm10,aqi,aqv)
            },
            error: function(err) {
             console.log(err);
            }
        });
  	}
  	$(document).ready(function(){
  		//window.setTimeout(function(){location.reload()},10000)

  		setInterval(function(){
		    gaugechange('1'); // this will run after every 5 seconds
		    gaugechange('2'); 
		    gaugechange('3'); 
		    gaugechange('4'); 
		}, 10000);

  	});
  	

  </script>
  <script>
  function gaugechart(id,temp,humidity,co2,tvoc,pm2_5,pm10,aqi,aqv){
    //console.log(sourceData);
    //var datavalues=jQuery.parseJSON(sourceData);
    //console.log(datavalues);
    //var airquality = [];
    //var airqualitylabels = [];
    /*$.each(datavalues, function( key, value ) {
      console.log("i am here" + value);
    });*/
      var gaugeChart = AmCharts.makeChart("chartdiv"+id, {
        "type": "gauge",
        "theme": "light",
        "axes": [{
          "axisAlpha": 0,
          "tickAlpha": 0,
          "labelsEnabled": false,
          "startValue": 0,
          "endValue": 100,
          "startAngle": 0,
          "endAngle": 270,
          "bands": [{
            "color": "#94AB8D",
            "startValue": 0,
            "endValue": 200,
            "radius": "100%",
            "innerRadius": "95%"
          }, {
            "color": "#1E5027",
            "startValue": 0,
            "endValue": temp,
            "radius": "100%",
            "innerRadius": "95%",
            //"balloonText": "90%"
          }, {
            "color": "#b3c9ff",
            "startValue": 0,
            "endValue": 100,
            "radius": "90%",
            "innerRadius": "94%"
          }, {
            "color": "#3371FF",
            "startValue": 0,
            "endValue": humidity,
            "radius": "90%",
            "innerRadius": "94%",
            //"balloonText": "35%"
          }, {
            "color": "#ffd9b3",
            "startValue": 0,
            "endValue": 100,
            "radius": "85%",
            "innerRadius": "90%"
          }, {
            "color": "#ff9933",
            "startValue": 0,
            "endValue": co2,
            "radius": "85%",
            "innerRadius": "90%",
            //"balloonText": "92%"
          }, {
            "color": "#ff99cc",
            "startValue": 0,
            "endValue": 100,
            "radius": "80%",
            "innerRadius": "82%"
          }, {
            "color": "#ff3333",
            "startValue": 0,
            "endValue": tvoc,
            "radius": "80%",
            "innerRadius": "82%",
            //"balloonText": "68%"
          }, {
            "color": "#b3ff99",
            "startValue": 0,
            "endValue": 100,
            "radius": "75%",
            "innerRadius": "78%"
          }, {
            "color": "#66ff33",
            "startValue": 0,
            "endValue": pm2_5,
            "radius": "75%",
            "innerRadius": "78%",
            //"balloonText": "65%"
          }, {
            "color": "#eee",
            "startValue": 0,
            "endValue": 100,
            "radius": "70%",
            "innerRadius": "72%"
          }, {
            "color": "#fdd400",
            "startValue": 0,
            "endValue": pm10,
            "radius": "70%",
            "innerRadius": "72%",
            //"balloonText": "63%"
          }, {
            "color": "#b3ffff",
            "startValue": 0,
            "endValue": 100,
            "radius": "70%",
            "innerRadius": "25%"
          }, {
            "color": "#67b7dc",
            "startValue": 0,
            "endValue": aqi,
            "radius": "70%",
            "innerRadius": "25%",
            //"balloonText": "67%"
          }]
      }],
      "allLabels": [{
        "text": "Temperature:"+temp+'F',
        "x": "48%",
        "y": "5%",
        "size": 12,
        "bold": false,
        "color": "#000",
        "align": "right"
      }, {
        "text": "Humidity"+humidity+'%',
        "x": "48%",
        "y": "11%",
        "size": 12,
        "bold": false,
        "color": "#000",
        "align": "right"
      }, {
        "text": "CO2:"+co2+'ppm',
        "x": "48%",
        "y": "18%",
        "size": 12,
        "bold": false,
        "color": "#000",
        "align": "right"
      }, {
        "text": "Total VCOs:"+tvoc+'mg/m3',
        "x": "48%",
        "y": "25%",
        "size": 12,
        "bold": false,
        "color": "#000",
        "align": "right"
      }, {
        "text": "PM 2.5:"+pm2_5+'ug/m3',
        "x": "48%",
        "y": "33%",
        "size": 12,
        "bold": false,
        "color": "#000",
        "align": "right"
      }, {
        "text": "PM 10:"+pm10+'ug/m3',
        "x": "48%",
        "y": "40%",
        "size": 12,
        "bold": false,
        "color": "#000",
        "align": "right"
      },{
        "text": "AQV",
        "align": "center",
        "bold": true,
        "size": 12,
        "y": 80
      },{
        "text": aqv,
        "align": "center",
        "bold": true,
        "size": 12,
        "y": 100
      }],
      "export": {
        "enabled": true
      }
    });
      
      
  }

  </script>
  
  </head>

  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <?php include('template_parts/sidebar.php');?>

        <!-- top navigation -->
        <?php include('template_parts/top_nav.php');?>
        <!-- /top navigation -->
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title">
                  <?php
            //$stmt = $auth_user->runQuery("SELECT * from Device ");
             $stmt = $auth_user->runQuery("SELECT * FROM `Device`");
             $stmt->execute();
             $userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);


             ?>
          	<div class="row">
         	    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Device List </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Monitor Number</th>
                          <th>Monitor Name</th>
                          <th>Date Installed</th>
                          <th>Save</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                       <?php foreach ($userRow as $row) { ?>
                        <tr>
                          <th scope="row"><?php echo $row['Device_id'];?></th>
                          <td>
                            <input type="text" value="<?php echo $row['Device_name'];?>" id="device_name_<?php echo $row['Device_id'];?>" name="device_name_<?php echo $row['Device_id'];?>" onkeyup="addition(<?php echo $row['Device_id']?>)" > <input type="hidden" id="device_<?php echo $row['Device_id'];?>">
                            </td>
                          <td><?php echo $row['Device_idate'];?></td>
                          <td><button type="submit" class="btn btn-primary" name="save" onclick="update(<?php echo $row['Device_id']?>)">Save</button></td>
                         
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>

                    
                    <script>
                      function update(id)
                      {
                       // var device_name = $("#device_"+id).val();
                      //  console.log("i am called");

                         $.ajax({
                                type: "POST",
                                url: "updatedevice.php",
                                data: {id:id,
                                      device_name:$("#device_"+id).val()},
                                  success: function(data) {
                                    console.log("suc" +data);
                                    if(data=='success')
                                    {
                                      location.reload();
                                    }
                                  },
                                  error: function(err) {
                                   console.log(err);
                                  }
                            });
                      }

                      function addition(id)
                      {
                      //  console.log("hello");
                      //  console.log("device name : device_name_"+id);
                        var device_name = $("#device_name_"+id).val();
                       // console.log("device name" + device_name);
                        $("#device_"+id).val(device_name);
                      }
                  </script>
                    
                  </div>
                </div>
              </div>
                <div class="form-group">
                  <div class="col-md-9 col-md-offset-3">
                   <!--  <button type="submit" class="btn btn-primary" name="save">Save</button> -->
                    <button type="submit" class="btn btn-success" name="cancel" onclick="location.reload();">Cancel</button>
                   
                  </div>
                </div>
          	</div>
     
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

 <!-- jQuery -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>

        <?php 
        include('template_parts/footer_scripts.php'); 
        include('template_parts/footer.php'); 
        ?>