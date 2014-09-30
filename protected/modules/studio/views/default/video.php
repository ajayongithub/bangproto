<?php
 
Yii::import('application.vendors.*');
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
 
     $authenticationURL = 'https://www.google.com/accounts/ClientLogin';
 
     $httpClient = Zend_Gdata_ClientLogin::getHttpClient(
                      $username          = 'ajay.work11',
                      $password           = 'ajay4work',
                      $service           = 'youtube',
                      $client           = null,
                      $source           = 'Heroes Wanted',
                      $loginToken           = null,
                      $loginCaptcha      = null,
                      $authenticationURL);
     $devkey = 'AI39si46zwkIWokHimGp8yHJyKVugkmmSPo6JuiOQaKidSr1w_zN-VccQ1DPQAy_oqHWdbws2o6gqV9iikah9PjtBgDkcf7pUw';
 
          $yt = new Zend_Gdata_YouTube($httpClient, 'Splat-HeroesWanted-1.0', '848033571411-ingtlu5o7mqoghghj2mn1i31rnkimlu9.apps.googleusercontent.com', $devkey);
          
          $video = new Zend_Gdata_YouTube_VideoEntry();
 
 
          $video->setVideoTitle('Your video title');
          $video->setVideoDescription('Description of the video');
         // $video->setVideoPrivate();
          $video->setVideoCategory('Entertainment'); // see Youtube. Else you may get an error. Avoid using People & Blogs. People alone or Blogs alone is good.
          $video->SetVideoTags('apps');
          $handler_url     = 'http://gdata.youtube.com/action/GetUploadToken';
          try{
          $token_array     = $yt->getFormUploadToken($video, $handler_url);
          }catch(Exception $ex){
          	var_dump($ex);
          	echo 'Exception ';
          }
 echo "Hello there".print_r($token_array,true) ;
          $token          = $token_array['token'];   
          $post_url     = $token_array['url'];
          $next_url      = 'http://splatstudio.in/bangbang/studio/default/upload' ; ///id/'.$user->id;
          echo $post_url ;
          echo $next_url ;

?>
 
<form action="<?php echo $post_url ?>?nexturl=<?php echo $next_url ?>"
method="post" enctype="multipart/form-data">
     <input name="file" type="file"/>
     <input name="token" type="hidden" value="<?php echo $token ?>"/>
     <input value="Upload Video File" type="submit" />
</form>