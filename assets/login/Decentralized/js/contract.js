const MATRIX_ADDRESS   = "0x5acc84a3e955Bdd76467d3348077d003f00fFB97";
const DEFAULT_UPLINE   = '0x81CA1e4DE24136EBcf34CA518af87F18FD39D45E';
const MATRIX_PRICE     = 0.05;
const DEFAULT_GASPRICE = 15e9;
const COOKIE_AUTH_NAME = 'auth';


window.getWeb3 = (callback, err) => {
  if(!window.ethereum && !window.web3) {
    Notice.error(
      l('notDetectedWallet')
    );
    return false;
  }

  if(!web3.eth.coinbase) {
    Notice.warning(
      l('unblockWallet')
    );
  }

  let i = 0;
  let id = setInterval(() => {
    if(i > 1800 || web3.eth.coinbase) {
      clearInterval(id);
      if(web3.eth.coinbase) {
        startApp();
        callback(window.web3, true);
      }
    } else if(++i == 1) {
      // Modern dapp browsers...
      if (window.ethereum) {
        if(ethereum.autoRefreshOnNetworkChange) {
          ethereum.autoRefreshOnNetworkChange = false;
        }
        window.web3 = new Web3(ethereum);
        try {
          // Request account access if needed
          ethereum.enable();
          startApp();
        } catch (error) {
          Notice.error(error.message);
          return false;
        }
      }
      // Legacy dapp browsers...
      else if (window.web3) {
        window.web3 = new Web3(web3.currentProvider);
        startApp();
      } 
      else {
      }
    }
  }, 100);
};

// Run app
function startApp() {
  //checking Main net 
  web3.version.getNetwork(function(err, netId){
    if(netId !== "1"){
        //net ID must be 1; Show any message
    }
    switch (netId) {
      // This is mainnet
      case "1":
        break
      // This is the deprecated Morden test network
      case "2":
        break
      // This is the ropsten test network
      case "3":
        break
      // This is the Rinkeby test network
      case "4":
        break
      // This is the Kovan test network
      case "42":
        break
      // This is an unknown network
      default:
    }
  });

  MatrixContract = web3.eth.contract(matrixAbi);
  MatrixInstance = MatrixContract.at(MATRIX_ADDRESS);

  initData();
}

function initData() {
  // Если поддерживается библиотека web3
  document.body.classList.add('web3' in window ? 'web3' : 'noweb3');
}

setTimeout(function () {
  if(!window.ethereum) {
    return false;
  }
  // Обработка события при смене кошелька
  window.ethereum.on('accountsChanged', function (accounts) {
    if(config.user.isAuthSecure) {
      // Дезавторизация при смене кошелька
      if(config.user.address && config.user.address != web3.eth.coinbase) {
        window.location = '/auth/logout/';
      }
    }
  });
  // Обработка события при смени сети
  window.ethereum.on('networkChanged', function (netId) {});
}, 1000);

