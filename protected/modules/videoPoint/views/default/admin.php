<?php
$this->breadcrumbs = array(
    Yii::t('app', 'User Details') => array('index'),
    Yii::t('app', 'Manage'),
);
if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
array('label'=>Yii::t('app', 'List') , 'url'=>array('index')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('user-details-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1> <?php echo Yii::t('app', 'Manage'); ?> <?php echo Yii::t('app', 'User Details'); ?> </h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?><div class="search-form" style="display: none">
    <?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('bootstrap.widgets.BootGridView', array(
'id' => 'user-details-grid',
'type'=>'striped bordered condensed',
'dataProvider' => $model->searchVideoPoint(),
'filter' => $model,
'columns' => array(
  //      'id',
        'location',
     //   'raw_data',
'name',    
    //'email',
    //    'first_name',
	//	'last_name',        
		'gender',
       // 'fid',
    //    'link',
//        'locale',
    
//        'timezone',
//        'updated_time',
//        'verified',
        'status',
        'original_video',
//        'composite_video',
//        'posting_status',
//        'remarks',
//        'extra',
/* array(
'class'=>'bootstrap.widgets.BootButtonColumn',
'htmlOptions'=>array('style'=>'width: 55px'),
), */
		array
		(
				'class'=>'CButtonColumn',
				'template'=>'{upload}',
				'buttons'=>array
				(
						'upload' => array
						(
								'label'=>'Link Video',
								//'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
								'url'=>'Yii::app()->createUrl("videoPoint/default/video", array("id"=>$data->id))',
								'visible'=>'$data->status != "File Linked" && $data->status != "Video Uploaded"'
								
						),
						/*
						'down' => array
						(
								'label'=>'[-]',
								'url'=>'"#"',
								//'visible'=>'$data->score > 0',
								'click'=>'function(){alert("Going down!");}',
						),*/
				),
		),
),
)); ?>