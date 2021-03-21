<?php
    class DatabaseClass  
    {  
        private $host = "localhost"; //  host name  
        private $username = "root"; //  user name  
        private $password = "root"; //  password  
        private $db = "sage_student_project"; //  database name
          
        public function __construct()  
        {  
            $this-> conn = mysqli_connect($this -> host, $this -> username, $this -> password) or die(mysqli_connect_error("database"));  
            mysqli_select_db($this-> conn, $this -> db) or die(mysqli_connect_error("database"));  
        }  

        // this method used to execute mysql query         
        public function execute_query($sql)  
        {  
            $c = mysqli_query($this-> conn, $sql) or die(mysqli_error("database")); 
            return $c;  
        } 
   
	// to get associative array 
        public function get_fetched_data($r)  
        {  
		return $r->fetch_array(MYSQLI_ASSOC);
        } 

	// to get row result	
	public function get_row($r)  
        {  
		return $r->fetch_row();
        }  
    }  
?>
