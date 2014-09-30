<h2>Configure this terminal</h2>

<div>
<!--  <form  action="<?php //echo Yii::app()->createUrl("/site/register")?>">-->
<form>
<p>Select the location  <select name="location">
							<option value="Ambience Mall">Ambience Mall</option>
							<option value="MGF Mall">MGF Mall</option>
							<option value="Pacific Mall">Pacific Mall</option>
							<option value="Chennai">Chennai</option>
							<option value="Hyderabad">Hyderabad</option>
							<option value="Delhi Studio">Delhi Studio</option>
						 </select>

<p>Select the terminal to configure : <select name="terminal">
							<option>Tab</option>
							<option>Laptop</option>
							<option>Studio</option>
						 </select>
</p>
<p>Enter the Code for verification : <input type="number" length="6" name="code" size="10" required/>
</p>
<input type="submit" formaction="<?php echo Yii::app()->createUrl("/site/register")?>" value='Configure' formmethod="POST"/>
</form>

</div>