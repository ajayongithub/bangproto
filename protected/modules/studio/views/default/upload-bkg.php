<?php
Yii::import('application.vendors.*');
// Call set_include_path() as needed to point to your client library.
require_once 'Google/Client.php';
require_once 'Google/Service/YouTube.php';
if(!isset($_SESSION)){
	session_start();
}else{
	Yii::log('Session already started'.print_r($_SESSION,true)) ;
}

/*
 * You can acquire an OAuth 2.0 client ID and client secret from the
 * Google Developers Console <https://console.developers.google.com/>
 * For more information about using OAuth 2.0 to access Google APIs, please see:
 * <https://developers.google.com/youtube/v3/guides/authentication>
 * Please ensure that you have enabled the YouTube Data API for your project.
 */
$OAUTH2_CLIENT_ID = '848033571411-ingtlu5o7mqoghghj2mn1i31rnkimlu9.apps.googleusercontent.com';
$OAUTH2_CLIENT_SECRET = '25TLrHGwW08rRj1Kdg-RC-j6';

$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');


$redirect = 'http://splatstudio.in/hw/studio/default/upload';//?id='.$user->id;
$client->setRedirectUri($redirect);
$_SESSION['yt_user_id'] = $user->id ;
// Define an object that will be used to make all API requests. 
$youtube = new Google_Service_YouTube($client);
echo "1.1" ;
if (isset($_GET['code'])) {
  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
    die('The session state did not match.');
  }
  
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: ' . $redirect);
}
echo "2.1" ;

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']); 
}
echo "3.1" ;

// Check to ensure that the access token was successfully acquired.
if ($client->getAccessToken()) {
echo "4.1" ;
  try{
    // REPLACE this value with the path to the file you are uploading.
   // $videoPath = "/home/u768579415/public_html/video.mp4";
    //$videoPath = $user->composite_video ;
  	$splitArr = str_split($user->gender) ;
  	$compName = $user->id.'_'.$splitArr[0].'_'.$user->extra.'_comp.mov' ;
  	 
  	$videoPath  = "/var/chroot/home/content/92/8982692/html/hw/composite/".$compName;

    // Create a snippet with title, description, tags and category ID
    // Create an asset resource and set its snippet metadata and type.
    // This example sets the video's title, description, keyword tags, and
    // video category.
    $snippet = new Google_Service_YouTube_VideoSnippet();
    $snippet->setTitle($user->first_name." joined the league of heroes #heroeswanted");
    $snippet->setDescription($user->first_name." Go Bang Bang with Mountain Dew India");
    $snippet->setTags(array("#MountainDewBangBang","#HeroesWanted"));

    // Numeric video category. See
    // https://developers.google.com/youtube/v3/docs/videoCategories/list 
    $snippet->setCategoryId("22");
	
    // Set the video's status to "public". Valid statuses are "public",
    // "private" and "unlisted".
    $status = new Google_Service_YouTube_VideoStatus();
    $status->privacyStatus = "public";

    // Associate the snippet and status objects with a new video resource.
    $video = new Google_Service_YouTube_Video();
    $video->setSnippet($snippet);
    $video->setStatus($status);

    // Specify the size of each chunk of data, in bytes. Set a higher value for
    // reliable connection as fewer chunks lead to faster uploads. Set a lower
    // value for better recovery on less reliable connections.
    $chunkSizeBytes = 1 * 1024 * 1024;

    // Setting the defer flag to true tells the client to return a request which can be called
    // with ->execute(); instead of making the API call immediately.
    $client->setDefer(true);

    // Create a request for the API's videos.insert method to create and upload the video.
    $insertRequest = $youtube->videos->insert("status,snippet", $video);

    // Create a MediaFileUpload object for resumable uploads.
    $media = new Google_Http_MediaFileUpload(
        $client,
        $insertRequest,
        'video/*',
        null,
        true,
        $chunkSizeBytes
    );
    $media->setFileSize(filesize($videoPath));
	$htmlBody = "";
    Yii::import('ext.runactions.components.ERunActions');
    
    if (ERunActions::runBackground())
    {
    	
    // Read the media file and upload it chunk by chunk.
    	$status = false;
    	$handle = fopen($videoPath, "rb");
    	while (!$status && !feof($handle)) {
      		$chunk = fread($handle, $chunkSizeBytes);
      		$status = $media->nextChunk($chunk);
    	}

    	fclose($handle);

    // If you want to make other calls after the file upload, set setDefer back to false
    	$client->setDefer(false);


    	$htmlBody1 = "<h3>Video Uploaded</h3><ul>";
    	$htmlBody1 .= sprintf('<li>%s (%s)</li>',
        $status['snippet']['title'],
        $status['id']);
		$url  = "http://youtube.com/watch?v=".$status["id"] ;
	
    	$htmlBody1 .= '<li>Url is : <a href="http://youtube.com/watch?v='.$status["id"].'">http://youtube.com/watch?v='.$status["id"].'</a>';
    	$htmlBody1 .= '</ul>';
    	$htmlBody1 .= '<hr/>' ;
    	$htmlBody1 .= '<hr/>' ;
    //$htmlBody .= print_r($status,true);
		$htmlBody1 .= 'you tube user id :'.$_SESSION['yt_user_id'] ;
		$user->remarks = $url ;
		$user->posting_status = "Uploaded" ;
		$user->save();
		Yii::log("Upload completed".$htmlBody1);
    }
		//$replacedContent = str_replace(array("<<<username>>>","<<<yt_link>>>"),array($user->name,$url),$mailContent) ;
	//$retVal = mail($user->email,"Your Heroes Wanted trailer",$replacedContent,"From: mountaindewindia@gmail.com ");
	//$retVal = mail("dummyheroes@gmail.com","Your Heroes Wanted trailer",$replacedContent,"From: mountaindewindia@gmail.com ");
  } catch (Google_ServiceException $e) {
	//echo "5.1" ;
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
	echo "6.1" ;
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
  }

	echo "7.1" ;
  $_SESSION['token'] = $client->getAccessToken();
	echo "7.2" ;
} else {
  // If the user hasn't authorized the app, initiate the OAuth flow
	echo "8.1" ;
  $state = mt_rand();
  $client->setState($state);
  $_SESSION['state'] = $state;
  $_SESSION['uploadUserId'] = $user->id ;

  $authUrl = $client->createAuthUrl();
  $htmlBody = <<<END
  <h3>Authorization Required</h3>
  <p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
	echo "9.1" ;
}
?>

<!doctype html>
<html>
<head>
<title>Video Uploaded</title>
</head>
<body>
  <?=$htmlBody?>
</body>
</html>