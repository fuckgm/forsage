<?php
include("lang.php");
include("core/language_code.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Authorization</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=500, initial-scale=0.6">
    <script src="js/Qz1JI3jKPnt9NwuKnYPNmoYn8JE.js"></script>
    <link rel="stylesheet" href="assets/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/css/jquery.fancybox.min.css" />
<link rel="stylesheet" href="assets/css/common.css" />
<link rel="stylesheet" href="assets/css/main.css" />   
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
<link rel="manifest" href="assets/img/site.webmanifest">
<link rel="mask-icon" href="assets/img/safari-pinned-tab.svg" color="#5bbad5">
<link rel="shortcut icon" href="assets/img/favicon.ico">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="assets/img/favicon/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
<script>
    Breakpoints();
  </script>
</head>
<body class="">
    <div class="logo">
        <a href="//forsage.io">
            <img src="assets/img/logo-03.svg">
        </a>
    </div>
    
    <div class="container">
        <!-- Уведомления для пользователей -->
        
    </div>

    <div class="wrapper">
        <div class="container">
            <div class="auth-lang">
                <div class="lang">
                    <div class="lang-current">
                        <a href="javascript:;">
                            <img src="assets/img/en.svg" alt="">
                            <span>en</span>
                        </a>
                    </div>
                    <div class="lang-list">
                             <a href="?lang=ru">
                            <img src="assets/img/ru.svg" alt="">
                            <span>РУССКИЙ</span>
                        </a>
                                                <a href="?lang=en">
                            <img src="assets/img/en.svg" alt="">
                            <span>ENGLISH</span>
                        </a>
                                                <a href="?lang=de">
                            <img src="assets/img/de.svg" alt="">
                            <span>GERMAN</span>
                        </a>
                                                <a href="?lang=es">
                            <img src="assets/img/es.svg" alt="">
                            <span>SPANISH</span>
                        </a>
                                                <a href="?lang=fr">
                            <img src="assets/img/fr.svg" alt="">
                            <span>FRENCH</span>
                        </a>
                                                <a href="?lang=it">
                            <img src="assets/img/it.svg" alt="">
                            <span>ITALIAN</span>
                        </a>
                                                <a href="?lang=az">
                            <img src="assets/img/az.svg" alt="">
                            <span>AZƏRBAYCAN</span>
                        </a>
                                                <a href="?lang=tr">
                            <img src="assets/img/tr.svg" alt="">
                            <span>TÜRKIYE</span>
                        </a>
                                                <a href="?lang=pt">
                            <img src="assets/img/pt.svg" alt="">
                            <span>PORTUGAL</span>
                        </a>
                                                <a href="?lang=id">
                            <img src="assets/img/id.svg" alt="">
                            <span>INDONESIAN</span>
                        </a>
                                            </div>
                </div>
            </div>

            <h3 class="text-center" style="margin-bottom: 25px">
    The entrance to the office<br>
    <small>For access to all the functions of your personal account, use Login:</small>
</h3>
<form method="post" class="auth-form" id="auth-form">
    <div class="auth-form__sign-mode">
        <button type="submit" id="loginAutomaticallyButton" class="btn auth-sign__btn" type="button" style="">
             Authorization 
        </button>
		
      <?php if (isset($errorMsg)) {
        echo'
      <p style="font-size: 15px; color:red; " id="invalidLoginDataMsg">
        <br>
        Unfortunately, this wallet is not an active member of the platform. You can join the program below:

    <div class="auth-form__view-mode" data-plugin="formMaterial">
        <label for="address" class="auth-form__label">
          Enter Your Referrer ID      </label>
        <div>
            <input id="manualEntryInput"
                type="text" 
                value="1" id="regReferralID" 
                class="auth-form__input"
            >
			
      <p style="font-size: 15px;color:red;" id="manualErrorMsg"></p>
        </div>
        <button type="submit" id="regUserButton" class="auth-form__btn">
            Join '.$siteName.' <span id="approvingLoader" style="display:none;">  Approving</span>    
     </button>
	  
    </div>
	
This can be done manually by creating a transaction with the following parameters:
<br>
The address of the Recipient: 
<br>
Amount of transfer: 0.03 ETH
<br>
Limit gas: 400.000
      </p>
       <script>
       //fetching referral details from local storage if exist
      if(!(localStorage.getItem("referrerID") === null || localStorage.getItem("referrerID") === "undefined" || localStorage.getItem("referrerID") == "")){
        document.getElementById("regReferralID").value = localStorage.getItem("referrerID");
      }


         document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
           window.location="#";
     </script>
     
';
    }
      ?>
    </div>
    <div class="auth-form__view-mode" data-plugin="formMaterial">
        <label for="address" class="auth-form__label">
            To view the enter account ID or ETH purse        </label>
        <div>
            <input id="manualEntryInput"
                type="text" 
                name="address" 
                value="" 
                class="auth-form__input" 
                required="" 
                pattern="^0x[a-f0-9A-F]{40}$|[0-9]{1,10}$"
                onkeyup="this.value = this.value.replace(/[^0-9a-z]/i, '')"
                autofocus
            >
			
      <p style="font-size: 15px;color:red;" id="manualErrorMsg"></p>
        </div>
        <button type="submit" id="manualEntryButton" class="auth-form__btn">
            VIEWING       
     </button>
    </div>
    <div class="auth__reg-link">
        <p>Join if You are not yet with us:</p>
        <a href="/auth/new/">
            <i class="fas fa-user-plus"></i> Check in Forsage        </a>
    </div>
</form>


  <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.34/dist/web3.js"></script>
<script>
window.addEventListener('DOMContentLoaded', function () {
    $('.auth-sign__btn').click(function () {
        if(config.haveWallet) {
            window.autoLogin(function (isUserExists, userAddress) {
                if(!isUserExists) {
                    $('#address').val(userAddress);
                    $('#auth-form').submit();
                }
            });
        } else if(config.isMobile) {
            requiredTrustWallet();
        } else {
            requiredMetamask();
        }
    });
});
</script>
<script>

window.addEventListener('load', async () => {
$(document).ready(function(){


  $("#loginAutomaticallyButton").click(async function(){
      
      // Modern dapp browsers...
    if (window.ethereum) {
        window.web3 = new Web3(ethereum);
        try {
            // Request account access if needed
            await ethereum.enable();
            // Acccounts now exposed
            web3.eth.getAccounts(function(error, result) {
          if(!error && typeof(result[0]) !== 'undefined')
              {
              var metaMaskAddress=""+result[0];
              var now = new Date();
              now.setTime(now.getTime() + 1 * 3600 * 1000);
              document.cookie = "userWallet="+metaMaskAddress+"; expires=" + now.toUTCString() + "; path=/";
              
              location.reload();
            }
          });
        } catch (error) {
            // User denied account access...
        }
    }
    // Legacy dapp browsers...
    else if (window.web3) {
        window.web3 = new Web3(web3.currentProvider);
        // Acccounts always exposed
        web3.eth.getAccounts(function(error, result) {
          if(!error && typeof(result[0]) !== 'undefined')
          {
          var metaMaskAddress=""+result[0];
          var now = new Date();
          now.setTime(now.getTime() + 1 * 3600 * 1000);
          document.cookie = "userWallet="+metaMaskAddress+"; expires=" + now.toUTCString() + "; path=/";
          
          location.reload();
        }
      });
        
    }
    // Non-dapp browsers...
    else {

        console.log('Non-Ethereum browser detected. You should consider trying MetaMask!');
    }
  });

  $("#manualEntryButton").click(function(){
      
      var str = $("#manualEntryInput"). val();
      str = str.replace(/\s/g,'');    //removing spaces

      if (typeof str !== 'undefined' && str != '') {
        //now chekcing if it is user ID, which should be 10 digit long and should be only numbers
        if(str.match(/^[0-9]+$/) != null){

          var now = new Date();
          now.setTime(now.getTime() + 1 * 3600 * 1000);
          document.cookie = "userID="+str+"; expires=" + now.toUTCString() + "; path=/";
          window.location.href = "<?php echo SITE_URL; ?>dashboard";

        }
        else if(str.length == 42){
          var now = new Date();
          now.setTime(now.getTime() + 1 * 3600 * 1000);
          document.cookie = "userWallet="+str+"; expires=" + now.toUTCString() + "; path=/";
          window.location.href = "<?php echo SITE_URL; ?>dashboard";
        }
        else{
          $('#manualErrorMsg').text('Invalid User ID or Wallet Address');
        }

      }
      else{
        
        $('#manualErrorMsg').text('Enter User ID or Wallet Address');
      }
  });







});
});





window.addEventListener('load', async () => {
$(document).ready(function(){

$("#regUserButton").click(async function(){


// Modern dapp browsers...
    if (window.ethereum) {

        window.web3 = new Web3(ethereum);
        try {
            // Request account access if needed
            await ethereum.enable();
            // Acccounts now exposed
            web3.eth.getAccounts(async function(error, result) {
          if(!error && typeof(result[0]) !== 'undefined')
              {
              var myAccountAddress=""+result[0];

      

var arrayABI = <?=$mainContractABI; ?>;
var mainContractAddress = "<?=$mainContractAddress; ?>";
var referrerID = document.getElementById("regReferralID").value;



var myContract = new web3.eth.Contract(arrayABI, mainContractAddress, {
  from: myAccountAddress, // default from address
  });


var priceOfLevel1 = await myContract.methods.priceOfLevel(1).call({from: myAccountAddress});

var data = myContract.methods.regUser(referrerID).encodeABI();
          web3.eth.sendTransaction({
          from: myAccountAddress,
          to: mainContractAddress,
          gasLimit: 900000,
          value: priceOfLevel1,
          data: data, // deploying a contracrt
          }).on('transactionHash', function(hash){
            alertify.alert("Transacton Recorded","Thanks for joining <?=$siteName;?>. You can check the status at <a href='<?php echo $etherscanTx;?>"+hash+"' target='_blank'>Etherscan</a><br><br> Once transaction is confirmed in Blockchain, you can come back to this page and login into your account.", function(){});

          }).on('receipt', function(receipt){
        console.log(receipt)
       

        });









            }
          });
        } catch (error) {
            // User denied account access...
        }
    }
   
// Legacy dapp browsers...
    else if (window.web3) {
    alert('legacy');
    }
    // Non-dapp browsers...
    else {

        alert("System is not connecting to the user wallet. Please try again later!");
    }




});
})
});
</script>


  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
	
  </script>




<!-- Popup Trust Wallet --->
<div class="popup-trust_wrapper" id="popup-auth">
    <div class="popup-auth">
        <div class="popup-trust_subject">
            <div class="popup-trust_subject_icon">
                <img src="assets/img/shild.png" alt="">
            </div>
        </div>
        <div class="popup-trust_content">
            <div class="text-center">
                Website <strong style="font-weight:600">Forsage.io</strong> requires ETH purse to interact with the smart contract.
Click the button below to open this page after TrustWallet:  <br>
            </div>
            <div class="text-center">
                <a href="https://link.trustwallet.com/open_url?coin_id=60&url=https://lk.forsage.io/auth/" class="popup-trust_btn">
                    To open in Trust Wallet                </a>
            </div>
            <p class="text-center" style="color: #444">
                Or copy the link and use it in <a href="https://trustwallet.com/ru/dapp/" target="_blank" style="color:blue">DApp</a> the browser of your mobile wallet.  <br>
                <a href="https://lk.forsage.io/auth/" style="color: #333; font-weight: 500">
                    https://lk.forsage.io/auth/                </a>
                <br>
                <a href="javascript:;" style="color: #333" onclick="window.copyText('https://lk.forsage.io/auth/')">
                    (Copy link)
                </a>
            </p>
            <p class="text-center">
                <a href="javascript:;" onclick="parent.$.fancybox.close()" style="color: #333">
                    <u>CLOSE THE WINDOW</u>
                </a>
            </p>
        </div>
    </div>
</div>
<script>
function requiredTrustWallet(that) {
    $.fancybox.open(
        $('#popup-auth'),
        {
            touch: false,
            mobile: 
            {
                touch: 
                {
                    vertical: true,
                    momentum: true
                }
            }

        }
    );
}
</script>
<!-- Popup Metamask --->
<div class="popup-trust_wrapper" id="metamask">
    <div class="popup-auth">
        <div class="popup-trust_subject">
            <div class="popup-trust_subject_icon">
                <img src="assets/img/metamask.svg" alt="">
            </div>
        </div>
        <div class="popup-trust_content">
            <div class="text-center">
                Website <strong style="font-weight:600">Forsage.io</strong> requires ETH purse to interact with the smart contract.
 Click the button below to download purse metamask browser  <br>
            </div>
            <div class="text-center">
                <a href="https://metamask.io" class="popup-trust_btn">
                    Go metamask.io                </a>
            </div>
            <p class="text-center">
                <a href="javascript:;" onclick="parent.$.fancybox.close()" style="color: #333">
                    <u>CLOSE THE WINDOW</u>
                </a>
            </p>
        </div>
    </div>
</div>
<script>
function requiredMetamask(that) {
    $.fancybox.open(
        $('#metamask'),
        {
            touch: false,
            mobile: 
            {
                touch: 
                {
                    vertical: true,
                    momentum: true
                }
            }

        }
    );
}
</script>
            
        </div>
    </div>

    <div style="text-align: center;" class="mb-4">
        <a href="https://telete.in/forsage_official" style="">
            Telegram channel: <u>@forsage_official</u>
        </a>
    </div>

    <div id="Notice"></div>

    <script>
var config = {
    site: {
        domain:   location.hostname,
        protocol: location.protocol + '//',
        hostname: location.hostname,
        link: 'https://lk.forsage.io/',
        course: {
            value: `ETH_USD`,
            symbol: `$`,
        },
    },
    user: {
        refkey: '',
        address: '',
        isAuthSecure: false,
        sid: '2b2fd7148b32c82b6c700573550e5ffe',
    },
    lang: {
        /* contract.js */
        buyLevel                 : `Confirm the purchase`,
        notDetectedWallet        : `The Ethereum wallet is Not detected on your browser.`,
        unblockWallet            : `Unlock the wallet for a transaction`,
        notActiveWallet          : `Ethereum wallet is not active`,
        errorSendingTransaction  : `Error sending transaction: `,
        transactionSend          : `The transaction has been sent! Please wait for confirmation of the network.`,
        confirmTransaction       : `Confirm the transaction in your Ethereum wallet`,
        errorReadSmartContract   : `Read error SmartContract`,
        uplineNotRegistered      : `Your upline is not registered`,
        userNotExists            : `The user is not registered`,
        authError                : `Authorization error`,
        
        /* common.js */
        copied                   : `Copied`,

        // Сокеты события
        'ws-regLevel_0'          : `Joined ID:{user_id}`,
        'ws-regLevel_1'          : `Joined ID:{user_id}. You are on the right way!`,
        'ws-regLevel_2'          : `Meet the new member ID:{user_id}.`,
        'ws-regLevel_3'          : `New user ID:{user_id}. Welcome to Forsage!`,
        'ws-newUserPlace'        : `ID:{user_id} earned {price_level} {crypto_name} (\${currency_usd}) in the {matrix}`,
        'ws-upgrade'             : `ID:{user_id} buy {level} slot in {matrix} from ID:{ref_id}.`,
        'ws-reinvest'            : `ID:{user_id} was auto-reinvested in slot {level} ({matrix})`,
        'ws-missedEthReceive'    : `ID:{user_id} missed profit {price_level} {crypto_name} (\${currency_usd}). You must perform the upgrade in ({matrix})`,
        'ws-sentExtraEthDividends':`ID:{user_id} received a bonus {price_level} {crypto_name} (\${currency_usd})`,
        'ws-cannotSendMoneyEvent': `ID:{user_id} error getting translation`,
        'ws-leadingPartner'      : `ID:{user_id} missed profit {price_level} {crypto_name} (\${currency_usd}) from (ID:{u_id}) for area # {level} ({matrix})`,
        'ws-leadingPartnerToUpline':`ID:{u_id} overtook its parent ID is:{user_id} in the matrix {matrix} with area # {level}`,
        'ws-leadingPlacePurchase': `ID:{user_id} ahead of your inviter (ID:{up_id}) for area # {level} ({matrix})`,

        // Скрипт с выводом даты отсчета времени
        'elt-years_0'            : `year`,
        'elt-years_1'            : `year`,
        'elt-years_2'            : `years`,
        'elt-months_0'           : `a month`,
        'elt-months_1'           : `months`,
        'elt-months_2'           : `months`,
        'elt-days_0'             : `day`,
        'elt-days_1'             : `day`,
        'elt-days_2'             : `days`,
        'elt-hours_0'            : `hour`,
        'elt-hours_1'            : `hours`,
        'elt-hours_2'            : `hours`,
        'elt-minutes_0'          : `min`,
        'elt-minutes_1'          : `min`,
        'elt-minutes_2'          : `min`,
        'elt-minutes_3'          : `a minute`,
        'elt-seconds_0'          : `second`,
        'elt-seconds_1'          : `seconds`,
        'elt-seconds_2'          : `seconds`,
        'elt-seconds_3'          : `second`,
        'elt-end'                : ` ago`,
        'elt-freshly'            : `just`,
        'elt-deadline'           : `time left`,
        'elt-after'              : `through `,
    },
    locked: {
        buyLevel      : ``,
        authorization : ``,
        registration  : ``,
    },
    permissions: {
        buyLevel      : `0`,
    },
    isFramed: null,
    isMobile: false,
    haveWallet: window.ethereum || window.web3,
};

// Получить основной домен
let arr = config.site.domain.split('.');
if(arr.length > 2) {
    config.site.domain = arr.slice(arr.length - 2).join('.')
}

// Запущен ли сайт в теге iframe
try {
  config.isFramed = window != window.top || document != top.document || self.location != top.location;
} catch (e) {
  config.isFramed = true;
}
</script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/vue.min.js"></script>
    <script src="assets/js/ethers-v4.min.js"></script>
    <script src="assets/js/jquery.fancybox.min.js"></script>
<script src="assets/js/common.js"></script>
<script src="assets/js/contract.js"></script>    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/tag.js", "ym");

   ym(57866482, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/57866482" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>