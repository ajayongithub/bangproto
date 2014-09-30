<?php
class LocationsController extends Controller {

public function filters() {
    return array(
            'accessControl - login, logout', 
            );
}

public function accessRules() {
    return array(
            array('allow', 
                'actions'=>array('index', 'view'),
                'users'=>array('@'),
                ),
            array('allow', 
                'actions'=>array('minicreate', 'create', 'update', 'admin', 'delete', 'toggle'),
                'users'=>array('admin'),
                ),
            array('deny', 
                'users'=>array('*'),
                ),
            );
}

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Locations');
        $this->render('index', array(
                'dataProvider' => $dataProvider,
        ));
    }
        
    public function actionView($id) {
        $this->render('view', array(
                'model' => $this->loadModel($id),
        ));
    }
        
    public function actionCreate() {
        $model = new Locations;
                if (isset($_POST['Locations'])) {
            $model->setAttributes($_POST['Locations']);

                
                try {
                    if($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                            $this->redirect($_GET['returnUrl']);
                    } else {
                            $this->redirect(array('view','id'=>$model->id));
                    }
                }
                } catch (Exception $e) {
                        $model->addError('site_name', $e->getMessage());
                }
        } elseif(isset($_GET['Locations'])) {
                        $model->attributes = $_GET['Locations'];
        }

        $this->render('create',array( 'model'=>$model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        
        if(isset($_POST['Locations'])) {
            $model->setAttributes($_POST['Locations']);
                try {
                    if($model->save()) {
                        if (isset($_GET['returnUrl'])) {
                                $this->redirect($_GET['returnUrl']);
                        } else {
                                $this->redirect(array('view','id'=>$model->id));
                        }
                    }
                } catch (Exception $e) {
                        $model->addError('site_name', $e->getMessage());
                }

            }

        $this->render('update',array(
                'model'=>$model,
                ));
    }
                
               

    public function actionDelete($id) {
        if(Yii::app()->request->isPostRequest) {    
            try {
                $this->loadModel($id)->delete();
            } catch (Exception $e) {
                    throw new CHttpException(500,$e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                            $this->redirect(array('admin'));
            }
        }
        else
            throw new CHttpException(400,
                Yii::t('app', 'Invalid request.'));
    }
                
    public function actionAdmin() {
        $model = new Locations('search');
        $model->unsetAttributes();

        if (isset($_GET['Locations']))
                $model->setAttributes($_GET['Locations']);

        $this->render('admin', array(
                'model' => $model,
        ));
    }
    
    
    public function loadModel($id) {
            $model=Locations::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }

}