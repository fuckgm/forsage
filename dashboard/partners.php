<?php
 $page = 'Dashboard';  
 include('core/common_code.php');
 
include('sidebar.php');

?>

            
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
       
         <div class="row">
      <div class="col">
         <div class="border-gradient">
            <div class="border-gradient_content">
               <h3 class="head">Partners</h3>
               <form class="bg-black_transparent filter-partners" method="POST" action="<?php echo SITE_URL.'dashboard/partners.php'?>">
                  <h4 class="text-center">Filter: </h4>
                  <div class="row">
                     <div class="col-md-3 form-group">
                        <label for="level">Slot</label>
                        <select name="level" id="level" class="form-control">
                           <option value="">---</option>
                           <option value="1" <?php if($_POST){ if($_POST['level']=='1') { echo 'selected=selected';} }?>>
                              1
                           </option>
                           <option value="2" <?php if($_POST){ if($_POST['level']=='2') { echo 'selected=selected';} }?>>
                              2
                           </option>
                           <option value="3" <?php if($_POST){ if($_POST['level']=='3') { echo 'selected=selected';} }?>>
                              3
                           </option>
                           <option value="4" <?php if($_POST){ if($_POST['level']=='4') { echo 'selected=selected';} }?>>
                              4
                           </option>
                           <option value="5" <?php if($_POST){ if($_POST['level']=='5') { echo 'selected=selected';} }?>>
                              5
                           </option>
                           <option value="6" <?php if($_POST){ if($_POST['level']=='6') { echo 'selected=selected';} }?>>
                              6
                           </option>
                           <option value="7" <?php if($_POST){ if($_POST['level']=='7') { echo 'selected=selected';} }?>>
                              7
                           </option>
                           <option value="8" <?php if($_POST){ if($_POST['level']=='8') { echo 'selected=selected';} }?>>
                              8
                           </option>
                           <option value="9" <?php if($_POST){ if($_POST['level']=='9') { echo 'selected=selected';} }?>>
                              9
                           </option>
                           <option value="10" <?php if($_POST){ if($_POST['level']=='10') { echo 'selected=selected';} }?>>
                              10
                           </option>
                           <option value="11" <?php if($_POST){ if($_POST['level']=='11') { echo 'selected=selected';} }?>>
                              11
                           </option>
                           <option value="12" <?php if($_POST){ if($_POST['level']=='12') { echo 'selected=selected';} }?>>
                              12
                           </option>
                        </select>
                     </div>
                     <div class="col-md-3 form-group">
                        <label for="matrix">Program</label>
                        <select name="matrix" id="matrix" class="form-control">
                           <option value="">---</option>
                           <option value="1" >
                              x3
                           </option>
                           <option value="2" >
                              x4
                           </option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="search">Search by ID | Wallet</label>
                           <input type="text" name="search" value="<?php if($_POST){ if($_POST['search']!='') { echo $_POST['search'];} }?>" placeholder="Enter..." id="search" class="form-control">
                        </div>
                     </div>
                  </div>
                  <input type="hidden" name="user" value="123">
                  <input type="hidden" name="sid" value="">
                  <button type="submit" class="btn btn-primary">
                  Apply                    </button>
                  <a href="<?php echo SITE_URL.'dashboard/?partners';?>" class="btn btn-secondary">
                  Reset filter                    </a>
               </form>
               <div class="row bg-black_transparent partners-group">
                  <div class="col-6">
                     <div class="partners-group__tip">
                        <div class="row">
                           <div class="col-8">Clicks:</div>
                           <div class="col-4">1</div>
                        </div>
                        <div class="row">
                           <div class="col-8">Number of registrations:</div>
                           <div class="col-4">0</div>
                        </div>
                        <div class="row">
                           <div class="col-8">Registrations for the week:</div>
                           <div class="col-4">0</div>
                        </div>
                        <div class="row">
                           <div class="col-8">Registrations for 24 hours:</div>
                           <div class="col-4">0</div>
                        </div>
                        <div class="row">
                           <div class="col-8">Partners in the structure:</div>
                           <div class="col-4">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 text-right">
                     <!-- <div class="partners-group__tip">
                        <i class="fas fa-info"></i> &nbsp;To receive referral links to partners, you need to invite<br> else "5" member to the structure                        </div> -->
                  </div>
               </div>
			   <!-- Plugins For This Page -->

               <h4 class="head">Your Downline Partners</h4>
               <div class="mycls table-responsive" id="myid">
                  <table class="table_mini tablePartners" id="example">
                     <thead>
                        <tr>
                           <td style="">
                              <a href="?sort=id&order=ASC">
                              User ID                                                                            </a>
                           </td>
                           <td style="">
                              <a href="?sort=date&order=ASC">
                              Level                                                                            </a>
                           </td>
                           <td style="">
                              Wallet Address
                           </td>
                           <td style="">
                              <a href="?sort=x3&order=ASC">
                              Date                                                                            </a>
                           </td>
                        </tr>
                     </thead>
                     <tbody>


