<h1>Current Students</h1>

<?php foreach( $students as $student ):?>
	<p>
		Student ID#: <?=$student->id?><br/>
		First Name: <?=$student->first_name?><br/>
		Second Name: <?=$student->last_name?><br/>
		Date of Birth: <?= date( "l jS F Y", strtotime( $student->dob ) )?><br/>
		Date Enrolled: <?= date( "l jS F Y", strtotime( $student->date_enrolled ) )?><br/>
		Time at School: <?= round( ( time() - strtotime( $student->date_enrolled ) ) / 86400 ) ?> Days<br/>
	</p>
<?php endforeach;?>

<a href="<?=base_url()?>addstudent">Add a Student</a>