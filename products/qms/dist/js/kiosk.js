$(function(){
	getdate();
	function getdate(){
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();
		var a = 'AM';
		 if(s<10){
			 s = "0"+s;
		 }
		 if(h <12 )
		 {
			a='AM';
		 }
		 else{
			a='PM';
		 }
		 if(h == 0){
			 h = "12";
		 }
		 if(m<10){
			 m = "0"+m;
		 }
		 

		$("#clock").text(h+" : "+m+" : "+s+ " "+a);
		setTimeout(function(){getdate()}, 500);
	}

	$(".servicecls").unbind().on("click",function(){
		
		var service = $(this).attr("data-service-id");
		
		var serviceid=service.split("-");
		
		$("#s_"+serviceid[1]).addClass("sser");
		$.post(baseurl+"kiosk/createUserToken",{'service':serviceid[1]}, function(data, status){
			if(data == 1)
			{
				window.location.href=baseurl+"kiosk";
			}
			else{
				alert("Sorry, Something Went wrong. Please contact administration");
			}
		});
	});
});
 
 
    