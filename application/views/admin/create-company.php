<link href="<?php echo base_url()?>uifiles/css/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>uifiles/css/summernote/summernote-bs3.css" rel="stylesheet">
<style type="text/css">
.note-editable{height:200px;}
</style>
<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Add Company Details</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
					<a href="<?php echo base_url('adminvenjos/company');?>" class="btn btn-default">Back</a>
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
				<form id="logoForm" method="POST" action="<?php echo base_url('index.php/adminvenjos/saveCompany');?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Address <span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="comAdrs" name="comAdrs" class="form-control col-md-7 col-xs-12 txtcls" rows="8"></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email Ids<span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="comEmail" name="comEmail" class="form-control col-md-7 col-xs-12" required="required"></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E- Mail Communication<span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="text" id="comMail" name="comMail" class="form-control col-md-7 col-xs-12" required="required" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contact Numbers 
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="comMobile" name="comMobile" class="form-control col-md-7 col-xs-12"></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fax Number 
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="text" id="comFax" name="comFax" class="form-control col-md-7 col-xs-12" />
					</div>
				  </div>
				  
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
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