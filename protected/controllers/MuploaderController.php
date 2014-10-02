<?php

class MuploaderController extends Controller
{
	/* public function actionIndex()
	{	$model = new FileUpload;
		$this->render('index',array('model'=>$model));
	} */
	public function actionIndex() {
		Yii::import("xupload.models.XUploadForm");
		$model = new XUploadForm;
		$this -> render('index', array('model' => $model, ));
	}
	public function actions()
	{
		$userId = Yii::app()->user->id ;
		return array(
				'upload'=>array(
						'class'=>'xupload.actions.XUploadAction',
						'path' =>Yii::app() -> getBasePath()."/../uploads/",
						'publicPath' => Yii::app() -> getBaseUrl()."/uploads/",
				),
		);
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