<?php

$date2=date('Y-m-d');	
$date1 =$project_year;


$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

	
$url=$etherscanAddress.''.$mainContractAddress;
$cURLConnection = curl_init();
curl_setopt($cURLConnection, CURLOPT_URL, $url);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($cURLConnection, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($cURLConnection, CURLOPT_CUSTOMREQUEST, "GET");
$etherscanCode = curl_exec($cURLConnection);
$error = curl_error($cURLConnection);
//echo $error;
curl_close($cURLConnection);
$data = explode("title='Click to view full list'>",$etherscanCode);
$data = explode("</a> transactions",$data[1]);
$totalTransactions = $data[0];


//find total participates
$query = "SELECT count(*) FROM event_reglevelev  ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_row($result);
$totalParticipants = 0;
if($row != NULL){
	$totalParticipants = $row[0];
}


//fetching data for Level Profit
$query = "SELECT SUM(amount) AS totalProfit FROM event_paidforlevelev where referrer='".clean($userWallet)."' ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$levelProfit = 0;
if($row != NULL){
	$levelProfit = $row['totalProfit'] / 1000000000000000000;
	
}
//Total earned:




/*




$query = "SELECT level, COUNT(*) as totalRows  FROM event_paidforlevelev GROUP BY level";
$result = mysqli_query($conn,$query);
$totalPaidForLevels = array();
if($result != NULL){
	while ($row = mysqli_fetch_assoc($result)) {
		$totalPaidForLevels[$row['level']] = $row['totalRows'];
	}
}
$query = "SELECT level, COUNT(*) as totalRows  FROM event_lostforlevelev GROUP BY level";
$result = mysqli_query($conn,$query);
$totalLostForLevels = array();
if($result != NULL){
	while ($row = mysqli_fetch_assoc($result)) {
		$totalLostForLevels[$row['level']] = $row['totalRows'];
	}
}
for($i=0;$i<=10;$i++){
	if(!isset($totalPaidForLevels[$i])){
		$totalPaidForLevels[$i] = 0;
	}
	if(!isset($totalLostForLevels[$i])){
		$totalLostForLevels[$i] = 0;
	}
}
*/

