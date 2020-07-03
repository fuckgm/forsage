<?php
$page = "Promo";
include('top_navbar.php');
include('sidebar.php');



?>
 

  <!-- Page -->
  <div class="page">
	<div class="page-content container-fluid">
		<div class="row" data-plugin="matchHeight" data-by-row="true">
		<div class="col-xxl-12 col-lg-12 pb-10" style="">
			<!-- TradingView Widget BEGIN -->
				<div class="tradingview-widget-container">
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
				</div>

			  
	</div>
		<div class="col-xl-12">
              <!-- Example Tabs Icon -->
              <div class="example-wrap">
			  <h4 class=""><?=$$lang['Promotions']; ?></h4>
                <div class="card nav-tabs-horizontal" data-plugin="tabs">
                  <ul class="nav nav-tabs nav-quick nav-quick-sm" role="tablist">
                    <li class="nav-item col-xxl-12 col-lg-3" role="presentation">
						<a class="nav-link active" data-toggle="tab" href="#exampleTabsIconOne" aria-controls="exampleTabsIconOne" role="tab" aria-selected="true">
							<i class="icon fa-desktop" aria-hidden="true"></i>
							<?=$$lang['Presentation']?>
						</a>
					</li>
                    <li class="nav-item col-xxl-12 col-lg-3" role="presentation">
						<a class="nav-link" data-toggle="tab" href="#exampleTabsIconTwo" aria-controls="exampleTabsIconTwo" role="tab" aria-selected="false">
							<i class="icon fa-file-text-o" aria-hidden="true"></i>
							<?=$$lang['Articles']?>
							<span class="badge badge-danger">13</span>
						</a>
					</li>
                    <li class="nav-item col-xxl-12 col-lg-3" role="presentation">
						<a class="nav-link" data-toggle="tab" href="#exampleTabsIconThree" aria-controls="exampleTabsIconThree" role="tab" aria-selected="false">
							<i class="icon fa-photo" aria-hidden="true"></i>
							<?=$$lang['Banner']?>
						</a>
					</li>
                    <li class="nav-item col-xxl-12 col-lg-3" role="presentation">
						<a class="nav-link" data-toggle="tab" href="#exampleTabsIconFour" aria-controls="exampleTabsIconFour" role="tab" aria-selected="false">
							<i class="icon fa-youtube-play" aria-hidden="true"></i>
						<?=$$lang['Video']?>
						</a>
					</li>
                  </ul>
                  <div class="tab-content p-20">
                    <div class="tab-pane active" id="exampleTabsIconOne" role="tabpanel">
                      Fruenda stabilique contumeliae erga inpendente nostros morbi, fugiendus modo cumanum,
                      possit sicut orestem iucunde appetere expetendum platonem,
                      manu nisi orestem discordiae. Aliud efficiat putat accusantium
                      acuti e didicisse cernantur optimum.
                    </div>
                    <div class="tab-pane" id="exampleTabsIconTwo" role="tabpanel">
                      Iucunde restincto corrupti locos sane totam contrariis, putas quaerimus, aequo
                      grate dissentiet disseruerunt epicureum, modo adipisci contemnentes
                      legam istius maximam, virtute torquentur multam, habemus
                      integris morbos tradunt suppetet animis detracta.
                    </div>
                    <div class="tab-pane" id="exampleTabsIconThree" role="tabpanel">
                      Quarum eloquentiam, aperta. Hominibus adipiscuntur. Firme graecis doloris liberabuntur
                      sensum recteque declarant. Aiunt, fore tranquillae dicitis
                      necessariae, chorusque periculis libenter constituamus aspernandum
                      ait chaere, cogitemus, quisquis omnia genuit has hae.
                    </div>
                    <div class="tab-pane" id="exampleTabsIconFour" role="tabpanel">
                      Excepturi causae, cepisse meliore quanta consectetur aliqua attulit aperiri. Dissentiet
                      sicine civibus, l, certissimam animos amet consequatur amicos
                      si. Albam. Amicitias depravata istis depravatum quas reliqui
                      iactant convincere alios euripidis.
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Example Tabs Icon -->
            </div>
	</div>
    </div>
	
  </div>
  <!-- End Page -->

<?php
include('footer.php');
?>