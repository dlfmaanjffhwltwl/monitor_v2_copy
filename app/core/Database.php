<?php

/*
 * PDO Database Class
 * Connect to the database
 * Create and execute statements
 * Return results
 */

class Database {

	private static 	$_instance;

	private 		$_host		= 	DB_HOST,
					$_username	=	DB_USER,
					$_password	=	DB_PASS,
					$_dbname	=	DB_NAME;

	private 		$_pdo,
					$_query,
					$_results,
					$_errormsg,
					$_error;


 	private function __construct() {
 		// Set DSN
 		$dsn = 'mysql:host=' . $this->_host . ';dbname=' . $this->_dbname;

 		// PDO attributes
		$options  = array(
			PDO::MYSQL_ATTR_INIT_COMMAND 	=> "SET NAMES utf8",
            PDO::ATTR_ERRMODE            	=> PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   	=> FALSE,
            PDO::ATTR_PERSISTENT			=> TRUE,
        );
		// Create PDO instance
		try {
			$this->_pdo = new PDO($dsn, $this->_username, $this->_password, $options);
		} catch(PDOException $e) {
			// If error occured, echo error message
			die($e->getMessage());
		}
	}

	public static function instance() {
	 	if (!isset(self::$_instance)) {
			self::$_instance = new Database();
		}		
		return self::$_instance;
	}

	public function arrayToString($list) {
		$text ="";
        for($i=0; $i<count($list); $i++)
        {
            if($i==0){
                $text .= '"'.$list[$i].'"';
            }else{
                $text .= ',"'.$list[$i].'"';
            }
        }
	    return $text;
	}
	
	//에러 사유를 반환하는 함수
	private function getErrorReason($code){
		$reason = '';
		switch ($code) {
			case "23000":
				$reason = '삭제불가 : 해당 데이터와 연관된 내역이 있습니다 '."[".$code."]";
				break;
			default:
				$reason = '데이터 베이스 오류';
		}
		return $reason;
	}

	//insert,update 경우 fetchAll을 실행할경우 로컬에서는 괜찮은대 서버에서 에러가 발생함
	//이에따라 insert,update경우는 데이터를 반환 받지 않아도 되기 때문에 $isFetch를 false로 한다.
	public function query($query, $params = array(),$isFetch = true) {
		try{
			$this->_error = false;
			$this->_results = [];
			$stmt = $this->_pdo->prepare($query);
			if (!$stmt->execute($params)) {
				$this->_error = true;
			} else {
				if($isFetch){
					$this->_results = $stmt->fetchAll();
				}
			}
		}catch(PDOException $e){
			$chk = $e->getMessage();
			$this->_errormsg = $this->getErrorReason($e->getCode());
			$this->_error = true;
		}finally{
			return $this;
		}
		
	}

	public function pdoMultiInsert($tableName, $data){
		$this->_error = false;
		$this->_results = [];
		//Will contain SQL snippets.
		$rowsSQL = array();
	
		//Will contain the values that we need to bind.
		$toBind = array();
		
		//Get a list of column names to use in the SQL statement.
		$columnNames = array_keys($data[0]);
	
		//Loop through our $data array.
		foreach($data as $arrayIndex => $row){
			$params = array();
			foreach($row as $columnName => $columnValue){
				$param = ":" . $columnName . $arrayIndex;
				$params[] = $param;
				$toBind[$param] = $columnValue; 
			}
			$rowsSQL[] = "(" . implode(", ", $params) . ")";
		}
	
		//Construct our SQL statement
		$sql = "INSERT INTO `$tableName` (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $rowsSQL);
	
		$stmt = $this->_pdo->prepare($sql);
		//Prepare our PDO statement.
		//$pdoStatement = $this->_pdo->prepare($sql);
	
		//Bind our values.
		foreach($toBind as $param => $val){
			$stmt->bindValue($param, $val);
		}
		

		if (!$stmt->execute()) {
			$this->_error = true;
	    } else {
	    	$this->_results = $stmt->fetchAll();
	    }

	    return $this;
	}

	public function results() {
		return $this->_results;
	}

	public function first() {
		return @$this->_results[0];
	}

	public function error() {
		return $this->_error;
	}
	public function errormsg() {
		return $this->_errormsg;
	}
}