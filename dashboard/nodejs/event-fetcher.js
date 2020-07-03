#!/usr/bin/env nodejs
var http = require('http');
const Web3 = require('web3');
const fs = require('fs');

http.createServer(async function (req, res) {
  res.writeHead(200, {'Content-Type': 'text/plain'});
  
//===========================================================
//=====================  CONFIGURATION  =====================
//===========================================================

const web3 = new Web3(Web3.givenProvider || "https://rinkeby.infura.io/v3/6f8dc3b58cd345cd9a6589821d2c131c");
var myAccountAddress = "0x90309140fe9B02d20BC2601960dfA837D6e06D19";
const mainContractAddress = "0xbf1F20535EBA1257e838014742BA045d0AF0fD94";
const arrayABI = JSON.parse(fs.readFileSync('abi.txt', 'utf8'));
var myContract = new web3.eth.Contract(arrayABI, mainContractAddress, {
    from: myAccountAddress, // default from address
    });

var currentBlock = await web3.eth.getBlockNumber();

var fromBlock = currentBlock - 10000;	//last 10000 blocks will be synced


myContract.getPastEvents('allEvents', {
    fromBlock: fromBlock,
    toBlock: 'latest'
}, function(error, events){
	//res.end("");
	})
.then(function(events){
	res.end(JSON.stringify(events));
	


});


  
}).listen(8080, 'localhost');
console.log('Server running at http://localhost:8080/');








