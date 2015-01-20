<?php

/**
 * Class M_PDO
 * @Version 1.0
 * @Desc Used for PDO
 */

class M_PDO extends PDO
{
	private static $instance;

	public static function Instance()
	{	
        $configData = parse_ini_file('../config.ini',true);

        if (self::$instance == null)
			self::$instance = new M_PDO("mysql:host={$configData['db_config']['db_host']};dbname={$configData['db_config']['db_name']};charset=utf8", $configData['db_config']['db_user'], $configData['db_config']['db_password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		return self::$instance;
	}

	//FUNCTION SELECT
	//GET ONE PARAMETER - QUERY
	//RETURN ASSOC ARRAY - arr
	public function select($query){
		//print $query;
		$arr = array();
		if($result = parent::query($query)){
			while ($row = $result->fetch(PDO::FETCH_ASSOC)){
				$arr[] = $row;
			}
			return $arr;
		}
		else {
			print "Select problems";
			$this->log("SELECT", $this->errorCode, $query);die($this->error);
		}
	}


	//FUNCTION SELECT
	//GET ONE PARAMETER - QUERY
	//RETURN ASSOC ARRAY - arr
	public function select_result_array($query, $return){
		//print $query;
		$arr = array();
		if($result = parent::query($query)){
			while ($row = $result->fetch(PDO::FETCH_ASSOC)){
				$arr[] = $row[$return];
			}
			return $arr;
		}
		else {
			print "Select problems";
			$this->log("SELECT", $this->errorCode(), $query);
		}
	}

	//FUNCTION SELECTOne
	//GET ONE PARAMETER - QUERY
	//RETURN ASSOC ARRAY - arr
	public function selectOne($query){
		//print $query;
		$arr = array();
		if($result = parent::query($query)){
			while ($row = $result->fetch(PDO::FETCH_ASSOC)){
				$arr[] = $row;
			}
			if(!empty($arr[0])) return $arr[0]; else return null;
		}
		else {
			print "Select problems";
			$this->log("SELECT", $this->errorCode(), $query);
		}
	}	
	
	//
	//FUNCTION INSERT
	//GET TWO PARAMETERS - TABLE NAME, ARRAY OF KEYS => VALUES
	//RETURN TRUE OR ERROR
	public function insert($tableName, $keyValue){
		//echo "<pre>"; print_r($keyValue);
	
		foreach($keyValue as $key => $value)
			$columns[] = $key;
		
        $values  = ':' . implode(',:', $columns);		
		$columns = implode('`,`', $columns);
		
        $query = "INSERT INTO $tableName (`$columns`) VALUES ($values)";//die($query);

		foreach ($keyValue as $key => $value)
            $params[':' . $key] = $value;
		
		$stmt = $this->prepare($query);
		
		if(!$stmt->execute($params)){
			print "Insert problems";
			$this->log("INSERT", $this->errorCode(), $query);
		}	
		else return true;
	}
	
	//
	//FUNCTION UPDATE
	//GET THREE PARAMETERS - TABLE NAME, ARRAY OF KEYS => VALUES, ID
	//RETURN TRUE OR ERROR
	public function update($tableName, $keyValue, $id, $column = 'id'){
		
		$sets = array();
		foreach ($keyValue as $key => $value)
			$sets[] = "`$key` = :$key";

		$setsQuery = implode(',', $sets);
		
		$query = "UPDATE $tableName SET $setsQuery WHERE $column = '$id'";
		
		foreach ($keyValue as $key => $value)
            $params[':' . $key] = $value;  
			
        $stmt = $this->prepare($query);              
//die($query);
		if(!$stmt->execute($params)){
			print "Update problems";
			$this->log("UPDATE", $this->errorCode(), $query);
		}	
		//else die((string)$stmt->rowCount());
			//return true;
	}
	
	
	//
	//FUNCTION DELETE
	//GET TWO PARAMETERS - TABLE NAME, ID
	//RETURN TRUE OR ERROR
	public function delete($tableName, $id, $column = 'id'){

		$query = "DELETE FROM $tableName WHERE `" . $column . "` = '$id'";

		if(!$this->query($query)){
			print "Deleting problems";
			$this->log("DELETE", $this->errorCode(), $query);
		}	
		else
			return true;
	}	
	
	
	//
	//FUNCTION LOG
	//GET TWO PARAMETERS - ACTION, RESULT
	public function log($action, $result, $additional){
		/*print_r($result);
		die($result);*/
		$query = $this->prepare("INSERT INTO log (action, result, additional) VALUES ('$action', '$result', '$additional')");
		$query->execute();

	}

	
	public function clearInput($str)
	{
		$str = htmlspecialchars( trim( $str ) ) ;
		return $str;
	}	
	
	public function mysqlDate($str)
	{		
		return date('Y-m-d H:i:s', strtotime($str));
	}	
	
	public function mysqlDateNow()
	{		
		return date('Y-m-d H:i:s');
	}


    public function humanCount($count){
        if($count >= 1000000) $count = $count/1000000 . 'm';
        elseif($count >= 1000) $count = $count/1000 . 'k';

        return $count;
    }
}


