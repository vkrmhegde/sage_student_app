<?php
require_once("DatabaseClass.php"); 
$db_obj = DatabaseClass::getInstance();

// for enrollment addition
if(isset($_POST['student_enrollment'])) {
	$student_id = $_POST['student_id'];
	$course_id = $_POST['course_id'];
	// first check if a row with same student and course exists, if so return.
	$params_array = [$student_id, $course_id];
	$sql = "SELECT student_course_enrollment_id FROM student_course_enrollment WHERE student_id=? and course_id=?";
	$resultset = $db_obj -> execute_query($sql, $params_array);
	$row = $db_obj -> get_fetched_data($resultset);	
	if(!$row['student_course_enrollment_id']){//can insert row
		try{
			$params_array = [NULL, $student_id, $course_id];
			$sql = "INSERT INTO student_course_enrollment(`student_course_enrollment_id`, `student_id`, `course_id`) VALUES (?, ?, ?)";
		 	$resultset = $db_obj -> execute_query($sql, $params_array);		
			echo "enrolled";
		}
		catch(Exception $e){
			echo "unable to enroll";
		}
	} else {				
		echo "1";	 
	}
}

// for enrollment deletion
else if(isset($_POST['student_enrollment_deletion'])) {
	$id = $_POST['student_course_enrollment_id'];
	$params_array = [$id];
	try{
		$sql = "delete from student_course_enrollment where student_course_enrollment_id=?";
		$resultset = $db_obj -> execute_query($sql, $params_array);
		echo "deleted";
	}
	catch(Exception $e){
		echo "unable to delete";
	}
}
?>
