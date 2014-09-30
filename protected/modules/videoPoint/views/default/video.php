<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Participants') => array('index'),
    Yii::t('app', 'Videos'),
);
if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
array('label'=>Yii::t('app', 'List') , 'url'=>array('index')),
);
?>
<html>

<head></head>
<body>
<script>
function _(el){
	return document.getElementById(el);
}

function linkFile(){
	var file = _("file1").files[0];
	if(file==null || typeof(file)=='undefined'){ alert('Please select a file to link.'); return ;}
	//alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("id",_("userId").value);
	formdata.append("filename",file.name);
	var ajax = new XMLHttpRequest();
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.open("POST", "<?php echo Yii::app()->createUrl('/videoPoint/default/linkFile')?>");
	ajax.send(formdata);
}
function uploadFile(){
	var file = _("file1").files[0];
	//alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file1", file);    
	formdata.append("id",_("userId").value);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "<?php echo Yii::app()->createUrl('/videoPoint/default/uploadFile')?>");
	ajax.send(formdata);
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	//_("progressBar").value = 0;
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}

</script>
<form action="<?php echo Yii::app()->createUrl('/videoPoint/default/linkFile')?>" method="post">
<input type="hidden" name="id" id="userId" value="<?php echo $userId ?>"/>
 <input type="file" name="file1" id="file1" accept="video/*"><br>
  <input type="button" value="Link File" onclick="linkFile()">
   <h3 id="status"></h3>
</form>
<button type="button" onclick='window.open("<?php echo Yii::app()->createUrl("videoPoint/default");?>","_self");' >Back</button>
</body>
</html>