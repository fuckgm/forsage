<?php
//write default db_name, db_host, db_user, db_pass  below in line 7, and if require_onced one can pass other db_name...etc on fly while calling 'runsql' function

// function "runsql" will return array of rows for query started with 'select' or 'show' and will return true or false for other query

include("config.php");


function runsql($Sql)
 {
	 global $conn;
	 //echo $Sql;
	//$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	if(! $conn ) 
	{
		echo "Database connection fail" . mysqli_connect_error();	
    }
   else if ($conn) 
	{
		$rows=array();
		$Sql = ltrim($Sql);
		$result = mysqli_query($conn,$Sql);
		$QType = strtoupper(substr($Sql,0,4));
		if ($QType == "SELE" or $QType == "SHOW")
		{
			while($row = $result->fetch_assoc())
			{
				array_push($rows,$row);
			}
			return $rows;
		}
		else if ($QType == "INSE" )
		{
			return $conn->insert_id;
		}
		else
		{
			return $result;
		}	
	} 
	mysqli_close($conn); 
 }
 
 //this function is only for debug purpose to see array contents
 function sa($NewArray)
 {
	 echo '<pre>';
	 print_r($NewArray);
	 echo '</pre>';
	 //die();
 }
 ?>
