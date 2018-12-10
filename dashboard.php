<?php
include('template_parts/header.php');
?>
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
             $rescount=count($userRow);
            
             $result = json_decode(exec('python /home/cjhp5a9hjf11/public_html/mintair/aqping1.py'));
             $temp=$result->temperature;
             $humidity=$result->Humidity;
             $Co2=$result->Co2;
             $tvoc=$result->TvoC;
             $pm2_5=$result->pm2_5;
             $pm10=$result->pm10;
             $aqi=$result->Aindex;
             $aqv=$result->Avalue;
             
          ?>
          	<div class="row">
         	<?php for ($x = 1; $x <= $rescount; $x++){?>
	          <div class="col-md-6 col-sm-6 col-xs-12">
	          	 
		            <p class="devices">
		              <select name="device" id="device" class="form-control" onchange="gaugechange(<?php echo $x;?>);">
		              	<?php foreach ($userRow as $row) { $id=$row['Device_id'];?>
		              		<option value="<?php echo $row['Device_id'];?>" <?php if ($id == $x ) echo 'selected' ; ?>><?php echo $row['Device_name'];?></option>
		              	<?php } ?>
		              </select>	           </p>
	            
	            <p><div id="chartdiv<?php echo $x;?>" class="gaugescharts"></div> <script type="text/javascript">gaugechart('<?php echo $x;?>','<?php echo $temp;?>','<?php echo $humidity;?>','<?php echo $Co2;?>','<?php echo $tvoc;?>','<?php echo $pm2_5;?>','<?php echo $pm10 ;?>','<?php echo $aqi ;?>','<?php echo $aqv ;?>');</script>
	            </p>
	           </div>
            <?php }?>
          	</div>
     
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php 
include('template_parts/footer_scripts.php'); 
include('template_parts/footer.php'); 
?>