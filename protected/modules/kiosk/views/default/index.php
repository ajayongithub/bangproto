<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Login</title>
<link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true)?>/css/kiosk/ash/master.css" type="text/css" media="all" />
</head>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

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
// Load the SDK asynchronously
(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/all.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

				
function doLogin1(){
	
	console.log("Do Login now") ;
	doLike();
}
function doLike(){
	var actionStr = '<div class="action-box"><h4>SELECT ONE OF THE THREE ACTIONS</h4><a href="#" class="action-1"></a><a href="#" class="action-2"></a> <a href="#" class="action-3"></a> <p>AND</p> <a href="#" id="logout-btn" class="log-out"></a></div>';
	$('#mini-container').html(actionStr) ;
	$('#logout-btn').click(function(){doLogout();});
	

}

function doLogout(){
	console.log('callingLogout();');
	FB.logout(function(response){
			console.log("Got Response on logout");
			console.log(response);
			//window.location.reload(true);
			goToHomePage() ;
			FB.XFBML.parse();
		       ;
		});
}
function doLogin(){
	if($('#username').val() == ''){ alert("Please enter your name"); return ; }
	FB.logout(function(){console.log("Bugger has been logged off") ;});
	FB.login(function(response) {
		current_login_status=response.status;
		
		if (response.authResponse) {
			//window.location.reload(true);
				FB.XFBML.parse();
				FB.api('/me', function(response) 
		    {
		       sendDataToServer(response );
		       goToLikePage();
		    });
		} else {
				alert('User cancelled login or did not fully authorize.');
				doLogout();
			}
		}, {scope:'email,public_profile'});
	console.log("Doing login done for now"); 
	return ;
// Additional initialization code such as adding Event Listeners goes here
// FB.getLoginStatus(function(response) {
// 	if (response.status === 'connected') {
// 		console.log("Login Status Response ");
// 		console.log(response);
// 		// the user is logged in and has authenticated the app,
// 		FB.logout(function(){console.log("Bugger has been logged off") ;});
// 		console.log("logged out") ;
// 	/*	FB.api('/me', function(response) 
// 			    {
// 			       console.log("User connected details are");
// 			       console.log(response);
// 			       console.log("Cookie is "); 
// 			       console.log( getCookie('siteId'));
// 				   //FB.XFBML.parse();
// 			       //sendDataToServer(response );
// 			       //goToLikePage();
// 			    });*/
		
// 	} else if (response.status === 'not_authorized') {
// 		// the user is logged in to Facebook,
// 		// but has not authenticated the app
// 		FB.login(function(response) {
// 			current_login_status=response.status;
// 			if (response.authResponse) {
// 				//window.location.reload(true);
// 				FB.XFBML.parse();
// 			} else {
// 				alert('User did not fully authorize.');
// 				doLogout();
// 			}
// 		}, {scope: 'email,public_profile,user_friends'});
// 	} else {
// 		console.log(" the user isn't logged in to Facebook.");
// 		FB.login(function(response) {
// 			current_login_status=response.status;
			
// 			if (response.authResponse) {
// 				//window.location.reload(true);
// 					FB.XFBML.parse();
// 					FB.api('/me', function(response) 
// 			    {
// 			       sendDataToServer(response );
// 			       goToLikePage();
// 			    });

// 			} else {
// 				alert('User cancelled login or did not fully authorize.');
// 				doLogout();
// 			}
// 		}, {scope:'email,public_profile,user_friends'});
// 	}
// });
}			

function goToId(id){
		$('html, body').animate({
	        scrollTop: $(id).offset().top
	    }, 2000);
	}

function goToLikePage(){
	var likeStr = 	'<div class="action-box"><header> <h2>Welcome to Bang Bang Promotion Campaign</h2> </header>'
	+'<p>You can like our Facebook campaign page by clicking like below: <br />'
	+'<fb:like href="https://www.facebook.com/mountaindewindia" layout="button" action="like" show_faces="true" share="true"></fb:like> <br/> <p>AND</p> <a href="#" id="action-btn" class="action-btn"></a></div>';
	$('#mini-container').html(likeStr) ;
	FB.XFBML.parse();
	$('#action-btn').click(function(){doLike();})
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
	var siteId  = getCookie("siteId");
	var siteName = getCookie("siteName")
	$.ajax({type:"POST",url:"<?php echo Yii::app()->createUrl('/kiosk/default/storeData')?>",data:{response:response,siteId:siteId,siteName:siteName },success:function(result){
	    //$("#div1").html(result);
	    console.log("Result recd is ");
	    console.log(result);
//	    window.location.reload(true);
	  }});
}

$(document).ready(function(){goToHomePage();
// 						var loginStr = '<div class="login-box"><!-- <a href="#" class="name"></a> --> <input type="text" required name="username" id="username" placeholder="Name" class="name-text"/> <a id="login-btn" href="#" class="fb-btn"></a> </div>';
// 						$('#mini-container').html(loginStr) ;
// 						$('#login-btn').click(function(){doLogin()});
					});

function goToHomePage(){
	var loginStr = '<div class="login-box"><!-- <a href="#" class="name"></a> --> <input type="text" required name="username" id="username" placeholder="Name" class="name-text"/> <a id="login-btn" href="#" class="fb-btn"></a> </div>';
	$('#mini-container').html(loginStr) ;
	$('#login-btn').click(function(){doLogin()});
}
console.log("Getting login status");
//while(typeof(FB)=='undefined' &&  FB==null) ;
FB.getLoginStatus(function(response){
	console.log("Login Status Response ");
	console.log(response);
	// the user is logged in and has authenticated the app,
	if(response.status!=null)
	FB.logout(function(){console.log("Bugger has been logged off") ;});
	else
		console.log("No response");
});
</script>
<body>
	<div class="main-container">
    	<div id="mini-container"></div>
		<div class="img-left"><img src="<?php echo Yii::app()->getBaseUrl(true)?>/images/kiosk/ash/left-img.png" ></div>
        <div class="img-right"><img src="<?php echo Yii::app()->getBaseUrl(true)?>/images/kiosk/ash/right-img.png" ></div>
        <div class="text-footer">
        	<strong>discalimer: </strong>
			<p>your facebook id and information contained in it will only be used for the mountain dew bang bang
            promotion only. no criticle data will be saved and other legal blah blah blah</p>
        </div>
    </div>
    
<!--     	<div id="login-div" display="hidden">
    		<div class="login-box">
    			<a href="#" class="name"></a> 
    			<input type="text" required name="username" id="username" placeholder="Name" class="name-text"/> 
            	<a href="#" class="fb-btn"></a>
        	</div>
        </div>
 -->    
</body>
</html>
