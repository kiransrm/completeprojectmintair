<?php
require_once('dbconfig.php');
require_once('class.common_functions.php');

/* Written by kiransrm*/

class BackupRestore extends CommonFunctions
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
		

	}
	
	public function backupDbTableSql($tables = '*'){

	    //get all of the tables
	    if($tables == '*'){
	        $tables = array();
	        $result = $this->conn->query("SHOW TABLES");
	        while($row = $result->fetch(PDO::FETCH_NUM)){
	            $tables[] = $row[0];
	        }
	    }else{
	        $tables = is_array($tables)?$tables:explode(',',$tables);
	    }

	    //loop through the tables
	    foreach($tables as $table){
	        $result = $this->conn->prepare("SELECT * FROM $table");
	        $result->execute();
	       	$numColumns = $result->columnCount();
	      
	        $return .= "DROP TABLE $table;";

	        $result2 = $this->conn->prepare("SHOW CREATE TABLE $table");
	        $result2->execute();
	        $row2 = $result2->fetch(PDO::FETCH_NUM);

	        $return .= "\n\n".$row2[1].";\n\n";

	        for($i = 0; $i < $numColumns; $i++){
	            while($row = $result->fetch(PDO::FETCH_NUM)){
	                $return .= "INSERT INTO $table VALUES(";
	                for($j=0; $j < $numColumns; $j++){
	                    $row[$j] = addslashes($row[$j]);
	                    /*uncomment below if in case face any issue*/

	                    $row[$j] = ereg_replace("\n","\\n",$row[$j]);
	                    if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
	                    if ($j < ($numColumns-1)) { $return.= ','; }
	                }
	                $return .= ");\n";
	            }
	        }

	        $return .= "\n\n\n";	
	    }

	    //save file
	   	$filenane = WEB_PATH.'/backup/db-backup-'.time().'.sql';
	    $handle = fopen($filenane,'w+');
	    fwrite($handle,$return);
	    fclose($handle);
	    $this->downloadFile($filenane);
	}
	
	public function restoreDbTableSql($filename, $tables='*'){

		// check if the file exist on server
		if(!file_exists($filename))
			return false;
		// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		//$filename = $this->renameUploadFile($filename);

		//die($filename);
		$lines = file($filename);

		// Loop through each line
		foreach ($lines as $line)
		{
		// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
		    	continue;

			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';')
			{
			    // Perform the query
			    
				try {
					
					$queryd = $this->conn->prepare($templine);
		     		$queryd->execute();
		     		// Reset temp variable to empty
		     		$templine = '';

				} catch (Exception $e) {
					$e->getMessage();
					return false;
				} 		
   	
			}
			
		}
		return true;
		
	}


	public function backupDbTableCsv($table){

		try {
			
			//check if no table is specified
			if($table ==  '')
				return false;
			
			$filenane = 'db-backup-'.time().'.csv';
	      	$columnNames = array();

	      	//get all columns from the table
	       	$columnQuery = $this->conn->prepare("SHOW COLUMNS FROM $table");
	        $columnQuery->execute();
	      	
			while ($columnQueryRow = $columnQuery->fetch(PDO::FETCH_NUM)) {
				$columnNames[] = $columnQueryRow[0];
			}
			
			//create a file pointer
		 	$filePointer = fopen('php://memory', 'w');

		 	fputcsv($filePointer, $columnNames);

			$columnDataQuery = $this->conn->prepare("SELECT * FROM $table");
	        $columnDataQuery->execute();
	     	
	 	    while($columnDataRow = $columnDataQuery->fetch(PDO::FETCH_NUM)){

		        fputcsv($filePointer, $columnDataRow);
		    }
	  
		    //move the pointer to the begining
	 	   	fseek($filePointer, 0);
	    
	    	//set headers to download file rather than displayed

	    	header('Content-Type: text/csv');
	    	header('Content-Disposition: attachment; filename="' . $filenane . '";');
	    
	    	//output all remaining data on a file pointer
	    	fpassthru($filePointer);

	    	exit;
	    } catch (Exception $e) {
			
			echo $e->getMessage();
		}
	}


	public function restoreDbTableCsv($table, $filename){


		//read the file
		//WEB_PATH.'/backup/db-backup-1540448388.csv
		$csvFile = fopen($filename, 'r');

		try {

			if($table ==  '')
				return false;
			
			//empty the data of the table before upload.
			$emptyQuery = $this->conn->prepare("TRUNCATE TABLE $table");
			$emptyQuery->execute();

			//get all columns from the table
		   	$columnQuery = $this->conn->prepare("SHOW COLUMNS FROM $table");
		    $columnQuery->execute();
		  	
			while ($columnQueryRow = $columnQuery->fetch(PDO::FETCH_NUM)) {
				$columnNames[] = $columnQueryRow[0];
			}
			
			//skip first line
	        fgetcsv($csvFile);

	     	//parse data from csv file line by line
	        while(($line = fgetcsv($csvFile)) !== FALSE){

	        	//insert the line date to table
	        	$rsQuery = $this->conn->prepare( "INSERT INTO `$table` (`".implode("`,`", $columnNames)."`) VALUES ('".implode("','", $line)."')");
	        	$rsQuery->execute();	

	        }

	        //close opened csv file
	       	fclose($csvFile);
	    } catch (Exception $e) {

			echo $e->getMessage();

			return false;
		}
        return true;

	}
}