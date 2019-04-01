<?php
$jsonObj=@json_decode($json);
?>
<link href="<?php echo base_url();?>uifiles/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

 <div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Assigned Services</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
				
				
			  </div>
			</div>
		  </div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
		  <div class="col-md-8 col-sm-8 col-xs-12">
			<div class="x_panel">
			  
			  <div class="x_content">
				<?php
				if(@$this->session->userdata('assignSuccess') != '')
				{
				?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">	
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('assignSuccess');
					@$this->session->unset_userdata('assignSuccess');
					?>
				</div>
				<?php
				}
				if(@$this->session->userdata('assignFail') != '')
				{
				?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('assignFail');
					@$this->session->unset_userdata('assignFail');
					?>
				</div>
				<?php
				}
				?>
				<table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Service</th>
                          <th>Counter</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  $items=$jsonObj->assigns;
					  //echo "<pre>";print_R($items);echo "</pre>";
					  $aservices=$acounters=array();
					  if(@sizeOf($items) > 0)
					  {
						  for($i=0;$i<sizeOf($items);$i++)
						  {
					?>
						<tr>
                          <th scope="row"><?php echo ($i+1);?></th>
                          <td>
							<?php echo @ucwords($items[$i]->service[0]->serviceName);?>
						  </td>
                          <td>
							<?php echo @ucwords($items[$i]->counter[0]->counterName);?>
						  </td>
                         
                          <td>
						  <?php
						 
						  if(@$items[$i]->status == 2)
						  {
							echo "Deleted &nbsp;|&nbsp;";
						?>
							<a href="<?php echo base_url('adminvenjos/changeAssignServiceCounterStatus/'.@$items[$i]->id.'/1');?>" class="btn btn-warning"><i class="fa fa-circle"></i> Enable Now</a>
						<?php
						  }
						  else{
							 
							  ?>
								<a href="<?php echo base_url('adminvenjos/deleteServiceAssignItem/'.@$items[$i]->id.'/0');?>"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;&nbsp;|&nbsp;
							<?php
							if(@$items[$i]->status == 1)
							{
							?>
								<a href="<?php echo base_url('adminvenjos/changeAssignServiceCounterStatus/'.@$items[$i]->id.'/0');?>"><i class="fa fa-circle-o"></i> Make In-Active</a>
							<?php
							}
							if(@$items[$i]->status == 0)
							{
							?>
								<a href="<?php echo base_url('adminvenjos/changeAssignServiceCounterStatus/'.@$items[$i]->id.'/1');?>"><i class="fa fa-circle"></i> Make Active</a>
							<?php
							}
						  }
						?>
						  </td>
                        </tr>
					<?php  
							$aservices[]=$items[$i]->service[0]->id;
							$acounters[]=$items[$i]->counter[0]->id;
						  }
					  }
					  ?>
                        
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4 col-xs-12">
			<h4 class="alert alert-danger nobrd">Assign Service to Counter</h4>
			<div class="x_panel">
			  
			  <div class="x_content">
					
					<form id="logoForm" method="POST" action="<?php echo base_url('index.php/adminvenjos/saveServiceAssigns');?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
						<div class="form-group">
							<label class="control-label col-md-5 col-sm-5 col-xs-12" for="serviceID">Select Service<span class="required">*</span>
							</label>
							<div class="col-md-7 col-sm-7 col-xs-12">
							  <select id="serviceID" name="serviceID" class="form-control col-md-7 col-xs-12" required="required">
								<option value="">Choose Service</option>
								<?php
								if(@sizeOf($services) > 0)
								{
									for($s=0;$s<sizeOf($services);$s++)
									{
										if(@in_array(@$services[$s]->id,$aservices))
										{
											
										}
										else{
								?>
								<option value="<?php echo @$services[$s]->id;?>"><?php echo @ucwords($services[$s]->serviceName);?></option>
								<?php
										}
									}
								}
								?>
							  </select>
							</div>
						  </div>
						<div class="form-group">
							<label class="control-label col-md-5 col-sm-5 col-xs-12" for="serviceID">Select Counter<span class="required">*</span>
							</label>
							<div class="col-md-7 col-sm-7 col-xs-12">
							  <select id="counterID" name="counterID" class="form-control col-md-7 col-xs-12" required="required">
								<option value="">Choose Counter</option>
								<?php
								if(@sizeOf($counters) > 0)
								{
									for($c=0;$c<sizeOf($counters);$c++)
									{
										if(@in_array(@$counters[$c]->id,$acounters))
										{
											
										}
										else{
								?>
								<option value="<?php echo @$counters[$c]->id;?>"><?php echo @ucwords($counters[$c]->counterName);?></option>
								<?php
										}
									}
								}
								?>
							  </select>
							</div>
						</div>
						
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							  <button type="submit" class="btn btn-success submitBtn">Assign Now</button>
							</div>
						</div>
					</form>
			  </div>
			</div>
		  </div>
		</div>
	</div>
</div>

<script src="<?php echo base_url();?>uifiles/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-scroller/js/dataTables.scroller.min.js"></script>