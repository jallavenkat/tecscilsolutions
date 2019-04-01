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
			<h3>Roles</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
				
				<a href="<?php echo base_url('adminvenjos/createRole');?>" class="btn btn-success">Add Role</a>
				
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
				if(@$this->session->userdata('roleSuccess') != '')
				{
				?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">	
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('roleSuccess');
					@$this->session->unset_userdata('roleSuccess');
					?>
				</div>
				<?php
				}
				if(@$this->session->userdata('roleFail') != '')
				{
				?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('roleFail');
					@$this->session->unset_userdata('roleFail');
					?>
				</div>
				<?php
				}
				?>
				<table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Role Name</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  $items=$jsonObj->roles;
					  if(@sizeOf($items) > 0)
					  {
						  for($i=0;$i<sizeOf($items);$i++)
						  {
					?>
						<tr>
                          <th scope="row"><?php echo ($i+1);?></th>
                          <td>
							<?php echo @$items[$i]->roleName;?>
						  </td>
                         
                          <td>
						  <?php
						 
						  if(@$items[$i]->status == 2)
						  {
							echo "Deleted &nbsp;|&nbsp;";
						?>
							<a href="<?php echo base_url('adminvenjos/changeRoleStatus/'.@$items[$i]->id.'/1');?>" class="btn btn-warning"><i class="fa fa-circle"></i> Enable Now</a>
						<?php
						  }
						  else{
							 
							  ?>
								<a href="<?php echo base_url('adminvenjos/editRole/'.@$items[$i]->id);?>"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;&nbsp;|&nbsp;
								<a href="<?php echo base_url('adminvenjos/changeRoleStatus/'.@$items[$i]->id.'/2');?>"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;&nbsp;|&nbsp;
							<?php
							if(@$items[$i]->status == 1)
							{
							?>
								<a href="<?php echo base_url('adminvenjos/changeRoleStatus/'.@$items[$i]->id.'/0');?>"><i class="fa fa-circle-o"></i> Make In-Active</a>
							<?php
							}
							if(@$items[$i]->status == 0)
							{
							?>
								<a href="<?php echo base_url('adminvenjos/changeRoleStatus/'.@$items[$i]->id.'/1');?>"><i class="fa fa-circle"></i> Make Active</a>
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