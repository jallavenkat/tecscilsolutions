<link href="<?php echo base_url()?>uifiles/css/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>uifiles/css/summernote/summernote-bs3.css" rel="stylesheet">
<style type="text/css">
.note-editable{height:200px;}
</style>
<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Edit Page</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
					<a href="<?php echo base_url('adminvenjos/pages');?>" class="btn btn-default">Back</a>
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
				<form id="logoForm" method="POST" action="<?php echo base_url('index.php/adminvenjos/updatePage');?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pTitle">Page Title<span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="text" id="pTitle" name="pTitle" class="form-control col-md-7 col-xs-12" value="<?php echo @$item[0]->pTitle;?>" required="required" />
					</div>
				  </div>
				  
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pShortDesc">Short Description
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="pShortDesc" name="pShortDesc" class="form-control col-md-7 col-xs-12" rows="8"><?php echo @$item[0]->pShortDesc;?></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pBanner">Page Banner 
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					<?php
					if(@$item[0]->pBanner != '')
					{
					?>
					<img src="<?php echo base_url('uploads/files/'.@$item[0]->pBanner);?>" style="width:200px" /><br />
					<?php
					}
					?>
					  <input type="file" id="pBanner" name="pBanner" class="form-control col-md-7 col-xs-12" />
					  <input type="hidden" id="hiddenpBanner" name="hiddenpBanner" value="<?php echo @$item[0]->pBanner;?>" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuTitle">Meta Title 
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="metaTitle" name="metaTitle" class="form-control col-md-7 col-xs-12" rows="3" required><?php echo @$item[0]->metaTitle;?></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuDesc">Meta Description <span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="metaDesc" name="metaDesc" class="form-control col-md-7 col-xs-12" rows="8" required><?php echo @$item[0]->metaDesc;?></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuDesc">Meta Keywords <span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="metaKeys" name="metaKeys" class="form-control col-md-7 col-xs-12" rows="8" required><?php echo @$item[0]->metaKeys;?></textarea>
					</div>
				  </div>
				  
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<input type="hidden" name="rowid" value="<?php echo @$rowid;?>" />
						<input type="hidden" name="menuid" value="<?php echo @$item[0]->menuid;?>" />
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