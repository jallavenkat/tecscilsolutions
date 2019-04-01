<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Add Logo</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
					<a href="<?php echo base_url('adminvenjos/logo');?>" class="btn btn-default">Back</a>
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
				<form id="logoForm" method="POST" action="<?php echo base_url('index.php/adminvenjos/saveLogo');?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Upload Logo <span class="required">*</span>
					</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
					  <input type="file" id="logo" name="logo" required="required" class="form-control col-md-7 col-xs-12">
					</div>
				  </div>
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Upload Brand Logo <span class="required">*</span>
					</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
					  <input type="file" id="brandLogo" name="brandLogo" class="form-control col-md-7 col-xs-12">
					</div>
				  </div>
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Upload Favicon <span class="required">*</span>
					</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
					  <input type="file" id="favicon" name="favicon" class="form-control col-md-7 col-xs-12" required="required" />
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