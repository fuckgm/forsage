<?php
   //phpinfo();
   //code to process ref ID
   error_reporting(E_ALL);
   error_reporting(0);
   if(isset($_GET['a']) && $_GET['a'] != '' ){
   	echo $_GET['a'];
   echo '
   <script>
   
   localStorage.setItem("referrerID", '. $_GET['a'].');
   window.location.href = "/";
   </script>
   ';
   die();
   }
   
   include("dashboard/config.php");
   include("lang.php");
     
   global $mainContractAddress;	
   global $etherscanAddress;
         
   /*
     if(isset($_COOKIE['country']) && $_COOKIE['country'] != ""){
       $lang = "language_".$_COOKIE['country'];
       $c=$_COOKIE['country'];
     }else{
       $lang = "language_ru";
       $c='ru';
     }*/
     
     
   //-------------------------------default language setting code start-------------------------------------------------
   
   $query = "SELECT defaultLanguage FROM adminsetting";
   $result = mysqli_query($conn,$query);
   $lang=array();
   $lang = mysqli_fetch_row($result);
   $defaultLanguage = $lang[0];
    if(isset($_COOKIE['country']) && $_COOKIE['country'] != ""){
       $lang = "language_".$_COOKIE['country'];
       $c=$_COOKIE['country'];
     }else{
       $lang = "language_".$defaultLanguage;
       $c=$defaultLanguage;
     }
   //--------------- default language setting end code--------------------------------------------------------
   
   //print_r($$lang);
   //finding total transaction from etherscan
   //I could not find exact API to get total transactions from etherscan, 
   //so, I just got its entire page and then extracted the amount variable 
   $url=$etherscanAddress.''.$mainContractAddress;
   $cURLConnection = curl_init();
   curl_setopt($cURLConnection, CURLOPT_URL, $url);
   curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($cURLConnection, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
   curl_setopt($cURLConnection, CURLOPT_CUSTOMREQUEST, "GET");
   $etherscanCode = curl_exec($cURLConnection);
   
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
   
   
   //find today's participates
   $time = time() - 86400;
   $query = "SELECT count(*) FROM event_reglevelev where timestamp > ".$time." ";
   $result = mysqli_query($conn,$query);
   $row = mysqli_fetch_row($result);
   $todayParticipants = 0;
   if($row != NULL){
   	$todayParticipants = $row[0];
   }
   
   
   //find users earned
   $query = "SELECT sum(amount) FROM event_levelbuyev ";
   $result = mysqli_query($conn,$query);
   $row = mysqli_fetch_row($result);
   $totalEarned = 0;
   if($row != NULL){
   	$totalEarned = $row[0] / 1000000000000000000;
   }
   
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Forsage</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Connecting stylesheets-->
      <script src="js/Qz1JI3jKPnt9NwuKnYPNmoYn8JE.js"></script>
      <link rel="stylesheet" href="assets/css/materialize.min.css">
      <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
      <link rel="stylesheet" href="assets/css/styles.css">
      <link rel="stylesheet" href="assets/css/fm.revealator.jquery.css">
      <link rel="apple-touch-icon" sizes="180x180" href="assets/image/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="assets/image/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="assets/image/favicon-16x16.png">
      <link rel="manifest" href="assets/image/site.webmanifest">
      <link rel="mask-icon" href="assets/image/safari-pinned-tab.svg" color="#5bbad5">
      <link rel="shortcut icon" href="assets/image/favicon.ico">
      <meta name="apple-mobile-web-app-title" content="Forsage">
      <meta name="application-name" content="Forsage">
      <meta name="msapplication-TileColor" content="#da532c">
      <meta name="msapplication-config" content="/img/favicon/browserconfig.xml">
      <meta name="theme-color" content="#ffffff">
   </head>
   <body>
      <!-- !!begin of page-->
      <!-- header -->
      <header class="header">
         <div class="header-wrap">
            <div class="header-logo">
               <h2 class="logo">FORSAGE</h2>
            </div>
            <ul class="header-lang">
               <li class="header-lang__option language__item_ru <?php if($c=="ru") { echo "current"; }?>" >
                  <div class="header-lang__option-flag" >
                     <img src="assets/image/ru.svg" alt="ru">
                  </div>
                  <a href="?lang=ru" class="header-lang__option-name" onclick="document.cookie='country=ru; path=/';location.reload();" title="РУССКИЙ" class="language__item" style="background-position:-0px -0px;" data-cf-modified-93340714edec2859566b6c98-="" data-cf-modified-a85c2e4d8a49b9c677299ca8-="">
                  РУССКИЙ                    </a>
               </li>
               <li class="header-lang__option language__item_en <?php if($c=="en") { echo "current"; } ?>" >
                  <div class="header-lang__option-flag">
                     <img src="assets/image/en.svg" alt="en">
                  </div>
                  <div class="header-lang__option-name">
                      <a href="#" onclick="document.cookie='country=en; path=/';location.reload();" title="English" class="language__item" style="background-position:-0px -0px;" data-cf-modified-93340714edec2859566b6c98-="" data-cf-modified-a85c2e4d8a49b9c677299ca8-="">English</a>
                                                
                  </div>
               </li>
               <li class="header-lang__option language__item_de <?php if($c=="de") { echo "current"; }?>" >
                  <div class="header-lang__option-flag">
                     <img src="assets/image/de.svg" alt="de">
                  </div>
                  <a href="?lang=de" class="header-lang__option-name language__item" onclick="document.cookie='country=de; path=/';location.reload();" title="GERMAN"  style="background-position:-0px -0px;" data-cf-modified-93340714edec2859566b6c98-="" data-cf-modified-a85c2e4d8a49b9c677299ca8-="">
                  GERMAN                    </a>
               </li>
               <li class="header-lang__option language__item_es <?php if($c=="es") { echo "current"; }?>" >
                  <div class="header-lang__option-flag">
                     <img src="assets/image/es.svg" alt="es">
                  </div>
                  <a href="?lang=es" class="header-lang__option-name language__item" onclick="document.cookie='country=es; path=/';location.reload();" title="SPANISH"  style="background-position:-0px -0px;" data-cf-modified-93340714edec2859566b6c98-="" data-cf-modified-a85c2e4d8a49b9c677299ca8-="">
                  SPANISH                    </a>
               </li>
               <li class="header-lang__option language__item_fr <?php if($c=="fr") { echo "current"; }?>" >
                  <div class="header-lang__option-flag">
                     <img src="assets/image/fr.svg" alt="fr">
                  </div>
                  <a href="?lang=fr" class="header-lang__option-name language__item" onclick="document.cookie='country=fr; path=/';location.reload();" title="FRENCH"  style="background-position:-0px -0px;" data-cf-modified-93340714edec2859566b6c98-="" data-cf-modified-a85c2e4d8a49b9c677299ca8-="">
                  FRENCH                    </a>
               </li>
               <li class="header-lang__option language__item_it <?php if($c=="it") { echo "current"; }?>"  >
                  <div class="header-lang__option-flag">
                     <img src="assets/image/it.svg" alt="it">
                  </div>
                  <a href="?lang=it" class="header-lang__option-name language__item" onclick="document.cookie='country=it; path=/';location.reload();" title="ITALIAN"  style="background-position:-0px -0px;" data-cf-modified-93340714edec2859566b6c98-="" data-cf-modified-a85c2e4d8a49b9c677299ca8-="">
                  ITALIAN                    </a>
               </li>
               <li class="header-lang__option language__item_az <?php if($c=="az") { echo "current"; }?>" >
                  <div class="header-lang__option-flag">
                     <img src="assets/image/az.svg" alt="az">
                  </div>
                  <a href="?lang=az" class="header-lang__option-name language__item" onclick="document.cookie='country=az; path=/';location.reload();" title="AZƏRBAYCAN"  style="background-position:-0px -0px;" data-cf-modified-93340714edec2859566b6c98-="" data-cf-modified-a85c2e4d8a49b9c677299ca8-="">
                  AZƏRBAYCAN                    </a>
               </li>
            
			
			</ul>
         </div>
      </header>
	  
	<script type="93340714edec2859566b6c98-text/javascript">
                      $(document).ready(function() {
				var c = "<?php echo $c;?>";

					                                        if(c == 'ru'){ 
															  $(".language__item_ru").show();
															  $(".language__item_en").hide();
															  $(".language__item_de").hide();
															  $(".language__item_es").hide();
															  $(".language__item_fr").hide();
															  $(".language__item_it").hide();
															  $(".language__item_az").hide();
															
															}															
															else if(c == 'de'){ 
															 $(".language__item_ru").hide();
															  $(".language__item_en").hide();
															  $(".language__item_de").show();
															  $(".language__item_es").hide();
															  $(".language__item_fr").hide();
															  $(".language__item_it").hide();
															  $(".language__item_az").hide();
															
															}
															else if(c == 'en'){ 
															$(".language__item_ru").hide();
															  $(".language__item_en").show();
															  $(".language__item_de").hide();
															  $(".language__item_es").hide();
															  $(".language__item_fr").hide();
															  $(".language__item_it").hide();
															  $(".language__item_az").hide();
															}
															else if(c == 'es'){ 
															  $(".language__item_ru").hide();
															  $(".language__item_en").hide();
															  $(".language__item_de").hide();
															  $(".language__item_es").show();
															  $(".language__item_fr").hide();
															  $(".language__item_it").hide();
															  $(".language__item_az").hide();
															
															}
															else if(c == 'fr'){ 
															  $(".language__item_ru").hide();
															  $(".language__item_en").hide();
															  $(".language__item_de").hide();
															  $(".language__item_es").hide();
															  $(".language__item_fr").show();
															  $(".language__item_it").hide();
															  $(".language__item_az").hide();
															
															}else if(c == 'it'){ 
															  $(".language__item_ru").hide();
															  $(".language__item_en").hide();
															  $(".language__item_de").hide();
															  $(".language__item_es").hide();
															  $(".language__item_fr").hide();
															  $(".language__item_it").show();
															  $(".language__item_az").hide();
															
															}else if(c == 'az'){ 
															  $(".language__item_ru").hide();
															  $(".language__item_en").hide();
															  $(".language__item_de").hide();
															  $(".language__item_es").hide();
															  $(".language__item_fr").hide();
															  $(".language__item_it").hide();
															  $(".language__item_az").show();
															
															}else { 
															  $(".language__item_ru").hide();
															  $(".language__item_en").show();
															  $(".language__item_de").hide();
															  $(".language__item_es").hide();
															  $(".language__item_fr").hide();
															  $(".language__item_it").hide();
															  $(".language__item_az").hide();
															
															}			
});
</script>
      <!-- //header -->
      <!-- sections -->
      <div class="wrapper" id="wrapper">
         <!-- First section -->
         <div class="section heading">
            <div class="section-content heading-content">
               <div class="heading-content__cat">
                  <img src="assets/image/cat_figure.svg" alt="">
               </div>
               <div class="heading-content__title">
                  <h1 class="global-title"><?=$$lang['THE FIRST EVER']?> </h1>
               </div>
               <div class="heading-content__subtitle">
                  <h2 class="global-subtitle"><span>100%</span> <?=$$lang['DECENTRALIZED']?> </h2>
               </div>
               <div class="heading-content__btns flex">
                  <div class="btn-wrap">
                     <a href="https://lk.forsage.io/auth/i/28lpi1/" class="def-btn def-blue"><?=$$lang['JOIN NOW']?> </a>
                  </div>
                  <div class="btn-wrap">
                     <a href="javascript:;" class="def-btn def-trans marketing-video__button">
                      <?=$$lang['marketing video']?></a>
                  </div>
                  <div class="btn-wrap"><a href="dashboard" class="def-btn def-purple" style="white-space: nowrap;"><?=$$lang['Login']?> </a></div>
               </div>
            </div>
            <div class="section-titling heading-titling">
              <?=$$lang['TREND']?>  2020    
            </div>
            <div class="section-bg heading-bg"></div>
            <div class="section-shadow heading-shadow2"></div>
            <div class="section-shadow heading-shadow3"></div>
            <div class="section-shadow heading-shadow4"></div>
            <div class="section-shadow heading-shadow5"></div>
         </div>
         <!-- Second section -->
         <div class="section advantages">
            <div class="section-content advantages-content">
               <div class="advantages-list">
                  <div class="advantages-list__title default-title revealator-slideleft revealator-once">
                     <h2><span><?=$$lang['international crowdfunding']?> </span> <br>
<?=$$lang['the new generation platform']?>					 </h2>
                  </div>
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  <!-----------bhavna----------------->
				  
				  
				  
				  
                 <div class="advantages-list__subtitle  revealator-slideright revealator-once"> <?=$$lang['Revolutionary Smart Contract* technology provides decentralized market participants with the ability to directly engage in personal and business transactions.']?> <br><?=$$lang['The Forsage Decentralized Matrix Project`s Smart Contract is publicly and perpetually available to view on the Ethereum Blockchain']?>
                  </div>
                  <div class="advantages-list-block">
                     <div class="advantage revealator-zoomin revealator-once">
                        <div class="advantage-title"><?=$$lang['Zero Risk Factors']?></div>
                        <div class="advantage-text"><?=$$lang['On February 6, 2020, Forsage developers deployed a self-executing smart contract on the Ethereum Blockchain that exists in perpetuity and cannot be modified by any entity.']?>  </div>
                     </div>
                     <div class="advantage revealator-zoomin revealator-once">
                        <div class="advantage-title"><?=$$lang['Immutability']?></div>
                        <div class="advantage-text"><?=$$lang['Indefinite access to the Forsage project is an intrinsic feature programmed into the smart contract to enable continued participation in the matrix project.']?>
                        </div>
                     </div>
                     <div class="advantage revealator-zoomin revealator-once">
                        <div class="advantage-title"><?=$$lang['Instant Peer-to-Peer Payments']?></div>
                        <div class="advantage-text"><?=$$lang['The Forsage smart contract is nothing more than a payment gateway that facilitates peer-to-peer commission payments between its program participants.']?></div>
                     </div>
                     <div class="advantage revealator-zoomin revealator-once">
                        <div class="advantage-title"><?=$$lang['Nonhierarchically Organized']?></div>
                        <div class="advantage-text"><?=$$lang['A crowdfunded decentralized matrix project specifically designed to stimulate a global relocation to the crypto ecosystem by offering newcomers a seamless introductory experience.']?></div>
                     </div>
                     <div class="advantage revealator-zoomin revealator-once">
                        <div class="advantage-title"><?=$$lang['Transparency and Anonymity']?></div>
                        <div class="advantage-text"><?=$$lang['Verifiable proof of the project’s performance statistics as well as its partners transaction history are publicly available on the Ethereum blockchain.']?> </div>
                     </div>
                     <div class="advantage revealator-zoomin revealator-once">
                        <div class="advantage-title"><?=$$lang['Transactional Surety']?></div>
                        <div class="advantage-text"><?=$$lang['Network nodes irrevocably record and ubiquitously store the transactional history of all Forsage network partners on the Ethereum Blockchain.']?></div>
                     </div>
                  </div>
                  <div class="advantages-list__subtitle revealator-slidedown revealator-once" align="right"><br><br><small> *
                    <?=$$lang['A Smart Contract is a computer-programmed code containing a stringent set of criteria that must be satisfied before a transaction will be approved.  Reconciliation of these transactions are performed by a global collection of computer `nodes` that are volunteered for service by human and corporate entity `miners`(the computer owners) who are members of the Ethereum Blockchain’s globally distributed network infrastructure']?></small>
                  </div>
               </div>
               <div class="advantages-number">
                  <div class="advantages-number-wrap flex">
                     <div class="advantages-number__item revealator-zoomin revealator-once">
                        <div class="advantages-number__item-title"><?=$$lang['Total Participants']?></div>
                        <div class="advantages-number__item-content">
                           <nobr>268 465</nobr>
                        </div>
                     </div>
                     <div class="advantages-number__item revealator-zoomin revealator-once">
                        <div class="advantages-number__item-title"><?=$$lang['New for the day']?></div>
                        <div class="advantages-number__item-content">
                           <nobr>+7 655</nobr>
                        </div>
                     </div>
                     <div class="advantages-number__item revealator-zoomin revealator-once">
                        <div class="advantages-number__item-title"><?=$$lang['Only']?> <br><?=$$lang['Earned']?>, ETH</div>
                        <div class="advantages-number__item-content">
                           <nobr>189 896</nobr>
                        </div>
                     </div>
                     <div class="advantages-number__item revealator-zoomin revealator-once">
                        <div class="advantages-number__item-title"><?=$$lang['Earned']?><br><?=$$lang['during the day']?>, USD</div>
                        <div class="advantages-number__item-content">
                           <nobr>1 950 239</nobr>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="section-titling advantages-titling advantages-titling"><?=$$lang['UNIQUE']?></div>
            <div class="section-bg advantages-bg"></div>
            <div class="section-shadow advantages-shadow1"></div>
            <div class="section-shadow advantages-shadow2"></div>
            <div class="section-shadow advantages-shadow3"></div>
            <div class="section-shadow advantages-shadow4"></div>
         </div>
         <!-- Third section -->
         <div class="section results">
            <div class="section-content results-content">
               <div class="results-title">
                  <div class="default-title revealator-slideleft revealator-once">
                     <h2><span><?=$$lang['Results']?></span><?=$$lang['partners']?></h2>
                  </div>
               </div>
               <div class="results-subtitle revealator-slideleft revealator-once">
                  <div class="results-subtitle__text"><?=$$lang['All data is is stored on the blockchain and publicly accessible at etherscan.io']?></div>
                  <div class="results-subtitle__info"><?=$$lang['Contract address:']?>
                     <a href="https://etherscan.io/address/0x5acc84a3e955Bdd76467d3348077d003f00fFB97" target="_blank">
                     0x5acc84a3e955Bdd76467d3348077d003f00fFB97                </a>
                  </div>
               </div>
               <div class="carousel" id="carousel">
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 8679</div>
                        <div class="carousel-item__info-users">
                           544                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$386 125</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">1650.1 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">679.825 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">970.275 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 64</div>
                        <div class="carousel-item__info-users">
                           279                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$300 217</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">1282.975 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">500.775 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">782.2 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 8648</div>
                        <div class="carousel-item__info-users">
                           166                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$255 757</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">1092.975 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">471.775 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">621.2 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 7977</div>
                        <div class="carousel-item__info-users">
                           44                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$177 379</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">758.025 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">337.25 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">420.775 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 191420</div>
                        <div class="carousel-item__info-users">
                           156                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$166 223</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">710.35 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">405.45 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">304.9 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 113</div>
                        <div class="carousel-item__info-users">
                           44                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$152 663</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">652.4 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">258.25 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">394.15 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 209711</div>
                        <div class="carousel-item__info-users">
                           12                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$154 312</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">659.45 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">339.05 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">320.4 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 176735</div>
                        <div class="carousel-item__info-users">
                           44                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$130 280</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">556.75 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">228.375 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">328.375 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 24250</div>
                        <div class="carousel-item__info-users">
                           22                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$125 273</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">535.35 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">231.75 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">303.6 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 10668</div>
                        <div class="carousel-item__info-users">
                           4                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$96 350</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">411.75 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">155.35 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">256.4 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 7515</div>
                        <div class="carousel-item__info-users">
                           18                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$112 362</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">480.175 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">247.15 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">233.025 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 10705</div>
                        <div class="carousel-item__info-users">
                           78                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$101 341</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">433.075 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">239 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">194.075 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 731</div>
                        <div class="carousel-item__info-users">
                           10                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$99 790</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">426.45 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">189.225 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">237.225 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 14941</div>
                        <div class="carousel-item__info-users">
                           38                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$84 095</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">359.375 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">122.75 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">236.625 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 209269</div>
                        <div class="carousel-item__info-users">
                           4                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$103 347</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">441.65 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">217.55 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">224.1 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 13423</div>
                        <div class="carousel-item__info-users">
                           16                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$96 497</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">412.375 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">192.6 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">219.775 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 227655</div>
                        <div class="carousel-item__info-users">
                           16                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$81 486</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">348.225 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">219.6 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">128.625 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 28887</div>
                        <div class="carousel-item__info-users">
                           13                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$91 519</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">391.1 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">219.6 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">171.5 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 36202</div>
                        <div class="carousel-item__info-users">
                           137                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$90 466</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">386.6 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">215.95 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">170.65 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 36053</div>
                        <div class="carousel-item__info-users">
                           5                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$63 246</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">270.275 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">92.475 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">177.8 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 2419</div>
                        <div class="carousel-item__info-users">
                           45                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$80 187</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">342.675 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">165.375 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">177.3 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 813</div>
                        <div class="carousel-item__info-users">
                           7                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$80 427</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">343.7 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">167.7 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">176 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 28707</div>
                        <div class="carousel-item__info-users">
                           46                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$66 229</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">283.025 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">167.475 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">115.55 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 143006</div>
                        <div class="carousel-item__info-users">
                           7                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$62 321</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">266.325 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">160.05 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">106.275 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 176989</div>
                        <div class="carousel-item__info-users">
                           1                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$69 119</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">295.375 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">153.575 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">141.8 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 24193</div>
                        <div class="carousel-item__info-users">
                           715                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$63 784</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">272.575 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">140.75 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">131.825 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 131858</div>
                        <div class="carousel-item__info-users">
                           6                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$56 869</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">243.025 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">140.7 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">102.325 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 30445</div>
                        <div class="carousel-item__info-users">
                           59                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$62 275</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">266.125 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">127.5 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">138.625 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 194811</div>
                        <div class="carousel-item__info-users">
                           2                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$56 992</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">243.55 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">131.15 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">112.4 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 46604</div>
                        <div class="carousel-item__info-users">
                           15                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$50 574</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">216.125 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">125.2 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">90.925 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 227294</div>
                        <div class="carousel-item__info-users">
                           1                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$55 840</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">238.625 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">118.15 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">120.475 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 129604</div>
                        <div class="carousel-item__info-users">
                           1                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$48 276</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">206.3 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">115.15 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">91.15 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 215454</div>
                        <div class="carousel-item__info-users">
                           1                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$49 445</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">211.3 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">102.375 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">108.925 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 221544</div>
                        <div class="carousel-item__info-users">
                           1                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$49 504</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">211.55 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">104.05 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">107.5 <span>ETH</span></div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="carousel-item__info">
                        <div class="carousel-item__info-id">ID 195083</div>
                        <div class="carousel-item__info-users">
                           54                                            
                        </div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">USD balance</div>
                        <div class="carousel-item__block-info">$44 560</div>
                     </div>
                     <div class="carousel-item__block">
                        <div class="carousel-item__block-title">Balance ETH</div>
                        <div class="carousel-item__block-info">190.425 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X3</span></div>
                        <div class="carousel-item__subitem-row">96.25 <span>ETH</span></div>
                     </div>
                     <div class="carousel-item__subitem">
                        <div class="carousel-item__subitem-title">FORSAGE <span>X4</span></div>
                        <div class="carousel-item__subitem-row">94.175 <span>ETH</span></div>
                     </div>
                  </div>
               </div>
               <div class="carousel-nav">
                  <div class="carousel-nav__arrow carousel-nav__prev"></div>
                  <div class="carousel-nav-dots"></div>
                  <div class="carousel-nav__arrow carousel-nav__next"></div>
               </div>
            </div>
            <div class="sectiont-titling results-titling"></div>
            <div class="section-bg results-bg"></div>
            <div class="results-second-bg"></div>
            <div class="section-shadow results-shadow1"></div>
            <div class="section-shadow results-shadow2"></div>
            <div class="section-shadow results-shadow3"></div>
            <div class="section-shadow results-shadow4"></div>
         </div>
         <!-- Fourth section -->
         <div class="section examples">
            <div class="section-content examples-content">
               <div class="examples-title">
                  <div class="default-title revealator-slideleft revealator-once">
                     <h2><span><?=$$lang['COMMISSION PAYOUT SYSTEM']?></span><br>X3 AND X4 <?=$$lang['PARTNER INCOME EXPLAINED']?> </h2>
                  </div>
               </div>
               <div class="examples-blocks">
                  <div class="example">
                     <div class="example-title"><?=$$lang['FORSAGE']?><span>X3</span></div>
                     <div class="example-container">
                        <div class="example-row"><img src="assets/image/repeat_icon.png" alt="repeat"><span><?=$$lang['Automatic deduction of reinvestment fees keeps your slot(s) active as new partners register in your downstream structure']?></span></div>
                        <div class="example-row"><img src="assets/image/wallet_icon.png" alt="wallet"><span><?=$$lang['Automatic downstream partner commissions instantly paid to your ETH wallet']?></span></div>
                     </div>
                  </div>
                  <div class="example">
                     <div class="example-title"><?=$$lang['FORSAGE']?><span>X4</span></div>
                     <div class="example-container">
                        <div class="example-row"><img src="assets/image/boost_icon.png" alt="repeat"><span><?=$$lang['Slot fees are automatically paid to your superior partner`s ETH wallet']?></span></div>
                     </div>
                  </div>
                  <div class="examples-more">
                     <div class="examples-more__text revealator-slideleft revealator-once"><?=$$lang['Simultaneous entry into slot one on the']?><span>X3</span> <?=$$lang['and']?> <span>X4</span><?=$$lang['matrices']?> <br> <?=$$lang['automatically occurs during program registration']?> </div>
                     <div class="examples-more__btn revealator-fade revealator-zoomin revealator-once">
                        <a href="#" class="def-btn def-purple pulse"><?=$$lang['ONLY .05 ETH TO JOIN']?></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="section-titling examples-titling"><?=$$lang['PROFITABLE']?></div>
            <div class="section-bg examples-bg"></div>
            <div class="section-shadow examples-shadow1"></div>
            <div class="section-shadow examples-shadow2"></div>
            <div class="section-shadow examples-shadow3"></div>
            <div class="section-shadow examples-shadow4"></div>
         </div>
         <!-- Fifth section -->
         <div class="section faqq">
            <div class="section-content faq-content">
               <div class="faq-container">
                  <div class="faq-title">
                     <div class="default-title revealator-slideleft revealator-once">
                        <h2><span><?=$$lang['THE FAQS']?></span></h2>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['What is FORSAGE.IO?']?>                       
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Forsage - crowdfunding international platform of new generation and the first ever smart contract with the marketing of type "Matrix" in the blockchain of Ethereum cryptocurrency. It samovolnoy a software algorithm performing the function of a distribution of the affiliate commissions between community members and the observance of certain conditions (the marketing plan). The code is in the public domain. Transaction information can be viewed at the link']?><a href="https://etherscan.io/address/0x5acc84a3e955Bdd76467d3348077d003f00fFB97" target="_blank">https://etherscan.io/address/0x5acc84a3e955Bdd76467d3348077d003f00fFB97</a>.</div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['Who manages the platform?']?>                       
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Platform Forsage does not have a Manager. There are the creators of the Smart contract who works in the Ethereum blockchain. This means that the platform is fully decentralized (i.e. it has no leaders or admins).']?></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['What is Ethereum?']?>                       
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Ethereum (ETH) is one of the leading cryptocurrency established in 2015. The blockchain of the cryptocurrency allows you to create on the basis of smart contracts. A huge number of large crypto companies uses this currency.']?></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['What is a smart contract? What are its advantages?']?>        
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Smart contract – the algorithm inside the blockchain cryptocurrencies. In our case that Ethereum is number one among the those on which it is possible to create smart contracts. The main purpose of such contracts is the automation of the relationship, the opportunity to make commitments samospalenie.']?></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['What is decentralization?']?>                     
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['It is a system in which there are no admins, there is no single server or system monitoring, project management. The creators of the platform are the same project participants like you.']?></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['What is needed to participate in the project?']?>                        
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x-mlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Enough to have nearly any device with access to the Internet, smartphone, tablet, laptop or simply computer. Installed on the device and recharged Ethereum wallet. For communication with partners and support project recommend to install Telegram.']?> <a href="https://tlgrm.ru" target="_blank">https://tlgrm.ru</a></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['Which purse should I use?']?>                  
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['We recommend you to use:
                           for mobile devices (smartphone, tablet) the app Trust Wallet']?><a href="https://trustwallet.com/" target="_blank">https://trustwallet.com/</a>
                           <?=$$lang['Link to instructional video on installing a Trust Wallet:']?><a href="https://www.youtube.com/watch?v=2VsYyt_AGqk&feature=youtu.be" target="_blank">https://www.youtube.com/watch?v=2VsYyt_AGqk&feature=youtu.be</a> -
                           <?=$$lang['Token Pocket Wallet (can be used in China)']?><a href="https://www.tokenpocket.pro" target="_blank">https://www.tokenpocket.pro</a>
                           <?=$$lang['for computers and laptops browser extension Metamask']?> <a href="https://metamask.io" target="_blank">https://metamask.io</a>
                           <?=$$lang['Link to video installation instructions:']?><a href="https://www.youtube.com/watch?v=6uatQ7_NEyk" target="_blank">https://www.youtube.com/watch?v=6uatQ7_NEyk</a>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['Where can I get more information about the project?']?>                     
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['You can ask questions directly to the participants who have already gained experience and are ready to share their experiences and successes.
                           This can be done in the chat Telegram']?><a href="https://t.me/smartpeoplechat." target="_blank">https://t.me/smartpeoplechat</a>.<?=$$lang[' We also recommend to study the materials on the website under “School”.']?>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['What data do I need to register?']?>                     
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['To register you will need only a wallet Metamask - a Google Chrome extension (PC) and/or some other applications for mobile devices. Tested and safe applications:']?>
                           <?=$$lang['wallet Trust Wallet']?><a href="https://trustwallet.com/" target="_blank">https://trustwallet.com/</a> 
                           <?=$$lang['- Pocket Wallet Token']?> <a href="https://www.tokenpocket.pro" target="_blank">https://www.tokenpocket.pro</a>
                           <?=$$lang['During registration you will need to enter the name or email address']?>.
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['How to buy Ethereum, if I never had to deal with cryptocurrency?']?>                     
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['There are many ways of buying/selling cryptocurrency - all of them are as simple as with ordinary money, enough to make a couple of transactions independently, then each operation will take you no more than 1-2 minutes. One of the main ways is the use of sharing sites that allow you to exchange real money for free. One of the ways of replenishment of the purse shown in this video:']?><a href="https://www.youtube.com/watch?v=ohkz7L6zZ2g" target="_blank">https://www.youtube.com/watch?v=ohkz7L6zZ2g</a>
                           Proven website exchange:']?> <a href="https://www.bestchange.ru/?p=1126851" target="_blank">https://www.bestchange.ru/?p=1126851</a>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['How to register on the platform?']?>                     
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['To register Forsage, you need to have a purse Metamask (extension in Google Chrome) and refill it (minimum amount to get started 0,025 + 0,025 eth without Commission network of the blockchain), then go to the affiliate link and click “Automatic registration”. You don`t need to enter personal details - name, email address. After you register you are assigned an ID (identification number) in the system. 
                           Link to video registration'] ?>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['Can I use your phone?']?>                       
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Yes. If you want to work with the phone, you need to install on the phone Trust purse Wallet or pocket Token. There are also a number of other apps, the list will be regularly updated. The actual information you can find on the website or ask in one of the chats project']?>(<a href="https://t.me/smartpeoplechat" target="_blank">https://t.me/smartpeoplechat</a>, <a href="https://t.me/joinchat/AAAAAEVxhgH4fvo7W9lqkg" target="_blank">https://t.me/joinchat/AAAAAEVxhgH4fvo7W9lqkg</a>) 
                           <?=$$lang['To fill it, and sign in using your affiliate link. Read more in videos:']?><a href="https://youtu.be/V8FQ554sXl8" target="_blank">https://youtu.be/V8FQ554sXl8</a>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['Can I register if I come to the site without affiliate links?']?>                      
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Yes. Registration without referral link will put you in command id 1.']?></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['What happens to my account if I stop working?']?>                       
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Your account will not close one. It forever. Your wallet will continue to take payments from all levels except the last one active.']?></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['I registered and paid for, what to do next?']?>                    
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['In order to effectively earn on the platform of the fast and the furious, do the following:
                           1. To communicate with the person who invited you, it will help to take the first steps. 
                           2. If the upstream partner is unable to help or you don`t - go to the “School” where you get all the necessary knowledge.']?>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['How to make money in fast and Furious?']?>                     
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['The principle of earnings is based on building the partner network. You tell potential partners about the capabilities of the platform and send interested people your affiliate link. When a person registers through your link is under you in the system and you instantly get 100% payment on your wallet. The platform works in two marketing plans. Read more about marketing plans in this video.']?>
                           <a href="https://www.youtube.com/watch?v=U7ZFMWvZX-k&feature=emb_logo" target="_blank">https://www.youtube.com/watch?v=U7ZFMWvZX-k&feature=emb_logo</a>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['Possible passive income?']?>                       
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Yes. Site FORSAGE x4 is arranged in such a way that all participants help each other. You can obtain spillovers from upline or downline, however, make a lot of money, doing nothing will not work. To provide a passive income in the future, you need to make some effort to attract new partners and the opening of new platforms in X3 and x4. Inviting a few active people in your team, you will be able to earn good money and achieve their goals. How quickly this will happen depends on you.']?></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['Where to find people to build a team? What if I don`t know how to invite?']?>                       
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['You do not have to invite to the platform their relatives and friends or to impose a participation to someone. A lot of people are interested in earning online, and many have participated in various projects and are in search of new opportunities. They can search social networks by yourself or set up a sales funnel, and then interested people will find you. To learn how to invite partners, go to School and pass free training. 
                           Use your strengths, watch webinars and ask questions of experienced participants of the platform and improve your skills through free training in school, and success will not keep you waiting. Remember one simple truth - your result depends on you, be nice to not be
                           A list of useful links:']?>
                           <a href="https://docs.google.com/spreadsheets/d/1qjxnuxG5czF5XlEyZ_AyBeMR5QmgxFSQUGCTAfeUtEI/edit#gid=0" target="_blank">https://docs.google.com/spreadsheets/d/1qjxnuxG5czF5XlEyZ_AyBeMR5QmgxFSQUGCTAfeUtEI/edit#gid=0</a>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['How much can you earn?']?>                  
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['The amount of your income depends on the number of invited people and how actively they will work. The minimum amount of income at the closure of 12 sites for two programs are shown in the table below:']?>
                           <a href="assets/image/profit_table.svg" target="_blank"><img src="assets/image/profit_table.svg" alt="" width="600"></a>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['How quickly can I withdraw money from the project?']?>                      
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['A withdrawal occurs instantly. The money is transferred immediately into your personal wallet. You can manage your money the way you want.']?></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['What is X3 and x4, and that such levels?']?>                       
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Program X3 and x4 is a matrix with a limited number of seats. The matrix X3, there are three locations in the matrix x4 - six. When completing the matrix, it opens the same new auto.
                           Each program has 12 levels. Each level is exactly 2 times more expensive than the previous and allows you to earn 2 times more']?>.
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['Are there levels of validity?']?>                        
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['No. You buy any level in the program once and for all. Sites have no validity. It considerably distinguishes a platform Forsage from other projects where you are required regular of costs. Here you comes solely from your personal financial capabilities']?>.
						</div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['What is a "Reinvest"?']?>                      
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Reinvest is an update to any template in any program at any level when it is fully filled. When you re-open a new, completely free matrix, the filling of which, you again get the payments on your wallet. The amount of the reinvestment goes to senior partner, you personally do not need to pay extra for.']?></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['What is "Shimmering" and "Overtaking"?']?>                     
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Iridescence is when you receive the payment, from registration of new partners and other participants in the program x4
                           Overtaking is when your personally sponsored partner purchases level (a more expensive pad in X3 or x4), which still is not you. In this case the payment is received by any upstream partner in the structure, which this level is available.']?>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['Can I lose my invited partner? ']?>                     
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['No. It is possible. Your personally invited partner forever bound to you bound referral.']?></div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['My partner bought me a basket of 3 in x4, and payouts in my wallet. Why?']?>                       
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['This can happen for two reasons:
                           - your partner came to you in the first line of the matrix x4. You will receive the payment only at the second line
                           - your partner took the last free place in the matrix X3 or x4, activated reinvest. In this case the payment went your upline structure']?>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                           <?=$$lang['What is the difference from the pyramid?']?>                   
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Forsage is a crowdfunding platform for the new generation and has no relation to the pyramids.
                           The principle of a financial pyramid based on the fact that most of the money concentrated in the hands of its creators. The sooner you come, the more money. A pyramid scheme can be closed at any time. The participants of the platform Forsage – both leaders and newcomers - are equal. To stop the platform, no one can, because its functioning is ensured by a smart contract that cannot be deleted or changed. Even if the site will stop working, all the data and structure will be in integrity and smart contract will continue to operate as long as there is Internet and electricity.']?>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-wrap">
                     <div class="accordion revealator-slideright revealator-once">
                        <div class="accordion-heading">
                          <?=$$lang['What are the risks?']?>                       
                           <span class="accordion-heading__arrow">
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="white">
                                 <g>
                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                       c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                       c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                       c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                 </g>
                              </svg>
                           </span>
                        </div>
                        <div class="accordion-content"><?=$$lang['Risks platform Forsage do not exist. Enough to invite 1 person to immediately recoup the initial cost of participation in the project. The platform works based on the smart contract blockchain system. Code of the smart contract is in the public domain. 
                           All payments go directly into your personal wallet, without any hidden fees and without third-party resources. This ensures that any amount you earn belongs to you and only you,and the money you can use at the same moment, as they did to you on the wallet, without having to wait or requests for payment.']?>
                        </div>
                     </div>
                  </div>
               </div>
               <footer class="footer">
                  <div class="footer-wrap">
                     <div class="footer-left">
                        <div class="footer-left__logo">© FORSAGE</div>
                        <div class="footer-left__address">
                           <span>Smart-contract:</span>
                           <span><a href="https://etherscan.io/txs?a=0x5acc84a3e955Bdd76467d3348077d003f00fFB97" target="_blank">0x5acc84a3e955Bdd76467d3348077d003f00fFB97</a></span>
                        </div>
                     </div>
                     <div class="footer-right">
                        <a href="https://t.me/forsage_official" class="footer-right__social tg" target="_blank"><img src="assets/image/tg_icon.svg" alt=""></a>
                        <a href="https://www.youtube.com/channel/UCIw_BhcSHA0Gf-z9PAPTSRQ" target="_blank" class="footer-right__social yt"><img src="assets/image/yt_icon.svg" alt=""></a>
                     </div>
                  </div>
               </footer>
            </div>
            <div class="sectiont-titling faq-titling"></div>
            <div class="section-bg faq-bg"></div>
            <div class="section-shadow faq-shadow1"></div>
            <div class="section-shadow faq-shadow2"></div>
         </div>
      </div>
      <!-- !!end of page -->
      <div id="marketing-video" class="modal marketing-video">
         <div class="modal-header">
            <div class="list-lang">
               <a href="javascript:;" data-lang="ru" data-video_key="U7ZFMWvZX-k" class="">
               <img src="assets/image/ru.svg" alt="" width="50px" height="50px">
               </a>
               <a href="javascript:;" data-lang="en" data-video_key="m0NzYwFfGH4" class="active">
               <img src="assets/image/en.svg" alt="" width="50px" height="50px">
               </a>
            </div>
         </div>
         <div class="modal-content">
            <div data-video_lang="ru" class="video-container ">
               <iframe width="90%" src="https://www.youtube.com/embed/U7ZFMWvZX-k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div data-video_lang="en" class="video-container active">
               <iframe width="90%" src="https://www.youtube.com/embed/m0NzYwFfGH4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
         </div>
         <div class="modal-footer">
            <div class="block-copy">
               <span class="link">
               <a href="https://youtu.be/m0NzYwFfGH4" target="_blank">https://youtu.be/m0NzYwFfGH4</a>
               </span>
               <span class="copy">
               <i class="fas fa-copy"></i>
               </span>
            </div>
         </div>
      </div>
      <div id="Notice"></div>
      <script>
         var config = {
             site: {
                 domain:   location.hostname,
                 protocol: location.protocol + '//',
                 hostname: location.hostname,
                 link: 'https://forsage.io/',
             },
             user: {
                 refkey: 'unknown',
             },
             lang: {
                 /* common.js */
                 copied                   : `Copied`,
         
                 // Сокеты события
                 'ws-regLevel_0'          : `ID #:{user_id} just joined! Welcome.`,
                 'ws-regLevel_1'          : `ID #:{user_id} just joined! Welcome.`,
                 'ws-regLevel_2'          : `Introducing New Partner #:{user_id}.`,
                 'ws-regLevel_3'          : `ID #:{user_id} just joined. Welcome to Forsage!`,
                 'ws-newUserPlace'        : `ID #:{user_id} received {price_level} {crypto_name} (\${currency_usd}) from the {matrix} matrix`,
                 'ws-upgrade'             : `ID #:{user_id} bought {level} for the slot in {matrix} from user {ref_id}.`,
                 'ws-reinvest'            : `Automatic reinvestment fee deducted for ID #:{user_id} on {level} for slot ({matrix})`,
                 'ws-missedEthReceive'    : `ID #:{user_id} missed profit {price_level} {crypto_name} (\${currency_usd}). Upgrade in ({matrix}) to avoid future losses`,
                 'ws-sentExtraEthDividends':`ID #:{user_id} received a bonus {price_level} {crypto_name} (\${currency_usd})`,
                 'ws-cannotSendMoneyEvent': `ID #:{user_id} Translation error`,
                 'ws-leadingPartner'      : `ID #:{user_id} missed profit {price_level} {crypto_name} (\${currency_usd}) from (ID:{ref_id}) for slot # {level} ({matrix})`,
                 'ws-leadingPlacePurchase': `ID #:{user_id} overtook (ID:{up_id}) on slot # {level} ({matrix})`,
         
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
                 'elt-minutes_1'          : `minutes`,
                 'elt-minutes_2'          : `minutes`,
                 'elt-seconds_0'          : `second`,
                 'elt-seconds_1'          : `seconds`,
                 'elt-seconds_2'          : `seconds`,
                 'elt-end'                : ` ago`,
                 'elt-freshly'            : `just`,
             },
             locked: {
                 buyLevel      : ``,
                 authorization : ``,
                 registration  : ``,
             },
             permissions: {
                 buyLevel      : `0`,
             }
         };
         // Получить основной домен
         let arr = config.site.domain.split('.');
         if(arr.length > 2) {
             config.site.domain = arr.slice(arr.length - 2).join('.')
         }
      </script>
      <!-- Connecting scripts and libraries -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.fancybox.min.js"></script>
      <script src="assets/js/materialize.min.js"></script>
      <script src="assets/js/scrolloverflow.min.js"></script>
      <script src="assets/js/fullpage.min.js"></script>
      <script src="assets/js/fullpage.extensions.min.js"></script>
      <script src="assets/js/fm.revealator.jquery.js"></script>
      <script src="assets/js/index.js"></script>
      <!-- created by sellsteam13 | https://www.weblancer.net/users/sellsteam13/ -->
      <script src="assets/js/common.js"></script>
   </body>
</html>