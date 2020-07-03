<?php
	global $mainContractAddress;
	
	global $mainContractABI;
	
	global $ethPrice;
	
	global $gasPriceAverage;
	
	global $gasPriceFast;
	
    global $siteName;
	
    global $siteURL;
	
    global $etherscanAddress;
    
    global $etherscanTx;
	
    global $infuraAPI;
	
	global $ethPriceBtc;

    global $project_year;
	
	global $ethPiceInUsd;
  

    //error_reporting(0);
  require_once('lang.php');
  require_once('config.php');
include("core/language_code.php");

$query = "SELECT * FROM adminsetting  ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
 $userID = $row['id'];
if($row != NULL){
	$mainContractAddress = $row['mainContractAddress'];
	$mainContractABI = $row['mainContractABI'];
	$ethPrice = $row['ethPiceInUsd'];
}


$query = "SELECT * FROM adminsetting  ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
 $userID = $row['id'];

 
//fetching data for Level Profit
$query = "SELECT userWallet FROM event_reglevelev where userID='".clean($userID)."' ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$userWallet = $row['userWallet'];
 
//fetching data for Level Profit
$query = "SELECT SUM(amount) AS totalProfit FROM event_paidforlevelev where referrer='".clean($userWallet)."' ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$levelProfit = 0;
if($row != NULL){
	$levelProfit = $row['totalProfit'] / 1000000000000000000;
}
//Total earned:
$totalEarned =  $levelProfit;




//Toal partners - all levels
function fetchDownlinestop($userID, $conn){

$query = "SELECT userID FROM event_reglevelev where referrerID='".clean($userID)."' ";
$result = mysqli_query($conn,$query);
$row = mysqli_num_rows($result);
$tempArray = array();
if($row != NULL && $row > 0){
	while ($row1 = $result -> fetch_row()) {
		array_push($tempArray,$row1[0]);
	}
}
return $tempArray;
}



$mainArray = array();
$level1Array = array();

//level 1 referrals
$tempArray2 = fetchDownlinestop($userID, $conn);
if(count($tempArray2) > 0){
	$mainArray = array_merge($mainArray, $tempArray2);
	$level1Array = $tempArray2;

		//These are level 1 refs
		foreach ($tempArray2 as $key) {

			//level 2 referrals
			$tempArray2 = fetchDownlinestop($key, $conn);

			if(count($tempArray2) > 0){

				$mainArray = array_merge($mainArray, $tempArray2);
				//These are level 2 refs
				foreach ($tempArray2 as $key) {

					//level 2 referrals
					$tempArray2 = fetchDownlinestop($key, $conn);

					//level 3 referrals
					if(count($tempArray2) > 0){
						
						$mainArray = array_merge($mainArray, $tempArray2);

							//level 4
							foreach ($tempArray2 as $key) {

								$tempArray2 = fetchDownlinestop($key, $conn);
								
								//level 4 referrals
								if(count($tempArray2) > 0){
									
									$mainArray = array_merge($mainArray, $tempArray2);


										//level 5
										foreach ($tempArray2 as $key) {

										$tempArray2 = fetchDownlinestop($key, $conn);
										
										//level 5 referrals
										if(count($tempArray2) > 0){
											
											$mainArray = array_merge($mainArray, $tempArray2);



//level 6
foreach ($tempArray2 as $key) {

$tempArray2 = fetchDownlinestop($key, $conn);

//level 6 referrals
if(count($tempArray2) > 0){
	
	$mainArray = array_merge($mainArray, $tempArray2);

	//level 7
	foreach ($tempArray2 as $key) {

	$tempArray2 = fetchDownlinestop($key, $conn);

	//level 7 referrals
	if(count($tempArray2) > 0){
		
		$mainArray = array_merge($mainArray, $tempArray2);


		//level 8
		foreach ($tempArray2 as $key) {

		$tempArray2 = fetchDownlinestop($key, $conn);

		//level 8 referrals
		if(count($tempArray2) > 0){
			
			$mainArray = array_merge($mainArray, $tempArray2);


			//level 9
			foreach ($tempArray2 as $key) {

			$tempArray2 = fetchDownlinestop($key, $conn);

			//level 9 referrals
			if(count($tempArray2) > 0){
				
				$mainArray = array_merge($mainArray, $tempArray2);


				//level 10
				foreach ($tempArray2 as $key) {

				$tempArray2 = fetchDownlinestop($key, $conn);

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
$totalPartners = count($mainArray);
$level1Partners = count($level1Array);




  
?>

