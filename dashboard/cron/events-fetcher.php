<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//include("../config.php");
include dirname(__FILE__).'/../config.php';

$query = "select `blockNumber` from `event_blocks_synced`  ORDER BY `blockNumber` DESC limit 0,1";
$q = mysqli_query( $conn, $query ) or die(mysqli_error($conn));
$x = mysqli_fetch_row($q);
$lastBlock = 0;
if($x!=null){
    $lastBlock = $x[0];
}



//$contract = "0xe7ef1ece7fb594bc20e6f191edaa2d34e2ea730e";
$contract = $mainContractAddress;
$regLevelEv = "0xb379f7768ce193adf456f71484d8a30387411414ad0d537cb05321c4f47b2672";
$paidForLevelEv = "0x0734110f42782e4b9e753c59dd68a1c5a95d493d0055b9e2ac5bf868a7d3e4ca";
$lostForLevelEv = "0x066de3bfb518a0ab80b46247552cd821402c26802e462195762d8696dbb27f5f";
$levelBuyEv = "0xf5f484ee3d635738bdec948ed09f313573438a5cd84840aa0c1991eaf37df54a";


$url = $etherscanAPIurl."/api?module=logs&action=getLogs&fromBlock=".($lastBlock)."&toBlock=latest&address=".$contract;

$ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $output = curl_exec($ch);
    $output = json_decode($output);
    curl_close ($ch);

//print_r($output);

if($output->status=='1'){

$blockNumber = end($output->result)->blockNumber;
$blockNumber = hexdec($blockNumber);
if ($blockNumber > $lastBlock)
{

    
$result = $output->result;

foreach ($result as $key => $value) {

$blockNumber = $value->blockNumber;
$blockNumber = hexdec($blockNumber);


$query = "INSERT INTO `event_blocks_synced` (blockNumber) VALUES ('".$blockNumber."');";
mysqli_query( $conn, $query );


    if($value->topics[0] == $levelBuyEv){

        $userWallet = $value->topics[1];
        $userWallet = '0x'.substr($userWallet,26);

        $data = $value->data;

        $level = hexdec('0x'.substr($data,0,66));
        $amount = hexdec('0x'.substr($data,66,64));
        $time = hexdec('0x'.substr($data,130,64));

        $query = "INSERT INTO `event_levelbuyev` (buyer, level, amount, timestamp)";
        $query .= " VALUES ('".$userWallet."','".$level."','".$amount."','".$time."');";
       // print $query."<br/>";
        mysqli_query( $conn, $query );

    }
    elseif($value->topics[0] == $lostForLevelEv){

        $userWallet = $value->topics[1];
        $userWallet = '0x'.substr($userWallet,26);

        $referralWallet = $value->topics[2];
        $referralWallet = '0x'.substr($referralWallet,26);

        $data = $value->data;

        $level = hexdec('0x'.substr($data,0,66));
        $amount = hexdec('0x'.substr($data,66,64));
        $time = hexdec('0x'.substr($data,130,64));

        $query = "INSERT INTO `event_lostforlevelev` (referrer, buyer, level, amount, timestamp)";
        $query .= " VALUES ('".$userWallet."', '".$referralWallet."', '".$level."','".$amount."','".$time."');";
        //print $query."<br/>";
        mysqli_query( $conn, $query );

    }

    elseif($value->topics[0] == $paidForLevelEv){

        $userWallet = $value->topics[1];
        $userWallet = '0x'.substr($userWallet,26);

        $referralWallet = $value->topics[2];
        $referralWallet = '0x'.substr($referralWallet,26);

        $data = $value->data;

        
        $level = hexdec('0x'.substr($data,0,66));
        $amount = hexdec('0x'.substr($data,66,64));
        $time = hexdec('0x'.substr($data,130,64));
    
   

        $query = "INSERT INTO `event_paidforlevelev` (referrer, buyer, level, timestamp, amount)";
        $query .= " VALUES ('".$userWallet."', '".$referralWallet."', '".$level."','".$time."','".$amount."');";
        print $query."<br/>";
        mysqli_query( $conn, $query );

    }

 
    elseif($value->topics[0] == $regLevelEv){

//var_dump($value);
        $userID = $value->topics[1];
        $userID = hexdec($userID);


        $userWallet = $value->topics[2];
        $userWallet = '0x'.substr($userWallet,26);

        $referrerID = $value->topics[3];
        $referrerID = hexdec($referrerID);


        $data = $value->data;
        $refererWallet = substr($data,0,66);
        $refererWallet = '0x'.substr($refererWallet,26);


        $originalReferrerID = substr($data,66,64);
        $originalReferrerID = hexdec('0x'.substr($originalReferrerID,24));


        $time = substr($data,130,64);
        $time = hexdec('0x'.substr($time,24));

        $query = "INSERT INTO `event_reglevelev` (userID,  userWallet, referrerID, originalReferrer, timestamp)";
        $query .= " VALUES ('".$userID."','".$userWallet."', '".$referrerID."','".$originalReferrerID."','".$time."');";
        //print $query."<br/>";
        mysqli_query( $conn, $query );

    }

}

}

}


//update ether's USD price
$handle = curl_init();
$url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2Cethereum&vs_currencies=usd";
// Set the url
curl_setopt($handle, CURLOPT_URL, $url);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
$output = curl_exec($handle);
$output = json_decode($output, true);
//var_dump($output);
curl_close($handle);
$ethPrice = $output['ethereum']['usd'];
//updating the admin setting table
$query = "UPDATE adminsetting SET ethPiceInUsd=".$ethPrice;
mysqli_query( $conn, $query );




//updating gas price from ethgasstation.info
$handle = curl_init();
$url = "https://ethgasstation.info/json/ethgasAPI.json";
// Set the url
curl_setopt($handle, CURLOPT_URL, $url);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
$output = curl_exec($handle);
curl_close($handle);
$gasPriceAverage = json_decode($output)->average / 10;
$gasPriceFastest = json_decode($output)->fastest / 10;
//updating the admin setting table
$query = "UPDATE adminsetting SET gasPriceAverage=".$gasPriceAverage.", gasPriceFast=".$gasPriceFastest;
mysqli_query( $conn, $query ) or die(mysqli_error($conn));




/*  CODE TO EXTRACT VARIOUS VARIOUS TYPES

//BLOCK NUMBER
$blockNumber = $value->blockNumber;
$blockNumber = hexdec($blockNumber);


//TIMESTAMP
$timeStamp = $value->timeStamp;
$timeStamp = hexdec($timeStamp);


//UINT256
$tokenId = $value->topics[2];
$tokenId = hexdec($tokenId);


//ADDRESS
$userWallet = $value->topics[1];
$userWallet = '0x'.substr($userWallet,26);


//DATA
$data = $value->data;
$level = hexdec('0x'.substr($data,0,66));
$amount = hexdec('0x'.substr($data,66,64));
$time = hexdec('0x'.substr($data,130,64));



*/