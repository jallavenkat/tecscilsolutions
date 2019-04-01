<?php
$jsonObj=@json_decode($json);
?>
<style type="text/css">
.minicolors-panel{top:35px !important;}
</style>

<link href="<?php echo base_url();?>uifiles/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>uifiles/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>dist/css/jquery.minicolors.css" rel="stylesheet" type="text/css" />
 <div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Kiosk Settings</h3>
		  </div>

		  <div class="title_right">
			<div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
				
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
				if(@$this->session->userdata('kioskSuccess') != '')
				{
				?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">	
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('kioskSuccess');
					@$this->session->unset_userdata('kioskSuccess');
					?>
				</div>
				<?php
				}
				if(@$this->session->userdata('kioskFail') != '')
				{
				?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
					<?php
					echo @$this->session->userdata('kioskFail');
					@$this->session->unset_userdata('kioskFail');
					?>
				</div>
				<?php
				}
				?>
				<form method="POST" action="<?php echo base_url();?>adminvenjos/saveKioskSettings" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">	
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Backgroud Image<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
						  <input type="file" id="kioskBg" name="kioskBg" class="form-control col-md-5 col-xs-12" required="required" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
							Button Color From<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" name="kioskBtnBgFrom"  id="hue-demo" data-control="hue" class="kioskBtnBgFrom form-control col-md-7 col-xs-12 demo" placeholder="Color Code" required autocomplete="off"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
							Button Color To<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" name="kioskBtnBgTo"  id="hue-demo" data-control="hue" class="kioskBtnBgTo form-control col-md-7 col-xs-12 demo" placeholder="Color Code" required autocomplete="off"/>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<button class="btn btn-default" id="demoNormL">Demo Button</button>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
							Button Hove Color From<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" name="kioskBtnHovrFrom"  id="hue-demo" data-control="hue" class="form-control col-md-7 col-xs-12 demo" placeholder="Color Code" required autocomplete="off"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
							Button Hove Color To<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" name="kioskBtnHovrTo"  id="hue-demo" data-control="hue" class="form-control col-md-7 col-xs-12 demo" placeholder="Color Code" required autocomplete="off"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
							Button Hove Color To<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" name="kioskBtnSize" id="kioskBtnSize" class="form-control col-md-7 col-xs-12" placeholder="Ex: 12px" required />
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

<script src="<?php echo base_url();?>uifiles/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo base_url();?>uifiles/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

<script src="<?php echo base_url();?>dist/js/jquery.minicolors.js" type="text/javascript"></script>

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
	  
	  $(".kioskBtnBgFrom").on("change",function(){
		  var color = $(this).val();
		  var tocolor = $(".kioskBtnBgTo").val();
		  if(tocolor == '')
		  {
			  var tcolor = '#FFFFFF';
		  }
		  else
		  {
			  var tcolor = tocolor;
		  }
		  $("button#demoNormL").css({
				"background-color" : ""+color,
				"background-image" : "-webkit-gradient(linear, left top, left bottom, from("+color+"), to("+tcolor+"))",
				"background-image" : "-webkit-linear-gradient(top, "+color+", "+tcolor+")",
				"background-image" : "-moz-linear-gradient(top, "+color+", "+tcolor+")",
				"background-image" : "-ms-linear-gradient(top, "+color+", "+tcolor+")",
				"background-image" : "-o-linear-gradient(top, "+color+","+tcolor+")",
				"background-image" : "linear-gradient(to bottom, "+color+", "+tcolor+")",
				"background-image" : "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr="+color+", endColorstr="+tcolor+")",
		  });
	  });
	  $(".kioskBtnBgTo").on("change",function(){
		  var color = $(this).val();
		  var frmcolor = $(".kioskBtnBgFrom").val();
		  alert(frmcolor)
		  if(frmcolor == '')
		  {
			  var fcolor = '#FFFFFF';
		  }
		  else
		  {
			  var fcolor = frmcolor;
		  }
		  $("button#demoNormL").css({
				"background-color" : ""+fcolor,
				"background-image" : "-webkit-gradient(linear, left top, left bottom, from("+fcolor+"), to("+color+"))",
				"background-image" : "-webkit-linear-gradient(top, "+fcolor+", "+color+")",
				"background-image" : "-moz-linear-gradient(top, "+fcolor+", "+color+")",
				"background-image" : "-ms-linear-gradient(top, "+fcolor+", "+color+")",
				"background-image" : "-o-linear-gradient(top, "+fcolor+","+color+")",
				"background-image" : "linear-gradient(to bottom, "+fcolor+", "+color+")",
				"background-image" : "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr="+fcolor+", endColorstr="+color+")",
		  });
	  });

    });
  </script>