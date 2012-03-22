<?php if( $submitted ): ?>

	<a href="<?=base_url()?>">View Students</a>

<?php else: ?>
	<form action="" method="post">
		<input type="text" name="first_name" id="first_name" required="required" placeholder="First Name"/>
		<br/>
		<input type="text" name="second_name" id="second_name" required="required" placeholder="Second Name"/>
		
		<br/>
	
		<select name="gender" id="gender" required="true">
			<option value="m">Male</option>
			<option value="m">Female</option>
		</select>
		
		<br/>
			
		<input type="text" name="day" id="date" type="number" required="required" placeholder="Day" maxlength="2"/>
		<input type="text" name="month" id="date" type="number" required="required" placeholder="Month" maxlength="2"/>
		<input type="text" name="year" id="date" type="number" required="required" placeholder="Year" maxlength="4"/>
		
		<br/>
		
		<input type="submit" name="submit" value="Add"/>
	</form>
<?php endif; ?>