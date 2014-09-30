<h2>Configure this terminal</h2>

<div>
<!--  <form  action="<?php //echo Yii::app()->createUrl("/site/register")?>">-->
<form>
<p>Select the location  <select name="location">
							<option value="Delhi Site 1">Delhi Site 1</option>
							<option value="Delhi Site 2">Delhi Site 2</option>
							<option value="Delhi Site 3">Delhi Site 3</option>
							<option value="Delhi Site 4">Delhi Site 4</option>
							<option value="Location 5">Location 5</option>
							<option value="Location 6">Location 6</option>
							<option value="Location 7">Location 7</option>
							<option value="Location 8">Location 8</option>
							<option value="Delhi Studio">Delhi Studio</option>
						 </select>

<p>Select the terminal to configure : <select name="terminal">
							<option>Kiosk</option>
							<option>Video Point</option>
							<option>Studio</option>
						 </select>
</p>
<p>Enter the Code for verification : <input type="number" length="6" name="code" size="10" required/>
</p>
<input type="submit" formaction="<?php echo Yii::app()->createUrl("/site/register")?>" value='Configure' formmethod="POST"/>
</form>

</div>