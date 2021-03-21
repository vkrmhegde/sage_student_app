<?php
require_once("DatabaseClass.php"); 
$db_obj = new DatabaseClass(); 

if(isset($_POST['student_registration'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$dateofbirth = $_POST['dateofbirth'];	
	$contactnumber = $_POST['contactnumber']; 

	$sql = "SELECT contactnumber FROM students WHERE contactnumber='$contactnumber'";
	$resultset = $db_obj -> execute_query($sql);  
	$row = $db_obj -> get_fetched_data($resultset);	
	if(!$row['contactnumber']){	
		$sql = "INSERT INTO students(`student_id`, `first_name`, `last_name`, `dateofbirth`, `contactnumber`) VALUES (NULL, '$first_name', '$last_name', '$dateofbirth', '$contactnumber')";
		 $db_obj -> execute_query($sql);  		
		echo "registered";
	} else {				
		echo "1";	 
	}
}

else if(isset($_POST['student_updation'])) {
	$first_name = $_POST['first_name_to_update'];
	$last_name = $_POST['last_name_to_update'];
	$dateofbirth = $_POST['dateofbirth_to_update'];	
	$contactnumber = $_POST['contactnumber_to_update']; 

	$sql = "update students set `first_name`='$first_name', `last_name`='$last_name', `dateofbirth`='$dateofbirth' where `contactnumber`='$contactnumber'";	
	$db_obj -> execute_query($sql);  		
	echo "updated";
}

else if(isset($_POST['student_deletion'])) {
	$id=$_POST['student_id_to_delete'];
	#since there's a FK relation, first remove the row from student_course_enrollment
	$sql = "delete from student_course_enrollment where `student_id`=$id";
	$db_obj -> execute_query($sql);  
	$sql = "delete from students where `student_id`=$id";
	$db_obj -> execute_query($sql);  		
	echo "deleted";
}
?>
