<link href="<?php echo base_url();?>externals/css/jquery.minicolors.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.minicolors-theme-default.minicolors{width: 50%;}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Add color</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>index.php/home/colors">Colors</a>
			</li>
			<li class="active">
				<strong>Add color</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url()?>index.php/home/colors" class="btn btn-w-m btn-default pull-right">Back to List</a>
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="col-lg-8">
					<div class="ibox">							
						<div class="ibox-content">
							<form method="POST" action="<?php echo base_url();?>index.php/home/savecolors" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">	
								<div class="form-group">
									<label class="col-sm-4 control-label">Color Name</label>
									<div class="col-sm-8">
										<input type="text" name="color_name" id="color_name" class="form-control" placeholder="Enter Color Name" required autocomplete="off"/>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Color Code</label>
									<div class="col-sm-8">
										<input type="text" name="color_code"  id="hue-demo" data-control="hue" class="form-control demo" placeholder="Enter Color Code" required autocomplete="off"/>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<button class="btn btn-white" type="reset">Reset</button>
										<button class="btn btn-primary" type="submit">Save</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url();?>externals/js/jquery.minicolors.js" type="text/javascript"></script>

<script>
    $(document).ready( function() {

      $('.demo').each( function() {
        $(this).minicolors({
          control: $(this).attr('data-control') || 'hue',
          defaultValue: $(this).attr('data-defaultValue') || '',
          format: $(this).attr('data-format') || 'hex',
          keywords: $(this).attr('data-keywords') || '',
          inline: $(this).attr('data-inline') === 'true',
          letterCase: $(this).attr('data-letterCase') || 'lowercase',
          opacity: $(this).attr('data-opacity'),
          position: $(this).attr('data-position') || 'bottom left',
          swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
          change: function(hex, opacity) {
            var log;
            try {
              log = hex ? hex : 'transparent';
              if( opacity ) log += ', ' + opacity;
              console.log(log);
            } catch(e) {}
          },
          theme: 'default'
        });

      });

    });
  </script>