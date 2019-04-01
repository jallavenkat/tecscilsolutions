<div class="container mheigh" style="width:<?php echo @$items[0]->displayWidth;?>px;height:100%;min-height:<?php echo @$items[0]->displayHeight;?>px;padding:0;">

	<div class="col w100per" style="padding:0;">
		<div class="col w100per grybg p10px">
			<div class="hFontsm txtleft">S. No</div>
			<div class="hFontmd txtleft">Service</div>
			<div class="hFont">Room</div>
			<div class="hFont">Token</div>
		</div>
		<?php
		$tokens=@json_decode($tokens);
		if(@sizeOf($tokens) > 0)
		{
			for($t=0;$t<sizeOf($tokens);$t++)
			{
		?>
		<div class="col w100per nopad brdbm">
			<div class="transparentbg" id="row_<?php echo @$tokens[$t]->tokenNumber;?>"></div>
			<div class="col w100per nopad">
				<div class="dFontsm whiteclr"><?php echo ($t+1);?></div>
				<div class="dFontmd txtleft whiteclr"><?php echo @ucwords($tokens[$t]->service[0]->serviceName);?></div>
				<div class="dFont whiteclr"><?php echo @ucwords($tokens[$t]->counter[0]->counterCode);?></div>
				<div class="dFont whiteclr"><?php echo @ucwords($tokens[$t]->tokenNumber);?></div>
			</div>
		</div>
		<?php
			}
		}
		?>
		
	</div>
</div>
<input type="hidden" name="buzzToken" id="buzzToken" value="0" />
<script src="<?php echo base_url('dist/sound/');?>script/soundmanager2.js"></script>
<script type="text/javascript">
$(function(){
	token();
});


function token(){
	$.ajax({
		type:"POST",
		url:baseurl+"kiosk/displayToken",
		async:false,
		//dataType:'json',
		success:function(resp){
			var data=$.parseJSON(resp);
			var token = data.token;
			var buzzer = data.buzz;
			//alert(buzzer)
			$("#buzzToken").val(buzzer);
			if(token != '')
			{
				if(buzzer == 1)
				{
					playTokenSound(token); 
					$("#row_"+token).addClass("blinking");
				}
				else{
					$(".transparentbg").removeClass("blinking");
					setTimeout("refreshTokens()", 2000);
					//refreshTokens();
				}
			}
			else{
				$(".transparentbg").removeClass("blinking");
				setTimeout("refreshTokens()", 2000);
				//refreshTokens();
			}
		}
	});
}
var audioFiles = [];
var onstart = '';
/* var playSequence = [];
var cnt = 0;
var audio = []; */

soundManager.setup({

  // location: path to SWF files, as needed (SWF file name is appended later.)

  url: baseurl+'dist/sound/swf/',

  // optional: version of SM2 flash audio API to use (8 or 9; default is 8 if omitted, OK for most use cases.)
	flashVersion: 9,
	useFlashBlock: true,
	debugMode: false,
	idPrefix: 'sound',
	consoleOnly: true,
	preferFlash: true

});

	function playTokenSound(token)
	{
		audioFiles = [];
		onstart = true;
		
		sound ( token, onstart );
	}
	
	/**
	 *	Play sound when a new token comes in the display
	 *	@return sound
	 */
	function sound ( token, flag ) {
	 
		audioFiles.push(baseurl+"dist/swf/token.mp3");
		
		if ( token != -1 ) {
			
			for (t = 0; t < token.length; t++) {
				audioFile = token.charAt(t).toUpperCase();
				audioFiles.push(baseurl+"dist/swf/audio/"+audioFile+".mp3?");
				var tPath=baseurl+"dist/swf/audio/"+audioFile+".mp3?";
			}
		}
		
		soundToken (0, flag, token,audioFiles);
	}

	function soundToken(indexVal,flag,token,audioFiles)
	{
		//alert(audioFiles+""+indexVal);
		var taudio=audioFiles[indexVal];
		//alert(taudio)
		
		if(typeof taudio != 'undefined')
		{
			  // use soundmanager2-nodebug-jsmin.js, or disable debug mode (enabled by default) after development/testing
			  // debugMode: false,

			  // good to go: the onready() callback

			  soundManager.onready(function() {

				// SM2 has started - now you can create and play sounds!
				
					var mySound = soundManager.createSound({
					//id: 'sk4Audio'+indexVal, // optional: provide your own unique id
					url: taudio,
				   //onload: function() { console.log('sound loaded!', this); }
				  // other options here..
					autoLoad: true,
					autoPlay: true,
					stream: true,
					//multiShotEvents:true,
					onfinish: function() {
						
							indexVal++;
							soundToken(indexVal, true, token,audioFiles);
							
						}
					});
					/* if (onstart == false) {
						mySound.mute();
					} else {
						mySound.unmute();
					} */
					mySound.play();
				
			});
		
		}
		else
		{
			//alert("here");
			refreshTokens();
		}
	}
	function refreshTokens()
	{
		var buzzToken = $("#buzzToken").val();
		if(buzzToken == 1)
		{			
			window.location.reload();
			setTimeout("refreshTokens()", 5000);
			/* setTimeout(function(){
				refreshTokens();
			},3000);  */
		}
		else{
			window.location.reload();
		}
	}
	
	function playNow(tPath)
	{
		soundManager.setup({

		  // location: path to SWF files, as needed (SWF file name is appended later.)

		  url: baseurl+'dist/sound/swf/',

		  // optional: version of SM2 flash audio API to use (8 or 9; default is 8 if omitted, OK for most use cases.)
		   flashVersion: 9,

		  // use soundmanager2-nodebug-jsmin.js, or disable debug mode (enabled by default) after development/testing
		  // debugMode: false,

		  // good to go: the onready() callback

		  onready: function() {

			// SM2 has started - now you can create and play sounds!
			
			if(audioFiles.length > 0)
			{
				var mySound = soundManager.createSound({
				id: 'JALLvenkatesh', // optional: provide your own unique id
				url: tPath,
			   //onload: function() { console.log('sound loaded!', this); }
			  // other options here..
				autoLoad: true,
				autoPlay: true,
				stream: true,
				/* onfinish: function() {
					
						indexVal=indexVal+1;
						soundToken(indexVal, true, token);
						
						
					} */ 
				});

				mySound.play();
			}
			

		  },

		});
	}
$(function(){
	//alert("dasds")
	//refreshTokens();
	//playSound (-1, false);
});
</script>

