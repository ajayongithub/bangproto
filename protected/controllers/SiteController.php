<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(isset(Yii::app()->request->cookies['siteId'])){
			$_SESSION['siteId'] = Yii::app()->request->cookies['siteId'];
			$_SESSION['siteType'] = Yii::app()->request->cookies['siteType'];
			$_SESSION['siteName'] = Yii::app()->request->cookies['siteName'];
			if(strcmp('Kiosk',$_SESSION['siteType'])==0){
				$this->redirect(Yii::app()->createUrl(Yii::app()->params['kioskBaseUrl']));
			}else{
				$this->redirect(Yii::app()->createUrl(Yii::app()->params['loginUrl']));
			}
		}else{
			$this->redirect(Yii::app()->createUrl(Yii::app()->params['configureUrl']));
		}

	}

	public function actionBranch(){
		$type = Yii::app()->request->cookies['siteType'];
		if(strcmp('Studio',$type)==0){
			echo 'Studio' ;
		}else {
			$this->redirect(Yii::app()->createUrl(Yii::app()->params['videoBaseUrl']));
		}
	}	
	
	public function actionRegister(){
		$redirectUrl = Yii::app()->baseUrl;
		if(isset($_POST)){
			$location = $_POST['location'];
			$terminal = $_POST['terminal'];
			$code = $_POST['code'];
					                           
			$loc = Locations::model()->findAllByAttributes(array('site_name'=>$location,'site_type'=>$terminal)) ;
			
			if(count($loc) > 0){
		
				if(strcmp($code,$loc[0]->site_code)==0){
					if(strcmp('Available',$loc[0]->status)==0){
						$loc[0]->status="Registered" ;
						$loc[0]->save();
						$daysExpires = 7 ;
						$cookie = new CHttpCookie('siteId', $loc[0]->id);
						$cookie->expire = time() + 60 * 60 * 24 * $daysExpires;
						Yii::app()->request->cookies['siteId'] = $cookie;
						
						$cookie = new CHttpCookie('siteType', $loc[0]->site_type);
						$cookie->expire = time() + 60 * 60 * 24 * $daysExpires;
						Yii::app()->request->cookies['siteType'] = $cookie;
						
						$cookie = new CHttpCookie('siteName', $loc[0]->site_name);
						$cookie->expire = time() + 60 * 60 * 24 * $daysExpires;
						Yii::app()->request->cookies['siteName'] = $cookie;
						
/*						if(strcmp('Kiosk',$terminal)==0) $redirectUrl = Yii::app()->params['kioskBaseUrl'];
						if(strcmp('Video Point',$terminal)==0) $redirectUrl = Yii::app()->params['videoBaseUrl'];
						if(strcmp('Studio',$terminal)==0) $redirectUrl = Yii::app()->params['studioBaseUrl'];*/
						$redirectUrl = Yii::app()->getBaseUrl(true) ;
						Yii::app()->user->setFlash('flashMsg','Your terminal has been successfully registered.') ;
					}else{
						Yii::app()->user->setFlash('flashMsg','Site is already registered, please contact administrator.') ;
						$redirectUrl = Yii::app()->params['configureUrl'] ;
					}
				}else{
						Yii::app()->user->setFlash('flashMsg','Invalid security code, please retry.') ;
						$redirectUrl = Yii::app()->params['configureUrl'] ;
				}
					
			
			}else{
				Yii::app()->user->setFlash('flashMsg','Invalid location and terminal type, please retry.') ;
				$redirectUrl = Yii::app()->params['configureUrl'] ;
			} 
		}else {
			$redirectUrl = Yii::app()->params['configureUrl'] ;
		}
		Yii::log("Redirect url ".$redirectUrl);

		$this->redirect($redirectUrl);
	}
	
	public function actionConfigure(){
		$this->render('configure');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}