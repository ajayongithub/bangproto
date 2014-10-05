<?php

class DefaultController extends Controller
{
	
	private function getBaseUploadPathForFile($file){
		$loc = $file->location;
		$path = Yii::app()->getBasePath().'//..//'.Yii::app()->params['localUpload'].'//2014//' ;
		return $path ;
	}
	private function getBaseDownloadPath(){
		$path = Yii::app()->getBasePath().'//..//'.Yii::app()->params['localComposite'].'//' ;
		return $path ;
	}
	public function getCompositeFileName($file){
		$splitArr = str_split($file->gender) ;
		return $file->id.'_'.$splitArr[0].'_'.$file->extra.'_comp.mov' ;
	}
	public function actionFetchProcessedFiles(){
		
		$filesLinked = UserDetails::model()->findAllByAttributes(array('status'=>'Video Uploaded' , 'posting_status'=>null));
	//	echo 'count uploaded is '.count($processing) ;
		if(count($filesLinked)==0) $this->redirect('index') ;
		        
		foreach($filesLinked as $file){   
			//echo 'Checking for file '.$file->original_video ;
			//echo 'Path is '.$this->getBaseDownloadPath() ;
			if(file_exists($this->getBaseDownloadPath().$this->getCompositeFileName($file))){
				//echo "file Exists" ;
				$file->posting_status = 'Processing Complete';
				$file->save();
			}else{
				//echo 'File does not exist ' ; 
			}
		
		}
		
/*  		$conn_id = ftp_connect(Yii::app()->params['remoteHost']);
		// login with username and password
		$login_result = ftp_login($conn_id, Yii::app()->params['remoteUser'] , Yii::app()->params['remotePwd'] );
		ftp_chdir($conn_id,Yii::app()->params['downloadDir']);
		Yii::log("4");
		foreach($processing as $file){
			$splitArr = str_split($file->gender) ;
			$remoteFileName = $file->id."_".$splitArr[0].'_'.$file->extra.'_comp.*' ;
			$retResult = ftp_nlist($conn_id,$remoteFileName) ;
			if($retResult!=false){
				ftp_get($conn_id, Yii::app()->getBasePath().'//..//composite//'.$retResult[0], $retResult[0],FTP_BINARY);
				$file->posting_status = 'Processing Complete';
				$file->composite_video = Yii::app()->getBasePath().'//..//composite//'.$retResult[0] ;
				$file->save();
			}	
		}
		ftp_close($conn_id); */
	$this->redirect('index');
	}
	public function checkVideoUploaded(){

		$filesLinked = UserDetails::model()->findAllByAttributes(array('status'=>'File Linked'));
		//echo count($filesLinked) ;
		if(count($filesLinked)==0) return ;//$this->redirect('index') ;
		foreach($filesLinked as $file){
			//echo 'Checking for file '.$file->original_video ;
			//echo 'Path is '.$this->getBaseUploadPathForFile($file) ;
			if(file_exists($this->getBaseUploadPathForFile($file).$file->original_video)){
				//echo "file Exists" ;
				$file->status = 'Video Uploaded';
				$file->save();
			}else{
				//echo 'File does not exist ' ;	
			}
				
		}
	}
	public function actionFetchRawVideo(){
		$retVal = "NULL";	
		$id = $_POST['href'];
		$user = UserDetails::model()->findByPk($id) ;
		if($user!=null){
			$file = $user->original_video ;
			$remoteBaseName = basename($file);
			$uploadFolder = Yii::app()->basePath.'//..//'.Yii::app()->params['localUpload'].'//' ;
			$splitArr = str_split($file->gender) ;
			$remoteFileBase = $user->id.'_'.$splitArr[0].'_'.$user->extra;
			$conn_id = ftp_connect(Yii::app()->params['remoteHost']);
			// login with username and password
			$login_result = ftp_login($conn_id, Yii::app()->params['remoteUser'] , Yii::app()->params['remotePwd'] );
			ftp_chdir($conn_id,Yii::app()->params['uploadDir']);
			if (ftp_put($conn_id, $remoteBaseName, $file,FTP_BINARY)&&
				ftp_put($conn_id, $remoteFileBase.'.nk',$uploadFolder.$remoteFileBase.'.nk',FTP_ASCII)) {
				//echo "successfully uploaded $fileName \n";
				$user->posting_status = 'Studio Updated' ;
				$retVal = 'Success in fetching files.\n' ;	
			} else {
				//echo "There was a problem while uploading $fileName\n";
				$user->posting_status = 'Studio Update Failure' ;
				$retVal = 'Failure in fetching files.\n' ;	
			}
			if(!$user->save()){
				$retVal .= 'Error in saving to db.' ;	
			}
		}
		echo $retVal ;
	}
	public function actionIndex()
	{
		$this->checkVideoUploaded() ;
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new UserDetails('search');
		$model->unsetAttributes();
	//	$model->location = Yii::app()->request->cookies['siteName'];
			
		if (isset($_GET['UserDetails']))
			$model->setAttributes($_GET['UserDetails']);
	
		$this->render('admin', array(
				'model' => $model,
		));
	}
	public function actionPublishVideoold()
	{
			$this->render('video');//,array('user'=>$user)); 
	}
	public function actionPostUpload(){
		echo print_r($_REQUEST);
	}
	public function actionPublishVideo($id){
		$user = UserDetails::model()->findByPk($id) ;
		$key = file_get_contents(Yii::app()->getBasePath().'/data/the_key.txt');
		
		//set_include_path($_SERVER['DOCUMENT_ROOT'] . '/path-to-your-director/');
		Yii::import('application.vendors.*');
// Call set_include_path() as needed to point to your client library.
		require_once 'Google/Client.php';
		require_once 'Google/Service/YouTube.php';
				
		$application_name = 'Heroes Wanted';
		$client_id = '848033571411-ingtlu5o7mqoghghj2mn1i31rnkimlu9.apps.googleusercontent.com';
		$client_secret = '25TLrHGwW08rRj1Kdg-RC-j6';
		
//		$client_secret = 'XXXXXXX';
//		$client_id = 'XXXXXXX.apps.googleusercontent.com';
		$scope = array('https://www.googleapis.com/auth/youtube.upload', 'https://www.googleapis.com/auth/youtube', 'https://www.googleapis.com/auth/youtubepartner');
		 
		//$videoPath = "tutorial.mp4";
		$splitArr = str_split($user->gender) ;
		$compName = $user->id.'_'.$splitArr[0].'_'.$user->extra.'_comp.mov' ;
		
		$videoPath  = "/var/chroot/home/content/92/8982692/html/hw/composite/".$compName;
		
		$videoTitle = $user->first_name." joined the league of heroes #heroeswanted";
		$videoDescription = $user->first_name." Go Bang Bang with Mountain Dew India";
		$videoCategory = "22";
		$videoTags = array("#MountainDewBangBang","#HeroesWanted");
		
		
		try{
			// Client init
			$client = new Google_Client();
			$client->setApplicationName($application_name);
			$client->setClientId($client_id);
			$client->setAccessType('offline');
			$client->setAccessToken($key);
			$client->setScopes($scope);
			$client->setClientSecret($client_secret);
		
			if ($client->getAccessToken()) {
		
				/**
				 * Check to see if our access token has expired. If so, get a new one and save it to file for future use.
				 */
				if($client->isAccessTokenExpired()) {
					$newToken = json_decode($client->getAccessToken());
					$client->refreshToken($newToken->refresh_token);
					file_put_contents(Yii::app()->getBasePath().'/data/the_key.txt', $client->getAccessToken());
				}
		
				$youtube = new Google_Service_YouTube($client);
		
		
		
				// Create a snipet with title, description, tags and category id
				$snippet = new Google_Service_YouTube_VideoSnippet();
				$snippet->setTitle($videoTitle);
				$snippet->setDescription($videoDescription);
				$snippet->setCategoryId($videoCategory);
				$snippet->setTags($videoTags);
		
				// Create a video status with privacy status. Options are "public", "private" and "unlisted".
				$status = new Google_Service_YouTube_VideoStatus();
				$status->setPrivacyStatus('public');
		
				// Create a YouTube video with snippet and status
				$video = new Google_Service_YouTube_Video();
				$video->setSnippet($snippet);
				$video->setStatus($status);
		
				// Size of each chunk of data in bytes. Setting it higher leads faster upload (less chunks,
				// for reliable connections). Setting it lower leads better recovery (fine-grained chunks)
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
		
		
				// Read the media file and upload it chunk by chunk.
				$status = false;
				$handle = fopen($videoPath, "rb");
				while (!$status && !feof($handle)) {
					$chunk = fread($handle, $chunkSizeBytes);
					$status = $media->nextChunk($chunk);
				}
		
				fclose($handle);
		
				/**
				 * Vidoe has successfully been upload, now lets perform some cleanup functions for this video
				*/
				if ($status->status['uploadStatus'] == 'uploaded') {
					$htmlBody = "<h3>Video Uploaded</h3><ul>";
					$htmlBody .= sprintf('<li>%s (%s)</li>',
							$status['snippet']['title'],
							$status['id']);
					$url  = "http://youtube.com/watch?v=".$status["id"];
					// Actions to perform for a successful upload
					$user->remarks = $url ;
					$user->posting_status = "Uploaded" ;
					$user->save();
				}
		
				// If you want to make other calls after the file upload, set setDefer back to false
				$client->setDefer(true);
		
			} else{
				// @TODO Log error
				echo 'Problems creating the client';
			}
		
		} catch(Google_Service_Exception $e) {
			print "Caught Google service Exception ".$e->getCode(). " message is ".$e->getMessage();
			print "Stack trace is ".$e->getTraceAsString();
		}catch (Exception $e) {
			print "Caught Google service Exception ".$e->getCode(). " message is ".$e->getMessage();
			print "Stack trace is ".$e->getTraceAsString();
		}
		echo $htmlBody ;
		//$this->render('upload',array('user'=>$user)) ;
	}
	public function actionUpload(){
		Yii::log("Session is ".print_r($_SESSION,true));
		
		if (isset($_GET['code'])) {
			if (strval($_SESSION['state']) !== strval($_GET['state'])) {
				die('The session state did not match.');
			}
		
			$client->authenticate($_GET['code']);
			$_SESSION['token'] = $client->getAccessToken();
		
		}
		
		if (isset($_SESSION['token'])) {
			$client->setAccessToken($_SESSION['token']);
			echo '<code>' . $_SESSION['token'] . '</code>';
		}
		
		// Check to ensure that the access token was successfully acquired.
		if ($client->getAccessToken()) {
			try {
				// Call the channels.list method to retrieve information about the
				// currently authenticated user's channel.
				$channelsResponse = $youtube->channels->listChannels('contentDetails', array(
						'mine' => 'true',
				));
		
				$htmlBody = '';
				foreach ($channelsResponse['items'] as $channel) {
					// Extract the unique playlist ID that identifies the list of videos
					// uploaded to the channel, and then call the playlistItems.list method
					// to retrieve that list.
					$uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];
		
					$playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
							'playlistId' => $uploadsListId,
							'maxResults' => 50
					));
		
					$htmlBody .= "<h3>Videos in list $uploadsListId</h3><ul>";
					foreach ($playlistItemsResponse['items'] as $playlistItem) {
						$htmlBody .= sprintf('<li>%s (%s)</li>', $playlistItem['snippet']['title'],
								$playlistItem['snippet']['resourceId']['videoId']);
					}
					$htmlBody .= '</ul>';
				}
			} catch (Google_ServiceException $e) {
				$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
						htmlspecialchars($e->getMessage()));
			} catch (Google_Exception $e) {
				$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
						htmlspecialchars($e->getMessage()));
			}
		
			$_SESSION['token'] = $client->getAccessToken();
		} else {
			$state = mt_rand();
			$client->setState($state);
			$_SESSION['state'] = $state;
		
			$authUrl = $client->createAuthUrl();
			$htmlBody = <<<END
  <h3>Authorization Required</h3>
  <p>You need to <a href="$authUrl">authorise access</a> before proceeding.<p>
END;
		}
		
		
		//	$this->render('upload'); 
		echo $htmlBody ;
	}
	public function actionMarkBeginProcessing(){
		$ref = $_POST['href'];
		
		$params = explode('_',$ref) ;
		$id= $params ;
		$user = UserDetails::model()->findByPk($id);
		$user->posting_status = "Processing" ;
		if($user->save()){
			echo "Success";
		}else{
			echo "Failure" ;
		}
	}
	
	public function actionUpdatePostStatus(){
		$id = $_POST['href'];
		$status = $_POST['pStatus'] ;
		$user = UserDetails::model()->findByPk($id);
		$user->posting_status = $status ;
		if($user->save()){
			echo "Success";
		}else{
			echo "Failure" ;
		}
	}
	
}