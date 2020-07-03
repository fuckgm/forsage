<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//system default localhost server
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','forsage');




$conn = mysqli_connect(DB_HOST,DB_USER, DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }


//getting admin setting data
$query = "SELECT * FROM adminsetting  ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

define('SITE_URL',$row['siteURL']);
if($row != NULL){
    
    $mainContractABI = $row['mainContractABI'];
    $ethPrice = $row['ethPiceInUsd'];
    $gasPriceAverage = $row['gasPriceAverage'];
    $gasPriceFast = $row['gasPriceFast'];
    $siteName=$row['siteName'];
    $siteURL=$row['siteURL'];   
    $etherscanAddressMain = $row['etherscanAddressMain'];
    $etherscanAddressTestnet = $row['etherscanAddressTestnet'];
    $etherscanTxMain  = $row['etherscanTxMain'];
    $etherscanTxTestnet  = $row['etherscanTxTestnet'];
    $infuraAPIMainnet  = $row['infuraAPIMainnet'];
    $infuraAPITestnet  = $row['infuraAPITestnet'];
    $network=$row['network'];
    $ethPriceBtc=$row['ethPiceInBtc'];
    $project_year=$row['project_year'];
    $ethPiceInUsd=$row['ethPiceInUsd'];
}

// 0 = rinkeby testnet and 1 = mainnet
if($network==0){

    $mainContractAddress = $row['testnetContractAddress'];  

    $etherscanAddress = $row['etherscanAddressTestnet'];
   
    $etherscanTx  = $row['etherscanTxTestnet'];
    
    $infuraAPI  = $row['infuraAPITestnet'];

    $etherscanAPIurl = $row['etherscanAPIurlTestnet'];
    
}else {
        
    $mainContractAddress = $row['mainContractAddress'];

    $etherscanAddress = $row['etherscanAddressMain'];
    
    $etherscanTx  = $row['etherscanTxMain'];
    
    $infuraAPI  = $row['infuraAPIMainnet'];

   $etherscanAPIurl = $row['etherscanAPIurlMainnet'];
    
}


 function clean($string) {
   $string = str_replace(' ', '', $string); // Remove all spaces.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}


