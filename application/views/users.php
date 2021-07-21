		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div class="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Users <?php echo $_SERVER['SERVER_NAME'] ?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
		  			<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Users'); ?>" method="post">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="username" name="username" required="required" class="form-control col-md-7 col-xs-12" value="<?php if(isset($user['username'])) echo $user['username'];?>" <?php if(isset($user['username'])) echo 'readonly';?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Privilege Access <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="id_privilege" class="form-control">
                          	<option value="6"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 6)  echo 'selected';?>>Operasi Reguler</option>
                            <option value="22" <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 22) echo 'selected';?>>Operasi Eagle</option>
                          	<option value="7"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 7)  echo 'selected';?>>Checker</option>
                          	<option value="800"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 800)  echo 'selected';?>>ITMS</option>
                          	<option value="9"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 9)  echo 'selected';?>>Shelter Team</option>
                          	<option value="10" <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 10) echo 'selected';?>>Contact Center</option>
                          	<option value="11" <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 11) echo 'selected';?>>Workshop</option>
                          	<option value="12" <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 12) echo 'selected';?>>Operation Only</option>
                          	<option value="13" <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 13) echo 'selected';?>>Airport</option>
                          	<option value="14" <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 14) echo 'selected';?>>Warroom</option>
                          	<option value="15" <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 15) echo 'selected';?>>TnD</option>    
                            <option value="500"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 500)  echo 'selected';?>>SOP</option>
                            <option value="501"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 501)  echo 'selected';?>>Akunting</option>                             	
                          	<option value="5"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 5)  echo 'selected';?>>Marketing</option>
						              	<option value="16" <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 16) echo 'selected';?>>Finance</option>
                          	<option value="4"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 4)  echo 'selected';?>>AM & Kapool</option>
                          	<option value="3"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 3)  echo 'selected';?>>GM/SM</option>
                          	<option value="2"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 2)  echo 'selected';?>>Board Member</option>
                          	<option value="1"  <?php if(isset($user['id_privilege']) && $user['id_privilege'] == 1)  echo 'selected';?>>Administrator</option>
                            
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Area <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="area" class="form-control">
                          	<option value="0" <?php if(isset($user['area']) && $user['area'] == 0) echo 'selected';?>>All</option>
                          	<option value="1" <?php if(isset($user['area']) && $user['area'] == 1) echo 'selected';?>>Reguler 1</option>
                          	<option value="2" <?php if(isset($user['area']) && $user['area'] == 2) echo 'selected';?>>Reguler 2</option>
                          	<option value="4" <?php if(isset($user['area']) && $user['area'] == 4) echo 'selected';?>>Eagle</option>
                          	<option value="5" <?php if(isset($user['area']) && $user['area'] == 5) echo 'selected';?>>Tiara</option>
                          	<option value="6" <?php if(isset($user['area']) && $user['area'] == 6) echo 'selected';?>>Reguler 3</option>
                          	<option value="7" <?php if(isset($user['area']) && $user['area'] == 7) echo 'selected';?>>Reguler 4</option>                          	
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pool <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="pool" class="form-control">
                          	<?php 
                          	foreach((Array) $arrPool AS $key => $val){
                          		echo '<option value="'.$key.'"'.((isset($user['pool']) && $user['pool'] == $key) ? 'selected' : '').'>'.$val.'</option>';
                          	}
                          	?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Active <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="radio">
                            <label>
                              <input type="radio" name="active" value="1" required="required" checked="checked"> Active
                            </label>
                            <label>
                              <input type="radio" name="active" value="0"> Non Active
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="<?php if(isset($user['username'])) echo 'update';?>">Submit</button>
                          <?php if(isset($user['username'])){
                          	echo '<button type="submit" class="btn btn-warning" name="reset_pass">Reset Password</button>';
                          }
                          ?>                          
                          <small class="pull-right"><?php if(!isset($user['username'])) echo "* Newly created user's password is express";?></small>
                        </div>
                      </div>
                    </form>
                </div>  
                </div>                                  
            </div>
          </div>
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>User List</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="datatable" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Username</th>              		
                    		<th>Privilege</th>
                    		<th>Area</th>
                    		<th>Pool</th>                    		
                    		<th>Create Date</th>
                    		<th>Last Login</th>
                    		<th>Login Times</th>                    		                    		
                    		<th>#</th>
                    	</tr>
                    </thead>
                    <tbody>
                    <?php         
                    	$arrArea = array('0' => 'All', '1' => 'Reguler 1', '2' => 'Reguler 2', '4' => 'Eagle', '5' => 'Tiara', '6' => 'Reguler 3', '7' => 'Reguler 4');     	
                    	foreach ((Array) $data AS $key => $val) { 
                    		$diff = (strtotime(date('Y-m-d H:i:s')) - strtotime($val['login_dt']))/(60*60);
                    		echo '<tr><td>'.$val['username'].'</td>'.                 		
                    		'<td>'.($val['id_privilege'] === '1' ? 'Administrator' : ($val['id_privilege'] === '2' ? 'Board Member' : 
                    			($val['id_privilege'] === '3' ? 'GM/SM' : ($val['id_privilege'] === '5' ? 'Marketing' : 
                    			($val['id_privilege'] === '6' ? 'Operasi' : ($val['id_privilege'] === '7' ? 'Checker' : 
                    			($val['id_privilege'] === '8' ? 'ITMS' : ($val['id_privilege'] === '9' ? 'Shelter Team' : 
                    			($val['id_privilege'] === '10' ? 'Contact Center' :
                    			($val['id_privilege'] === '11' ? 'Workshop' : 
                    			($val['id_privilege'] === '12' ? 'Operation Only' : 
                    			($val['id_privilege'] === '13' ? 'Airport' : 
                    			($val['id_privilege'] === '14' ? 'Warroom' :
								($val['id_privilege'] === '16' ? 'Finance' :
								($val['id_privilege'] === '15' ? 'TnD' : 'AM & Kapool'))))))))))))))).'</td>'.
                    		'<td>'.$arrArea[$val['area']].'</td>'.
                    		'<td>'.($val['id_privilege'] === '7' ? $val['pool'] : $arrPool[$val['pool']]).'</td>'.                    		                    		
                    		'<td>'.date('Y-m-d H:i:s', strtotime($val['create_dt'])).'</td>'.
                    		'<td class="'.($diff >= 24 ? 'red' : ($diff >= 12 ? 'orange': 'green')).'">'.$val['login_dt'].'</td>'. 
                    		'<td>'.number_format($val['ct']).'</td>'.                     		                   		
                    		'<td><a href="'.site_url('/Users/index/'.$val['username']).'"><button class="btn btn-success btn-xs">Edit</button></a></td></tr>';
                    	}
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
		</div>
	  </div>
	</div>
        <!-- /page content -->
			<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
		<!-- jQuery -->
		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>
		<!-- NProgress -->
		<script src="<?php echo base_url('/assets/js/nprogress.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
    	<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
		<!-- Datatables -->
    <script>
      $(document).ready(function() {
        $('#datatable').dataTable( {
        "order": [[ 1, "asc" ]],
bFilter: false, paging: false, bInfo: false
    } );
        } );
    </script>
    <!-- /Datatables -->
