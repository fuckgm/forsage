<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");


if(isset($_REQUEST['userid']) && isset($_REQUEST['block']) && isset($_REQUEST['txHash']) ){


$blockNumber = $_REQUEST['block'];
$userid = $_REQUEST['userid'];
$inputTxHash = $_REQUEST['txHash'];







$contract = "0xff8e926d0d92b5da930f5534a79e5b821f719f8a";

$regLevelEv = "0x3763287bad057fbb8d9daa3d5b43669cf979ff2e772207bb964aac646d3bcf5e";
$paidForLevelEv = "0x0734110f42782e4b9e753c59dd68a1c5a95d493d0055b9e2ac5bf868a7d3e4ca";
$lostForLevelEv = "0x066de3bfb518a0ab80b46247552cd821402c26802e462195762d8696dbb27f5f";
$levelBuyEv = "0xf5f484ee3d635738bdec948ed09f313573438a5cd84840aa0c1991eaf37df54a";
$autoPoolPayEv = "0x48fc38f6edf90a47053931ebbbe8ccb13ec20d565a2a70156b76ba327efd61b0";
$paidForUniLevelEv="0xad55d0dd3030e6fbcfa4c70bb06457f0c59741e04a62b466af1e0d8ce050f68e";


//just put block number - 1. That is just so it fetch one extra block. Just in case. 
$url ="https://api.etherscan.io/api?module=logs&action=getLogs&fromBlock=".($blockNumber-1)."&toBlock=".($blockNumber+1)."&address=".$contract;



$ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $output = curl_exec($ch);
    $output = json_decode($output);
    curl_close ($ch);



if($output->status=='1'){
    
$result = $output->result;

$isRegUser=0;
foreach ($result as $key => $value) {

if($value->transactionHash == $inputTxHash && $value->topics[0] == $regLevelEv){

    $userID = $value->topics[2];
    $userID = hexdec($userID);

    $query = "select `userID` from `event_reglevelev`  where userID='".$userID."'";
    $q = mysqli_query( $conn, $query );
    $x = mysqli_fetch_row($q);
    
    if($x!=NULL && count($x)>0){
        $isRegUser=1;
    }
}
}




foreach ($result as $key => $value) {

if($value->transactionHash == $inputTxHash && $isRegUser == 0){

$blockNumber = $value->blockNumber;
$blockNumber = hexdec($blockNumber);



    if($value->topics[0] == $levelBuyEv){

  //var_dump($value);      

        $userWallet = $value->topics[1];
        $userWallet = '0x'.substr($userWallet,26);

        $data = $value->data;

        $level = hexdec('0x'.substr($data,0,66));
        $amount = hexdec('0x'.substr($data,66,64));
        $time = hexdec('0x'.substr($data,130,64));

        $query = "INSERT INTO `event_levelbuyev` (buyer, level, amount, timestamp)";
        $query .= " VALUES ('".$userWallet."','".$level."','".$amount."','".$time."');";
        mysqli_query( $conn, $query ) or die("ErroR..".mysqli_error($conn));

    }
    elseif($value->topics[0] == $lostForLevelEv){
//  var_dump($value);  
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
        mysqli_query( $conn, $query ) or die("ERRoor...".mysqli_error($conn));

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

        $query = "INSERT INTO `event_paidforlevelev` (referrer, buyer, level, amount, timestamp)";
        $query .= " VALUES ('".$userWallet."', '".$referralWallet."', '".$level."','".$amount."','".$time."');";
        //print $query."<br/>";
        mysqli_query( $conn, $query ) or die("ERROOr..".mysqli_error($conn));

    }

 
    elseif($value->topics[0] == $regLevelEv){

        //var_dump($value);

        $userID = $value->topics[2];
        $userID = hexdec($userID);


        $userWallet = $value->topics[1];
        $userWallet = '0x'.substr($userWallet,26);

        $referrerID = $value->topics[3];
        $referrerID = hexdec($referrerID);


        $data = $value->data;

        $time = substr($data,0,66);
        $time = hexdec('0x'.substr($time,26));


        $refererWallet = substr($data,66,64);
        $refererWallet = '0x'.substr($refererWallet,24);


        $originalReferrerID = hexdec('0x'.substr($data,130,64));


        

        $query = "INSERT INTO `event_reglevelev` (userID,  userWallet, referrerID, originalReferrer, timestamp)";
        $query .= " VALUES ('".$userID."','".$userWallet."', '".$referrerID."','".$originalReferrerID."','".$time."');";
        //print $query."<br/>";
        //mysqli_query( $conn, $query ) or die(mysqli_error($conn));

    }

    elseif($value->topics[0] == $autoPoolPayEv){

        var_dump($value);


        $data = $value->data;

        $time = substr($data,0,66);
        $time = hexdec('0x'.substr($time,26));


        $paidTo  = substr($data,66,64);
        $paidTo = '0x'.substr($paidTo,24);


        $originalReferrerID = hexdec('0x'.substr($data,130,64));


        

        $query = "INSERT INTO `event_reglevelev` (userID,  userWallet, referrerID, originalReferrer, timestamp)";
        $query .= " VALUES ('".$userID."','".$userWallet."', '".$referrerID."','".$originalReferrerID."','".$time."');";
        //print $query."<br/>";
        mysqli_query( $conn, $query ) or die(mysqli_error($conn));

    }




}
}
}

}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Sync Individual User ID</title>
</head>
<body>


<br><br><br>

<center>
    <form type="GET" action="">
        <div>
            
            <table>
                <tr>
                    <td>
                        User ID: 
                    </td>
                    <td>
                        <input type="text" name="userid">
                    </td>
                </tr>
                <tr>
                    <td>
                        Block Number: 
                    </td>
                    <td>
                        <input type="text" name="block">
                    </td>
                </tr>
                <tr>
                    <td>
                        Transaction Hash: 
                    </td>
                    <td>
                        <input type="text" name="txHash">
                    </td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                    <td>
                        <input type="submit" name="formSubmit">
                    </td>
                </tr>
            </table>
        </div>
    </form>
</center>
</body>
</html>

