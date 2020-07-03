<?php

//Toal partners - all levels
function fetchDownlines($userID, $conn){

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

$url=$etherscanAddress.$mainContractAddress;
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
//curl_getinfo($etherscanCode);
curl_close($cURLConnection);
$data = explode("title='Click to view full list'>",$etherscanCode);
$data = explode("</a> transactions",$data[1]);
$totalTransactions = $data[0];


//find users earned
$query = "SELECT sum(amount) FROM event_levelbuyev ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_row($result);
$totalEarned = 0;
if($row != NULL){
	$totalEarned = $row[0] / 1000000000000000000;
}
$totalEarnedUSD=$totalEarned* $ethPiceInUsd;
$totalEarnedBTC=$totalEarned*$ethPriceBtc;



$query = "SELECT count(*) FROM event_reglevelev  ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_row($result);
$totalParticipants = 0;
if($row != NULL){
	$totalParticipants = $row[0];
}


$query = "SELECT level, COUNT(*) as totalRows  FROM event_levelbuyev GROUP BY level";
$result = mysqli_query($conn,$query);
$totalPaidForLevels = array();
if($result != NULL){
	while ($row = mysqli_fetch_assoc($result)) {
		$totalPaidForLevels[$row['level']] = $row['totalRows'];
	}
}

for($i=0;$i<=10;$i++){
	if(!isset($totalPaidForLevels[$i])){
		$totalPaidForLevels[$i] = 0;
	}
}

$mainArray = array();
$level1Array = array();

//level 1 referrals
$tempArray2 = fetchDownlines($userID, $conn);
if(count($tempArray2) > 0){
	$mainArray = array_merge($mainArray, $tempArray2);
	$level1Array = $tempArray2;

		//These are level 1 refs
		foreach ($tempArray2 as $key) {

			//level 2 referrals
			$tempArray2 = fetchDownlines($key, $conn);

			if(count($tempArray2) > 0){

				$mainArray = array_merge($mainArray, $tempArray2);
				//These are level 2 refs
				foreach ($tempArray2 as $key) {

					//level 2 referrals
					$tempArray2 = fetchDownlines($key, $conn);

					//level 3 referrals
					if(count($tempArray2) > 0){
						
						$mainArray = array_merge($mainArray, $tempArray2);

							//level 4
							foreach ($tempArray2 as $key) {

								$tempArray2 = fetchDownlines($key, $conn);
								
								//level 4 referrals
								if(count($tempArray2) > 0){
									
									$mainArray = array_merge($mainArray, $tempArray2);


										//level 5
										foreach ($tempArray2 as $key) {

										$tempArray2 = fetchDownlines($key, $conn);
										
										//level 5 referrals
										if(count($tempArray2) > 0){
											
											$mainArray = array_merge($mainArray, $tempArray2);



//level 6
foreach ($tempArray2 as $key) {

$tempArray2 = fetchDownlines($key, $conn);

//level 6 referrals
if(count($tempArray2) > 0){
	
	$mainArray = array_merge($mainArray, $tempArray2);

	//level 7
	foreach ($tempArray2 as $key) {

	$tempArray2 = fetchDownlines($key, $conn);

	//level 7 referrals
	if(count($tempArray2) > 0){
		
		$mainArray = array_merge($mainArray, $tempArray2);


		//level 8
		foreach ($tempArray2 as $key) {

		$tempArray2 = fetchDownlines($key, $conn);

		//level 8 referrals
		if(count($tempArray2) > 0){
			
			$mainArray = array_merge($mainArray, $tempArray2);


			//level 9
			foreach ($tempArray2 as $key) {

			$tempArray2 = fetchDownlines($key, $conn);

			//level 9 referrals
			if(count($tempArray2) > 0){
				
				$mainArray = array_merge($mainArray, $tempArray2);


				//level 10
				foreach ($tempArray2 as $key) {

				$tempArray2 = fetchDownlines($key, $conn);

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
		<div class="simplemarquee-wrapper" style="display: inline-block;animation: 41.0286s linear 0s infinite normal none running simplemarquee-2cb6d14153e;background-color: white;vertical-align: top;">


            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['total participants']; ?></div>
                <div class="currency__data">
                    <img src="./img/pa_icon_bar.png" width="21" alt="" class="currency__chart" style="display: none;"><i class="fas fa-user"></i> 
                    <span id="vs_line_total_user" class="currency__value"><?=$totalParticipants; ?></span>
                </div>
            </div>
            
            <div class="currency">
                <div class="currency__percent currency__percent--minus">1 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l1_tx" class="currency__value"><?php echo $totalPaidForLevels[1]; ?></span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus">2 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l2_tx" class="currency__value"><?php echo $totalPaidForLevels[2]; ?></span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus">3 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l3_tx" class="currency__value"><?php echo $totalPaidForLevels[3]; ?></span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus">4 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l4_tx" class="currency__value"><?php echo $totalPaidForLevels[4]; ?></span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus">5 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l5_tx" class="currency__value"><?php echo $totalPaidForLevels[5]; ?></span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus">6 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l6_tx" class="currency__value"><?php echo $totalPaidForLevels[6]; ?></span>
                </div>
            </div>
            
            
            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['project month'];?> </div>
                <div class="currency__data">
                    <i class="fas fa-calendar-alt"></i> 
                    <span id="vs_project_days" class="currency__value">
                    	<?=$months; ?></span>
                </div>
            </div>
			 <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['total transactions'];?></div>
                <div class="currency__data">
                    <i class="fas fa-chart-bar"></i> <span id="vs_line_total_tx" class="currency__value"><?=$totalTransactions; ?></span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['total'];?> ETH</div>
                <div class="currency__data">
                    <i class="fab fa-ethereum"></i> <span id="vs_ETH_amuont" class="currency__value"><?=$totalEarned;?></span> <span class="currency__pair">ETH</span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['equivalent to'];?> BTC</div>
                <div class="currency__data">
                    <i class="fab fa-bitcoin"></i> <span id="vs_BTC_amuont" class="currency__value"><?=$totalEarnedBTC; ?></span> <span class="currency__pair">BTC</span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['equivalent to']; ?> USD</div>
                <div class="currency__data">
                    <i class="fas fa-dollar-sign"></i> <span id="vs_USDT_amuont" class="currency__value"><?=$totalEarnedUSD; ?></span> <span class="currency__pair">USD</span>
                </div>
            </div>

        </div><div class="simplemarquee-wrapper" style="display: inline-block; margin-left: 40px; animation: 41.0286s linear 0s infinite normal none running simplemarquee-2cb6d14153e;">


            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['total participants'];?></div>
                <div class="currency__data">
                    <img src="./img/pa_icon_bar.png" width="21" alt="" class="currency__chart" style="display: none;"><i class="fas fa-user"></i> <span id="vs_line_total_user" class="currency__value"><?=$totalParticipants; ?></span>
                </div>
            </div>
            
            <div class="currency" style="display: none;">
                <div class="currency__percent currency__percent--minus">1 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l1_tx" class="currency__value"><?php echo $totalPaidForLevels[1] + $totalLostForLevels[1]; ?></span>
                </div>
            </div>
            <div class="currency" style="display: none;">
                <div class="currency__percent currency__percent--minus">2 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l2_tx" class="currency__value"><?php echo $totalPaidForLevels[2] + $totalLostForLevels[2]; ?></span>
                </div>
            </div>
            <div class="currency" style="display: none;">
                <div class="currency__percent currency__percent--minus">3 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l3_tx" class="currency__value"><?php echo $totalPaidForLevels[3] + $totalLostForLevels[3]; ?></span>
                </div>
            </div>
            <div class="currency" style="display: none;">
                <div class="currency__percent currency__percent--minus">4 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l4_tx" class="currency__value"><?php echo $totalPaidForLevels[4] + $totalLostForLevels[4]; ?></span>
                </div>
            </div>
            <div class="currency" style="display: none;">
                <div class="currency__percent currency__percent--minus">5 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l5_tx" class="currency__value"><?php echo $totalPaidForLevels[5] + $totalLostForLevels[5]; ?></span>
                </div>
            </div>
            <div class="currency" style="display: none;">
                <div class="currency__percent currency__percent--minus">6 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l6_tx" class="currency__value"><?php echo $totalPaidForLevels[6] + $totalLostForLevels[6]; ?></span>
                </div>
            </div>
            <div class="currency" style="display: none;">
                <div class="currency__percent currency__percent--minus">7 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l7_tx" class="currency__value"><?php echo $totalPaidForLevels[7] + $totalLostForLevels[7]; ?></span>
                </div>
            </div>
            <div class="currency" style="display: none;">
                <div class="currency__percent currency__percent--minus">8 <?=$$lang['LEVEL'];?></div>
                <div class="currency__data">
                    <i class="fas fa-user"></i> <span id="vs_line_l8_tx" class="currency__value"><?php echo $totalPaidForLevels[8] + $totalLostForLevels[8]; ?></span>
                </div>
            </div>
            
            
            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['project month'];?></div>
                <div class="currency__data">
                    <i class="fas fa-calendar-alt"></i> <span id="vs_project_days" class="currency__value"><?=$months; ?></span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['total transactions'];?></div>
                <div class="currency__data">
                    <i class="fas fa-chart-bar"></i> <span id="vs_line_total_tx" class="currency__value"><?=$totalTransactions; ?></span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['total'];?> ETH</div>
                <div class="currency__data">
                    <i class="fab fa-ethereum"></i> <span id="vs_ETH_amuont" class="currency__value"><?=$totalEarned;?></span> <span class="currency__pair">ETH</span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['equivalent to'];?> BTC</div>
                <div class="currency__data">
                    <i class="fab fa-bitcoin"></i> <span id="vs_BTC_amuont" class="currency__value"><?=$totalEarnedBTC;?></span> <span class="currency__pair">BTC</span>
                </div>
            </div>
            <div class="currency">
                <div class="currency__percent currency__percent--minus"><?=$$lang['equivalent to'];?> USD</div>
                <div class="currency__data">
                    <i class="fas fa-dollar-sign"></i> <span id="vs_USDT_amuont" class="currency__value"><?=$totalEarnedUSD;?></span> <span class="currency__pair">USD</span>
                </div>
            </div>

        </div><style>
        
        .currency {
            display: inline-block;
            padding: 5px 65px 0px;
            text-align: center;
            color: #000000;
        }
        
        .currency {
            text-transform: uppercase;
            font-weight: 300;
        }
        
        .currency__percent.currency__percent--minus {
            font-size: 12px;
        }
        
        .currency__data {
            /*color: #f2f4ff;*/
            font-size: 12px;
            font-weight: 400;
            line-height: 30px;
            text-transform: uppercase;
        }
        
            @-webkit-keyframes simplemarquee-2cb6d14153e {
                0%   { -webkit-transform: translate(0, 0); } 
                100% { -webkit-transform: translate(-1436px, 0); }
            }
            @-moz-keyframes simplemarquee-2cb6d14153e {
                0%   { -moz-transform: translate(0, 0); } 
                100% { -moz-transform: translate(-1436px, 0); }
            }
            @-o-keyframes simplemarquee-2cb6d14153e {
                0%   { -o-transform: translate(0, 0); } 
                100% { -o-transform: translate(-1436px, 0); }
            }
            @keyframes simplemarquee-2cb6d14153e {
                0%   { transform: translate(0, 0); } 
                100% { transform: translate(-1436px, 0); }
            }
            </style>
            </div>