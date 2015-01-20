<?php

class M_MYSQL extends mysqli
{
	private static $instance; 
	
	public static function Instance()
	{
        $configData = parse_ini_file('config.ini',true);

		if (self::$instance == null)
			self::$instance = new M_MYSQL($configData['db_config']['db_host'], $configData['db_config']['db_user'], $configData['db_config']['db_host'], $configData['db_password']['db_name']);
		return self::$instance;
	}

	//FUNCTION SELECT
	//GET ONE PARAMETER - QUERY
	//RETURN ASSOC ARRAY - arr
	public function select($query){
		//print $query;
		$arr = array();
		if($result = parent::query($query)){
			while ($row = $result->fetch_assoc()){
				$arr[] = $row;
			}
			return $arr;
		}
		else {
			print "Select problems";
			$this->log("SELECT", $this->error, $query);die($this->error);
		}
	}


	//FUNCTION SELECT
	//GET ONE PARAMETER - QUERY
	//RETURN ASSOC ARRAY - arr
	public function select_result_array($query, $return){
		//print $query;
		$arr = array();
		if($result = parent::query($query)){
			while ($row = $result->fetch_assoc()){
				$arr[] = $row[$return];
			}
			return $arr;
		}
		else {
			print "Select problems";
			$this->log("SELECT", $this->error, $query);
		}
	}

	//FUNCTION SELECTOne
	//GET ONE PARAMETER - QUERY
	//RETURN ASSOC ARRAY - arr
	public function selectOne($query){
		//print $query;
		$arr = array();
		if($result = parent::query($query)){
			while ($row = $result->fetch_assoc()){
				$arr[] = $row;
			}
			if(!empty($arr[0])) return $arr[0]; else return null;
		}
		else {
			print "Select problems";
			$this->log("SELECT", $this->error, $query);
		}
	}	
	
	//
	//FUNCTION INSERT
	//GET TWO PARAMETERS - TABLE NAME, ARRAY OF KEYS => VALUES
	//RETURN TRUE OR ERROR
	public function insert($tableName, $keyValue){
		$columns = array();
		$values  = array();
		foreach ($keyValue as $key => $value){
			$columns[] = "`".$this->real_escape_string($key)."`";
			
			if($value === null){
				$values[] = "NULL";
			}
			else{
				$value = $this->real_escape_string(htmlspecialchars(trim($value)));
				$values[] = "'$value'";
			}
		}
		
		$columnsQuery = implode(',', $columns);
		$valuesQuery  = implode(',', $values);
		
		$query = "INSERT INTO $tableName ($columnsQuery) VALUES ($valuesQuery)";

		if(!$this->query($query)){
			print "Insert problems";
			$this->log("INSERT", $this->error, $query);
            //print $query;die();
		}	
		else return true;
	}
	
	//
	//FUNCTION UPDATE
	//GET THREE PARAMETERS - TABLE NAME, ARRAY OF KEYS => VALUES, ID
	//RETURN TRUE OR ERROR
	public function update($tableName, $keyValue, $id, $column = 'id'){
		$id = (int)$id;
		$sets = array();
		foreach ($keyValue as $key => $value){
			$key = "`".$this->real_escape_string($key)."`";			
			if($value === null){
				$values[] = "NULL";
			}
			else{
				$value = $this->real_escape_string(htmlspecialchars(trim($value)));			
			}
			$sets[] = "$key = '$value'";			
		}
		$setsQuery = implode(',', $sets);
		
		$query = "UPDATE $tableName SET $setsQuery WHERE $column = '$id'";
		//print $query;exit();
		if(!$this->query($query)){
			print "Update problems";
			$this->log("UPDATE", $this->error, $query);
		}	
		else
			return true;
	}
	
	
	//
	//FUNCTION DELETE
	//GET TWO PARAMETERS - TABLE NAME, ID
	//RETURN TRUE OR ERROR
	public function delete($tableName, $id, $column = 'id'){
		$id = (int)$id;
		$query = "DELETE FROM $tableName WHERE `" . $column . "` = '$id'";
		if(!$this->query($query)){
			print "Deleting problems";
			$this->log("DELETE", $this->error, $query);
		}	
		else
			return true;
	}	
	
	
	//
	//FUNCTION LOG
	//GET TWO PARAMETERS - ACTION, RESULT
	public function log($action, $result, $additional){
		$action = $this->real_escape_string($action);
		$result = $this->real_escape_string($result);
		$additional = $this->real_escape_string($additional);
		$query = "INSERT INTO log (action, result, additional) 
				  VALUES ('$action', '$result', '$additional')";
		$this->query($query);
	}
	
	public function clearInput($str)
	{
		$str = htmlspecialchars( $this->real_escape_string(trim($str) ) );
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


