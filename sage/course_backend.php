<?php
require_once("DatabaseClass.php"); 
$db_obj = DatabaseClass::getInstance();

// for course addition
if(isset($_POST['course_addition'])) {
	$course_name = $_POST['course_name'];
	$course_detail = $_POST['course_detail'];
	// first check if a row with same course_name exists, if so return.
	$params_array = [$course_name];
	$sql = "SELECT course_name FROM courses WHERE course_name=?";
	$resultset = $db_obj -> execute_query($sql, $params_array);
	$row = $db_obj -> get_fetched_data($resultset);		
	if(!$row['course_name']){//can insert row
		try{	
			$params_array = [NULL, $course_name, $course_detail];
			$sql = "INSERT INTO courses(`course_id`, `course_name`, `course_detail`) VALUES (?, ?, ?)";
			$db_obj -> execute_query($sql, $params_array);	
			echo "added";
		}
		catch(Exception $e){
			echo "unable to add";
		}
	} else {				
		echo "1";	 
	}
}

// for course updation
else if(isset($_POST['course_updation'])) {
	$course_name = $_POST['course_name_to_update'];
	$course_detail = $_POST['course_detail_to_update'];
	$params_array = [$course_detail, $course_name];
	try{
		$sql = "update courses set `course_detail`=? where `course_name`=?";	
		$db_obj -> execute_query($sql, $params_array);		
		echo "updated";
	}
	catch(Exception $e){
		echo "unable to update";
	}
}

//for course deletion
else if(isset($_POST['course_deletion'])) {
	$id=$_POST['course_id_to_delete'];
	#since there's a FK relation, first remove the row from student_course_enrollment
	$params_array = [$id];
	try{
		$sql = "delete from student_course_enrollment where `course_id`=?";
		$db_obj -> execute_query($sql, $params_array);	
		$sql = "delete from courses where `course_id`=?";
		$db_obj -> execute_query($sql, $params_array);	
		echo "deleted";
	}
	catch(Exception $e){
		echo "unable to delete";
	}

}
?>
