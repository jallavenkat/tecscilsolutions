
<section class="Welcome py-5 mh200">
	<div class="container py-sm-4">
		<div class="row">
			<div class="col-lg-12 mb-lg-0 mb-5">
				<h3 class="mt-lg-0 txtCenter logoClrCon">
					
				</h3>
				<p class="my-4 txtCenter logoClrCon"><?php echo @$about[0]->pShortDesc;?></p>
				<div class="col-lg-4 loginbg1 nopad fleft">
					<h3 class="mt-lg-0 txtCenter logoClrCon panelH">
						Room No : <?php echo @$mycounter[0]->counterID;?>
					</h3>
				</div>
				<div class="col-lg-4 loginbg1 nopad fleft">
					<h3 class="mt-lg-0 txtCenter logoClrCon panelH">
						Service : <?php 
						if(@sizeOf($myservice) > 0)
						{
							echo @$myservice[0]->serviceName;
						}
						?>
					</h3>
				</div>
				<div class="col-lg-3 loginbg1 nopad fleft">
					<h3 class="mt-lg-0 txtCenter logoClrCon panelH">
						
						Total Tokens : <span id="totalTokensText">
							<?php
							$allokens=array();
							if(@sizeOf($serveTokens) > 0)
							{
								$allokens=@sizeOf($totaltokens);
							}
							else
							{
								$allokens=@sizeOf($tokens);
							}
							echo $allokens;
							?>
							</span>
					</h3>
				</div>
				
			</div>
			<div class="col-lg-12 mb-lg-0 mb-5">
				<div class="col-lg-7 loginbg1 nopad fleft">
					<h3 class="mt-lg-0 txtCenter logoClrCon panelH">
						Current Token
					</h3>
					<h1 class="txtCenter hBTxtFont">
						<span id="currentTokenText">
							<?php echo @$serveTokens[0]->tokenNumber;?>
						</span>
					</h1>
					
					<h1 class="txtCenter hTxtFont">
						<input type="hidden" name="totalTokens" id="totalTokens" value="<?php echo @sizeOf($allokens);?>" />
						<input type="hidden" name="currentTotken" id="currentTotken" value="<?php echo @$serveTokens[0]->tokenNumber;?>" />
						<input type="hidden" name="isTrigger" id="isTrigger" value="0" />
						<button type="button" name="nextToken" id="nextBtn" class="logoClrCon fweight btn btnbg mTxtFont padLeft">Next <span class="btn ml-2"><i class="fas fa-arrow-right" aria-hidden="true"></i></span></button>
						<button type="button" name="buzzNow" id="buzzNow" class="logoClrCon fweight btn btnbg mTxtFont padLeft">Buzz <span class="btn ml-2"><i class="fas fa-volume-up" aria-hidden="true"></i></span></button>
					</h1>
					
				</div>
				<div class="col-lg-4 loginbg1 nopad fleft">
					<h3 class="mt-lg-0 txtCenter logoClrCon panelH">
						Counter List
					</h3>
					<table width="100%" class="tabMargin" cellpadding="5" cellspacing="5">
						<tr>
							<td class="tabH">Service</td>
							<td class="tabH">Tokens</td>
							<td class="tabH">Multi Tokens</td>
							<td class="tabH">Missed Tokens</td>
						</tr>
					<?php
					$counterlist=@json_decode($counterlist);
					//echo "<pre>";print_r($counterlist);echo "</pre>";
					if(@sizeOf($counterlist) > 0)
					{
						for($c=0;$c<sizeOf($counterlist);$c++)
						{
							if(@$myservice[0]->id != $counterlist[$c]->id)
							{
					?>
						<tr>
							<td><?php echo @ucwords($counterlist[$c]->serviceName);?></td>
							<td><?php echo @sizeOf($counterlist[$c]->tokens);?></td>
							<td><?php echo @sizeOf($counterlist[$c]->multitokens);?></td>
							<td><?php echo @sizeOf($counterlist[$c]->missedtokens);?></td>
						</tr>
					<?php
							}
						}
					}
					?>
						
					</table>
				</div>
			</div>
		</div>	
	</div>	
</section>
  
    <script src="<?php echo base_url('dist/vendor/');?>bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url('dist/vendor/');?>jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url('dist/vendor/');?>scrollreveal/scrollreveal.min.js"></script>
    <script src="<?php echo base_url('dist/vendor/');?>magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url('dist/js/');?>creative.min.js"></script>
    <script src="<?php echo base_url('dist/js/');?>teller.js"></script>

  </body>

</html>

