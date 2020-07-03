<?php
$page = "Lost";
include('top_navbar.php');
include('sidebar.php');
include('core/lost_curl.php');


?>
 

  <!-- Page -->
  <div class="page">
	<div class="page-content container-fluid">
		<div class="row" data-plugin="matchHeight" data-by-row="true">
		<div class="col-xxl-12 col-lg-12 pb-10" style="">
			<!-- TradingView Widget BEGIN -->
				<!--<div class="tradingview-widget-container">
				  <div class="tradingview-widget-container__widget"></div>
				  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
				  {
				  "symbols": [
					{
					  "proName": "BITSTAMP:BTCUSD",
					  "title": "BTC/USD"
					},
					{
					  "proName": "BITSTAMP:ETHUSD",
					  "title": "ETH/USD"
					},
					{
					  "description": "",
					  "proName": "BINANCE:ETHPAX"
					},
					{
					  "description": "",
					  "proName": "BINANCE:ETHBTC"
					}
				  ],
				  "colorTheme": "light",
				  "isTransparent": false,
				  "displayMode": "adaptive",
				  "locale": "in"
				}
				  </script>
				</div>-->

				<div class="currencies_vs  currencies--userland section_home_block_stats_content" style="overflow-wrap: normal; white-space: nowrap; overflow: hidden;background-color: #ffffff!important;">
					<!-- TradingView Widget start -->
						<?php include('slider.php'); ?>
					<!-- TradingView Widget END -->
			  
			</div>
		
        </div>

	<div class="panel">
	<header class="panel-heading">
		<div class="panel-actions"></div>
		<h3 class="panel-title"><?=$$lang['Lost Profits']; ?></h3>
	</header>
	<div class="panel-body">
	<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-hover dataTable table-striped w-full dtr-inline" data-plugin="dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 1014px;">
						<thead>
							<tr role="row">
								<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 211.992px;" aria-sort="ascending" aria-label="Name: activate to sort column descending"><?=$$lang['Date']?></th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 211.992px;" aria-label="Position: activate to sort column ascending">ETH <?=$$lang['Amount']?></th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 184.992px;" aria-label="Office: activate to sort column ascending"><?=$$lang['Wallet Address']?></th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 73.992px;" aria-label="Salary: activate to sort column ascending"><?=$$lang['USER ID']?></th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 73.992px;" aria-label="Salary: activate to sort column ascending"><?=$$lang['LEVEL']?></th>
							</tr>
						</thead>
						<tbody>


<?php

global $etherscanAddress;
$query = "SELECT * FROM event_lostforlevelev where referrer='".clean($userWallet)."' ";
$result = mysqli_query($conn,$query);
$rown = mysqli_num_rows($result);
if($rown > 0){
while ($row1 = $result -> fetch_assoc()) {


//find user id
$query2 = "SELECT * FROM event_reglevelev where userWallet='".$row1['buyer']."'  ";
$result2 = mysqli_query($conn,$query2);
$row2 = mysqli_num_rows($result2);

if($row2 > 0){
	$row3 = $result2 -> fetch_assoc();
	$buyerID = $row3['userID'];
}
		

echo'							<tr role="row">
								<td>'.date('m/d/Y', $row1['timestamp']).'</td>
								<td>'.($row1['amount'] / 1000000000000000000).'</td>
								<td>
								<a href="'.$etherscanAddress.''.$row1['buyer'].'" target="new"> '.$row1['buyer'].' </a>
								</td>
								<td>'.$buyerID.'</td>
								<td>'.$row1['level'].'</td>
							</tr>
';	


	}
}



				


?>					
						</tbody>
					</table>
				</div>
			</div>
		
	</div>
	
	
	
		
		
	</div>
</div>
    </div>
	
  </div>
  <!-- End Page -->

<?php
include('footer.php');
?>