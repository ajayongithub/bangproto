<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->layout="//layouts/empty";
		$this->render('index');
	}
	public function actionLogin(){
		$this->layout="//layouts/empty";
		$this->render('login');
	}
	public function actionChooseAction(){
		$this->layout="//layouts/empty";
		$this->render('choose_action');
	}
	public function actionIndex1()
	{
		$this->layout="//layouts/empty";
		$this->render('index1');
	}
	public function actionTos(){
		$this->layout="//layouts/empty";
		$this->render('tos');
	}
	public function actionStoreData(){
		
		if(isset($_POST['response'])){
			//echo print_r($_POST['response'],true) ;
		//	$response  = CJSON::decode($_POST['response']) ;
			//echo $response->gender ;
			Yii::log(print_r($_POST,true)) ;
			$response = $_POST['response'] ;
			//echo $response["gender"] ;
			$splitArr = str_split($response['gender']) ;
			$model = new UserDetails() ;
			$model->raw_data = CJSON::encode($response);
			$model->fid = $response["id"] ; 
			$model->email = $response["email"] ; 
			$model->first_name = $response["first_name"] ; 
			$model->gender = $splitArr[0] ;
			$model->last_name = $response["last_name"] ; 
			$model->link = $response["link"] ;
			$model->locale = $response["locale"] ; 
			$model->name = ucwords($_POST['userName']);
			$model->timezone = $response["timezone"] ; 
			$model->updated_time = $response["updated_time"] ; 
			$model->verified = $response["verified"] ;
//			$model->location = $_POST['siteName'] ;
			if(isset(Yii::app()->request->cookies['siteName'])){
				$model->location = Yii::app()->request->cookies['siteName'];
				Yii::log('Site name is '.Yii::app()->request->cookies['siteName']);
			}else
				Yii::log("No cookie is received from the tab.") ;		
			if($model->save())
					echo "Success" ;
			else {
				echo "\nFailure".print_r($model->errors,true) ;
				Yii::log("Failure in registration.".print_r($model->errors,true)) ;
			}
		}
	}
}