<?php

if($_POST){
	$levels= $_POST['level'];
    $search= $_POST['search'];
    $matrix= $_POST['matrix'];

    define('LEVELS',$levels);
    define('SEARCH',$search);

	function fetchDownlines($userID, $conn, $level=0){

	$query = "SELECT * FROM event_reglevelev where referrerID='".clean($userID)."' ";
	$result = mysqli_query($conn,$query);
	$row = mysqli_num_rows($result);
	
	$tempArray = array();
	if($row != NULL && $row > 0){
		while ($row1 = $result -> fetch_assoc()) {
			array_push($tempArray,$row1['userID']);
			$levels = LEVELS;
            $search = SEARCH;
                if($levels!='' && $search!=''){
					if($levels==$level && $search==$row1['userWallet']){

					echo'
								<tr role="row" class="odd">
									<td>'.$row1['userID'].'</td>
									<td>'.$level.'</td>
									<td>
									<a href="https://etherscan.io/address/'.$row1['userWallet'].'" target="new"> '.$row1['userWallet'].' </a>
									</td>
									<td>'.date('m/d/Y', $row1['timestamp']).'</td>
								</tr>
							';
					}

				}
				elseif($levels!='' && $search==''){
					if($levels==$level){
					echo'
								<tr role="row" class="odd">
									<td>'.$row1['userID'].'</td>
									<td>'.$level.'</td>
									<td>
									<a href="https://etherscan.io/address/'.$row1['userWallet'].'" target="new"> '.$row1['userWallet'].' </a>
									</td>
									<td>'.date('m/d/Y', $row1['timestamp']).'</td>
								</tr>
							';

					}
				}elseif($levels=='' && $search!=''){
					if($search==$row1['userWallet']){
					echo'
								<tr role="row" class="odd">
									<td>'.$row1['userID'].'</td>
									<td>'.$level.'</td>
									<td>
									<a href="https://etherscan.io/address/'.$row1['userWallet'].'" target="new"> '.$row1['userWallet'].' </a>
									</td>
									<td>'.date('m/d/Y', $row1['timestamp']).'</td>
								</tr>
							';
					}


				}else{
					echo'
								<tr role="row" class="odd">
									<td>'.$row1['userID'].'</td>
									<td>'.$level.'</td>
									<td>
									<a href="https://etherscan.io/address/'.$row1['userWallet'].'" target="new"> '.$row1['userWallet'].' </a>
									</td>
									<td>'.date('m/d/Y', $row1['timestamp']).'</td>
								</tr>
							';


				}





		}
	}
	return $tempArray;
	}
}else{
	function fetchDownlines($userID, $conn, $level=0){

	$query = "SELECT * FROM event_reglevelev where referrerID='".clean($userID)."' ";
	$result = mysqli_query($conn,$query);
	$row = mysqli_num_rows($result);
	$tempArray = array();
	if($row != NULL && $row > 0){
		while ($row1 = $result -> fetch_assoc()) {
			array_push($tempArray,$row1['userID']);


						echo'
								<tr role="row" class="odd">
									<td>'.$row1['userID'].'</td>
									<td>'.$level.'</td>
									<td>
									<a href="https://etherscan.io/address/'.$row1['userWallet'].'" target="new"> '.$row1['userWallet'].' </a>
									</td>
									<td>'.date('m/d/Y', $row1['timestamp']).'</td>
								</tr>
							';


		}
	}
	return $tempArray;
	}
}





//Toal partners - all levels

$mainArray = array();
$level1Array = array();

//level 1 referrals
$tempArray2 = fetchDownlines($userID, $conn, 1);

