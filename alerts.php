<?php
include('template_parts/header.php');
?>

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
              
              <div class="x_content">
                <div class="x_title">
                  <h3>Active Alerts</h3>
                  <div class="clearfix"></div>
              </div>
                <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                             Dismiss
                            </th>

                            <th class="column-title">Monitor </th>
                            <th class="column-title">Alert_type</th>
                            <th class="column-title">Value </th>
                            <th class="column-title">Date </th>
                            <th class="column-title">Time </th>
                            <th class="column-title no-link last"><span class="nobr">Duration</span>
                            </th>
                            
                          </tr>
                        </thead>
                            <?php

                      //$stmt = $auth_user->runQuery("SELECT * from Device ");
                       $stmt = $auth_user->runQuery("SELECT * FROM `Alerts` where Dismiss='0'");
                       $stmt->execute();
                       $userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
                       //print_r($userRow);
                       ?>
                        <tbody>
                            <?php 
                            $i=0;
                            if($userRow){
                            foreach ($userRow as $row) { $i++;
                              if ($i % 2 == 0)
                              {
                                $class="even pointer";
                              }
                              else
                              {
                                $class="odd pointer";
                              }
                              ?>
                              <tr class="<?php echo $class;?>">
                                <td class="a-center ">
                                 <!--  <input type="checkbox" class="flat" name="dismiss" value="<?php echo $row['Dismiss'];?>" onclick="return alertchange('<?php echo $row["id"];?>');"> -->

                                 <!--  dONE BY AARTI -->
                                  <input type="checkbox" class="flat" name="dismiss" value="<?php echo $row['Dismiss'];?>" onclick="changealert('<?php echo $row["id"];?>','1');">
                                </td>
                                <td class=" "><?php echo $row['Device_name'];?> </td>
                                <td class=" "><?php echo $row['Alert_type'];?></td>
                                <td class=" "><?php echo $row['Value'];?></td>
                                <td class=" "><?php echo $row['Date'];?></td>
                                <td class="a-right a-right "><?php echo $row['Time'];?></td>
                                <td class=" last"><?php echo $row['Duration'];?>
                                </td>
                              </tr>
                            <?php } 
                            }else{?>
                                <tr>
                                  <td colspan="7">NO Active Alerts</td>
                                </tr>
                            <?php } ?>
                         
                        </tbody>
                      </table>
                      <!-- <div class="cd-popup" role="alert">
                      <div class="cd-popup-container">
                        <p> Do You want to Deactivate Alert? </p>
                        <ul class="cd-buttons">
                          <li><a href="javascript:void(0);" onclick="return changealert(<?php echo $row['id'];?>,'1');">Yes</a></li>
                          <li><a href="javascript:void(0);" class="closepopup">No</a></li>
                        </ul>
                        <a href="#0" class="cd-popup-close img-replace">Close</a>
                      </div> 
                    </div>  -->
                    <div id="myModals" class="modal fade">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <!-- dialog body -->
					      <div class="modal-body">
					         <p> Do You want to Deactivate Alert? </p>
					      </div>
					      <!-- dialog buttons -->
					      <div class="modal-footer">
					      <button type="button" class="btn btn-primary" onclick="return changealert(<?php echo $row['id'];?>,'1');">yes</button>
					      <button type="button" class="btn btn-primary closepopup">No</button>
					      </div>
					    </div>
					  </div>
					</div>
                    </div>
              </div>
                
                  <div class="x_title">
                    <h3>In Active Alerts</h3>
                    <div class="clearfix"></div>
                  </div>
                 <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                             Dismiss
                            </th>

                            <th class="column-title">Monitor </th>
                            <th class="column-title">Alert_type</th>
                            <th class="column-title">Value </th>
                            <th class="column-title">Date </th>
                            <th class="column-title">Time </th>
                            <th class="column-title no-link last"><span class="nobr">Duration</span>
                            </th>
                            
                          </tr>
                        </thead>
                            <?php
                      //$stmt = $auth_user->runQuery("SELECT * from Device ");
                       $stmt = $auth_user->runQuery("SELECT * FROM `Alerts` where Dismiss='1'");
                       $stmt->execute();
                       $userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);

                       ?>
                        <tbody>
                            <?php 
                            $i=0;
                            if($userRow){
                            foreach ($userRow as $row) { $i++;
                              if ($i % 2 == 0)
                              {
                                $class="even pointer";
                              }
                              else
                              {
                                $class="odd pointer";
                              }
                              ?>
                              <tr class="<?php echo $class;?>">
                                <td class="a-center ">
                                 <!--  <input type="checkbox" class="flat" name="dismiss" value="<?php echo $row['Dismiss'];?>" onclick="return inactivealert('<?php echo $row["id"];?>');"> -->

                                 <!-- DONE BY AARTI  -->
                                  <input type="checkbox" class="flat" name="dismiss" value="<?php echo $row['Dismiss'];?>" onclick="changealert('<?php echo $row["id"];?>','0');">
                                </td>
                                <td class=" "><?php echo $row['Device_name'];?> </td>
                                <td class=" "><?php echo $row['Alert_type'];?></td>
                                <td class=" "><?php echo $row['Value'];?></td>
                                <td class=" "><?php echo $row['Date'];?></td>
                                <td class="a-right a-right "><?php echo $row['Time'];?></td>
                                <td class=" last"><?php echo $row['Duration'];?>
                                </td>
                              </tr>
                            <?php } 
                            }else{?>
                                <tr>
                                  <td colspan="7">NO InActive Alerts</td>
                                </tr>
                            <?php } ?>
                         
                        </tbody>
                      </table>
                      <!-- div class="cd-popup-inactive" role="alert">
                      <div class="cd-popup-container">
                        <p> Do You want to Activate Alert? </p>
                        <ul class="cd-buttons">
                          <li><a href="javascript:void(0);" onclick="return changealert(<?php echo $row['id'];?>,'0');">Yes</a></li>
                          <li><a href="javascript:void(0);" class="closepopup1">No</a></li>
                        </ul>
                        <a href="#0" class="cd-popup-close img-replace">Close</a>
                      </div> 
                    </div>  -->
                    </div>
              <!-- set up the modal to start hidden and fade in and out -->
					<div id="myModal" class="modal fade">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <!-- dialog body -->
					      <div class="modal-body">
					         <p> Do You want to Activate Alert? </p>
					      </div>
					      <!-- dialog buttons -->
					      <div class="modal-footer">
					      <button type="button" class="btn btn-primary" onclick="return changealert(<?php echo $row['id'];?>,'0');">yes</button>
					      <button type="button" class="btn btn-primary closepopup1">No</button><!-- closepopup1"> -->
					      </div>
					    </div>
					  </div>
					</div>
				</div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
