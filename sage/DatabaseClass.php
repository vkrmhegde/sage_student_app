<?php
require_once('config.php');
//database connection and queries in singleton pattern
class DatabaseClass {
	private $_connection;
	private static $_instance; //singleton
	private $_host = DB_HOST;
	private $_username = DB_UER;
	private $_password = DB_PASS;
	private $_database = DB_NAME;

	// get instance of db
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	// Constructor
	private function __construct() {
		try {
		  $this->_connection = new PDO('mysql:host='.$this->_host.';dbname='.$this->_database, $this->_username, $this->_password);
		  // set the PDO error mode to exception
		  $this->_connection-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
		  echo "DB Connection failed: " . $e->getMessage();
		}
		
	}

	//prevent duplication of connection
	private function __clone() { }

	// Get PDO connection
	public function getConnection() {
		return $this->_connection;
	}	

	// execute query
        public function execute_query( $statement = "" , $parameters = [] ){
            try{
			
                $stmt = $this->_connection->prepare($statement);
                $stmt->execute($parameters);
                return $stmt;
				
            }catch(Exception $e){
                throw new Exception($e->getMessage());   
            }		
        }

	// fetch associative array query
	public function get_fetched_data($r)  
        {  
		return $r->fetch(PDO::FETCH_ASSOC);
        }

	// fetch row query
	public function get_row($r)  
        {  
		return $r->fetch();
        }  

}
?>
