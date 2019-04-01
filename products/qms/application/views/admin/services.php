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
			<h3>Services</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
				
				<a href="<?php echo base_url('adminvenjos/createService');?>" class="btn btn-success">Add Service</a>
				
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
				if(@$this->session->userdata('serSuccess') != '')
				{
				?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">	
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('serSuccess');
					@$this->session->unset_userdata('serSuccess');
					?>
				</div>
				<?php
				}
				if(@$this->session->userdata('serFail') != '')
				{
				?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('serFail');
					@$this->session->unset_userdata('serFail');
					?>
				</div>
				<?php
				}
				?>
				<form method="POST" id="orderForm" action="<?php echo base_url('adminvenjos/updateServiceOrderPos');?>">
				<table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Service Title</th>
                          <th>Service Code</th>
                          <th>Order Position</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  $items=$jsonObj->services;
					  if(@sizeOf($items) > 0)
					  {
						  for($i=0;$i<sizeOf($items);$i++)
						  {
					?>
						<tr>
                          <th scope="row"><?php echo ($i+1);?></th>
                          <td>
							<?php echo @$items[$i]->serviceName;?>
						  </td>
                          <td>
							<?php echo @$items[$i]->serviceCode;?>
						  </td>
                          <td>
							<input type="hidden" name="row[]" value="<?php echo @$items[$i]->id;?>" />
							<input type="hidden" name="no_<?php echo @$items[$i]->id;?>" id="ind_<?php echo @$i;?>" value="<?php echo @$i;?>" />
							<?php
							if(@$i == 0)
							{

							}
							else
							{
							?>
								<a title="Move Up To The Position" href="javascript:;" class="orderAsc index<?php echo @$i;?>" data-id="<?php echo @$items[$i]->id;?>" order="<?php echo @$items[$i]->cat_position;?>" index="<?php echo @$i;?>"><i class="fa fa-arrow-up"></i> &nbsp;</a>
							<?php
							}
							?>
							<a title="Move Down To The Position" href="javascript:;" class="orderDesc index<?php echo @$i;?>" data-id="<?php echo @$items[$i]->id;?>" order="<?php echo @$items[$i]->cat_position;?>" index="<?php echo @$i;?>"><i class="fa fa-arrow-down"></i>  &nbsp;</a>
						  </td>
                          <td>
						  <?php
						 
						  if(@$items[$i]->status == 2)
						  {
							echo "Deleted &nbsp;|&nbsp;";
						?>
							<a href="<?php echo base_url('adminvenjos/changeServiceStatus/'.@$items[$i]->id.'/1');?>" class="btn btn-warning"><i class="fa fa-circle"></i> Enable Now</a>
						<?php
						  }
						  else{
							 
							  ?>
								<a href="<?php echo base_url('adminvenjos/editService/'.@$items[$i]->id);?>"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;&nbsp;|&nbsp;
								<a href="<?php echo base_url('adminvenjos/changeServiceStatus/'.@$items[$i]->id.'/2');?>"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;&nbsp;|&nbsp;
							<?php
							if(@$items[$i]->status == 1)
							{
							?>
								<a href="<?php echo base_url('adminvenjos/changeServiceStatus/'.@$items[$i]->id.'/0');?>"><i class="fa fa-circle-o"></i> Make In-Active</a>
							<?php
							}
							if(@$items[$i]->status == 0)
							{
							?>
								<a href="<?php echo base_url('adminvenjos/changeServiceStatus/'.@$items[$i]->id.'/1');?>"><i class="fa fa-circle"></i> Make Active</a>
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

<script type="text/javascript">
$(".orderDesc").unbind().on("click",function(){
	var index = $(this).attr('index');
	var nextIndex = parseInt(parseInt(index)+1);
	var rowid = $(this).attr('data-id');
	var current = $("#ind_"+index).val();
	var next = $("#ind_"+nextIndex).val();
	$("#ind_"+index).val(nextIndex);
	$("#ind_"+nextIndex).val(index);
	var Acurrent = $("#ind_"+index).val();
	var Anext = $("#ind_"+nextIndex).val();
	$("form#orderForm").submit();
});
$(".orderAsc").unbind().on("click",function(){
	var index = $(this).attr('index');
	var nextIndex = parseInt(parseInt(index)-1);
	var rowid = $(this).attr('data-id');
	var current = $("#ind_"+index).val();
	var next = $("#ind_"+nextIndex).val();
	$("#ind_"+index).val(nextIndex);
	$("#ind_"+nextIndex).val(index);
	var Acurrent = $("#ind_"+index).val();
	var Anext = $("#ind_"+nextIndex).val();
	$("form#orderForm").submit();
});
</script>