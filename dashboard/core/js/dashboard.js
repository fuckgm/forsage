	
	async function buyLevel(level){

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
              var metaMaskAddress=""+result[0];

             var levelPrice = await myContract.methods.priceOfLevel(level).call({from: metaMaskAddress});


			var data = myContract.methods.buyLevel(level).encodeABI();
		        web3.eth.sendTransaction({
		        from: metaMaskAddress,
		        to: mainContractAddress,
		        data: data, // deploying a contracrt
		        value: levelPrice,
		        }).on('transactionHash',function(hash){
		        alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='<?php echo $etherscanTx;?>"+hash+"' target='_blank'> Etherscan</a>", function(){});
		      })

			



            }
          });
        } catch (error) {
            // User denied account access...
        }
    }
   
    // Non-dapp browsers...
    else {

        alert("Please login using Automatic Methods to perform this action!");
    }
}


async function pulloutFund(){

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
              var metaMaskAddress=""+result[0];

			var data = myContract.methods.withdrawMyDividendNAll().encodeABI();
		        web3.eth.sendTransaction({
		        from: metaMaskAddress,
		        to: mainContractAddress,
		        data: data, // deploying a contracrt
		        }).on('transactionHash',function(hash){
		        alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='<?php echo $etherscanTx;?>"+hash+"' target='_blank'> Etherscan</a>", function(){});
		      })
            }
          });
        } catch (error) {
            // User denied account access...
        }
    }
   
    // Non-dapp browsers...
    else {

        alert("Please login using Automatic Methods to perform this action!");
    }


}