<?php 
  include('template_parts/footer_scripts.php'); 
?>
    <script type="text/javascript">
      function alertchange(id)
      {
         //alert(id);
      	$("#myModals").modal({                  
		      "backdrop"  : "static",
		      "keyboard"  : true,
		      "show"      : true                     
	    });
      }
      function inactivealert(id)
      {
         //alert(id);
          $("#myModal").modal({                  
		      "backdrop"  : "static",
		      "keyboard"  : true,
		      "show"      : true                     
	    });
      }
      function changealert(id,dismiss)
      {
        if(dismiss == "1")
        {
          var con = confirm("Do you really want to Deacticate this Alert ??");
        }
        else
        {
          var con = confirm("Do you really want to Acticate this Alert ??");
        }
        
        if(con==true)
        {
           $.ajax({
            type: "POST",
            url: "updateresult.php",
            data: {id:id,dismiss:dismiss},
            success: function(data) {
              console.log("suc" +data);
              if(data=='success')
              {
                $('.cd-popup').removeClass('is-visible');
                location.reload();
              }
            },
            error: function(err) {
             console.log(err);
            }
        });
        }
        else
        {
          location.reload();
        }
       
      }
       $('.closepopup').on('click', function(event){
        /*$("#myModals").hide();*/
        $("#myModals").remove();
         $(".modal-backdrop.fade").removeClass('in');
         location.reload(); //done by aarti
      });
       $(".closepopup1").on('click', function(event){
         $("#myModal").remove();
         $(".modal-backdrop.fade").removeClass('in');
         location.reload(); //done by aarti
      });
      //close popup
      $('.cd-popup').on('click', function(event){
        if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
          event.preventDefault();
          $(this).removeClass('is-visible');
        }
      });
    //close popup when clicking the esc keyboard button
    $(document).keyup(function(event){
        if(event.which=='27'){
          $('.cd-popup').removeClass('is-visible');
        }
      });
    </script>
<?php    
include('template_parts/footer.php'); 
?>