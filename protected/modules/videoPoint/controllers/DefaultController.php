<?php

class DefaultController extends Controller
{
	
	public function actionIndex() {
		$model = new UserDetails('searchVideoPoint');
		$model->unsetAttributes();
		$model->location = Yii::app()->request->cookies['siteName'];
			
		if (isset($_GET['UserDetails']))
			$model->setAttributes($_GET['UserDetails']);
	
		$this->render('admin', array(
				'model' => $model,
		));
	}
	public function actionVideo($id){
		$this->render('video',array('userId'=>$id));
	}
	
	public function actionLinkFile(){
		//echo print_r($_REQUEST,true ) ;
		$id = $_REQUEST['id'] ;
		if(!isset($_REQUEST['filename'])) echo 'Please select a filename for linking.';
		$model = UserDetails::model()->findByPk($id) ;
		$model->original_video = $_REQUEST['filename'] ;
		$model->status = 'File Linked' ;
		if($model->save()){
			echo 'File has been linked successfully. Please <a href="'.Yii::app()->createUrl("muploader").'">queue</a> the file for upload' ;
		}else{
			echo 'File could not be linked, please contact administrator.' ;
			Yii::log(print_r($model->errors,true)) ;
		}
		$splitArr = str_split($model->gender) ;
		$remoteFileName = $model->id.'_'.$splitArr[0].'_'.$model->extra.'_comp.mov';
		$nukeFileName = $model->id.'_'.$splitArr[0].'_'.$model->extra.'.nk';
		$this->createNukeFile($model->original_video,$remoteFileName,$nukeFileName );
		
	}
	public function actionUploadFile(){
		$id = $_REQUEST['id'] ;
		$model = UserDetails::model()->findByPk($id) ;
		//echo print_r($_REQUEST,true);
		if (!isset($_FILES["file1"])) { // if file not chosen
			echo "ERROR: Please browse for a file before clicking the upload button.";
			exit();
		}
 		$fileName = $_FILES["file1"]["name"]; // The file name
		$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES["file1"]["type"]; // The type of file it is
		$fileSize = $_FILES["file1"]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
		if (!$fileTmpLoc) { // if file not chosen
			echo "ERROR: Please browse for a file before clicking the upload button.";
			exit();
		}
		//echo 'File name'.$fileName." tmp loc ".$fileTmpLoc ;
		
		
		// set up basic connection
		$conn_id = ftp_connect(Yii::app()->params['remoteHost']); 
		
		// login with username and password
		$login_result = ftp_login($conn_id, Yii::app()->params['remoteUser'] , Yii::app()->params['remotePwd'] );
		$info = new SplFileInfo($fileName);
		$extension = $info->getExtension();
		$splitArr = str_split($model->gender) ;
		$remoteFileBase = $model->id.'_'.$splitArr[0].'_'.$model->extra;
		$remoteFile = $model->id.'_'.$splitArr[0].'_'.$model->extra.'.'.$extension ;
		$uploadFolder = Yii::app()->basePath.'//..//'.Yii::app()->params['localUpload'].'//' ;
		copy($fileTmpLoc,Yii::app()->basePath.'//..//'.Yii::app()->params['localUpload'].'//'.$remoteFile);
		$this->createNukeFile($remoteFileBase,$extension);
		$model->status = 'Video Uploaded' ;
		$model->original_video = Yii::app()->basePath.'//..//'.Yii::app()->params['localUpload'].'//'.$remoteFile ;
		// upload a file
 		try{
 			ftp_chdir($conn_id, Yii::app()->params['uploadDir']) ;
			Yii::log("cwd ") ;
		if (ftp_put($conn_id, $remoteFile, $fileTmpLoc,FTP_BINARY)&&
			ftp_put($conn_id,$remoteFileBase.'.nk',$uploadFolder.'//'.$remoteFileBase.'.nk',FTP_ASCII)) {
			//echo "successfully uploaded $fileName \n";
			Yii::log("pposted both files") ;
			$model->posting_status = 'Studio Updated' ;
						
		} else {
			//echo "There was a problem while uploading $fileName\n";
			$model->posting_status = 'Studio Update Failure' ;
			Yii::log("Posting failure 1 ") ;
	
		}
		}catch(Exception $ex){
			$model->posting_status = 'Studio Update Failure' ;
			Yii::log("Posting failure 2 ") ;
		} 
		if($model->save()){
			echo 'Video has been uploaded.' ;
			Yii::log("Posting failure 3 ") ;
		}else{
			echo 'Video could not be uploaded, Please retry.\n Errors :\n'.print_r($model->errors,true);
			Yii::log("Posting failure 4 ".print_r($model->errors,true)) ;
		}
		
 	/* 	if(move_uploaded_file($fileTmpLoc, "test_uploads/$fileName")){
			echo "$fileName upload is complete";
		} else {
		echo "move_uploaded_file function failed";
} */
	}
	
	public function actionFive(){
		$this->layout="//layouts/empty";
		$this->render('five') ;
	}
	private function createNukeFile($inputFileName,$outputFileName,$nukeFileName){
		Yii::log("Input :".$inputFileName);
		Yii::log("output :".$outputFileName);
		Yii::log("nuke :".$nukeFileName);
		
		$str_content = file_get_contents(Yii::app()->getBasePath().'//..//'.Yii::app()->params['localUpload'].'/sample.nk') ;
		$replacedContent = str_replace(array("<<<input_file>>>","<<<output_file>>>"),array($inputFileName,$outputFileName),$str_content) ;
		
	//	echo  Yii::app()->getBasePath().'/../uploads/'.$file_name.'.nk' ;
		$retVal = file_put_contents(Yii::app()->getBasePath().'//..//'.Yii::app()->params['localUpload'].'//'.Yii::app()->request->cookies['siteName'].'//'.'2014//'.$nukeFileName,$replacedContent) ;
		Yii::log("Write status is ".$retVal ) ;	
	}
}
/*
 * send via curl
 * $ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('file' => '@/path/to/file.txt'));
curl_setopt($ch, CURLOPT_URL, 'http://server2/upload.php');
curl_exec($ch);
curl_close($ch);
 * /
 */