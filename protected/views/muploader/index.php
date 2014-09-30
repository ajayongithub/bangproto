<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php
/* @var $this MuploaderController */

$this->breadcrumbs=array(
	'Uploader',
);
?>
<h1><?php echo 'Please upload your files here'; ?></h1>

<?php
$this->widget('xupload.XUpload', array(
                    'url' => Yii::app()->createUrl("muploader/upload"),
                    'model' => $model,
                    'attribute' => 'file',
                    'multiple' => true,
		 'options' => array(
        'maxFileSize' => 30000000,
        'acceptFileTypes' => "js:/(\.|\/)(mp4|mov|avi|wmv)$/i",
    )
		
		
));
?>
