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
		$this->render('upload',array('user'=>$user)) ;
	}
	public function actionUpload(){
//		$msg = " id is ".$id ;
//		$user = UserDetails::model()->findByPk($id) ;
//		$msg .= " user name is ".$user->name ;
//		$user->remarks = "Done" ;
//		if($user->save()){
//			$msg .= "user saved.";
//		}else {
//			$msg .= print_r($user->error,true) ;
//		}
		Yii::log("Session is ".print_r($_SESSION,true));
//		Yii::app()->user->setFlash('flashMsg',$msg ) ;
		 
		/* if(isset($_SESSION['uploadUserId'])){
			$id =	$_SESSION['uploadUserId'] 	;
			$user = UserDetails::model()->findByPk($id) ;
			$this->render('upload',array('user'=>$user));
		}else*/
			$this->render('upload'); 
		echo 'Upload Redirected' ;
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