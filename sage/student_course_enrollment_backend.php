<?php
require_once("DatabaseClass.php"); 
$db_obj = new DatabaseClass(); 

if(isset($_POST['student_enrollment'])) {
	$student_id = $_POST['student_id'];
	$course_id = $_POST['course_id'];

	$sql = "SELECT student_course_enrollment_id FROM student_course_enrollment WHERE student_id='$student_id' and course_id='$course_id'";
	$resultset = $db_obj -> execute_query($sql);  
	$row = $db_obj -> get_fetched_data($resultset);	
	if(!$row['student_course_enrollment_id']){	
		$sql = "INSERT INTO student_course_enrollment(`student_course_enrollment_id`, `student_id`, `course_id`) VALUES (NULL, $student_id, $course_id)";
		 $db_obj -> execute_query($sql);  		
		echo "enrolled";
	} else {				
		echo "1";	 
	}
}

else if(isset($_POST['student_enrollment_deletion'])) {
	$id = $_POST['student_course_enrollment_id'];
	$sql = "delete from student_course_enrollment where student_course_enrollment_id='$id'";
	$db_obj -> execute_query($sql);  		
	echo "deleted";
}
?>
