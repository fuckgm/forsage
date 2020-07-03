<?php

error_reporting(0);
	
require 'config.php';

$today=$_REQUEST["today"];
$tomorrow=$_REQUEST["tomorrow"];
$userID=$_REQUEST["refid"];


/*
$query = "select timestamp FROM event_reglevelev where timestamp<=".$today." and timestamp>=".$tomorrow." and referrerID=".$refid."";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_all($result);
*/

//echo json_encode($row);



//Toal partners - all levels
$dayWiseArray = array();
function fetchDownlines($userID, $conn, $today, $tomorrow, &$dayWiseArray){

$query = "select userID, timestamp FROM event_reglevelev where timestamp<=".$today." and timestamp>=".$tomorrow." and referrerID=".$userID."";
$result = mysqli_query($conn,$query);
$row = mysqli_num_rows($result);
$tempArray = array();
if($row != NULL && $row > 0){
	while ($row1 = $result -> fetch_row()) {
		array_push($tempArray,$row1[0]);
		$day = date('d', $row1[1]);
		$dayWiseArray[$day]++;
	}
}
return $tempArray;
}



$mainArray = array();
$level1Array = array();

//level 1 referrals
$tempArray2 = fetchDownlines($userID, $conn, $today, $tomorrow, $dayWiseArray);
if(count($tempArray2) > 0){
	$mainArray = array_merge($mainArray, $tempArray2);
	$level1Array = $tempArray2;

		//These are level 1 refs
		foreach ($tempArray2 as $key) {

			//level 2 referrals
			$tempArray2 = fetchDownlines($key, $conn, $today, $tomorrow, $dayWiseArray);

			if(count($tempArray2) > 0){

				$mainArray = array_merge($mainArray, $tempArray2);
				//These are level 2 refs
				foreach ($tempArray2 as $key) {

					//level 2 referrals
					$tempArray2 = fetchDownlines($key, $conn, $today, $tomorrow, $dayWiseArray);

					//level 3 referrals
					if(count($tempArray2) > 0){
						
						$mainArray = array_merge($mainArray, $tempArray2);

							//level 4
							foreach ($tempArray2 as $key) {

								$tempArray2 = fetchDownlines($key, $conn, $today, $tomorrow, $dayWiseArray);
								
								//level 4 referrals
								if(count($tempArray2) > 0){
									
									$mainArray = array_merge($mainArray, $tempArray2);


										//level 5
										foreach ($tempArray2 as $key) {

										$tempArray2 = fetchDownlines($key, $conn, $today, $tomorrow, $dayWiseArray);
										
										//level 5 referrals
										if(count($tempArray2) > 0){
											
											$mainArray = array_merge($mainArray, $tempArray2);



//level 6
foreach ($tempArray2 as $key) {

$tempArray2 = fetchDownlines($key, $conn, $today, $tomorrow, $dayWiseArray);

//level 6 referrals
if(count($tempArray2) > 0){
	
	$mainArray = array_merge($mainArray, $tempArray2);

	//level 7
	foreach ($tempArray2 as $key) {

	$tempArray2 = fetchDownlines($key, $conn, $today, $tomorrow, $dayWiseArray);

	//level 7 referrals
	if(count($tempArray2) > 0){
		
		$mainArray = array_merge($mainArray, $tempArray2);


		//level 8
		foreach ($tempArray2 as $key) {

		$tempArray2 = fetchDownlines($key, $conn, $today, $tomorrow, $dayWiseArray);

		//level 8 referrals
		if(count($tempArray2) > 0){
			
			$mainArray = array_merge($mainArray, $tempArray2);


			//level 9
			foreach ($tempArray2 as $key) {

			$tempArray2 = fetchDownlines($key, $conn, $today, $tomorrow, $dayWiseArray);

			//level 9 referrals
			if(count($tempArray2) > 0){
				
				$mainArray = array_merge($mainArray, $tempArray2);


				//level 10
				foreach ($tempArray2 as $key) {

				$tempArray2 = fetchDownlines($key, $conn, $today, $tomorrow, $dayWiseArray);

				//level 10 referrals
				if(count($tempArray2) > 0){
					
					$mainArray = array_merge($mainArray, $tempArray2);






				}//level 10 if condition


				}	//level 10 foreach



			}//level 9 if condition


			}	//level 9 foreach



		}//level 8 if condition


		}	//level 8 foreach



	}//level 7 if condition


	}	//level 7 foreach




}//level 6 if condition


}	//level 6 foreach




										}//level 5 if condition


									}	//level 5 foreach


								}//level 4 if condition


							}	//level 4 foreach


					}//level 3 if condition


				}	//level 3 foreach


			}//level 2 if condition


		}	//level 2 foreach



}	// level 1 if condition





ksort($dayWiseArray);
$finalArray = array();
$firstDay = $day = date('d', $_REQUEST["tomorrow"]);

for($i=0; $i<7; $i++){
	if(!isset($dayWiseArray[$firstDay])) {
		array_push($finalArray,0);
	}
	else{
		array_push($finalArray, $dayWiseArray[$firstDay]);
	}
	$firstDay++;
}
echo json_encode($finalArray);
?>