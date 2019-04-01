<link href="<?php echo base_url()?>uifiles/css/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>uifiles/css/summernote/summernote-bs3.css" rel="stylesheet">
<style type="text/css">
.note-editable{height:200px;}
</style>
<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Edit Display</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
					<a href="<?php echo base_url('adminvenjos/displays');?>" class="btn btn-default">Back</a>
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
				<form id="logoForm" method="POST" action="<?php echo base_url('index.php/adminvenjos/updateDisplay');?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="displayMode">Display Mode<span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="text" id="displayMode" name="displayMode" class="form-control col-md-7 col-xs-12" value="<?php echo @$item[0]->displayMode;?>" required="required" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="displayWidth">Display Width<span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="text" id="displayWidth" name="displayWidth" class="form-control col-md-7 col-xs-12 isNumber" value="<?php echo @$item[0]->displayWidth;?>" required="required" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="displayHeight">Display Height<span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="text" id="displayHeight" name="displayHeight" class="form-control col-md-7 col-xs-12 isNumber" value="<?php echo @$item[0]->displayHeight;?>" required="required" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="displayDefault">Is Default Screen<span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="radio" id="displayDefault" name="displayDefault" value="1" <?php if(@$item[0]->displayDefault == 1){echo 'checked="checked"';}?> />Yes 
					  <input type="radio" id="displayDefault" name="displayDefault" value="0" <?php if(@$item[0]->displayDefault == 0){echo 'checked="checked"';}?> />No 
					</div>
				  </div>
				  
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <button class="btn btn-primary" type="button">Cancel</button>
					  <button class="btn btn-primary" type="reset">Reset</button>
					  <input type="hidden" name="rowid" id="rowid" value="<?php echo @$rowid;?>" />
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