// Запомнить подписанную сессию пользователя 
function rememberSession(userAddress, sessionCallback) {
  let hash = config.user.sid || 'unknown';
  signMessage(hash).then(sign => {
    $.ajax({
      url: '/ajax/auth/',
      type: 'POST',
      cache: false,
      async: true,
      dataType: 'json',
      data: {
        userAddress: userAddress,
        sign: sign,
        hash: hash
      },
      success: function (val, status) {
        if(status != 'success') {
          console.log('Unsuccessful  Ajax request: ' + jqXHR.responseText);
          Notice.warning(
            l('authError')
          );
          sessionCallback(false)
          return;
        }
        if(val.status == 'success') {
          Notice.success(val.message);
          sessionCallback(true, {
            redirect: val.params.hash ? '/?' + val.params.key + '=' + val.params.hash : '/'
          });
        } else {
          Notice.warning(val.message);
          sessionCallback(false);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log('Error Ajax request: ' + jqXHR.responseText);
        Notice.warning(
          l('authError')
        );
        sessionCallback(false);
      }
    });
  }, error => {
    Notice.warning(
      l('authError')
    );
    sessionCallback(false);
    return;
  });
  sessionCallback(false);
  return;
}

function regByGroup(partner, partnerStack) {
  $.ajax({
    url: '/ajax/regByGroup/',
    type: 'POST',
    cache: false,
    async: true,
    data: {
      partner: partner,
      partnerStack: partnerStack
    },
    success: function (val, status) {
      if(status != 'success') {
        alert('Unsuccessful  Ajax request: ' + jqXHR.responseText);
        console.log('Unsuccessful  Ajax request: ' + jqXHR.responseText);
        return;
      }
      if(val.status != 'success') {
        alert(val.message);
      }
      console.log('Group link: ', val.message)
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('Error Ajax request: ' + jqXHR.responseText);
      console.log('Error Ajax request: ' + jqXHR.responseText);
    }
  });
}

// Цифровая подпись кошелька
function signMessage(message){
  return new Promise(function(ok, fail){
    getWeb3(function(web3) {
      web3.personal.sign(web3.fromUtf8(message), web3.eth.coinbase, function(error, sign){
        if(error){
          fail(error)
        } else {
          ok(sign)
        }
      });
    });
  });
}

function getInfoByTransaction(tx, callback) {
  let defaultData = {
    block: null,
    blockNumber: 0,
    transaction: null,
    countConfirmation: 0
  };
  getWeb3(function(web3) {
    web3.eth.getBlockNumber(function (err, blockNumber) {
      if(err) {
        callback(err, defaultData);
        return false;
      }
      web3.eth.getTransaction(tx, function (err, transaction) {
        if(err) {
          callback(err, defaultData);
          return false;
        }
        if(!transaction) {
          callback(null, defaultData);
          return false;
        }
        web3.eth.getBlock(transaction.blockNumber, function (err, block) {
          if(err) {
            callback(err, defaultData);
            return false;
          }
          let countConfirmation = transaction.blockNumber === null ? 0 : blockNumber - transaction.blockNumber;
          callback(err, {
            block: block,
            blockNumber: blockNumber,
            transaction: transaction,
            countConfirmation: countConfirmation 
          });
          return true;
        });
      });
    });
  });
}

// Auto login
function autoLogin(userAddress) {
  if(config.locked.authorization) {
    alert(config.locked.authorization)
    return false;
  }
  getWeb3(function(web3) {
    MatrixInstance.isUserExists(web3.eth.coinbase, function (err, isUserExists) {
      if(err) {
        Notice.error(
          l('errorReadSmartContract') + ': ' + err
        );
        return false;
      }
      if(!isUserExists) {
        userAddress(isUserExists, web3.eth.coinbase);
        return false;
      }
      rememberSession(web3.eth.coinbase, function (err, result) {
        // Иначе выводим ошибку авторизации
        if(!err) {
          return false;
        }
        if(result.redirect) {
          setTimeout(function () {
              window.location.href = result.redirect;
          }, 2500);
        }
      });
      userAddress(isUserExists, web3.eth.coinbase);
      return true;
    });
  });
  return false;
};

// Registration
function registrationUser(data, response) {
  if(config.locked.registration) {
    alert(config.locked.registration)
    return false;
  }
  getWeb3(function(web3) {
    if(typeof MatrixInstance == 'undefined') {
      Notice.error(
        l('notActiveWallet')
      );
      return false;
    }
    var upline = data.upline || data.uplineDefault || '';

    web3.eth.getGasPrice(function (err, result) {
      if(err) {
        Notice.error(err.message);
        return false;
      }
      
      var registration = function (uplineAddress) {
        MatrixInstance.registrationExt(
          uplineAddress,
          {
            value: web3.toWei(MATRIX_PRICE),
            gasPrice: !err ? parseInt(result.toFixed()) + 3e9 : DEFAULT_GASPRICE
          },
          function (err, tx) {
            if(err) {
              Notice.warning(
                l('errorSendingTransaction') + err.message
              );
              return false;
            }
            Notice.success(
              l('transactionSend')
            );
            setCookie(COOKIE_AUTH_NAME, web3.eth.coinbase);
            if(data.ug != '') {
              regByGroup(data.upline, data.ug);
            }
            response(false, uplineAddress, {
              tx: tx
            });
          }
        );
        Notice.error(
          l('confirmTransaction')
        );
      };

      if(upline.match(/^[0-9]+$/)) {
        MatrixInstance.userIds(upline, {}, function(err, res) {
          if(err) {
            Notice.error(
              l('errorReadSmartContract') + ': ' + err
            );
            return false;
          }
          if(res && res != '0x0000000000000000000000000000000000000000') {
            registration(res);
          }
          else {
            Notice.error(
              l('uplineNotRegistered')
            );
            response(true)
          }
        });
      }
      else if(upline.match(/^0x[a-f0-9]{40}$/i)) {
        registration(upline);
      }
      else {
        registration(DEFAULT_UPLINE);
      }
    });
    return false;
  });
  return false;
};

// Buy level
function buyLevel(matrix, level, price) {
  if(config.locked.buyLevel) {
    alert(config.locked.buyLevel);
    return false;
  }
  getWeb3(function(web3) {
    web3.eth.getGasPrice(function (err, result) {
      if(typeof MatrixInstance == 'undefined') {
        Notice.error(
          l('notActiveWallet')
        );
        return false;
      }
      MatrixInstance.buyNewLevel(matrix, level, {
          value: web3.toWei(price),
          gasPrice: !err ? parseInt(result.toFixed()) + 3e9 : DEFAULT_GASPRICE
        }, function(err, tx) {
        if(err) {
          return Notice.warning(
            l('errorSendingTransaction') + err.message
          );
        }
        Notice.success(
          l('transactionSend')
        );
      });
      Notice.warning(
        l('confirmTransaction')
      );
    });
  });
};

function getActiveX3Levels(userAddress) {
  MatrixInstance.getActiveX3Levels(userAddress, function (err, result) {
    if(!err) {
      return result
    } else {
      return err
    }
  })
}

function getActiveX6Levels(userAddress) {
  MatrixInstance.getActiveX3Levels(userAddress, function (err, result) {
    if(!err) {
      return result
    } else {
      return err
    }
  })
}

function getX3Matrix(userAddress, level) {
  MatrixInstance.usersX3Matrix(userAddress, level, function (err, result) {
    if(!err) {
      return result
    } else {
      return err
    }
  })
}

function getX6Matrix(userAddress, level) {
  MatrixInstance.usersX6Matrix(userAddress, level, function (err, result) {
    if(!err) {
      return result
    } else {
      return err
    }
  })
}

var matrixAbi = [
  {
    "constant": true,
    "inputs": [
      {
        "name": "",
        "type": "address"
      }
    ],
    "name": "balances",
    "outputs": [
      {
        "name": "",
        "type": "uint256"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [],
    "name": "lastUserId",
    "outputs": [
      {
        "name": "",
        "type": "uint256"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "",
        "type": "uint256"
      }
    ],
    "name": "userIds",
    "outputs": [
      {
        "name": "",
        "type": "address"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [],
    "name": "owner",
    "outputs": [
      {
        "name": "",
        "type": "address"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "",
        "type": "address"
      }
    ],
    "name": "users",
    "outputs": [
      {
        "name": "id",
        "type": "uint256"
      },
      {
        "name": "referrer",
        "type": "address"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "",
        "type": "uint8"
      }
    ],
    "name": "levelPrice",
    "outputs": [
      {
        "name": "",
        "type": "uint256"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [
      {
        "name": "ownerAddress",
        "type": "address"
      }
    ],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "constructor"
  },
  {
    "payable": true,
    "stateMutability": "payable",
    "type": "fallback"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "name": "user",
        "type": "address"
      },
      {
        "indexed": false,
        "name": "referrer",
        "type": "address"
      }
    ],
    "name": "Registration",
    "type": "event"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "name": "user",
        "type": "address"
      },
      {
        "indexed": true,
        "name": "currentReferrer",
        "type": "address"
      },
      {
        "indexed": false,
        "name": "matrix",
        "type": "uint8"
      },
      {
        "indexed": false,
        "name": "level",
        "type": "uint8"
      }
    ],
    "name": "Reinvest",
    "type": "event"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "name": "user",
        "type": "address"
      },
      {
        "indexed": true,
        "name": "referrer",
        "type": "address"
      },
      {
        "indexed": false,
        "name": "matrix",
        "type": "uint8"
      },
      {
        "indexed": false,
        "name": "level",
        "type": "uint8"
      }
    ],
    "name": "Upgrade",
    "type": "event"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "name": "user",
        "type": "address"
      },
      {
        "indexed": true,
        "name": "referrer",
        "type": "address"
      },
      {
        "indexed": false,
        "name": "matrix",
        "type": "uint8"
      },
      {
        "indexed": false,
        "name": "level",
        "type": "uint8"
      },
      {
        "indexed": false,
        "name": "place",
        "type": "uint8"
      }
    ],
    "name": "NewUserPlace",
    "type": "event"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "name": "user",
        "type": "address"
      },
      {
        "indexed": true,
        "name": "referrer",
        "type": "address"
      },
      {
        "indexed": false,
        "name": "value",
        "type": "uint256"
      }
    ],
    "name": "MoneyHolded",
    "type": "event"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "name": "user",
        "type": "address"
      },
      {
        "indexed": true,
        "name": "referrer",
        "type": "address"
      },
      {
        "indexed": false,
        "name": "value",
        "type": "uint256"
      }
    ],
    "name": "MoneyUnholded",
    "type": "event"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "name": "user",
        "type": "address"
      },
      {
        "indexed": false,
        "name": "matrix",
        "type": "uint8"
      },
      {
        "indexed": false,
        "name": "level",
        "type": "uint8"
      }
    ],
    "name": "MatixClosed",
    "type": "event"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "name": "user",
        "type": "address"
      },
      {
        "indexed": false,
        "name": "money",
        "type": "uint256"
      }
    ],
    "name": "CannotSendMoney",
    "type": "event"
  },
  {
    "constant": false,
    "inputs": [
      {
        "name": "referrerAddress",
        "type": "address"
      }
    ],
    "name": "registrationExt",
    "outputs": [],
    "payable": true,
    "stateMutability": "payable",
    "type": "function"
  },
  {
    "constant": false,
    "inputs": [
      {
        "name": "matrix",
        "type": "uint8"
      },
      {
        "name": "level",
        "type": "uint8"
      }
    ],
    "name": "buyNewLevel",
    "outputs": [],
    "payable": true,
    "stateMutability": "payable",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "userAddress",
        "type": "address"
      },
      {
        "name": "level",
        "type": "uint8"
      }
    ],
    "name": "findFreeX3Referrer",
    "outputs": [
      {
        "name": "",
        "type": "address"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "userAddress",
        "type": "address"
      },
      {
        "name": "level",
        "type": "uint8"
      }
    ],
    "name": "findFreeX6Referrer",
    "outputs": [
      {
        "name": "",
        "type": "address"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "userAddress",
        "type": "address"
      },
      {
        "name": "level",
        "type": "uint8"
      }
    ],
    "name": "usersActiveX3Levels",
    "outputs": [
      {
        "name": "",
        "type": "bool"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "userAddress",
        "type": "address"
      },
      {
        "name": "level",
        "type": "uint8"
      }
    ],
    "name": "usersActiveX6Levels",
    "outputs": [
      {
        "name": "",
        "type": "bool"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "userAddress",
        "type": "address"
      },
      {
        "name": "level",
        "type": "uint8"
      }
    ],
    "name": "usersX3Matrix",
    "outputs": [
      {
        "name": "",
        "type": "address"
      },
      {
        "name": "",
        "type": "address[]"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "userAddress",
        "type": "address"
      },
      {
        "name": "level",
        "type": "uint8"
      }
    ],
    "name": "usersX6Matrix",
    "outputs": [
      {
        "name": "",
        "type": "address"
      },
      {
        "name": "",
        "type": "address[]"
      },
      {
        "name": "",
        "type": "address[]"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "user",
        "type": "address"
      }
    ],
    "name": "isUserExists",
    "outputs": [
      {
        "name": "",
        "type": "bool"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "userAddress",
        "type": "address"
      }
    ],
    "name": "getActiveX3Levels",
    "outputs": [
      {
        "name": "res",
        "type": "bool[12]"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "userAddress",
        "type": "address"
      }
    ],
    "name": "getActiveX6Levels",
    "outputs": [
      {
        "name": "res",
        "type": "bool[12]"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  }
];
