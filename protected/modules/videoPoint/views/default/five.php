<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<input type="file" id="input" onchange="handleFiles(this.files);" >
<input type="button" id="add" value="Add" onclick="addFiles();" />
To Be Done
<div id="todolist"></div>
<br/>
Done
<div id="donelist"></div>


<?php 
 $cs = Yii::app()->getClientScript();  
$cs->registerScript(
  'my-main-script-1',
  '
var files = [] ;
var selected = false ;
var running = false ;
		
function handleFiles(files){
		
//		console.log("Size is "+files.size);
//		console.log(files);
		
	//	if(files.size>0) 
		selected = true ;
		//else selected = false ;
		console.log("Selected = "+selected );
}		

		function errorHandler(error){
			console.log(error);
		}
		
function rename(cwd, src, newName) {
  cwd.getFile(src, {}, function(fileEntry) {
    fileEntry.moveTo(cwd, newName);
  }, errorHandler);
}
		
function addFiles(){
 		if(selected == false ) return ;
		window.requestFileSystem(window.TEMPORARY, 1024*1024, function(fs) {
  		rename(fs.root, $("#input")[0].files[0], "you.png");
		}, errorHandler); 
// 		console.log($("#input")[0].files[0].name+ " "
// 		+$("#input")[0].files[0].size+ " "
// 		+$("#input")[0].files[0].type );

// 		files.push($("#input")[0].files[0]) ;
// 		if(running == false )
// 		processFiles();
// 		$("#todolist").append("<p>"+$("#input")[0].files[0].name+"</p>");
		
		}
		function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
function processFiles(){
			running = true ;
		console.log(files) ;
			while(files.length>0){
				console.log("handling "+files[0].name);
				files.splice(0,1);
				sleep(5000);
				console.log("Done");
				$("#donelist").append("<p>"+$("#input")[0].files[0].name+"</p>");
				console.log(files);
			}
			running = false ;
		}
	',
  CClientScript::POS_END
);
?>