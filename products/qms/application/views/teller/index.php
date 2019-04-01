
<section class="Welcome py-5 mh200">
	<div class="container py-sm-4">
		<div class="row">
			<div class="col-lg-12 mb-lg-0 mb-5">
				<h3 class="mt-lg-0 txtCenter logoClrCon">
					<?php echo @ucwords($user[0]->firstname);?> Dashboard
				</h3>
				<p class="my-4 txtCenter logoClrCon"><?php echo @$about[0]->pShortDesc;?></p>
				<div class="col-lg-3 loginbg nopad fleft">
					<h3 class="mt-lg-0 txtCenter logoClrCon panelH">
						Today New Tokens
					</h3>
					<h1 class="txtCenter hTxtFont">
						<a href="<?php echo base_url('teller/process');?>"><?php echo @sizeOf($servicetokens);?></a>
					</h1>
					
				</div>
				<div class="col-lg-3 loginbg nopad fleft">
					<h3 class="mt-lg-0 txtCenter logoClrCon panelH">
						Today Served Tokens
					</h3>
					<h1 class="txtCenter hTxtFont">
						12
					</h1>
				</div>
				<div class="col-lg-3 loginbg nopad fleft">
					<h3 class="mt-lg-0 txtCenter logoClrCon panelH">
						Total Tokens
					</h3>
					<h1 class="txtCenter hTxtFont">
						32
					</h1>
				</div>
				
			</div>
		</div>	
	</div>	
</section>

