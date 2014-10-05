<?php

class BkgProcController extends Controller
{
	public function actionIndex()
	{
		Yii::import('ext.runactions.components.ERunActions');
		
			if (ERunActions::runBackground())
			{
				//do all the stuff that should work in background
				//mail->send() ....
				Yii::log("Mail send lateer") ;
				Yii::app()->end();
			}
			else
			{
				//this code will be executed immediately
				//echo 'Time-consuming process has been started'
				//user->setFlash ...render ... redirect,
				Yii::log('Log immediate');
			}
		
		$this->render('index');
	}

	public function actionGetToken(){
		
		$this->render('getToken') ;
		
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}