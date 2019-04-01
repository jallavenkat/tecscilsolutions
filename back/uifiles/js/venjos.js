$(document).ready(function(){
	$("#login").click(function(){
		var email = $("#uEmail").val();
		var password = $("#uPassword").val();
		// Checking for blank fields.
		if( email =='' || password ==''){
			$('input[type="email"],input[type="password"]').css("border","2px solid red");
			$('input[type="email"],input[type="password"]').css("box-shadow","0 0 3px red");
			alert("Please fill all fields...!!!!!!");
		}
		else {
			$.post(baseurl+"adminvenjos/verifyUser",{ email1: email, password1:password},
			function(data) {
				if(data=='Invalid') {
					$('input[type="email"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
					$('input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
					location.reload();
					//alert(data);
				}
				else if(data=='Email or Password is wrong...!!!!'){
					$('input[type="email"],input[type="password"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
					//alert(data);
					location.reload();
				} 
				else if(data==1){
					$("form")[0].reset();
					$('input[type="email"],input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
					window.location.href=baseurl+'adminvenjos';
				} else{
					//alert(data);
				}
			});
		}
	});
});