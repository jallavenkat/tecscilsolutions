<link href="<?php echo base_url();?>uifiles/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

 <div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Company Details</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
				<?php
				if(@sizeOf($company) > 0)
				{
					
				}
				else
				{
				?>
					<a href="<?php echo base_url('adminvenjos/createCompany');?>" class="btn btn-success">Add Details</a>
				<?php
				}
				?>
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
				if(@$this->session->userdata('companySuccess') != '')
				{
				?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">	
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('companySuccess');
					@$this->session->unset_userdata('companySuccess');
					?>
				</div>
				<?php
				}
				if(@$this->session->userdata('companyFail') != '')
				{
				?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('companyFail');
					@$this->session->unset_userdata('companyFail');
					?>
				</div>
				<?php
				}
				?>
				<table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Address</th>
                          <th>Email</th>
                          <th>Email Communication</th>
                          <th>Contact Number</th>
                          <th>Fax</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  if(@sizeOf($company) > 0)
					  {
					?>
						<tr>
                          <th scope="row">1</th>
                          <td>
							<?php echo @$company[0]->comAdrs;?>
						  </td>
                          <td style="width:25%;">
							<?php echo @$company[0]->comEmail;?>
						  </td>
                          <td>
							<?php echo @$company[0]->comMail;?>
						  </td>
                          <td>
							<?php echo @$company[0]->comMobile;?>
						  </td>
                          <td>
							<?php echo @$company[0]->comFax;?>
						  </td>
                          <td>
							<a href="<?php echo base_url('adminvenjos/editCompany/'.@$company[0]->id);?>"><i class="fa fa-edit"></i> Edit</a>
						  </td>
                        </tr>
					<?php  
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