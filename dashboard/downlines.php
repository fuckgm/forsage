<?php
//ini_set( 'opcache.enable', 0 );
//phpinfo();
//die();
$page = "Downlines";
include('top_navbar.php');
include('sidebar.php');
include('core/downline_curl.php');
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
		<div class="col-xxl-12 col-lg-6 col-sm-6" style="">
		  <div class="card card-shadow card-completed-options text-white">
			<div class="card-block p-25">			
			<div class="panel-heading">
              <h4 class=""><?=$$lang['Your Referral Link']; ?></h4>			  
            </div>
			 <div class="row">
				<div class="col-xxl-12 col-lg-9 ">
				  <div class="example-wrap mb-10">
				
					<input id="myRefLink" type="text" class="form-control focus"  value="<?=$siteURL;?>?a=<?=$userID;?>" >
				  </div>
				</div>
				<div class="col-xxl-12 col-lg-3">
					<button onclick="myFunctionCopy()" type="button" class="btn btn-block btn-primary waves-effect waves-classic mb-10"><i class="icon fa-copy" aria-hidden="true"></i> <span id="copyButton"><?=$$lang['Copy']?></span></button>
				</div>
			</div>
			</div>
		  </div>
		</div>
		
		<div class="col-xxl-12 col-lg-6 col-sm-6" style="">
		  <div class="card card-shadow card-completed-options text-white">
			<div class="card-block p-25">
			<div class="panel-heading">
              <h4 class=""><?=$$lang['Link for redirect to the Trust Wallet Dapp Browser'];?></h4>
            </div>
			 <div class="row">
				<div class="col-xxl-12 col-lg-9 ">
				  <div class="example-wrap mb-10">
					<input type="text" class="form-control focus" id="trustWalletLinkCopy" value="https://link.trustwallet.com/open_url?url=<?=$siteURL;?>?a=<?=$userID;?>" >
				  </div>
				</div>
				<div class="col-xxl-12 col-lg-3">
					<button onclick="myFunctionCopy2()" type="button" class="btn btn-block btn-primary waves-effect waves-classic mb-10"><i class="icon fa-copy" aria-hidden="true"></i> <span id="copyButton2"><?=$$lang['Copy']?></span> </button>
				</div>
			</div>
			</div>
		  </div>
		</div>
		
	

        </div>
		

        <style>
	
	.node {
		cursor: pointer;
	}

	.node circle {
	  fill: #fff;
	  stroke: #043e6f;
	  stroke-width: 1px;
	}

	.node text {
	  font: 10px sans-serif;
	  color: white;
	}

	.link {
	  fill: none;
	  stroke: #ccc;
	  stroke-width: 2px;
	}
	#tooltip 
	{
		display:none;
		position:absolute;
		background: linear-gradient(to right, #1d7ccb 30%, #1951b8 100%);
    	/*background-color: #e35583;*/
        border: 1px solid #1951b8;
		border-radius: 5px;
    	color: #ffff;
    	top: 25%;
    	font-size: 10px;
		padding:10px;
   
	}
     
     #tooltip ::after{
       content: '';
       position: absolute; 
       width: 2em;
       height: 2em;
       top: 25px;
       margin: -1em 0 0;
       background: url(assets/images/tooltip1.svg) no-repeat center center;
       background-size: 100%;  
       right: 99%
     
      }
        
      #tooltip ::before 
     {
   		display:none;	
   		position: absolute;
   		width: 0;
   		height: 0;
    	left: auto;
    	right: -200px;
   		top: 38px;
    	bottom: auto;
    	background: linear-gradient(to right, #1d7ccb 30%, #1951b8 100%);
   		border: 1px solid #1951b8;
  
	}
        
        
        
/*    new tooltips      */
        
      
/*    new tooltips      */
        
    
	
	#treechart
	{
		display:block;
		background-color:#ffff;
    	overflow: auto;
    	
    	
	}

        
#loader {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #3498db;
  width: 40px;
  height: 40px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  display:none;
  position:absolute;
}

        
        /* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
        
        
    </style>
		
    <div class="panel">
    <header class="panel-heading">
		<div class="panel-actions"></div>
		<h3 class="panel-title">Your Partners Tree</h3>
	</header>
    <div id="treechart" class="panel"></div>
    <div id="tooltip"></div>
    <div id="loader" ></div>
    <script src="d3.v3.min.js"></script>
    <script>
// ************** Generate the tree diagram	 *****************
function initial()
{
	treeData;
	margin = {top: 30, right: 100, bottom: 80, left: 200},
	width = 800 - margin.right - margin.left,
	height = 700 - margin.top - margin.bottom;
	
	i = 0;
	duration = 750;

	tree = d3.layout.tree()
		.size([height, width]);

	diagonal = d3.svg.diagonal()
		.projection(function(d) { return [d.y, d.x]; });

	svg = d3.select("#treechart").append("svg")
		.attr("width", width + margin.right + margin.left)
		.attr("height", height + margin.top + margin.bottom)
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	d3.select(self.frameElement).style("height", "800px");
	root = treeData[0];
	root.x0 = height / 2;
	root.y0 = 0;
	update(root);
}
     
window.addEventListener("load", function(){
   getData(document.getElementById('userid').innerHTML.trim(),0); 
});   

function getData(_id,onlyone)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200)
		{
			console.clear();
			console.log(this.responseText);
			treeData = JSON.parse(this.responseText);      	
    		var ele2 = document.getElementById('loader');
			ele2.style.display = "none";        
        	document.getElementById('treechart').innerHTML ="";
			var ele = document.getElementById('tooltip');
			ele.innerHTML = "";
			ele.style.display = "none";
			initial();
		}
	};
	xhttp.open("POST", <?php echo '"' . SITE_URL . 'dashboard/d3chart.php"'; ?>, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id=" + _id + "&onlyone="+onlyone);
}


function update(source) {
	
  // Compute the new tree layout.
  var nodes = tree.nodes(root).reverse(),
	  links = tree.links(nodes);
	  links = tree.links(nodes);

  // Normalize for fixed-depth.
  nodes.forEach(function(d) { d.y = d.depth * 110; });

  // Update the nodes…
  var node = svg.selectAll("g.node")
	  .data(nodes, function(d) { return d.id || (d.id = ++i); });

  // Enter any new nodes at the parent's previous position.
  var nodeEnter = node.enter().append("g")
	  .attr("class", "node")
	  .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
	  .on("click", click)
	  .on("mouseover", mouseover)
	  .on("mouseleave", mouseleave);

  nodeEnter.append("circle")
	  .attr("r", 1e-6)
	  .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; })


            nodeEnter.append('text').attr("dy", ".35em").attr("x", function(d) {
                return d.children || d._children ? -15 : -15;
            }).attr("text-anchor", function(d) {
                return d.children || d._children ? "end" : "end";
            }).text(function(d) {
                return "ID:" + d.name;
            });
            nodeEnter.append('text').attr("dy", ".35em").attr("x", function(d) {
                return -5;
            }).text(function(d) {
                return d.level;
            });



  // Transition nodes to their new position.
  var nodeUpdate = node.transition()
	  .duration(duration)
	  .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

  nodeUpdate.select("circle")
	  .attr("r", 8)
	  .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

  nodeUpdate.select("text")
	  .style("fill-opacity", 1);

  // Transition exiting nodes to the parent's new position.
  var nodeExit = node.exit().transition()
	  .duration(duration)
	  .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
	  .remove();

  nodeExit.select("circle")
	  .attr("r", 1e-6);

  nodeExit.select("text")
	  .style("fill-opacity", 1e-6);

  // Update the links…
  var link = svg.selectAll("path.link")
	  .data(links, function(d) { return d.target.id; });

  // Enter any new links at the parent's previous position.
  link.enter().insert("path", "g")
	  .attr("class", "link")
	  .attr("d", function(d) {
		var o = {x: source.x0, y: source.y0};
		return diagonal({source: o, target: o});
	  });

  // Transition links to their new position.
  link.transition()
	  .duration(duration)
	  .attr("d", diagonal);

  // Transition exiting nodes to the parent's new position.
  link.exit().transition()
	  .duration(duration)
	  .attr("d", function(d) {
		var o = {x: source.x, y: source.y};
		return diagonal({source: o, target: o});
	  })
	  .remove();

  // Stash the old positions for transition.
  nodes.forEach(function(d) {
	d.x0 = d.x;
	d.y0 = d.y;
  });

}

// Toggle children on click.
function click(d) {

	var usrid = document.getElementById('userid').innerHTML.trim();
  	if(((d.children == undefined && d._children == undefined) || treeData[0].name == d.name )  && d.name > usrid)
	{
    	if(treeData[0].name == d.name)
        {
			getData(usrid,0);        	
        }
    	else
        {
			getData(d.name,0);   
        }
    	showLoader(); 
    }
	else
	{
		if (d.children) {
			d._children = d.children;
			d.children = null;
		} else {
			d.children = d._children;
			d._children = null;
		}
		update(d);			
	}

}

    function showLoader()
    {
    	var ele2 = document.getElementById('loader')
		ele2.style.top =(event.pageY - 50)+"%"
		ele2.style.left =(event.pageX - 50)+"%"
		ele2.style.display = "block"
    }

  // Three function that change the tooltip when user hover / move / leave a cell
  function mouseover(d)  
  {
	var ele = document.getElementById('tooltip')
    var elem = document.getElementById('treechart')
    var rect = elem.getBoundingClientRect();
    var position = {
       top: rect.top + window.pageYOffset,
       left: rect.left + window.pageXOffset
    };    
	ele.innerHTML = levelTxt(d.detail,d.name)
	ele.style.top =(event.pageY - position.top + elem.offsetTop - 30)+"px"
	ele.style.left =(event.pageX - position.left + elem.offsetLeft + 30)+"px"
	ele.style.display = "block"

  }


  // Three function that change the tooltip when user hover / move / leave a cell
  function mouseleave(d) 
  {
	var ele = document.getElementById('tooltip')
	ele.innerHTML = ""
	ele.style.display = "None"
  }

	var process = new Array(5);
    
	function levelTxt(lvl,id)
	{
		var outTxt = '<div id="popupData" style="text-align:center;"> ID : ' + id + '</div>'
		outTxt += '<div style="text-align:center; margin-top:10px;"> <table>'
    	resetProcess()
		for(var j=lvl.length;j>0;j--)
		{
			var lvlNo = parseInt(lvl[j-1]['level']);
        	if(process[ lvlNo - 1 ] == 0)
            {
				var d = new Date();
        		var n = parseInt(lvl[j-1]['days']) + 15552000;
        		n = n -  ((d.getTime()/1000).toFixed(0));
				n =(n / 86400).toFixed(0);
				outTxt += '<tr><td>Lvl &nbsp; '+ lvlNo + '&nbsp; : &nbsp; </td><td>  ' + n + ' &nbsp; d</td></tr>'
            	process[ lvlNo - 1 ] = 1;
            }
		}
		return outTxt + '</table></div>'
	} 
    
    function resetProcess()
    {
    	for(i=0;i<10;i++)
        {
        	process[i] = 0;
        }
    }
    
    // ************** Generate the tree diagram	END *****************
    </script>
    </div>		
		
		
	<div class="panel">
	<header class="panel-heading">
		<div class="panel-actions"></div>
		<h3 class="panel-title"><?=$$lang['Your Downline Partners']; ?></h3>
	</header>
<div class="panel-body">
	<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
			<div class="row">
				<div class="col-sm-12 table-responsive">
					<table class="table table-hover dataTable table-striped w-full dtr-inline" data-plugin="dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 1014px;">
						<thead>
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 73.992px;" aria-label="Salary: activate to sort column ascending">User ID</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 211.992px;" aria-label="Position: activate to sort column ascending">Level</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 184.992px;" aria-label="Office: activate to sort column ascending">Wallet Address</th>
								<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 211.992px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Date Joined</th>

												
							</tr>
						</thead>
						<tbody>



<?php

function fetchDownlines_1($userID, $conn, $level=0){

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





//Toal partners - all levels

$mainArray_1 = array();
$level1Array_1 = array();

//level 1 referrals
$tempArray2_2 = fetchDownlines_1($userID, $conn, 1);

if(count($tempArray2_2) > 0){
	$mainArray_1 = array_merge($mainArray_1, $tempArray2_2);
	$level1Array_1 = $tempArray2_2;

		//These are level 1 refs
		foreach ($tempArray2_2 as $key) {

			//level 2 referrals
			$tempArray2_2 = fetchDownlines_1($key, $conn, 2);

			if(count($tempArray2_2) > 0){

				$mainArray_1 = array_merge($mainArray_1, $tempArray2_2);
				//These are level 2 refs
				foreach ($tempArray2_2 as $key) {

					//level 2 referrals
					$tempArray2_2 = fetchDownlines_1($key, $conn, 3);

					//level 3 referrals
					if(count($tempArray2_2) > 0){
						
						$mainArray_1 = array_merge($mainArray_1, $tempArray2_2);

							//level 4
							foreach ($tempArray2_2 as $key) {

								$tempArray2_2 = fetchDownlines_1($key, $conn, 4);
								
								//level 4 referrals
								if(count($tempArray2_2) > 0){
									
									$mainArray_1 = array_merge($mainArray_1, $tempArray2_2);


										//level 5
										foreach ($tempArray2_2 as $key) {

										$tempArray2_2 = fetchDownlines_1($key, $conn, 5);
										
										//level 5 referrals
										if(count($tempArray2_2) > 0){
											
											$mainArray_1 = array_merge($mainArray_1, $tempArray2_2);



//level 6
foreach ($tempArray2_2 as $key) {

$tempArray2_2 = fetchDownlines_1($key, $conn, 6);

//level 6 referrals
if(count($tempArray2_2) > 0){
	
	$mainArray_1 = array_merge($mainArray_1, $tempArray2_2);

	//level 7
	foreach ($tempArray2_2 as $key) {

	$tempArray2_2 = fetchDownlines_1($key, $conn, 7);

	//level 7 referrals
	if(count($tempArray2_2) > 0){
		
		$mainArray_1 = array_merge($mainArray_1, $tempArray2_2);


		//level 8
		foreach ($tempArray2_2 as $key) {

		$tempArray2_2 = fetchDownlines_1($key, $conn, 8);

		//level 8 referrals
		if(count($tempArray2_2) > 0){
			
			$mainArray_1 = array_merge($mainArray_1, $tempArray2_2);


			//level 9
			foreach ($tempArray2_2 as $key) {

			$tempArray2_2 = fetchDownlines_1($key, $conn, 9);

			//level 9 referrals
			if(count($tempArray2_2) > 0){
				
				$mainArray_1 = array_merge($mainArray_1, $tempArray2_2);


				//level 10
				foreach ($tempArray2_2 as $key) {

				$tempArray2_2 = fetchDownlines_1($key, $conn, 10);

				//level 10 referrals
				if(count($tempArray2_2) > 0){
					
					$mainArray_1 = array_merge($mainArray_1, $tempArray2_2);






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
$totalPartners = count($mainArray_1);
$level1Partners = count($level1Array_1);


?>




							

							
						</tbody>
					</table>
				</div>
			</div>
		
	</div>
	
	
	
		
		
	</div>
</div>





	<div class="panel">
	<header class="panel-heading">
		<div class="panel-actions"></div>
		<h3 class="panel-title"><?=$$lang['Commission Received']; ?></h3>
	</header>
	<div class="panel-body">
	<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
			<div class="row">
				<div class="col-sm-12 table-responsive">
					<table class="table table-hover dataTable table-striped w-full dtr-inline" data-plugin="dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 1014px;">
						<thead>
							<tr role="row">
								<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 211.992px;" aria-sort="ascending" aria-label="Name: activate to sort column descending"><?=$$lang['Date'];?></th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 73.992px;" aria-label="Salary: activate to sort column ascending"><?=$$lang['USER ID'];?></th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 184.992px;" aria-label="Office: activate to sort column ascending"><?=$$lang['From whom'];?></th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 211.992px;" aria-label="Position: activate to sort column ascending">ETH <?=$$lang['Received'];?></th>
								
								
							</tr>
						</thead>
						<tbody>


<?php
$query = "SELECT * FROM event_paidforlevelev where referrer='".clean($userWallet)."' ";
$result = mysqli_query($conn,$query);
$row = mysqli_num_rows($result);

if($row != NULL && $row > 0){
$row1 = $result -> fetch_all();

	foreach($row1 as $row2) {

		//find user id of this user
		$query1 = "SELECT * FROM event_reglevelev where userWallet='".$row2[1]."' ";
		$result1 = mysqli_query($conn,$query1);
		$referralID = $result1 -> fetch_assoc();



echo '
							<tr role="row" class="odd">
								<td>'.date('m/d/Y', $row2[5]).'</td>
								<td>'.$referralID['userID'].'</td>
								<td>
								<a href="'.$etherscanAddress.''.$row2[1].'" target="new"> '.$row2[1].' </a>
								</td>
								<td>'.($row2[4] / 1000000000000000000).'</td>
								
								
								
								
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


<script type="text/javascript" src="core/js/downline.copy.js">

      
</script>
<?php
include('footer.php');
?>


