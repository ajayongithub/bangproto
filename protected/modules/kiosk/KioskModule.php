<?php

class KioskModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'kiosk.models.*',
			'kiosk.components.*',
		));
		
/* 			$path = $this->assetManager->publish(Yii::getPathOfAlias('application.modules.kiosk.views.default'));
			$this->clientScript->registerCssFile($path . '/css/style.css', 'screen, projection');
			$this->clientScript->registerCssFile($path . '/css/style-wide.css', 'screen, projection');
 *///			$this->clientScript->registerScriptFile($path . '/js/some-js.js');
	//		Yii::app()->clientScript->registerCssFile(Yii::getPathOfAlias('application.modules.kiosk.views.default').'/css/style.css');
	//		Yii::app()->clientScript->registerCssFile(Yii::getPathOfAlias('application.modules.kiosk.views.default').'/css/style-wide.css');
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