if(count($tempArray2) > 0){
	$mainArray = array_merge($mainArray, $tempArray2);
	$level1Array = $tempArray2;

		//These are level 1 refs
		foreach ($tempArray2 as $key) {

			//level 2 referrals
			$tempArray2 = fetchDownlines($key, $conn, 2);

			if(count($tempArray2) > 0){

				$mainArray = array_merge($mainArray, $tempArray2);
				//These are level 2 refs
				foreach ($tempArray2 as $key) {

					//level 2 referrals
					$tempArray2 = fetchDownlines($key, $conn, 3);

					//level 3 referrals
					if(count($tempArray2) > 0){

						$mainArray = array_merge($mainArray, $tempArray2);

							//level 4
							foreach ($tempArray2 as $key) {

								$tempArray2 = fetchDownlines($key, $conn, 4);

								//level 4 referrals
								if(count($tempArray2) > 0){

									$mainArray = array_merge($mainArray, $tempArray2);


										//level 5
										foreach ($tempArray2 as $key) {

										$tempArray2 = fetchDownlines($key, $conn, 5);

										//level 5 referrals
										if(count($tempArray2) > 0){

											$mainArray = array_merge($mainArray, $tempArray2);



//level 6
foreach ($tempArray2 as $key) {

$tempArray2 = fetchDownlines($key, $conn, 6);

//level 6 referrals
if(count($tempArray2) > 0){

	$mainArray = array_merge($mainArray, $tempArray2);

	//level 7
	foreach ($tempArray2 as $key) {

	$tempArray2 = fetchDownlines($key, $conn, 7);

	//level 7 referrals
	if(count($tempArray2) > 0){

		$mainArray = array_merge($mainArray, $tempArray2);


		//level 8
		foreach ($tempArray2 as $key) {

		$tempArray2 = fetchDownlines($key, $conn, 8);

		//level 8 referrals
		if(count($tempArray2) > 0){

			$mainArray = array_merge($mainArray, $tempArray2);


			//level 9
			foreach ($tempArray2 as $key) {

			$tempArray2 = fetchDownlines($key, $conn, 9);

			//level 9 referrals
			if(count($tempArray2) > 0){

				$mainArray = array_merge($mainArray, $tempArray2);


				//level 10
				foreach ($tempArray2 as $key) {

				$tempArray2 = fetchDownlines($key, $conn, 10);

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

  </tbody>
                  </table>
                  <div class="pagination_wrapper">
                  </div>
               </div>
               <!-- end: border-gradient_content -->
            </div>
            <!-- end: border-gradient -->
         </div>
      </div>
   </div>

        </div>
    </div>
</div>

<div class="text-center mb-3">
    <!-- Toggle button -->
    <div class="button-con">
      <label for='cb1'>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="dayIcon" x="0px" y="0px" viewBox="0 0 35 35" style="enable-background:new 0 0 35 35;" xml:space="preserve">
          <g id="Sun">
            <g>
              <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M6,17.5C6,16.672,5.328,16,4.5,16h-3C0.672,16,0,16.672,0,17.5    S0.672,19,1.5,19h3C5.328,19,6,18.328,6,17.5z M7.5,26c-0.414,0-0.789,0.168-1.061,0.439l-2,2C4.168,28.711,4,29.086,4,29.5    C4,30.328,4.671,31,5.5,31c0.414,0,0.789-0.168,1.06-0.44l2-2C8.832,28.289,9,27.914,9,27.5C9,26.672,8.329,26,7.5,26z M17.5,6    C18.329,6,19,5.328,19,4.5v-3C19,0.672,18.329,0,17.5,0S16,0.672,16,1.5v3C16,5.328,16.671,6,17.5,6z M27.5,9    c0.414,0,0.789-0.168,1.06-0.439l2-2C30.832,6.289,31,5.914,31,5.5C31,4.672,30.329,4,29.5,4c-0.414,0-0.789,0.168-1.061,0.44    l-2,2C26.168,6.711,26,7.086,26,7.5C26,8.328,26.671,9,27.5,9z M6.439,8.561C6.711,8.832,7.086,9,7.5,9C8.328,9,9,8.328,9,7.5    c0-0.414-0.168-0.789-0.439-1.061l-2-2C6.289,4.168,5.914,4,5.5,4C4.672,4,4,4.672,4,5.5c0,0.414,0.168,0.789,0.439,1.06    L6.439,8.561z M33.5,16h-3c-0.828,0-1.5,0.672-1.5,1.5s0.672,1.5,1.5,1.5h3c0.828,0,1.5-0.672,1.5-1.5S34.328,16,33.5,16z     M28.561,26.439C28.289,26.168,27.914,26,27.5,26c-0.828,0-1.5,0.672-1.5,1.5c0,0.414,0.168,0.789,0.439,1.06l2,2    C28.711,30.832,29.086,31,29.5,31c0.828,0,1.5-0.672,1.5-1.5c0-0.414-0.168-0.789-0.439-1.061L28.561,26.439z M17.5,29    c-0.829,0-1.5,0.672-1.5,1.5v3c0,0.828,0.671,1.5,1.5,1.5s1.5-0.672,1.5-1.5v-3C19,29.672,18.329,29,17.5,29z M17.5,7    C11.71,7,7,11.71,7,17.5S11.71,28,17.5,28S28,23.29,28,17.5S23.29,7,17.5,7z M17.5,25c-4.136,0-7.5-3.364-7.5-7.5    c0-4.136,3.364-7.5,7.5-7.5c4.136,0,7.5,3.364,7.5,7.5C25,21.636,21.636,25,17.5,25z" />
            </g>
          </g>
        </svg>
      </label>
      <input class='toggle' id='cb1' type='checkbox' >
      <label class='toggle-button' for='cb1'></label>
      <label for='cb1'>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="nightIcon" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
          <path d="M96.76,66.458c-0.853-0.852-2.15-1.064-3.23-0.534c-6.063,2.991-12.858,4.571-19.655,4.571  C62.022,70.495,50.88,65.88,42.5,57.5C29.043,44.043,25.658,23.536,34.076,6.47c0.532-1.08,0.318-2.379-0.534-3.23  c-0.851-0.852-2.15-1.064-3.23-0.534c-4.918,2.427-9.375,5.619-13.246,9.491c-9.447,9.447-14.65,22.008-14.65,35.369  c0,13.36,5.203,25.921,14.65,35.368s22.008,14.65,35.368,14.65c13.361,0,25.921-5.203,35.369-14.65  c3.872-3.871,7.064-8.328,9.491-13.246C97.826,68.608,97.611,67.309,96.76,66.458z" />
        </svg>
      </label>
    </div>
    <script>
        // Enable Dark Theme
        window.addEventListener('DOMContentLoaded', function () {
            $('#cb1').click(function () {
                if($(this).prop('checked')) {
                    location.href = '?theme=dark';
                } else {
                    location.href = '?theme=default';
                }
            })
        });
    </script>
    <!-- end toggle button -->
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
        refkey: 'vpat19',
        address: '0x948e5f339942f9f6cf417c5fe6de73ef6059bd8b',
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


  <script type="text/javascript" src="assets_s/js/jquery-3.5.1.js" ></script>
			   
  <script src="global/vendor/datatables.net/jquery.dataTablesfd53.js?v4.0.1"></script>
  <script src="global/vendor/datatables.net-bs4/dataTables.bootstrap4fd53.js?v4.0.1"></script>
  <script src="global/vendor/datatables.net-responsive/dataTables.responsive.minfd53.js?v4.0.1"></script>
  <script src="global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.minfd53.js?v4.0.1"></script>
               <script>$(document).ready(function() {
                  $.noConflict();
                  var table = $('#example').DataTable( {
                     responsive: true
                  } );
                  
                  new $.fn.dataTable.FixedHeader( table );
                  } );
               </script>
		
  <script type="text/javascript" src="assets_s/js/jquery-3.5.1.js" ></script>
			   
  <script src="global/vendor/datatables.net/jquery.dataTablesfd53.js?v4.0.1"></script>
  <script src="global/vendor/datatables.net-bs4/dataTables.bootstrap4fd53.js?v4.0.1"></script>
  <script src="global/vendor/datatables.net-responsive/dataTables.responsive.minfd53.js?v4.0.1"></script>
  <script src="global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.minfd53.js?v4.0.1"></script>
               <script>$(document).ready(function() {
                  $.noConflict();
                  var table = $('#example').DataTable( {
                     responsive: true
                  } );
                  
                  new $.fn.dataTable.FixedHeader( table );
                  } );
               </script>
		
<script src="assets/Decentralized/js/jquery.min.js"></script>
<script src="assets/Decentralized/js/vue.min.js"></script>
<script src="assets/Decentralized/js/socket.io.js"></script>
<script src="assets/Decentralized/js/jquery.fancybox.min.js"></script>
<script src="assets/Decentralized/js/common.js"></script>
<script src="assets/Decentralized/js/contract.js"></script>
<script src="assets/Decentralized/js/cabinet.js"></script>
<div class="require-auth"> 
    Purchase in preview mode is not available! Please please login with your Ethereum wallet.<br>
    <br>
    <div>
                    <button class="btn btn-success" id="reauth">
                Authorization            </button>
            </div>
</div>
<!-- Yandex.Metrika counter -->
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