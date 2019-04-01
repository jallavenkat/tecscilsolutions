$(function(){
	getTotalTokens();
	function getTotalTokens()
	{
		$.post(baseurl+'teller/getTotalTokens',function(data,status){
			var myData =$.parseJSON(data);
			if(myData.token > 0)
			{
				getTokens()
			}
			else{
				setTimeout(function(){
					getTotalTokens();
				},3000);
				
			}
		});
	}
	function getTokens()
	{
		var triggerToken = $("#isTrigger").val();
		
		$.post(baseurl+'teller/getTokens',function(data,status){
			var myData =$.parseJSON(data);
			if(triggerToken == 1)
			{
				if(myData.currentToken != '')
				{
					$("#totalTokensText").html(myData.remainingTokens);
					$("#totalTokens").val(myData.remainingTokens);
					$("#currentTotken").val(myData.currentToken);
					$("#currentTokenText").html(myData.currentToken);
				}
				else{
					$("#totalTokensText").html(myData.remainingTokens);
					$("#totalTokens").val(myData.remainingTokens);
					$("#currentTotken").val(myData.token);
					$("#currentTokenText").html(myData.token);
				}
				setTimeout(function(){
					location.reload();
				},3000);
			}
			else{
				$("#totalTokens").val(myData.remainingTokens);
				$("#totalTokensText").html(myData.remainingTokens);
				setTimeout(function(){
					getTotalTokens();
				},3000);
			}
		});
		
		
		
	}
	
	$("#nextBtn").unbind().on("click",function(){
		$("#isTrigger").val(1);
		$("#nextBtn").attr("disabled");
		$.post(baseurl+'teller/nextToKen',function(data,status){
			var myData =$.parseJSON(data);
			if(myData.currentToken != '')
			{
				if(myData.token != '')
				{
					$("#totalTokensText").html(myData.remainingTokens);
					$("#totalTokens").val(myData.remainingTokens);
					$("#currentTotken").val(myData.currentToken);
					$("#currentTokenText").html(myData.currentToken);
				}
				else{
					
				}
			}
			else{
				if(myData.token != '')
				{
					$("#totalTokensText").html(myData.remainingTokens);
					$("#totalTokens").val(myData.remainingTokens);
					$("#currentTotken").val(myData.token);
					$("#currentTokenText").html(myData.token);
				}
				else{
					$("#totalTokensText").html(myData.remainingTokens);
					$("#totalTokens").val(myData.remainingTokens);
					$("#currentTotken").val(myData.token);
					$("#currentTokenText").html(myData.token);
					//getTokens();
				}
				
			}
			getTokens();
			setTimeout(function(){
				$("#nextBtn").removeAttr("disabled");
			},5000);
		});
	});
	
	$("#buzzNow").unbind().on("click",function(){
		$("#buzzNow").attr("disabled",true);
		var cToken = $("#currentTotken").val();
		$.post(baseurl+'teller/buzzToKen',{"token" : cToken},function(data,status){
			if(data == 1)
			{
				setTimeout(function(){
					$("#buzzNow").removeAttr("disabled");
				},5000);
			}
			else{
				$("#buzzNow").removeAttr("disabled");
			}
			
		});
		
	});
});
 
 
    