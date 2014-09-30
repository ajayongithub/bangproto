<!DOCTYPE HTML>
<!--
-->
<html xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<title>Bang Bang</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="<?php echo Yii::app()->baseUrl;?>/css/kiosk/ie/html5shiv.js"></script><![endif]-->
		<script src="<?php echo Yii::app()->baseUrl?>/js/kiosk/jquery.min.js"></script>
		<script src="<?php echo Yii::app()->getBaseUrl(true);?>/js/kiosk/jquery.scrolly.min.js"></script>
		<script src="<?php echo Yii::app()->getBaseUrl(true);?>/js/kiosk/jquery.poptrox.min.js"></script>
		<script src="<?php echo Yii::app()->getBaseUrl(true);?>/js/kiosk/skel.min.js"></script>
		<script src="<?php echo Yii::app()->getBaseUrl(true);?>/js/kiosk/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true);?>/css/kiosk/skel.css" />
			<link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true);?>/css/kiosk/style.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true);?>/css/kiosk/ie/v8.css" /><![endif]-->

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
		// Load the SDK asynchronously
		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		function doLogout(){
			FB.logout(function(response){
					console.log("Got Response on logout");
					console.log(response);
					//window.location.reload(true);
					FB.XFBML.parse();
				       goToId("#header");
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
					       sendDataToServer(response );
					       goToId("#banner");
					    });
				
			} else if (response.status === 'not_authorized') {
				// the user is logged in to Facebook,
				// but has not authenticated the app
				FB.login(function(response) {
					current_login_status=response.status;
					if (response.authResponse) {
						//window.location.reload(true);
						FB.XFBML.parse();
					} else {
						alert('User did not fully authorize.');
						doLogout();
					}
				}, {scope: 'email,public_profile,user_friends'});
			} else {
				console.log(" the user isn't logged in to Facebook.");
				FB.login(function(response) {
					current_login_status=response.status;
					
					if (response.authResponse) {
						//window.location.reload(true);
							FB.XFBML.parse();
							FB.api('/me', function(response) 
					    {
					       sendDataToServer(response );
					       goToId("#banner");
					    });

					} else {
						alert('User cancelled login or did not fully authorize.');
						doLogout();
					}
				}, {scope:'email,public_profile,user_friends'});
			}
		});
		}			
		
		function goToId(id){
				$('html, body').animate({
			        scrollTop: $(id).offset().top
			    }, 2000);
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
//			    window.location.reload(true);
			  }});
		}
		</script>
  
		<!-- Header -->
			<section id="header" style="{background-image:url('<?php echo Yii::app()->baseUrl?>/images/sample.jpg'); }">
				<header>
					<h1>Bang Bang</h1>
					<p>By Splat Studio</p>
				</header>
				<footer>
					<a onclick="doLogin();" class="button style2 scrolly scrolly-centered">Login using Facebook</a>
				</footer>
			</section>
		
		<!-- Banner -->
			<section id="banner">
				<header>
					<h2>Welcome to Bang Bang Promotion Campaign</h2>
				</header>
				<p>You can like our Facebook campaign page by clicking like below: 
				<br />
				<fb:like href="http://www.facebook.com/codeboilers" layout="standard" action="like" show_faces="true" share="true"></fb:like>
				<br/>
				<fb:like-box href="http://www.facebook.com/codeboilers" colorscheme="light" show_faces="true" header="true" stream="false" show_border="true"></fb:like-box>			
				<footer>
					<a onclick='goToId("#actionStyle");' class="button style2 scrolly">Get to the action</a>
				</footer>
			</section>

	
		<!-- Portfolio -->
			<section id="actionStyle">
			<article  class="container box style2">
				<header>
					<h2>Choose Your Action Style</h2>
					<p>You can select one of the actions that you would like to perform.</p>
				</header>
				<div class="inner gallery">
					<div class="row flush">
						<div class="3u"><a href="<?php echo Yii::app()->baseUrl?>/images/kiosk/fulls/01.jpg" class="image fit"><img src="<?php echo Yii::app()->baseUrl?>/images/kiosk/thumbs/01.jpg" alt="" title="Ad infinitum" /></a></div>
						<div class="3u"><a href="<?php echo Yii::app()->baseUrl?>/images/kiosk/fulls/02.jpg" class="image fit"><img src="<?php echo Yii::app()->baseUrl?>/images/kiosk/thumbs/02.jpg" alt="" title="Dressed in Clarity" /></a></div>
						<div class="3u"><a href="<?php echo Yii::app()->baseUrl?>/images/kiosk/fulls/03.jpg" class="image fit"><img src="<?php echo Yii::app()->baseUrl?>/images/kiosk/thumbs/03.jpg" alt="" title="Raven" /></a></div>
						 <div class="3u"><a href="<?php echo Yii::app()->baseUrl?>/images/kiosk/fulls/04.jpg" class="image fit"><img src="<?php echo Yii::app()->baseUrl?>/images/kiosk/thumbs/04.jpg" alt="" title="I'll have a cup of Disneyland, please" /></a></div> 
					</div>
					<div class="row flush">
		<!-- 				<div class="3u"><a href="images/fulls/05.jpg" class="image fit"><img src="images/thumbs/05.jpg" alt="" title="Cherish" /></a></div> -->
