<?php
require_once("DatabaseClass.php"); 
$db_obj = new DatabaseClass();

if(isset($_POST['course_addition'])) {
	$course_name = $_POST['course_name'];
	$course_detail = $_POST['course_detail'];

	$sql = "SELECT course_name FROM courses WHERE course_name='$course_name'";
	$resultset = $db_obj -> execute_query($sql);  
	$row = $db_obj -> get_fetched_data($resultset);		
	if(!$row['course_name']){	
		$sql = "INSERT INTO courses(`course_id`, `course_name`, `course_detail`) VALUES (NULL, '$course_name', '$course_detail')";
		 $db_obj -> execute_query($sql);  		
		echo "added";
	} else {				
		echo "1";	 
	}
}

else if(isset($_POST['course_updation'])) {
	$course_name = $_POST['course_name_to_update'];
	$course_detail = $_POST['course_detail_to_update'];

	$sql = "update courses set `course_detail`='$course_detail' where `course_name`='$course_name'";	
	 $db_obj -> execute_query($sql);  		
	echo "updated";
}

else if(isset($_POST['course_deletion'])) {
	$id=$_POST['course_id_to_delete'];
	#since there's a FK relation, first remove the row from student_course_enrollment
	$sql = "delete from student_course_enrollment where `course_id`=$id";
	$db_obj -> execute_query($sql);
	$sql = "delete from courses where `course_id`=$id";
	$db_obj -> execute_query($sql);  		
	echo "deleted";
}
?>
