<?php  
require_once("DatabaseClass.php");  
$db_obj = new DatabaseClass ();  
$query = "SELECT * FROM students LIMIT 10";  
$rs_result = $db_obj -> execute_query($query);
print_r($rs_result); 
while ($row = $db_obj -> get_fetched_data($rs_result)) {    
	print_r($row);
}



$sql = "SELECT contactnumber FROM students WHERE contactnumber=8553609783";
	$resultset = $db_obj -> execute_query($sql);
$row = $db_obj -> get_fetched_data($resultset);	
print($row['contactnumber']);
