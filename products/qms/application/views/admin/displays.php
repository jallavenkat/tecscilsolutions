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
			<h3>Display Configurations</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
				
				<a href="<?php echo base_url('adminvenjos/createDisplayItem');?>" class="btn btn-success">Add Display Item</a>
				
			  </div>
			</div>
		  </div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
			  
			  <div class="x_content">
				<?php
				if(@$this->session->userdata('dispSuccess') != '')
				{
				?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">	
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('dispSuccess');
					@$this->session->unset_userdata('dispSuccess');
					?>
				</div>
				<?php
				}
				if(@$this->session->userdata('dispFail') != '')
				{
				?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('dispFail');
					@$this->session->unset_userdata('dispFail');
					?>
				</div>
				<?php
				}
				?>
				<table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Display Title</th>
                          <th>Display Width</th>
                          <th>Display Height</th>
                          <th>Is Default Screen</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  $items=$jsonObj->displays;
					  if(@sizeOf($items) > 0)
					  {
						  for($i=0;$i<sizeOf($items);$i++)
						  {
					?>
						<tr>
                          <th scope="row"><?php echo ($i+1);?></th>
                          <td>
							<?php echo @$items[$i]->displayMode;?>
						  </td>
                          <td>
							<?php echo @$items[$i]->displayWidth;?>
						  </td>
                          <td>
							<?php echo @$items[$i]->displayHeight;?>
						  </td>
                          <td>
							<?php
							if(@$items[$i]->status == 2 || @$items[$i]->status == 0)
							{
								echo "N/A";
							}
							else
							{
								if(@$items[$i]->displayDefault == 0)
								{
								?>
								<a href="<?php echo base_url('adminvenjos/makeDefaultScreen/'.@$items[$i]->id);?>" class="btn btn-success">Set Default Screen</a>
								<?php
								}
								if(@$items[$i]->displayDefault == 1)
								{
									echo "Yes";
								}
							}
							?>
						  </td>
                          <td>
						  <?php
						 
						  if(@$items[$i]->status == 2)
						  {
							echo "Deleted &nbsp;|&nbsp;";
						?>
							<a href="<?php echo base_url('adminvenjos/changeDisplayStatus/'.@$items[$i]->id.'/1');?>" class="btn btn-warning"><i class="fa fa-circle"></i> Enable Now</a>
						<?php
						  }
						  else{
							 
							  ?>
								<a href="<?php echo base_url('adminvenjos/editDisplayItem/'.@$items[$i]->id);?>"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;&nbsp;|&nbsp;
								<a href="<?php echo base_url('adminvenjos/changeDisplayStatus/'.@$items[$i]->id.'/2');?>"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;&nbsp;|&nbsp;
							<?php
							if(@$items[$i]->status == 1)
							{
							?>
								<a href="<?php echo base_url('adminvenjos/changeDisplayStatus/'.@$items[$i]->id.'/0');?>"><i class="fa fa-circle-o"></i> Make In-Active</a>
							<?php
							}
							if(@$items[$i]->status == 0)
							{
							?>
								<a href="<?php echo base_url('adminvenjos/changeDisplayStatus/'.@$items[$i]->id.'/1');?>"><i class="fa fa-circle"></i> Make Active</a>
							<?php
							}
						  }
						?>
						  </td>
                        </tr>
					<?php  
						  }
					  }
					  ?>
                        
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
		
		<div class="page-title">
		  <div class="title_left">
			<h3>Display Sound Settings</h3>
		  </div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
			  
			  <div class="x_content">
				<?php
				if(@$this->session->userdata('dispsoundSuccess') != '')
				{
				?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">	
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('dispsoundSuccess');
					@$this->session->unset_userdata('dispsoundSuccess');
					?>
				</div>
				<?php
				}
				if(@$this->session->userdata('dispsoundFail') != '')
				{
				?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('dispsoundFail');
					@$this->session->unset_userdata('dispsoundFail');
					?>
				</div>
				<?php
				}
				?>
				<form method="POST" action="<?php echo base_url('adminvenjos/saveDisplayConfig');?>">
					<table class="table table-striped">
						 
						<tbody>
							<tr>
							  <td>
							  
								Is Sound enable at display screens : <input type="radio" name="isSound" id="isSound" value="1" <?php if(@$jsonObj->displaysound[0]->isSound == 1 || @sizeOf($jsonObj->displaysound) > 0){echo 'checked="checked"';}?> />Yes &nbsp; <input type="radio" name="isSound" id="isSound" value="0" <?php if(@$jsonObj->displaysound[0]->isSound == 0){echo 'checked="checked"';}?> />No
								
							  </td>
							
								<td>
									<button name="save" id="save" type="submit" class="btn btn-primary">Save Settings</button>
								</td>
								<td width="55%">&nbsp;</td>
							</tr>
						</tbody>
					</table>
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