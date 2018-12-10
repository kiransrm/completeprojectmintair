<?php
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
  <div class="col-md-12 col-sm-12 col-xs-12"> 
   <div class="col-md-3 col-sm-12 col-xs-12"><div id="chartdiv1" class="gaugescharts"></div> <script type="text/javascript">gaugechart('1','<?php echo $temp;?>','Temperature','F');</script>
  </div>
   <div class="col-md-3 col-sm-12 col-xs-12"><div id="chartdiv2" class="gaugescharts"></div> <script type="text/javascript">gaugechart('2','<?php echo $humidity;?>','Humidity','%');</script>
  </div>
   <div class="col-md-3 col-sm-12 col-xs-12"><div id="chartdiv3" class="gaugescharts"></div> <script type="text/javascript">gaugechart('3','<?php echo $Co2;?>','Co2','ppm');</script>
  </div>
   <div class="col-md-3 col-sm-12 col-xs-12"><div id="chartdiv4" class="gaugescharts"></div> <script type="text/javascript">gaugechart('4','<?php echo $tvoc;?>','Tvoc','mg/m3');</script>
  </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12"> 
   <div class="col-md-3 col-sm-12 col-xs-12"><div id="chartdiv5" class="gaugescharts"></div> <script type="text/javascript">gaugechart('5','<?php echo $pm2_5;?>','pm2_5','ug/m3');</script>
  </div>
   <div class="col-md-3 col-sm-12 col-xs-12"><div id="chartdiv6" class="gaugescharts"></div> <script type="text/javascript">gaugechart('6','<?php echo $pm10 ;?>','pm10','ug/m3');</script>
  </div>
   <div class="col-md-3 col-sm-12 col-xs-12"><div id="chartdiv7" class="gaugescharts"></div> <script type="text/javascript">gaugechart('7','<?php echo $aqi ;?>','Polluiton Index','');</script>
  </div>
   <div class="col-md-3 col-sm-12 col-xs-12"><div id="chartdiv8" class="gaugescharts"></div> <script type="text/javascript">gaugechart('8','<?php echo $aqv ;?>','Air Quality Index','');</script>
  </div>
</div>