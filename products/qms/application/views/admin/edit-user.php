<link href="<?php echo base_url()?>uifiles/css/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>uifiles/css/summernote/summernote-bs3.css" rel="stylesheet">
<style type="text/css">
.note-editable{height:200px;}
</style>
<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Edit User</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
					<a href="<?php echo base_url('adminvenjos/users');?>" class="btn btn-default">Back</a>
			  </div>
			</div>
		  </div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
			  
			  <div class="x_content">
				<br />
				<form id="logoForm" method="POST" action="<?php echo base_url('index.php/adminvenjos/updateUser');?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="displayMode">Select Role<span class="required">*</span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12">
					  <select id="role" name="role" class="form-control col-md-7 col-xs-12" required="required">
						<option value="">Choose Role</option>
						<?php
						if(@sizeOf($roles) > 0)
						{
							for($i=0;$i<sizeOf($roles);$i++)
							{
								if(@$roles[$i]->id == $item[0]->role)
								{
									$rsel='selected="selected"';
								}
								else
								{
									$rsel='';
								}
						?>
						<option <?php echo @$rsel;?> value="<?php echo @$roles[$i]->id;?>"><?php echo @ucwords($roles[$i]->roleName);?></option>
						<?php
							}
						}
						?>
					  </select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="displayMode">Username<span class="required">*</span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12">
					  <input type="text" id="uname" name="uname" value="<?php echo @$item[0]->uname;?>" class="form-control col-md-7 col-xs-12" required="required" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="displayMode">Firstname<span class="required">*</span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12">
					  <input type="text" id="firstname" name="firstname" value="<?php echo @$item[0]->firstname;?>" class="form-control col-md-7 col-xs-12" required="required" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="displayMode">Lastname<span class="required">*</span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12">
					  <input type="text" id="lastname" name="lastname" value="<?php echo @$item[0]->lastname;?>" class="form-control col-md-7 col-xs-12" required="required" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="displayMode">Email ID<span class="required">*</span>
					</label>
					<div class="col-md-4 col-sm-4 col-xs-12">
					  <input type="email" id="email" name="email" value="<?php echo @$item[0]->email;?>" class="form-control col-md-7 col-xs-12" required="required" />
					</div>
				  </div>
				  
				  
				 
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <button class="btn btn-primary" type="button">Cancel</button>
					  <button class="btn btn-primary" type="reset">Reset</button>
					  <input type="hidden" name="rowid" value="<?php echo @$rowid;?>" />
					  <button type="submit" class="btn btn-success submitBtn">Submit</button>
					</div>
				  </div>

				</form>
			  </div>
			</div>
		  </div>
		</div>
	</div>
</div>

<script>
$(".isNumber").on("keypress keyup blur",function (event) {
	$(this).val($(this).val().replace(/[^0-9\.]/g,''));
	
	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
});
</script>