<link href="<?php echo base_url()?>uifiles/css/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>uifiles/css/summernote/summernote-bs3.css" rel="stylesheet">
<style type="text/css">
.note-editable{height:200px;}
</style>
<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Add Page</h3>
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
				<form id="logoForm" method="POST" action="<?php echo base_url('index.php/adminvenjos/savePage');?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

				  <?php
				  $pgs=array();
				  if(@sizeOf($pages) > 0)
				  {
					  for($p=0;$p<sizeOf($pages);$p++)
					  {
						  $pgs[]=$pages[$p]->menuid;
					  }
				  }
				  ?>
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuid">Select Menu<span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <select id="menuid" name="menuid" class="form-control col-md-7 col-xs-12" required="required">
						<option value="">Choose Menu</option>
						<?php
						if(@sizeOf($menus) > 0)
						{
							for($m=0;$m<sizeOf($menus);$m++)
							{
								if(@in_array($menus[$m]->id,$pgs))
								{
									$msel='disabled="disabled" style="color:#ccc;"';
								}
								else
								{
									$msel='';
								}
						?>
						<option <?php echo @$msel;?> value="<?php echo @$menus[$m]->id;?>"><?php echo @ucwords($menus[$m]->menuTitle);?></option>
						<?php
							}
						}
						?>
					  </select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pTitle">Page Title<span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="text" id="pTitle" name="pTitle" class="form-control col-md-7 col-xs-12" required="required" />
					</div>
				  </div>
				  
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pShortDesc">Short Description
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="pShortDesc" name="pShortDesc" class="form-control col-md-7 col-xs-12" rows="8"></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pBanner">Page Banner 
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <input type="file" id="pBanner" name="pBanner" class="form-control col-md-7 col-xs-12" />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuTitle">Meta Title 
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="metaTitle" name="metaTitle" class="form-control col-md-7 col-xs-12" rows="3" required></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuDesc">Meta Description <span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="metaDesc" name="metaDesc" class="form-control col-md-7 col-xs-12" rows="8" required></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuDesc">Meta Keywords <span class="required">*</span>
					</label>
					<div class="col-md-7 col-sm-7 col-xs-12">
					  <textarea id="metaKeys" name="metaKeys" class="form-control col-md-7 col-xs-12" rows="8" required></textarea>
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