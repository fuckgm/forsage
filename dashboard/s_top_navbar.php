<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from getbootstrapadmin.com/remark/material/iconbar/tables/datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Feb 2020 16:11:44 GMT -->
<head>
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

    include("core/language_code.php");


 function clean($string) {
   $string = str_replace(' ', '', $string); // Remove all spaces.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}




//getting admin setting data
    $query = "SELECT * FROM adminsetting  ";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    if($row != NULL){
       $mainContractAddress = $row['mainContractAddress'];
       $mainContractABI = $row['mainContractABI'];
       $ethPrice = $row['ethPiceInUsd'];
   }



//fetching data for Level Profit
   $query = "SELECT SUM(amount) AS totalProfit FROM forsage_event_paidforlevelev where referrer='".clean($userWallet)."' ";
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

    $query = "SELECT userID FROM forsage_event_reglevelev where referrerID='".clean($userID)."' ";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $page; ?> | Dashboard</title>
    <meta charset="utf-8">
    <script src="assets_s_/Decentralized/js/Qz1JI3jKPnt9NwuKnYPNmoYn8JE.js"></script>
    <link rel="stylesheet" href="assets_s/Decentralized/css/all.min.css" />
    <link rel="stylesheet" href="assets_s/Decentralized/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets_s/Decentralized/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="assets_s/Decentralized/css/common.css" />
    <link rel="stylesheet" href="assets_s/Decentralized/css/main.css" />
    <link rel="stylesheet" href="assets_s/Decentralized/css/style.css" />   
    <link rel="apple-touch-icon" sizes="180x180" href="assets_s/Decentralized/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets_s/Decentralized/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets_s/Decentralized/img/favicon-16x16.png">
    <link rel="manifest" href="assets_s/Decentralized/img/site.webmanifest">
    <link rel="mask-icon" href="assets_s/Decentralized/img/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="assets_s/Decentralized/img/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Forsage">
    <meta name="application-name" content="Forsage">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="assets_s/Decentralized/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <style type="text/css">
        /*toggle buttons*/

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

    </style>
    <script type="text/javascript" src="core/js/dashboard.js" crossorigin="anonymous">

    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 logotype-wrapper">
            <div class="logotype">
                <a href="<?php echo SITE_URL;?>">
                    <img src="assets_s/Decentralized/img/logo-03.svg" alt="">
                    <!-- <img src="/img/forsagelogo.svg" alt=""> -->
                </a>
            </div>
            <div class="col-md-8 nav-wrapper">
                <ul class="nav">
                    <li>
                        <div class="auth-mode_view mr-2" title="Telegram">
                            <a href="https://telete.in/forsage_official" target="_blank"> 
                                <i class="fab fa-telegram"></i>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="auth-mode_view" title="View mode">
                            <i class="fa fa-eye"></i>
                        </div>
                    </li>
                    <li>
                        <a href="/">
                        Office                    </a>
                        <ul>
                            <li <?php if($page == 'Dashboard'){echo "active";} ?>>
                                <a href="<?php echo SITE_URL.'dashboard?s_dashboard';  ?>">
                                The main panel                            </a>
                            </li>
                            <li <?php if($page == 'Partners'){echo "active";} ?>>
                                <a href="<?php echo SITE_URL.'dashboard?partners';  ?>">
                                Partners                            </a>
                            </li>
                            <li <?php if($page == 'Statistics'){echo "active";} ?>>
                                <a href="<?php echo SITE_URL.'dashboard?statistics';  ?>">
                                Statistics                            </a>
                            </li>

                            <li <?php if($page == 'Uplines'){echo "active";} ?>>
                                <a href="<?php echo SITE_URL.'dashboard?s_uplines';  ?>">
                                Uplines                            </a>
                            </li>
                            <li <?php if($page == 'Dashboard'){echo "active";} ?>>
                                <a href="">
                                Goal                            </a>
                            </li>
                        </ul> 
                    </li>
                    <li>
                        <span class="text-white mr-1">Ethbull</span>
                        <label class="switch mb-0">
                          <input type="checkbox">
                          <span class="slider switch_dashboard round"></span>
                        </label>
                        <span class="text-white ml-1">Forsage</span>
                    </li>

                        <li>
                            <a>
                            Dashboard                    </a>
                            <ul>
                              <li <?php if($page == 'Partners'){echo "active";} ?>>
                                <a href="<?php echo SITE_URL.'dashboard/?s_dashboard';?>">
                                Forsage.io                            </a>
                            </li>
                            <li>
                                <a href="<?php echo SITE_URL.'dashboard/';?>">
                                Ethbull.io                            </a>
                            </li>

                        </ul>
                    </li>

                    <li >
                        <a href="<?php echo SITE_URL.'dashboard/?information';  ?>">Information</a>
                        <ul>
                            <li>
                                <a href="/guide/">
                                Instructions                            </a>
                            </li>
                        <!-- <li>
                            <a href="/page/news/">
                                News                            </a>
                        </li>
                        <li>
                            <a href="/page/webinar/">
                                Webinars                            </a>
                            </li> -->
                        </ul>
                    </li>
                    <li >
                        <a href="<?php echo SITE_URL.'dashboard/logoutRedirect.php';  ?>">
                        Logout                    </a>
                    </li>
                </ul>
                <script>  
                    var c = "<?php echo $c;?>";
                    if(c === 'ru'){            
                     document.write('<span class="flag-icon flag-icon-ru"></span>');
                 }else if(c === 'jp'){            
                     document.write('<span class="flag-icon flag-icon-jp"></span>');

                 }else if(c === 'de'){            
                     document.write('<span class="flag-icon flag-icon-de"></span>');

                 }else if(c === 'in'){            
                     document.write('<span class="flag-icon flag-icon-in"></span>');

                 } else{
                     document.write('<span class="flag-icon flag-icon-us"></span>');
                 }
             </script>


             <div class="lang">
                <div class="lang-current">
                    <a onClick="document.cookie='country=en; path=/'; location.reload();">
                        <img src="assets_s/Decentralized/img/en.svg" alt="">
                    </a>
                </div>
                <div class="lang-list">
                    <a onClick="document.cookie='country=ru; path=/'; location.reload();">
                        <img src="assets_s/Decentralized/img/ru.svg" alt="">
                        <span>РУССКИЙ</span>
                    </a>
                    <a onClick="document.cookie='country=en; path=/'; location.reload();">
                        <img src="assets_s/Decentralized/img/en.svg" alt="">
                        <span>ENGLISH</span>
                    </a>
                    <a  onClick="document.cookie='country=de; path=/'; location.reload();">
                        <img src="assets_s/Decentralized/img/de.svg" alt="">
                        <span>GERMAN</span>
                    </a>
                    <a  onClick="document.cookie='country=es; path=/'; location.reload();">
                        <img src="assets_s/Decentralized/img/es.svg" alt="">
                        <span>SPANISH</span>
                    </a>
                    <a onClick="document.cookie='country=fr; path=/'; location.reload();">
                        <img src="assets_s/Decentralized/img/fr.svg" alt="">
                        <span>FRENCH</span>
                    </a>
                    <a onClick="document.cookie='country=it; path=/'; location.reload();">
                        <img src="assets_s/Decentralized/img/it.svg" alt="">
                        <span>ITALIAN</span>
                    </a>
                    <a onClick="document.cookie='country=az; path=/'; location.reload();">
                        <img src="assets_s/Decentralized/img/az.svg" alt="">
                        <span>AZƏRBAYCAN</span>
                    </a>
                    <a onClick="document.cookie='country=tr; path=/'; location.reload();">
                        <img src="assets_s/Decentralized/img/tr.svg" alt="">
                        <span>TÜRKIYE</span>
                    </a>
                    <a onClick="document.cookie='country=pt; path=/'; location.reload();">
                        <img src="assets_s/Decentralized/img/pt.svg" alt="">
                        <span>PORTUGAL</span>
                    </a>
                    <a onClick="document.cookie='country=id; path=/'; location.reload();"href="?lang=id">
                        <img src="assets_s/Decentralized/img/id.svg" alt="">
                        <span>INDONESIAN</span>
                    </a>
                </div>
            </div>
            <div class="stats-top ">
                <div class="row no-gutters align-items-center">
                    <div class="col-8 stats-top_sum" style="color: #DD74C8">
                        <?php echo $totalPartners; ?>             </div>
                        <div class="col-3 stats-top_subject" >
                            ALL<br>PARTICIPANTS                    </div>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-8 stats-top_sum" style="color: #1EA4C1">
                            +8688                    </div>
                            <div class="col-4 stats-top_subject">
                                JOINED<br>IN 24 HOURS                    </div>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-8 stats-top_sum" style="color: #A2A1F2">
                                  <?php echo $levelProfit; ?>                    </div>
                                  <div class="col-4 stats-top_subject">
                                    PARTICIPANTS<br>have EARNED ETH                    </div>
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-8 stats-top_sum" style="color: #A2A1F2;">
                                        <?php echo number_format((float)($totalEarned*$ethPrice), 2, '.', ''); ?>                       </div>
                                        <div class="col-4 stats-top_subject">
                                            PARTICIPANTS<br>have EARNED USD                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-3 mb-4">
                                    <div class="border-gradient section-left">
                                        <div class="border-gradient_content status-panel">
                                            <div class="status-panel_id">
                                                <a href="javascript:;" style="color:#EEE" class="status-panel__user-id" data-trigger_value_siblings=".trigger_value__user-id" data-trigger_value="***|123">
                                                    ID <span title="Show/Hide"><?php echo $userID; ?></span>
                                                </a>
                                                <div class="status-panel_partners__top">
                                                    <span><?php echo $totalPartners; ?></span>
                                                    <img src="assets_s/Decentralized/img/partners_light.svg" alt="">
                                                </div>
                                            </div>
                                            <div class="status-panel__logo">
                                                <img src="assets_s/Decentralized/img/eth-logo-big.png">
                                            </div>
                                            <div class="status-panel_money">
                                                <div class="status-panel_money_total__dollars">
                                                    $<?php echo number_format((float)($totalEarned*$ethPrice), 2, '.', ''); ?>            </div>
                                                    <div class="status-panel_money_total__eth" title="(0)">
                                                        <?php echo $levelProfit; ?>  eth
                                                    </div>
                                                </div>
                                                <div class="status-panel_money">
                                                    <div class="border-gradient">
                                                        <div class="border-gradient_content">
                                                            <div class="logotypeX3">
                                                               <a href="/#x3main" ><img src="assets_s/Decentralized/img/x3.svg" alt=""></a>                               
                                                           </div>
                                                           <div class="status-panel_money__dollars">
                                                           $0                                </div>
                                                           <div class="status-panel_money__eth" title="(0)">
                                                            0.000 eth
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-gradient">
                                                    <div class="border-gradient_content">
                                                        <div class="logotypeX4">
                                                           <a href="/#x4main" ><img src="assets_s/Decentralized/img/x4.svg" alt=""></a>                               
                                                       </div>
                                                       <div class="status-panel_money__dollars">
                                                       $0                                </div>
                                                       <div class="status-panel_money__eth" title="(0)">
                                                        0.000 eth
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="telegram-bot_notify">
                                            <a href="https://telete.in/forsage_io_bot?add_address=0x948e5f339942f9f6cf417c5fe6de73ef6059bd8b" target="_blank">
                                                <img src="assets_s/Decentralized/img/bot_notif.png" alt=""> Enable notifications                        </a>
                                            </div>
                                            <div class="select-currency">
                                                <i class="fas fa-globe icon"></i>
                                                <a href="?currency=ETH_USD" class="active ">
                                                USD                            </a>
                                                <a href="?currency=ETH_EUR" class="">
                                                EUR                            </a>
                                                <a href="?currency=ETH_RUB" class="">
                                                RUB                            </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section-right">
                                        <div class="border-gradient">
                                            <div class="border-gradient_content status-panel_partners pb-5">
                                                <div class="status-panel_partners__subject">
                                                    Affiliate link                            <div class="status-panel_partners__count">
                                                        <span>0</span>
                                                        <img src="assets_s/Login/Decentralized/img/partners_light.svg" alt="">
                                                    </div>
                                                </div>
                                                <div class="area-text status-panel_partners__link trigger_value__user-refkey" title="https://forsage.io/i/vpat19/">
                                                    <input type="text" value="<?php echo SITE_URL.'?a='.$userID;?>" id="refLink" onclick="document.getElementById('refLink').select();" readonly>
                                                </div>
                                                <div class="status-panel_partners_copy" onclick="copyText('<?php echo SITE_URL.'?a='.$userID;?>');">
                                                Copy                        </div>
                                            </div>
                                        </div>
                                        <div class="border-gradient mt-5">
                                            <div class="border-gradient_content status-panel_wallets pb-4">
                                                <div class="status-panel_wallets__subject">
                                                Your Ethereum wallet                        </div>
                                                <div class="status-panel_wallet">
                                                    <?php echo $userWallet; ?>                        </div>
                                                    <a href="https://etherscan.io/address/<?php echo $userWallet; ?>" target="_blank" class="status-panel_wallets__btn" style="left:6px;">
                                                    TO ETHERSCAN                        </a>
                                                    <div class="status-panel_wallets__btn" style="right:6px;" onclick="window.copyText('<?php echo $userWallet; ?>')">
                                                    COPY                        </div>
                                                </div>
                                            </div>
                                            <div class="border-gradient mt-5">
                                                <div class="border-gradient_content status-panel_wallets pb-4">
                                                    <div class="status-panel_wallets__subject">
                                                    Smart Contract address                        </div>
                                                    <div class="status-panel_wallet">
                                                    0xbe1f94f08db7db10baa4858411d8fb5c9279b3d9</div>
                                                    <a href="https://etherscan.io/address/0xbe1f94f08db7db10baa4858411d8fb5c9279b3d9" target="_blank" class="status-panel_wallets__btn" style="left:6px;">
                                                    TO ETHERSCAN                        </a>
                                                    <div class="status-panel_wallets__btn" style="right:6px;" onclick="window.copyText('0xbe1f94f08db7db10baa4858411d8fb5c9279b3d9')">
                                                    COPY                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <!-- Всплывающие окошки с последними событиями -->
                                        <div class="alert-socket">
                                            <a class="alert-socket__btn">
                                                <i class="material-icons fa fa-bell"></i>
                                            </a>
                                            <div class="alert-socket__content" style="display: none;">
                                                <div class="alert-socket__subject">50 new events</div>
                                                <ul class="alert-socket__items">
                                                    <li></li>
                                                </ul>
                                            </div>
                                            <div class="alert-socket__cell"></div>
                                        </div>

                                        <!-- Уведомления для пользователей -->
</div>
            </div>
            <div class="section-right">
                <div class="border-gradient">
                    <div class="border-gradient_content status-panel_partners pb-5">
                        <div class="status-panel_partners__subject">
                            Affiliate link                            <div class="status-panel_partners__count">
                                                                    <span>0</span>
                                    <img src="assets_s/Login/Decentralized/img/partners_light.svg" alt="">
                                                            </div>
                        </div>
                        <div class="area-text status-panel_partners__link trigger_value__user-refkey" title="<?php echo SITE_URL;?>">
                            <input type="text" value="<?php echo SITE_URL.'?a='.$userID;?>" id="refLink" onclick="document.getElementById('refLink').select();" readonly>
                        </div>
                        <div class="status-panel_partners_copy" onclick="copyText('<?php echo SITE_URL.'?a='.$userID;?>');">
                            Copy                        </div>
                    </div>
                </div>
                <div class="border-gradient mt-5">
                    <div class="border-gradient_content status-panel_wallets pb-4">
                        <div class="status-panel_wallets__subject">
                            Your Ethereum wallet                        </div>
                        <div class="status-panel_wallet">
                            <?php echo $userWallet; ?>                        </div>
                        <a href="https://etherscan.io/address/<?php echo $userWallet; ?>" target="_blank" class="status-panel_wallets__btn" style="left:6px;">
                            TO ETHERSCAN                        </a>
                        <div class="status-panel_wallets__btn" style="right:6px;" onclick="window.copyText('<?php echo $userWallet; ?>')">
                            COPY                        </div>
                    </div>
                </div>
                <div class="border-gradient mt-5">
                    <div class="border-gradient_content status-panel_wallets pb-4">
                        <div class="status-panel_wallets__subject">
                            Smart Contract address                        </div>
                        <div class="status-panel_wallet">
                           0xbe1f94f08db7db10baa4858411d8fb5c9279b3d9</div>
                        <a href="https://etherscan.io/address/0xbe1f94f08db7db10baa4858411d8fb5c9279b3d9" target="_blank" class="status-panel_wallets__btn" style="left:6px;">
                            TO ETHERSCAN                        </a>
                        <div class="status-panel_wallets__btn" style="right:6px;" onclick="window.copyText('0xbe1f94f08db7db10baa4858411d8fb5c9279b3d9')">
                            COPY                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <!-- Всплывающие окошки с последними событиями -->
            <div class="alert-socket">
                <a class="alert-socket__btn">
                    <i class="material-icons fa fa-bell"></i>
                </a>
                <div class="alert-socket__content" style="display: none;">
                    <div class="alert-socket__subject">50 new events</div>
                    <ul class="alert-socket__items">
                        <li></li>
                    </ul>
                </div>
                <div class="alert-socket__cell"></div>
            </div>
            
            <!-- Уведомления для пользователей -->


                                        <script>
                                            Breakpoints();
                                        </script>