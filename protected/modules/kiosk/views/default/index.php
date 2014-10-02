<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mountain Dew : Heroes Wanted</title>
<link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(); ?>/css/kiosk/ash/master.css" type="text/css" media="all" />
</head>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script>
var current_login_status = "start";

 window.fbAsyncInit = function() {
 	// init the FB JS SDK
 	FB.init({
 		appId      : '706237152757938',  // App ID from the app dashboard
 		status     : true,         // Check Facebook Login status
 		xfbml      : true          // Look for social plugins on the page
 	});
 	console.log("Init Completed");
	
 	FB.logout();
 	buildLoginPage(); 
};

function buildLoginPage(){
	var loginStr = '<div class="login-box">'
					+'<input type="text" placeholder="Enter Name" id="username" class="form-input">'
					+'<a href="#" id="loginBtn" target="_blank" class="btn fb-btn">Login Using Facebook</a><br/><br/><br/>'    
    				+'<a class="tos" href="<?php echo Yii::app()->createUrl('kiosk/default/tos')?>">Terms and Conditions</a>'
					+'</div>';
	$('#mini-container').html(loginStr);
	$('#loginBtn').click(function(){doLogin();});	
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
function doLogin(){
	if($('#username').val() == ''){ alert("Please enter your name"); return ; }
	
	FB.login(function(response) {
		current_login_status=response.status;
		console.log("Status ".current_login_status);
		if (response.authResponse) {
			//window.location.reload(true);
			FB.api('/me', function(response) {
				console.log("Go to server and like pages");
		       sendDataToServer(response );
		    
		    });
		} else {
				alert('User cancelled login or did not fully authorize.');
				//doLogout();
				FB.logout(function(response){console.log("loging off unauthorized");});
			}
		}, {scope:'email,public_profile'});
	console.log("Doing login done for now"); 
	return ;
}
function sendDataToServer(response){
	var siteId  = getCookie("siteId");
	var siteName = getCookie("siteName")
		var name = $('#username').val();
	$.ajax({type:"POST",url:"<?php echo Yii::app()->createUrl('/kiosk/default/storeData')?>",data:{response:response,userName:name },success:function(result){
	    //$("#div1").html(result);
// 	    console.log("Result recd is ");
 	    console.log(result);
 	    if(result=='Success') {
 	 	    buildLikePage();
 	    }else{
				alert("Unable to register your request, please try after some time.");
				FB.logout(function(response){buildLoginPage();});
 	 	    }
//	    window.location.reload(true);
	  }});
}
function buildLikePage(){
				
	var likeButtonFBML = '<fb:like href="https://www.facebook.com/mountaindewindia" layout="standard" action="like" show_faces="true" share="false"></fb:like>' ;
	var likeButtonHtml5 = '<div class="fb-like" data-href="https://www.facebook.com/mountaindewindia" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>'
	var likeButtonUrl = 'http://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fmountaindewindia&width&layout=standard&action=like&show_faces=true&share=false&height=80&appId=706237152757938' ;
	var logoutMsg = '	<h3>Go! become a HERO!</h3> <a href="#" id="logoutBtn" class="btn logout">Log Out</a>'
		var topPage = 	'<div class="fb-like-box">'
			+'<p>Welcome to Heroes Wanted page like us on Facebook</p>'	
			//+'<a href="#"  class="btn fb-btn">Like Button</a>'
			+likeButtonFBML +logoutMsg+'</div>' ;
		
		$('#mini-container').html(topPage);
		FB.XFBML.parse();
		//$('#logoutBtn').click(function(){FB.logout(function(response){console.}});
	$('#logoutBtn').click(function(){console.log("logout manual ");FB.logout(function(response){console.log("Trying to logout");buildLoginPage();});});
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
<body>
	
	<div class="main-container">
		<div id="mini-container">
    
        </div>
    	<div class="img-left"><img src="<?php echo Yii::app()->getBaseUrl(); ?>/images/kiosk/ash/left-img.png" ></div>
        <div class="img-right"><img src="<?php echo Yii::app()->getBaseUrl(); ?>/images/kiosk/ash/right-img.png" ></div>

    </div>
</body>
</html