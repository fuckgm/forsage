<?php

include('config.php');
//application level defaults



if(isset($_COOKIE['userID']) && $_COOKIE['userID'] != ''){

$userID = $_COOKIE['userID'];

$query = "SELECT * FROM event_reglevelev where userID='".clean($userID)."' ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

if($row != NULL){
	loadPages($userID, $row['userWallet'], $conn);
}
else{
	$errorMsg = 'login-unsuccessful';
	include('auth.php');	//login page with error message
}

}
elseif (isset($_COOKIE['userWallet']) && $_COOKIE['userWallet'] != '')  {

$userWallet = $_COOKIE['userWallet'];
    
$query = "SELECT * FROM event_reglevelev where userWallet='".clean($userWallet)."' ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

if($row != NULL){
	loadPages($row['userID'], $userWallet, $conn);
}
else{
	$errorMsg = 'login-unsuccessful';
	include('auth.php');	//login page with error message
}
 


} else {
    include('auth.php');
}


function loadPages($userID, $userWallet, $conn){

	if(isset($_GET['lost'])){
		include('lost.php');	
	}
	elseif(isset($_GET['downlines'])){
		include('downlines.php');	
	}
	elseif(isset($_GET['promo'])){
		include('promo.php');	
	}
	elseif(isset($_GET['uplines'])){
		include('uplines.php');	
	}
	elseif(isset($_GET['logout'])){
		include('logout.php');	
	}
	else{
		include('dashboard.php');	
	}

}





?>