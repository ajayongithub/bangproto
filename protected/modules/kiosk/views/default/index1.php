<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
        <title>Kiosk Page</title>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<style>
body {
    background-image: url('/images/sample.jpg')`;
} 

</style>
</head>
<body>
<script>
var current_login_status = "start";
window.fbAsyncInit = function() {
	// init the FB JS SDK
	FB.init({
		appId      : '706237152757938',  // App ID from the app dashboard
		status     : false,         // Check Facebook Login status
		xfbml      : true          // Look for social plugins on the page
	});
	console.log("Init Completed");



};

function doLogout(){
	FB.logout(function(response){
			console.log("Got Response on logout");
			console.log(response);
			window.location.reload(true);
			//FB.XFBML.parse();
		});
}
function doLogin(){
	console.log("Doing login"); 
// Additional initialization code such as adding Event Listeners goes here
FB.getLoginStatus(function(response) {
	if (response.status === 'connected') {
		console.log("Login Status Response ");
		console.log(response);
		// the user is logged in and has authenticated the app,
		FB.api('/me', function(response) 
			    {
			       console.log("User connected details are");
			       console.log(response);
			       console.log("Cookie is "); 
			       console.log( getCookie('siteId'));
				   FB.XFBML.parse();
			       sendDataToServer(response,getCookie("siteId"),getCookie("siteName") );
			    });
		
	} else if (response.status === 'not_authorized') {
		// the user is logged in to Facebook,
		// but has not authenticated the app
		FB.login(function(response) {
			current_login_status=response.status;
			if (response.authResponse) {
				window.location.reload(true);
				FB.XFBML.parse();
			} else {
				alert('User did not fully authorize.');
			}
		}, {scope: 'email,public_profile,user_friends'});
	} else {
		console.log(" the user isn't logged in to Facebook.");
		FB.login(function(response) {
			current_login_status=response.status;
			console.log("Response is ");
			console.log(response) ;
			console.log("Cookie is ");
		    console.log( getCookie("siteId") );
		    
			if (response.authResponse) {
				//window.location.reload(true);
					FB.XFBML.parse();
					FB.api('/me', function(response) 
			    {
			       console.log("User connected details are");
			       console.log(response);
			       console.log("Cookie is "); 
			       console.log( getCookie('siteId'));
			       sendDataToServer(response,getCookie("siteId"),getCookie("siteName") );
			    });

			} else {
				alert('User cancelled login or did not fully authorize.');
			}
		}, {scope:'email,public_profile,user_friends'});
	}
});
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}
function sendDataToServer(response,siteId,siteName){
	$.ajax({type:"POST",url:"<?php echo Yii::app()->createUrl('/kiosk/default/storeData')?>",data:{response:response,siteId:siteId,siteName:siteName },success:function(result){
	    //$("#div1").html(result);
	    console.log("Result recd is ");
	    console.log(result);
//	    window.location.reload(true);
	  }});
}
function PostToPage(uid,accessToken){
	FB.api("/me/accounts",
	function(response){
		console.log("Response is ") ;
		console.log(response) ;
		var page = response.data[0] ;
		FB.api('/'+page.id+'/feed',
		"POST",
		{
			'message':"Hello World"
		},
		function(response){
			console.log("Post response is ") ;
			console.log(response) ;
		}
		);
	}
	);
		
}

// Load the SDK asynchronously
(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/all.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<button id="loginBtn" onclick="doLogin();" type="button">Login to Facebook</button>
<button id="logoutBtn" onclick="doLogout();" type="button">Logout of Facebook</button>
<p>
<div class="fb-like" data-href="https://www.facebook.com/codeboilers" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
<p>
<p>
<p>
<p>
<div class="fb-like-box" data-href="https://www.facebook.com/codeboilers" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

</body>
</html>
