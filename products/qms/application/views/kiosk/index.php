<div class="container mheight">
  <div class="card mb-5 text-center">
	<button type="button" class="btn btn-lg btn-default clrbg nobrdradius nomargin nooutline fbold">Select Service</button>
  </div>
  <?php
  if(@$_REQUEST['type'] == '')
	{
	?>
  <div class="card-deck mb-3 text-center">
	<?php
	
		$i=0;
		foreach($services as $service) {
			
		?>
		<div class="card box-shadow nobg nobrd">
		  <button type="button" class="btn btn-lg btn-primary servicecls btnclrbg brdradius40" id="s_<?php echo @$service->id;?>" data-service-id="s-<?php echo @$service->id;?>-id" data-service-name="<?php echo @$service->serviceName;?>" ><?php echo @$service->serviceName;?></button>
		</div>
		<?php
		  $i++;
		  if ($i % 3 == 0) {echo '</div><div class="card-deck mb-3 text-center">';}
		}
	?>
	</div>
	<?php
	}
	
	if(@$_REQUEST['type'] == 'multiple')
	{
	?>
	<div class="card-deck mb-3 text-center">
	<?php
		$m=0;
		foreach($services as $service) {
			
		?>
		<div class="card box-shadow nobg nobrd">
		  <button type="button" class="btn btn-lg btn-primary mservicecls btnclrbg brdradius40" id="s_<?php echo @$service->id;?>" data-service-id="s-<?php echo @$service->id;?>-id" data-service-name="<?php echo @$service->serviceName;?>" ><?php echo @$service->serviceName;?></button>
		</div>
		<?php
		  $m++;
		  if ($m % 3 == 0) {echo '</div><div class="card-deck mb-3 text-center">';}
		}
	?>
	</div>
	<div class="card-deck mb-3 text-center">
		<div class="card box-shadow">
			<button class="btn btn-success multiBtn" type="button">Confirm</button>
		</div>
		
		<div class="card box-shadow">
			<button class="btn btn-default clrBtnbg multiBtn" type="button">Clear</button>
		</div>
		<div class="card box-shadow">
			<button class="btn btn-danger multiBtn" type="button">Cancel</button>
		</div>
	</div>
	<?php
	}
?>
</div>
