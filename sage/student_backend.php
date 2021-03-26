<?php
require_once("DatabaseClass.php"); 
$db_obj = DatabaseClass::getInstance();

// for student registration
if(isset($_POST['student_registration'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$dateofbirth = $_POST['dateofbirth'];	
	$contactnumber = $_POST['contactnumber']; 
	// first check if a row with same contactnumber exists, if so return.
	$params_array = [$contactnumber];
	$sql = "SELECT contactnumber FROM students WHERE contactnumber=?";
	$resultset = $db_obj -> execute_query($sql, $params_array);  
	$row = $db_obj -> get_fetched_data($resultset);	
	if(!$row['contactnumber']){//can insert row
		try{
			$params_array = [NULL, $first_name, $last_name, $dateofbirth, $contactnumber];
			$sql = "INSERT INTO students(`student_id`, `first_name`, `last_name`, `dateofbirth`, `contactnumber`) VALUES (?, ?, ?, ?, ?)";
			$db_obj -> execute_query($sql, $params_array);  		
			echo "registered";
		}
		catch(Exception $e){
			echo "unable to register";
		}
	} else {				
		echo "1";	 
	}
}

// for student updation
else if(isset($_POST['student_updation'])) {
	$first_name = $_POST['first_name_to_update'];
	$last_name = $_POST['last_name_to_update'];
	$dateofbirth = $_POST['dateofbirth_to_update'];	
	$contactnumber = $_POST['contactnumber_to_update']; 
	$params_array = [$first_name, $last_name, $dateofbirth, $contactnumber];
	try{
		$sql = "update students set `first_name`=?, `last_name`=?, `dateofbirth`=? where `contactnumber`=?";	
		$db_obj -> execute_query($sql, $params_array);	
		echo "updated";
	}
	catch(Exception $e){
		echo "unable to update";
	}
}

//for student deletion
else if(isset($_POST['student_deletion'])) {
	$id=$_POST['student_id_to_delete'];
	#since there's a FK relation, first remove the row from student_course_enrollment
	$params_array = [$id];
	try{
		$sql = "delete from student_course_enrollment where `student_id`=?";
		$db_obj -> execute_query($sql, $params_array);
		$sql = "delete from students where `student_id`=?";
		$db_obj -> execute_query($sql, $params_array);		
		echo "deleted";
	}
	catch(Exception $e){
		echo "unable to delete";
	}
}
?>
