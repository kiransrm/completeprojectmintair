<?php
require_once("inc/session.php");
require_once("inc/class.user.php");
$auth_user = new USER();

$time_interval = $_POST['time_interval'];
$moniter_id = $_POST['moniter'];

//echo $time_interval . $moniter_id;


if($time_interval=='interval')
{
		$stmt = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mon_num` = $moniter_id ");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);

		$co21 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '01:00' and `mon_num` = $moniter_id " );
		$co21->execute();
		$co21=$co21->fetchAll(PDO::FETCH_ASSOC);

		$co22 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '02:00' and `mon_num` = $moniter_id " );
		$co22->execute();
		$co22=$co22->fetchAll(PDO::FETCH_ASSOC);

		$co23 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '02:30' and `mon_num` = $moniter_id " );
		$co23->execute();
		$co23=$co23->fetchAll(PDO::FETCH_ASSOC);

		$co24 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '03:00' and `mon_num` = $moniter_id " );
		$co24->execute();
		$co24=$co24->fetchAll(PDO::FETCH_ASSOC);

		$co25 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '03:30' and `mon_num` = $moniter_id " );
		$co25->execute();
		$co25=$co25->fetchAll(PDO::FETCH_ASSOC);

		$co26 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '04:00' and `mon_num` = $moniter_id " );
		$co26->execute();
		$co26=$co26->fetchAll(PDO::FETCH_ASSOC);

		$co27 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '04:30' and `mon_num` = $moniter_id " );
		$co27->execute();
		$co27=$co27->fetchAll(PDO::FETCH_ASSOC);

		$count =  count($userRow)-1;


	//die('<canvas id="linegraph"></canvas>');
}
else if($time_interval=='hourly')
{
		$stmt = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mon_num` = $moniter_id ");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);


		$co21 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '01:00' and `mon_num` = $moniter_id " );
		$co21->execute();
		$co21=$co21->fetchAll(PDO::FETCH_ASSOC);

		$co22 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '02:00' and `mon_num` = $moniter_id " );
		$co22->execute();
		$co22=$co22->fetchAll(PDO::FETCH_ASSOC);

		$co23 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '02:30' and `mon_num` = $moniter_id " );
		$co23->execute();
		$co23=$co23->fetchAll(PDO::FETCH_ASSOC);

		$co24 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '03:00' and `mon_num` = $moniter_id " );
		$co24->execute();
		$co24=$co24->fetchAll(PDO::FETCH_ASSOC);

		$co25 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '03:30' and `mon_num` = $moniter_id " );
		$co25->execute();
		$co25=$co25->fetchAll(PDO::FETCH_ASSOC);

		$co26 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '04:00' and `mon_num` = $moniter_id " );
		$co26->execute();
		$co26=$co26->fetchAll(PDO::FETCH_ASSOC);

		$co27 = $auth_user->runQuery("SELECT * FROM `Int_Report` where `mtime` = '04:30' and `mon_num` = $moniter_id " );
		$co27->execute();
		$co27=$co27->fetchAll(PDO::FETCH_ASSOC);


		$count =  count($userRow)-1;
}
else if($time_interval=='daily')
{
		$stmt = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mon_num` = $moniter_id ");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);

		$co21 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '01:00' and `mon_num` = $moniter_id " );
		$co21->execute();
		$co21=$co21->fetchAll(PDO::FETCH_ASSOC);

		$co22 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '02:00' and `mon_num` = $moniter_id " );
		$co22->execute();
		$co22=$co22->fetchAll(PDO::FETCH_ASSOC);

		$co23 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '02:30' and `mon_num` = $moniter_id " );
		$co23->execute();
		$co23=$co23->fetchAll(PDO::FETCH_ASSOC);

		$co24 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '03:00' and `mon_num` = $moniter_id " );
		$co24->execute();
		$co24=$co24->fetchAll(PDO::FETCH_ASSOC);

		$co25 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '03:30' and `mon_num` = $moniter_id " );
		$co25->execute();
		$co25=$co25->fetchAll(PDO::FETCH_ASSOC);

		$co26 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '04:00' and `mon_num` = $moniter_id " );
		$co26->execute();
		$co26=$co26->fetchAll(PDO::FETCH_ASSOC);

		$co27 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '04:30' and `mon_num` = $moniter_id " );
		$co27->execute();
		$co27=$co27->fetchAll(PDO::FETCH_ASSOC);

		$count =  count($userRow)-1;
}
else if($time_interval=='weekly')
{
		$stmt = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mon_num` = $moniter_id ");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);

		$co21 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '01:00' and `mon_num` = $moniter_id " );
		$co21->execute();
		$co21=$co21->fetchAll(PDO::FETCH_ASSOC);

		$co22 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '02:00' and `mon_num` = $moniter_id " );
		$co22->execute();
		$co22=$co22->fetchAll(PDO::FETCH_ASSOC);

		$co23 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '02:30' and `mon_num` = $moniter_id " );
		$co23->execute();
		$co23=$co23->fetchAll(PDO::FETCH_ASSOC);

		$co24 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '03:00' and `mon_num` = $moniter_id " );
		$co24->execute();
		$co24=$co24->fetchAll(PDO::FETCH_ASSOC);

		$co25 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '03:30' and `mon_num` = $moniter_id " );
		$co25->execute();
		$co25=$co25->fetchAll(PDO::FETCH_ASSOC);

		$co26 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '04:00' and `mon_num` = $moniter_id " );
		$co26->execute();
		$co26=$co26->fetchAll(PDO::FETCH_ASSOC);

		$co27 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '04:30' and `mon_num` = $moniter_id " );
		$co27->execute();
		$co27=$co27->fetchAll(PDO::FETCH_ASSOC);

		$count =  count($userRow)-1;
}
else if($time_interval=='monthly')
{
		$stmt = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mon_num` = $moniter_id ");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);

		$co21 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '01:00' and `mon_num` = $moniter_id " );
		$co21->execute();
		$co21=$co21->fetchAll(PDO::FETCH_ASSOC);

		$co22 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '02:00' and `mon_num` = $moniter_id " );
		$co22->execute();
		$co22=$co22->fetchAll(PDO::FETCH_ASSOC);

		$co23 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '02:30' and `mon_num` = $moniter_id " );
		$co23->execute();
		$co23=$co23->fetchAll(PDO::FETCH_ASSOC);

		$co24 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '03:00' and `mon_num` = $moniter_id " );
		$co24->execute();
		$co24=$co24->fetchAll(PDO::FETCH_ASSOC);

		$co25 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '03:30' and `mon_num` = $moniter_id " );
		$co25->execute();
		$co25=$co25->fetchAll(PDO::FETCH_ASSOC);

		$co26 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '04:00' and `mon_num` = $moniter_id " );
		$co26->execute();
		$co26=$co26->fetchAll(PDO::FETCH_ASSOC);

		$co27 = $auth_user->runQuery("SELECT * FROM `Hourly_report` where `mtime` = '04:30' and `mon_num` = $moniter_id " );
		$co27->execute();
		$co27=$co27->fetchAll(PDO::FETCH_ASSOC);

		$count =  count($userRow)-1;
}

$stmt1 = $auth_user->runQuery("SELECT * FROM `Device` where `Device_id` = $moniter_id ");
$stmt1->execute();
$userRow1=$stmt1->fetchAll(PDO::FETCH_ASSOC);


echo "<div class='col-md-4 col-sm-4 col-xs-12'>";
echo "                        <div class='x_panel'>";
echo "                              <div class='x_title'>";
echo "                                  <h3 class='device_name'>".$userRow1[0]['Device_name']."</h3>";
echo "                                  <div class='clearfix'></div>";
echo "                              </div>";
echo "                              <div class='x_content'>";
echo "                                 <div class='table-responsive'>";
echo "                                                <table class='table'>";
echo "                                                  <tr>";
echo "                                                      <td width='50%'>Humidity</td>";
echo "                                                      <td width='25%'>".$userRow[$count]['humidity']."</td>";
echo "                                                     <td width='25%'>";
echo "                                                       <span class='sparkline_li' style='height: 160px;'>";
echo "                                                         <canvas width='200' height='60' style='display: inline-block; vertical-align: top; width: 94px; height: 30px;'></canvas>";
echo "                                                      </span>";
echo "                                                     </td>";
echo "                                                  </tr>";
echo "                                                   <tr>";
echo "                                                      <td>Temperature</td>";
echo "                                                     <td>".$userRow[$count]['temp']."</td>";
echo "                                                     <td>";
echo "                                                       <span class='sparkline_li' style='height: 160px;'>";
echo "                                                         <canvas width='200' height='60' style='display: inline-block; vertical-align: top; width: 94px; height: 30px;'></canvas>";
echo "                                                     </span>";
echo "                                                     </td>";
echo "                                                  </tr>";
echo "                                                   <tr>";
echo "                                                     <td>VOC</td>";
echo "                                                     <td>".$userRow[$count]['tvoc']."</td>";
echo "                                                    <td>";
echo "                                                      <span class='sparkline_li' style='height: 160px;'>";
echo "                                                          <canvas width='200' height='60' style='display: inline-block; vertical-align: top; width: 94px; height: 30px;'></canvas>";
echo "                                                     </span>";
echo "                                                    </td>";
echo "                                                 </tr>";
echo "                                                 <tr>";
echo "                                                    <td> PM10</td>";
echo "                                                   <td>".$userRow[$count]['pm10']."</td>";
echo "                                                   <td>";
echo "                                                     <span class='sparkline_li' style='height: 160px;'>";
echo "                                                        <canvas width='200' height='60' style='display: inline-block; vertical-align: top; width: 94px; height: 30px;'></canvas>";
echo "                                                    </span>";
echo "                                                   </td>";
echo "                                                </tr>";
echo "                                                 <tr>";
echo "                                                    <td>PM25</td>";
echo "                                                   <td>".$userRow[$count]['pm25']."</td>";
echo "                                                   <td>";
echo "                                                    <span class='sparkline_li' style='height: 160px;'>";
echo "                                                        <canvas width='200' height='60' style='display: inline-block; vertical-align: top; width: 94px; height: 30px;'></canvas>";
echo "                                                    </span>";
echo "                                                   </td>";
echo "                                                </tr>";
echo "                                                 <tr>";
echo "                                                     <td>AQI</td>";
echo "                                                     <td>".$userRow[$count]['aqi']."</td>";
echo "                                                   <td>";
echo "                                                     <span class='sparkline_li' style='height: 160px;'>";
echo "                                                        <canvas width='200' height='60' style='display: inline-block; vertical-align: top; width: 94px; height: 30px;'></canvas>";
echo "                                                   </span>";
echo "                                                  </td>";
echo "                                                </tr>";
echo "                                                <tr>";
echo "                                                   <td> AQV</td>";
echo "                                                  <td>".$userRow[$count]['aqv']."</td>";
echo "                                                  <td>";
echo "                                                    <span class='sparkline_li' style='height: 160px;'>";
echo "                                                       <canvas width='200' height='60' style='display: inline-block; vertical-align: top; width: 94px; height: 30px;'></canvas>";
echo "                                                   </span>";
echo "                                                  </td>";
echo "                                               </tr>";
echo "                                             </table>";
echo "                               </div>";
echo "                           </div>";
echo "                     </div>";
echo "               </div>";

echo "               <div class='col-md-8 col-sm-8 col-xs-12'>";
echo "                     <div class='x_panel'>";
echo "                           <div class='x_title'>";
echo "                             <h3 class='device_name'>".$userRow1[0]['Device_name']."</h3>";
echo "                             <div class='clearfix'></div>";
echo "                           </div>";
echo "                          <div class='x_content' id='chart'>";
echo "                            <canvas id='linegraph'></canvas>";
echo "                          </div>";
echo "                    </div>";
echo "              </div>";

echo "<input type='hidden' id='co2-1' value='".$co21[0]['co2']."'>";
echo "<input type='hidden' id='co2-2' value='".$co22[0]['co2']."'>";
echo "<input type='hidden' id='co2-3' value='".$co23[0]['co2']."'>";
echo "<input type='hidden' id='co2-4' value='".$co24[0]['co2']."'>";
echo "<input type='hidden' id='co2-5' value='".$co25[0]['co2']."'>";
echo "<input type='hidden' id='co2-6' value='".$co26[0]['co2']."'>";
echo "<input type='hidden' id='co2-7' value='".$co27[0]['co2']."'>";

echo "<input type='hidden' id='pm-1' value='".$co21[0]['pm25']."'>";
echo "<input type='hidden' id='pm-2' value='".$co22[0]['pm25']."'>";
echo "<input type='hidden' id='pm-3' value='".$co23[0]['pm25']."'>";
echo "<input type='hidden' id='pm-4' value='".$co24[0]['pm25']."'>";
echo "<input type='hidden' id='pm-5' value='".$co25[0]['pm25']."'>";
echo "<input type='hidden' id='pm-6' value='".$co26[0]['pm25']."'>";
echo "<input type='hidden' id='pm-7' value='".$co27[0]['pm25']."'>";





die();


?>