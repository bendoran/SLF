<!DOCTYPE html>
<html lang="en">
	<head>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(init);

			function init(){
			}
			
			function restGet( showPrompt ){
				$("#students").empty();
				var data = {};
				var id = null;
				var url = "student";
				if( showPrompt ){
					id = prompt("Enter Student ID#:", "Number");
				}
				if( id ){
					$("#students").append("<h1>Student #" + id + "</h1>");
					url += "/"+id;
				}else{
					$("#students").append("<h1>Current Students</h1>");
				}

				jQuery.ajax({
		        	type: "GET",
		        	url: url,
		        	statusCode : {
			        	200: function(data){
								for( var i = 0; i < data.length; i++ ){
									var student = data[i];
					        		renderStudent(student, $("#students") );
								} 
		        			},
			        	404: function(){
			        		$("#students").append("<h2>Student Not Found</h2>");
			        	},
		        	},
		        	data: data
		        });
			}

			function restPost(){

				var data = {
					first_name : "Post",
					second_name : "User",
					gender : "m",
					dob : "01-01-01",
				};

				jQuery.ajax({
		        	type: "POST",
		        	url: "student",
		        	statusCode : {
			        	200: function(data){
								for( var i = 0; i < data.length; i++ ){
									var student = data[i];
					        		renderStudent(student, $("#students") );
								} 
		        			},
			        	400: function(){
			        		$("#students").append("<h2>Bad Request</h2>");
			        	},
		        	},
		        	data: data
		        });
			}

			function restDelete(){
			}

			function restPut(){
			}

			function renderStudent( student, container ){
				var dob = new Date( Date.parse( student.dob ) );
				var dateEnrolled = new Date( Date.parse( student.date_enrolled ) );
				var now = new Date();
				var timeAtSchool = Math.round( (now.getTime() - dateEnrolled.getTime() ) / 86400000 );
				var pTag = $("<p></p>");
				
				pTag.append( "Student ID#: " + student.id + "<br/>" );
				pTag.append( "First Name: " + student.first_name + "<br/>" );
				pTag.append( "Last Name: " + student.last_name + "<br/>" );
				pTag.append( "Student Gender: " + (student.gender == "m" ? "Male" : "Female") + "<br/>" );
				pTag.append( "Date of Birth: " + dob.getDate() + "-" + dob.getMonth() + "-" + dob.getFullYear() + "<br/>" );
				pTag.append( "Date Enrolled: " + dateEnrolled.getDate() + "-" + dateEnrolled.getMonth() + "-" + dateEnrolled.getFullYear() + "<br/>" );
				pTag.append( "Time at School: " + timeAtSchool + " Days <br/>" );

				container.append( pTag );
			}
		</script>
	</head>
	
	<body>
		<a href="#" onclick="restGet(false)">Get Students</a><br/>
		<a href="#" onclick="restGet(true)">Get Student</a><br/>
		<a href="#" onclick="restPut(true)">Put New Name on Student</a><br/>
		<a href="#" onclick="restDelete(true)">Delete Student</a><br/>
		<a href="#" onclick="restPost()">Add New Student</a><br/>
		<div id="students"></div>
	</body>
</html>