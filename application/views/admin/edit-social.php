<link href="<?php echo base_url()?>uifiles/css/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>uifiles/css/summernote/summernote-bs3.css" rel="stylesheet">
<style type="text/css">
.note-editable{height:200px;}
</style>
<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Edit Social Network URL</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
					<a href="<?php echo base_url('adminvenjos/socials');?>" class="btn btn-default">Back</a>
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
				<form id="logoForm" method="POST" action="<?php echo base_url('index.php/adminvenjos/updateSocial');?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Social Network Name 
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="text" id="socName" name="socName" class="form-control col-md-7 col-xs-12" value="<?php echo @$item[0]->socName;?>" required />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Social Network Icon
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					<?php
					if(@$item[0]->socIcon != '')
					{
					?>
					<img src="<?php echo base_url('uploads/files/'.@$item[0]->socIcon);?>" class="img-responsive" /><br />
					<?php
					}
					?>
					  <input type="file" id="socIcon" name="socIcon" class="form-control col-md-7 col-xs-12" />
					  <input type="hidden" id="hiddensocIcon" name="hiddensocIcon" value="<?php echo @$item[0]->socIcon;?>" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Social Network URL
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="text" id="socURL" name="socURL" class="form-control col-md-7 col-xs-12" value="<?php echo @$item[0]->socURL;?>" required />
					</div>
				  </div>
				  
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<input type="hidden" id="rowid" name="rowid" value="<?php echo @$rowid;?>" />
					  <button class="btn btn-primary" type="button">Cancel</button>
					  <button class="btn btn-primary" type="reset">Reset</button>
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
<script src="<?php echo base_url()?>uifiles/js/summernote/summernote.min.js"></script>
  
<script>
$(document).ready(function(){

	$('.txtcls').summernote();

});
var edit = function() {
	$('.click2edit').summernote({focus: true});
};
var save = function() {
	var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
	$('.click2edit').destroy();
}; 
</script>