<!-- 						<div class="3u"><a href="images/fulls/06.jpg" class="image fit"><img src="images/thumbs/06.jpg" alt="" title="Different." /></a></div>
						<div class="3u"><a href="images/fulls/07.jpg" class="image fit"><img src="images/thumbs/07.jpg" alt="" title="History was made here" /></a></div>
 -->						<!-- <div class="3u"><a href="images/fulls/08.jpg" class="image fit"><img src="images/thumbs/08.jpg" alt="" title="People come and go and walk away" /></a></div> -->
					</div>
				</div>
				<footer>
					<a  onclick='doLogout();' class="button style2 scrolly">Logout</a>
				</footer>
			</article>
		</section>
		<!-- Contact -->
			<!-- <article class="container box style3">
				<header>
					<h2>Nisl sed ultricies</h2>
					<p>Diam dignissim lectus eu ornare volutpat orci.</p>
				</header>
				<form method="post" action="#">
					<div class="row half">
						<div class="6u"><input type="text" class="text" name="name" placeholder="Name" /></div>
						<div class="6u"><input type="text" class="text" name="email" placeholder="Email" /></div>
					</div>
					<div class="row half">
						<div class="12u">
							<textarea name="message" placeholder="Message"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="12u">
							<ul class="actions">
								<li><input type="submit" value="Send Message" /></li>
							</ul>
						</div>
					</div>
				</form>
			</article>
 -->		
		<!-- Generic -->
		<!--
			<article class="container box style3">
				<header>
					<h2>Generic Box</h2>
					<p>Just a generic box. Nothing to see here.</p>
				</header>
				<section>
					<header>
						<h3>Paragraph</h3>
						<p>This is a subtitle</p>
					</header>
					<p>Phasellus nisl nisl, varius id <sup>porttitor sed pellentesque</sup> ac orci. Pellentesque 
					habitant <strong>strong</strong> tristique <b>bold</b> et netus <i>italic</i> malesuada <em>emphasized</em> ac turpis egestas. Morbi 
					leo suscipit ut. Praesent <sub>id turpis vitae</sub> turpis pretium ultricies. Vestibulum sit 
					amet risus elit.</p>
				</section>
				<section>
					<header>
						<h3>Blockquote</h3>
					</header>
					<blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget.
					tempus euismod. Vestibulum ante ipsum primis in faucibus.</blockquote>
				</section>
				<section>
					<header>
						<h3>Divider</h3>
					</header>
					<p>Donec consectetur <a href="#">vestibulum dolor et pulvinar</a>. Etiam vel felis enim, at viverra 
					ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel. Praesent nec orci 
					facilisis leo magna. Cras sit amet urna eros, id egestas urna. Quisque aliquam 
					tempus euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices 
					posuere cubilia.</p>
					<hr />
					<p>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra 
					ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel. Praesent nec orci 
					facilisis leo magna. Cras sit amet urna eros, id egestas urna. Quisque aliquam 
					tempus euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices 
					posuere cubilia.</p>
				</section>
				<section>
					<header>
						<h3>Unordered List</h3>
					</header>
					<ul class="default">
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
					</ul>
				</section>
				<section>
					<header>
						<h3>Ordered List</h3>
					</header>
					<ol class="default">
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
					</ol>
				</section>
				<section>
					<header>
						<h3>Table</h3>
					</header>
					<div class="table-wrapper">
						<table class="default">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Description</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>45815</td>
									<td>Something</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>29.99</td>
								</tr>
								<tr>
									<td>24524</td>
									<td>Nothing</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>19.99</td>
								</tr>
								<tr>
									<td>45815</td>
									<td>Something</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>29.99</td>
								</tr>
								<tr>
									<td>24524</td>
									<td>Nothing</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>19.99</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3"></td>
									<td>100.00</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</section>
				<section>
					<header>
						<h3>Form</h3>
					</header>
					<form method="post" action="#">
						<div class="row">
							<div class="6u">
								<input class="text" type="text" name="name" id="name" value="" placeholder="John Doe" />
							</div>
							<div class="6u">
								<input class="text" type="text" name="email" id="email" value="" placeholder="johndoe@domain.tld" />
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<select name="department" id="department">
									<option value="">Choose a department</option>
									<option value="1">Manufacturing</option>
									<option value="2">Administration</option>
									<option value="3">Support</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<input class="text" type="text" name="subject" id="subject" value="" placeholder="Enter your subject" />
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<textarea name="message" id="message" placeholder="Enter your message"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<ul class="actions">
									<li><input type="submit" value="Submit" /></li>
									<li><input type="reset" class="style3" value="Clear Form" /></li>
								</ul>
							</div>
						</div>
					</form>
				</section>
			</article>
		-->
		
		<section id="footer">
			<ul class="icons">
<!-- 				<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
				<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
				<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
				<li><a href="#" class="icon fa-pinterest"><span class="label">Pinterest</span></a></li>
				<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
				<li><a href="#" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
 -->			</ul>
			<div class="copyright">
				<ul class="menu">
					<!-- <li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li> -->
				</ul>
			</div>
		</section>

	</body>
</html>