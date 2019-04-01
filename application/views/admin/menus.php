<link href="<?php echo base_url();?>uifiles/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

 <div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Menus</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
				
				<a href="<?php echo base_url('adminvenjos/createMenu');?>" class="btn btn-success">Add Items</a>
				
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
				if(@$this->session->userdata('menuSuccess') != '')
				{
				?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">	
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('menuSuccess');
					@$this->session->unset_userdata('menuSuccess');
					?>
				</div>
				<?php
				}
				if(@$this->session->userdata('menuFail') != '')
				{
				?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('menuFail');
					@$this->session->unset_userdata('menuFail');
					?>
				</div>
				<?php
				}
				?>
				<table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Default URL</th>
                          <th>SEO Custoom URL</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  if(@sizeOf($items) > 0)
					  {
						  for($i=0;$i<sizeOf($items);$i++)
						  {
					?>
						<tr>
                          <th scope="row"><?php echo ($i+1);?></th>
                          <td>
							<?php echo @$items[$i]->menuTitle;?>
							<span class="aliasName">Alias: <?php echo @$items[$i]->menuAlias;?></span>
						  </td>
                          <td>
							<?php echo @$items[$i]->menuSeoURL;?>
						  </td>
                          <td>
							<?php echo @$items[$i]->menuSeoCustom;?>
						  </td>
                          <td>
							<a href="<?php echo base_url('adminvenjos/editMenu/'.@$items[$i]->id);?>"><i class="fa fa-edit"></i> Edit</a>
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