
<script type="text/javascript" language="javascript">
function nukeExecution(id){
	
	console.log("Got Id "+id);
//	console.log("Got Gender "+gender);
//	console.log("Got action "+action);
var oShell = new ActiveXObject("Shell.Application");
//var commandtoRun = "C:\\Program Files\\Nuke8.0v4\\nuke.exe";
var commandtoRun = "C:\\windows\\notepad.exe" ;
alert("D:\\Downloads\\ftp_upload\\"+id+".nk");
//oShell.ShellExecute(commandtoRun,"D:\\Downloads\\ftp_upload\\"+id+".nk","","open","1");
}

</script>

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
<button type="button" onclick="window.open('<?php echo Yii::app()->createUrl('studio/default/fetchProcessedFiles')?>','_self');" >Refresh</button><br/>
<p>
<!-- <form method="post">
		<label>Page Size:</label>
        <select name="pageSize" selected="25">
                <option value="25">Just for now</option>
                <option value="50">Past 1 hour</option>
                <option value="100">Past Session</option>
                <option value="200">One Day</option>
                <option value="400">Two days</option>
                <option value="800">Three days</option>
                <option value="1600">Sorry System cant take this value</option>
        </select>
</form> -->
<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?><div class="search-form" style="display: none">
    <?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BootGridView', array(
'id' => 'user-details-grid',
'type'=>'striped bordered condensed',
'dataProvider' => $model->search(),
'filter' => $model,
'columns' => array(
		
		
        'id',
        'location',
     //   'raw_data',
'name',    
//    'email',
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
     //   'composite_video',
        'posting_status',
        'remarks',
//        'extra',
 /* array(
'class'=>'bootstrap.widgets.BootButtonColumn',
'htmlOptions'=>array('style'=>'width: 55px'),
),
 */		/* array(
				'class'=>'CButtonColumn',
			
		), */
		array
		(
				'class'=>'CButtonColumn',
				'header'=>CHtml::dropDownList('pageSize',$pageSize,array(25=>'Oridnary',100=>'Medium',200=>'Bigger',400=>'Larger',1600=>'Largest'),array(
						'onchange'=>"$.fn.yiiGridView.update('user-details-grid',{ data:{pageSize: $(this).val() }})",
				)),
				'template'=>'{nuke}{publish}',//{comp}',{fetch}
				'buttons'=>array
				(
						'nuke' => array
						(
								'label'=>'Nuke',
								
		             			'url'=>'$data->id."_".$data->gender."_".$data->extra',
								'visible'=>'$data->status == "Video Uploaded" && $data->posting_status != "Uploaded" ',
								'click'=>'function(){nukeExecution($(this).attr("href")) ;'
								.'$.ajax({ type: "POST", url: "'.Yii::app()->createUrl('studio/default/markBeginProcessing').'", 
												data: { href: $(this).attr("href") } })
  												.done(function( msg ) {
    											console.log( msg );
												window.location.reload();
  													});'
													.'return false ; }' ,
		
						),
						'fetch' => array
						(
								'label'=>'Fetch',
								'url'=>'$data->id',
								'visible'=>'$data->posting_status == "Studio Update Failure" ',
								'click'=>'function(){$.ajax({ type: "POST", url: "'.Yii::app()->createUrl('studio/default/fetchRawVideo').'", 
													data: { 
														href: $(this).attr("href") , 
														pStatus:"Studio Updated" }
													})
  												.done(function( msg ) {
    												alert(msg);
													console.log( msg );
													window.location.reload();
												}); 
												return false ;}',
								
						),
						'publish' => array
						(
								'label'=>'Publish',
								'url'=>'Yii::app()->createUrl("studio/default/publishVideo",array("id"=>$data->id) )',
 								'visible'=>'$data->posting_status == "Processing Complete" ',
/*							 	'click'=>'function(){$.ajax({ type: "POST", url: "'.Yii::app()->createUrl('studio/default/publishVideo').'", 
													data: { 
														href: $(this).attr("href") , 
														pStatus:"Published" }
													})
  												.done(function( msg ) {
    												console.log( msg );
													window.open();
												}); 
												return false ;}',  */
								//'click'=>'function(){window.open("'.Yii::app()->createUrl(studio/default/).'"); return false ;}',
										
						),
						'comp' => array
						(
								'label'=>'Mark Complete',
								'url'=>'$data->id',
								'visible'=>'$data->posting_status == "Processing" ',
								'click'=>'function(){$.ajax({ type: "POST", url: "'.Yii::app()->createUrl('studio/default/updatePostStatus').'", 
													data: { 
														href: $(this).attr("href") , 
														pStatus:"Processing Complete" }
													})
  												.done(function( msg ) {
    												console.log( msg );
													window.location.reload();
												}); 
												return false ;}',
									
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
<div id="forScript">
</div>

<?php 
 $cs = Yii::app()->getClientScript();  
$cs->registerScript(
  'my-main-script-1',
  '
function nukeExecution(id){
	
	console.log("Got Id "+id);
//	console.log("Got Gender "+gender);
//	console.log("Got action "+action);
var oShell = new ActiveXObject("Shell.Application");
//var commandtoRun = "C://Windows//notepad.exe";
var commandtoRun = "C://Program Files//Nuke8.0v4//nuke8.0.exe";
//alert("D://Downloads//ftp_upload//"+id+".nk");
oShell.ShellExecute(commandtoRun,"Z://Raw//"+id+".nk","","open","1");
 

} 
	',
  CClientScript::POS_END
);
?>