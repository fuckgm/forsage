-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 19, 2020 at 03:07 AM
-- Server version: 5.5.64-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ethermoney1`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminsetting`
--

CREATE TABLE `adminsetting` (
  `id` int(11) NOT NULL,
  `mainContractAddress` varchar(50) NOT NULL,
  `testnetContractAddress` varchar(255) NOT NULL,
  `mainContractABI` text NOT NULL,
  `ethPiceInUsd` float NOT NULL,
  `gasPriceFast` float NOT NULL,
  `gasPriceAverage` float NOT NULL,
  `project_year` date DEFAULT NULL,
  `ethPiceInBtc` float NOT NULL,
  `siteName` varchar(255) NOT NULL,
  `siteURL` varchar(255) NOT NULL,
  `etherscanAddressMain` varchar(255) NOT NULL,
  `etherscanAddressTestnet` varchar(255) NOT NULL,
  `etherscanTxMain` varchar(255) NOT NULL,
  `etherscanTxTestnet` varchar(255) NOT NULL,
  `infuraAPIMainnet` varchar(255) NOT NULL,
  `infuraAPITestnet` varchar(255) NOT NULL,
  `network` int(255) NOT NULL DEFAULT '0' COMMENT '1=mainnet; 0=testnet',
  `etherscanAPIurlTestnet` varchar(255) NOT NULL,
  `etherscanAPIurlMainnet` varchar(255) NOT NULL,
  `defaultLanguage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminsetting`
--

INSERT INTO `adminsetting` (`id`, `mainContractAddress`, `testnetContractAddress`, `mainContractABI`, `ethPiceInUsd`, `gasPriceFast`, `gasPriceAverage`, `project_year`, `ethPiceInBtc`, `siteName`, `siteURL`, `etherscanAddressMain`, `etherscanAddressTestnet`, `etherscanTxMain`, `etherscanTxTestnet`, `infuraAPIMainnet`, `infuraAPITestnet`, `network`, `etherscanAPIurlTestnet`, `etherscanAPIurlMainnet`, `defaultLanguage`) VALUES
(1, '0xbf1F20535EBA1257e838014742BA045d0AF0fD94', '0x72027c811d6bdff80a5d846d3d0ab2a017e05254', '[\r\n	{\r\n		\"constant\": false,\r\n		\"inputs\": [],\r\n		\"name\": \"acceptOwnership\",\r\n		\"outputs\": [],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"nonpayable\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": false,\r\n		\"inputs\": [\r\n			{\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_level\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"name\": \"buyLevel\",\r\n		\"outputs\": [],\r\n		\"payable\": true,\r\n		\"stateMutability\": \"payable\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"inputs\": [],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"nonpayable\",\r\n		\"type\": \"constructor\"\r\n	},\r\n	{\r\n		\"anonymous\": false,\r\n		\"inputs\": [\r\n			{\r\n				\"indexed\": true,\r\n				\"internalType\": \"address\",\r\n				\"name\": \"previousOwner\",\r\n				\"type\": \"address\"\r\n			},\r\n			{\r\n				\"indexed\": true,\r\n				\"internalType\": \"address\",\r\n				\"name\": \"newOwner\",\r\n				\"type\": \"address\"\r\n			}\r\n		],\r\n		\"name\": \"OwnershipTransferredEv\",\r\n		\"type\": \"event\"\r\n	},\r\n	{\r\n		\"anonymous\": false,\r\n		\"inputs\": [\r\n			{\r\n				\"indexed\": true,\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_user\",\r\n				\"type\": \"address\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_level\",\r\n				\"type\": \"uint256\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_amount\",\r\n				\"type\": \"uint256\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_time\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"name\": \"levelBuyEv\",\r\n		\"type\": \"event\"\r\n	},\r\n	{\r\n		\"anonymous\": false,\r\n		\"inputs\": [\r\n			{\r\n				\"indexed\": true,\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_user\",\r\n				\"type\": \"address\"\r\n			},\r\n			{\r\n				\"indexed\": true,\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_referral\",\r\n				\"type\": \"address\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_level\",\r\n				\"type\": \"uint256\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_amount\",\r\n				\"type\": \"uint256\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_time\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"name\": \"lostForLevelEv\",\r\n		\"type\": \"event\"\r\n	},\r\n	{\r\n		\"anonymous\": false,\r\n		\"inputs\": [\r\n			{\r\n				\"indexed\": true,\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_user\",\r\n				\"type\": \"address\"\r\n			},\r\n			{\r\n				\"indexed\": true,\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_referral\",\r\n				\"type\": \"address\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_level\",\r\n				\"type\": \"uint256\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_amount\",\r\n				\"type\": \"uint256\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_time\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"name\": \"paidForLevelEv\",\r\n		\"type\": \"event\"\r\n	},\r\n	{\r\n		\"anonymous\": false,\r\n		\"inputs\": [\r\n			{\r\n				\"indexed\": true,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_userID\",\r\n				\"type\": \"uint256\"\r\n			},\r\n			{\r\n				\"indexed\": true,\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_userWallet\",\r\n				\"type\": \"address\"\r\n			},\r\n			{\r\n				\"indexed\": true,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_referrerID\",\r\n				\"type\": \"uint256\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_refererWallet\",\r\n				\"type\": \"address\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_originalReferrer\",\r\n				\"type\": \"uint256\"\r\n			},\r\n			{\r\n				\"indexed\": false,\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_time\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"name\": \"regLevelEv\",\r\n		\"type\": \"event\"\r\n	},\r\n	{\r\n		\"constant\": false,\r\n		\"inputs\": [\r\n			{\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_referrerID\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"name\": \"regUser\",\r\n		\"outputs\": [],\r\n		\"payable\": true,\r\n		\"stateMutability\": \"payable\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": false,\r\n		\"inputs\": [\r\n			{\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_newOwner\",\r\n				\"type\": \"address\"\r\n			}\r\n		],\r\n		\"name\": \"transferOwnership\",\r\n		\"outputs\": [],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"nonpayable\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"payable\": true,\r\n		\"stateMutability\": \"payable\",\r\n		\"type\": \"fallback\"\r\n	},\r\n	{\r\n		\"constant\": true,\r\n		\"inputs\": [\r\n			{\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_user\",\r\n				\"type\": \"address\"\r\n			}\r\n		],\r\n		\"name\": \"findFreeReferrer\",\r\n		\"outputs\": [\r\n			{\r\n				\"internalType\": \"address\",\r\n				\"name\": \"\",\r\n				\"type\": \"address\"\r\n			}\r\n		],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"view\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": true,\r\n		\"inputs\": [],\r\n		\"name\": \"lastIDCount\",\r\n		\"outputs\": [\r\n			{\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"view\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": true,\r\n		\"inputs\": [],\r\n		\"name\": \"newOwner\",\r\n		\"outputs\": [\r\n			{\r\n				\"internalType\": \"address\",\r\n				\"name\": \"\",\r\n				\"type\": \"address\"\r\n			}\r\n		],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"view\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": true,\r\n		\"inputs\": [],\r\n		\"name\": \"ownerWallet\",\r\n		\"outputs\": [\r\n			{\r\n				\"internalType\": \"address\",\r\n				\"name\": \"\",\r\n				\"type\": \"address\"\r\n			}\r\n		],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"view\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": true,\r\n		\"inputs\": [\r\n			{\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"name\": \"priceOfLevel\",\r\n		\"outputs\": [\r\n			{\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"view\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": true,\r\n		\"inputs\": [\r\n			{\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"name\": \"userAddressByID\",\r\n		\"outputs\": [\r\n			{\r\n				\"internalType\": \"address\",\r\n				\"name\": \"\",\r\n				\"type\": \"address\"\r\n			}\r\n		],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"view\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": true,\r\n		\"inputs\": [\r\n			{\r\n				\"internalType\": \"address\",\r\n				\"name\": \"\",\r\n				\"type\": \"address\"\r\n			}\r\n		],\r\n		\"name\": \"userInfos\",\r\n		\"outputs\": [\r\n			{\r\n				\"internalType\": \"bool\",\r\n				\"name\": \"joined\",\r\n				\"type\": \"bool\"\r\n			},\r\n			{\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"id\",\r\n				\"type\": \"uint256\"\r\n			},\r\n			{\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"referrerID\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"view\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": true,\r\n		\"inputs\": [\r\n			{\r\n				\"internalType\": \"address\",\r\n				\"name\": \"usr\",\r\n				\"type\": \"address\"\r\n			}\r\n		],\r\n		\"name\": \"viewTimestampSinceJoined\",\r\n		\"outputs\": [\r\n			{\r\n				\"internalType\": \"uint256[10]\",\r\n				\"name\": \"timeSinceJoined\",\r\n				\"type\": \"uint256[10]\"\r\n			}\r\n		],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"view\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": true,\r\n		\"inputs\": [\r\n			{\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_user\",\r\n				\"type\": \"address\"\r\n			},\r\n			{\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"_level\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"name\": \"viewUserLevelExpired\",\r\n		\"outputs\": [\r\n			{\r\n				\"internalType\": \"uint256\",\r\n				\"name\": \"\",\r\n				\"type\": \"uint256\"\r\n			}\r\n		],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"view\",\r\n		\"type\": \"function\"\r\n	},\r\n	{\r\n		\"constant\": true,\r\n		\"inputs\": [\r\n			{\r\n				\"internalType\": \"address\",\r\n				\"name\": \"_user\",\r\n				\"type\": \"address\"\r\n			}\r\n		],\r\n		\"name\": \"viewUserReferral\",\r\n		\"outputs\": [\r\n			{\r\n				\"internalType\": \"address[]\",\r\n				\"name\": \"\",\r\n				\"type\": \"address[]\"\r\n			}\r\n		],\r\n		\"payable\": false,\r\n		\"stateMutability\": \"view\",\r\n		\"type\": \"function\"\r\n	}\r\n]', 230.55, 43, 36, '2020-05-20', 0.022, 'EtherMoney', 'http://localhost/forsage/', 'http://localhost/forsage/address/', 'https://rinkeby.etherscan.io/address/', 'http://localhost/forsage/tx/', 'https://rinkeby.etherscan.io/tx/', 'https://mainnet.infura.io/v3/6f8dc3b58cd345cd9a6589821d2c131c', 'https://rinkeby.infura.io/v3/6f8dc3b58cd345cd9a6589821d2c131c', 0, 'https://api-rinkeby.etherscan.io', 'https://api.etherscan.io','en');

-- --------------------------------------------------------

--
-- Table structure for table `event_blocks_synced`
--

CREATE TABLE `event_blocks_synced` (
  `id` int(11) NOT NULL,
  `blockNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_blocks_synced`
--

INSERT INTO `event_blocks_synced` (`id`, `blockNumber`) VALUES
(1, 6629394),
(2, 6629394),
(3, 6629394),
(4, 6629394),
(5, 6629394),
(6, 6629394),
(7, 6629394),
(8, 6629394),
(9, 6629394),
(10, 6629394),
(11, 6629394),
(12, 6629394),
(13, 6629394),
(14, 6629394),
(15, 6634069),
(16, 6634069),
(17, 6634069),
(18, 6634082),
(19, 6634082),
(20, 6634082),
(21, 6636023),
(22, 6636023),
(23, 6636023),
(24, 6636101),
(25, 6636101),
(26, 6636101),
(27, 6640588),
(28, 6640588),
(29, 6640588),
(30, 6640637),
(31, 6640637),
(32, 6640637),
(33, 6640974),
(34, 6640974),
(35, 6640974),
(36, 6641075),
(37, 6641075),
(38, 6641075),
(39, 6641220),
(40, 6641220),
(41, 6641220),
(42, 6641271),
(43, 6641271),
(44, 6641317),
(45, 6641317),
(46, 6641317),
(47, 6646495),
(48, 6646495),
(49, 6646495),
(50, 6646533),
(51, 6646533),
(52, 6646533),
(53, 6646727),
(54, 6646727),
(55, 6646798),
(56, 6646798),
(57, 6646798),
(58, 6646999),
(59, 6646999),
(60, 6646999),
(61, 6647128),
(62, 6647128),
(63, 6647128),
(64, 6647180),
(65, 6647180),
(66, 6647210),
(67, 6647210),
(68, 6647210),
(69, 6652216),
(70, 6652216),
(71, 6652216),
(72, 6652746),
(73, 6652746),
(74, 6652746),
(75, 6653253),
(76, 6653253),
(77, 6653253),
(78, 6658399),
(79, 6658399),
(80, 6659298),
(81, 6659298),
(82, 6659418),
(83, 6659418),
(84, 6659472),
(85, 6659472),
(86, 6659838),
(87, 6659838),
(88, 6659838),
(89, 6660057),
(90, 6660057),
(91, 6660057),
(92, 6669695),
(93, 6669695),
(94, 6669695),
(95, 6669852),
(96, 6669852),
(97, 6670416),
(98, 6670416),
(99, 6670476),
(100, 6670476),
(101, 6670477),
(102, 6670477),
(103, 6670607),
(104, 6670607),
(105, 6670644),
(106, 6670644),
(107, 6670653),
(108, 6670653),
(109, 6670681),
(110, 6670681),
(111, 6670725),
(112, 6670725),
(113, 6670726),
(114, 6670726),
(115, 6670759),
(116, 6670759),
(117, 6670845),
(118, 6670845),
(119, 6670854),
(120, 6670854),
(121, 6670902),
(122, 6670902),
(123, 6670902),
(124, 6670904),
(125, 6670904),
(126, 6671034),
(127, 6671034),
(128, 6671059),
(129, 6671059),
(130, 6671071),
(131, 6671071),
(132, 6671105),
(133, 6671105),
(134, 6681494),
(135, 6681494),
(136, 6681494),
(137, 6681543),
(138, 6681543),
(139, 6681708),
(140, 6681708),
(141, 6688624),
(142, 6688624),
(143, 6688698),
(144, 6688698),
(145, 6688703),
(146, 6688703),
(147, 6689462),
(148, 6689462),
(149, 6689609),
(150, 6689609),
(151, 6692799),
(152, 6692799),
(153, 6692799),
(154, 6692831),
(155, 6692831),
(156, 6692837),
(157, 6692837),
(158, 6692837),
(159, 6692837),
(160, 6693068),
(161, 6693068),
(162, 6693068),
(163, 6693068),
(164, 6693068),
(165, 6693068),
(166, 6693081),
(167, 6693081);

-- --------------------------------------------------------

--
-- Table structure for table `event_levelbuyev`
--

CREATE TABLE `event_levelbuyev` (
  `id` int(11) NOT NULL,
  `buyer` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `amount` varchar(300) NOT NULL,
  `timestamp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_levelbuyev`
--

INSERT INTO `event_levelbuyev` (`id`, `buyer`, `level`, `amount`, `timestamp`) VALUES
(1, '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 1, '60000000000000000', 1591596380),
(2, '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 2, '100000000000000000', 1591596380),
(3, '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1591596380),
(4, '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 4, '1500000000000000000', 1591596380),
(5, '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 5, '2000000000000000000', 1591596380),
(6, '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 6, '5000000000000000000', 1591596380),
(7, '0x90309140fe9b02d20bc2601960dfa837d6e06d19', 1, '60000000000000000', 1591666505),
(8, '0x386975d3f3c6d9df2e1ad88a3358a4cd1cdbb968', 1, '60000000000000000', 1591666700),
(9, '0x222c1890a53f6dee06aa976449f50c7bca619784', 1, '60000000000000000', 1591695815),
(10, '0xccb7cc9b34427c82ca204441dad6a797aa1929f1', 1, '60000000000000000', 1591696985),
(11, '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', 1, '60000000000000000', 1591764290),
(12, '0xec17a9ffb69b08e08af8e67f486bdae77a9ad13b', 1, '60000000000000000', 1591765025),
(13, '0xde325236c3dd71fdbf8304f6d74e9b8f4359f84c', 1, '60000000000000000', 1591770080),
(14, '0xadb1336bca299ebd2cb5a6942ecc683a085a175b', 1, '60000000000000000', 1591771595),
(15, '0x1d48ab973612a23ceb33d8294c351babd6a04925', 1, '60000000000000000', 1591773770),
(16, '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', 2, '100000000000000000', 1591774535),
(17, '0x887e60316fc48534c1773081dec32c9542d14b16', 1, '60000000000000000', 1591775225),
(18, '0x182205c74d92d345b789d978b71876dd058453fb', 1, '60000000000000000', 1591852897),
(19, '0x466af25e6fc077d4ac09d879d2b0f2894d1e763f', 1, '60000000000000000', 1591853467),
(20, '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', 3, '250000000000000000', 1591856377),
(21, '0xf0723376038b5ae42909b2d70c876b70ec5ca0a4', 1, '60000000000000000', 1591857442),
(22, '0x542ca934f4a61a87e7746118a00cf73c12fe6a57', 1, '60000000000000000', 1591860457),
(23, '0xdda01f879ef99272735733f97eb7e1eb83599263', 1, '60000000000000000', 1591862392),
(24, '0xadb1336bca299ebd2cb5a6942ecc683a085a175b', 2, '100000000000000000', 1591863172),
(25, '0x86a1677a1fce4e26eb00caa0b93b3a8c8ae29af4', 1, '60000000000000000', 1591863622),
(26, '0xf234cd09f9d011bb4f7ef715c39de60509f1d70a', 1, '60000000000000000', 1591938714),
(27, '0x9a784f73bf11b593ab9392dd440c7151065113f0', 1, '60000000000000000', 1591946664),
(28, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 1, '60000000000000000', 1591954269),
(29, '0xec17a9ffb69b08e08af8e67f486bdae77a9ad13b', 2, '100000000000000000', 1592031459),
(30, '0x887e60316fc48534c1773081dec32c9542d14b16', 2, '100000000000000000', 1592044944),
(31, '0x1d48ab973612a23ceb33d8294c351babd6a04925', 2, '100000000000000000', 1592046744),
(32, '0x86a1677a1fce4e26eb00caa0b93b3a8c8ae29af4', 2, '100000000000000000', 1592047554),
(33, '0xc014a8132f50e5c72318572a35ee5447768a087b', 1, '60000000000000000', 1592053044),
(34, '0xba6dd8a6fe13304a2715d736f4cad920b46b1fe5', 1, '60000000000000000', 1592056329),
(35, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 1, '60000000000000000', 1592200899),
(36, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 2, '100000000000000000', 1592203254),
(37, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592211714),
(38, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 1, '60000000000000000', 1592212614),
(39, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592212629),
(40, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592214579),
(41, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592215134),
(42, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592215269),
(43, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592215689),
(44, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592216349),
(45, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592216364),
(46, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592216859),
(47, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592218149),
(48, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592218284),
(49, '0x2f5c9792b4b901cdc31eb133de7b5de5af9ad281', 1, '60000000000000000', 1592219004),
(50, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592219034),
(51, '0x2f5c9792b4b901cdc31eb133de7b5de5af9ad281', 1, '60000000000000000', 1592220984),
(52, '0x2f5c9792b4b901cdc31eb133de7b5de5af9ad281', 1, '60000000000000000', 1592221359),
(53, '0x2f5c9792b4b901cdc31eb133de7b5de5af9ad281', 2, '100000000000000000', 1592221539),
(54, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 3, '250000000000000000', 1592222049),
(55, '0x515799f98b0d539aa6e99b7098935340f2807671', 1, '60000000000000000', 1592377884),
(56, '0xba6dd8a6fe13304a2715d736f4cad920b46b1fe5', 2, '100000000000000000', 1592378619),
(57, '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', 3, '250000000000000000', 1592381094),
(58, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 1, '60000000000000000', 1592484834),
(59, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 1, '60000000000000000', 1592485944),
(60, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 2, '100000000000000000', 1592486019),
(61, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 3, '250000000000000000', 1592497404),
(62, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 3, '250000000000000000', 1592499609),
(63, '0x153ae3d4721ffb7e76e78bcea361a6b183956ed9', 1, '60000000000000000', 1592547459),
(64, '0x153ae3d4721ffb7e76e78bcea361a6b183956ed9', 1, '60000000000000000', 1592547939),
(65, '0x153ae3d4721ffb7e76e78bcea361a6b183956ed9', 2, '100000000000000000', 1592548029),
(66, '0x153ae3d4721ffb7e76e78bcea361a6b183956ed9', 2, '100000000000000000', 1592548029),
(67, '0x64c7117c31772c3a72b2c0e3b730493247db86aa', 1, '60000000000000000', 1592551494),
(68, '0x64c7117c31772c3a72b2c0e3b730493247db86aa', 1, '60000000000000000', 1592551494),
(69, '0x64c7117c31772c3a72b2c0e3b730493247db86aa', 2, '100000000000000000', 1592551689);

-- --------------------------------------------------------

--
-- Table structure for table `event_lostforlevelev`
--

CREATE TABLE `event_lostforlevelev` (
  `id` int(11) NOT NULL,
  `buyer` varchar(50) NOT NULL,
  `referrer` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `amount` varchar(300) NOT NULL,
  `timestamp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_lostforlevelev`
--

INSERT INTO `event_lostforlevelev` (`id`, `buyer`, `referrer`, `level`, `amount`, `timestamp`) VALUES
(1, '0xadb1336bca299ebd2cb5a6942ecc683a085a175b', '0x90309140fe9b02d20bc2601960dfa837d6e06d19', 2, '100000000000000000', 1591863172),
(2, '0xec17a9ffb69b08e08af8e67f486bdae77a9ad13b', '0x90309140fe9b02d20bc2601960dfa837d6e06d19', 2, '100000000000000000', 1592031459),
(3, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0x386975d3f3c6d9df2e1ad88a3358a4cd1cdbb968', 2, '100000000000000000', 1592203254),
(4, '0x2f5c9792b4b901cdc31eb133de7b5de5af9ad281', '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 2, '100000000000000000', 1592221539),
(5, '0x153ae3d4721ffb7e76e78bcea361a6b183956ed9', '0xde325236c3dd71fdbf8304f6d74e9b8f4359f84c', 2, '100000000000000000', 1592548029),
(6, '0x153ae3d4721ffb7e76e78bcea361a6b183956ed9', '0xde325236c3dd71fdbf8304f6d74e9b8f4359f84c', 2, '100000000000000000', 1592548029),
(7, '0x64c7117c31772c3a72b2c0e3b730493247db86aa', '0x386975d3f3c6d9df2e1ad88a3358a4cd1cdbb968', 2, '100000000000000000', 1592551689);

-- --------------------------------------------------------

--
-- Table structure for table `event_paidforlevelev`
--

CREATE TABLE `event_paidforlevelev` (
  `id` int(11) NOT NULL,
  `buyer` varchar(50) NOT NULL,
  `referrer` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `amount` varchar(300) NOT NULL,
  `timestamp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_paidforlevelev`
--

INSERT INTO `event_paidforlevelev` (`id`, `buyer`, `referrer`, `level`, `amount`, `timestamp`) VALUES
(1, '0x0000000000000000000000000000000000000000', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 1, '60000000000000000', 1591596380),
(2, '0x0000000000000000000000000000000000000000', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 2, '100000000000000000', 1591596380),
(3, '0x0000000000000000000000000000000000000000', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1591596380),
(4, '0x0000000000000000000000000000000000000000', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 4, '1500000000000000000', 1591596380),
(5, '0x0000000000000000000000000000000000000000', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 5, '2000000000000000000', 1591596380),
(6, '0x0000000000000000000000000000000000000000', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 6, '5000000000000000000', 1591596380),
(7, '0x90309140fe9b02d20bc2601960dfa837d6e06d19', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 1, '60000000000000000', 1591666505),
(8, '0x386975d3f3c6d9df2e1ad88a3358a4cd1cdbb968', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 1, '60000000000000000', 1591666700),
(9, '0x222c1890a53f6dee06aa976449f50c7bca619784', '0x90309140fe9b02d20bc2601960dfa837d6e06d19', 1, '60000000000000000', 1591695815),
(10, '0xccb7cc9b34427c82ca204441dad6a797aa1929f1', '0x222c1890a53f6dee06aa976449f50c7bca619784', 1, '60000000000000000', 1591696985),
(11, '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', '0x90309140fe9b02d20bc2601960dfa837d6e06d19', 1, '60000000000000000', 1591764290),
(12, '0xec17a9ffb69b08e08af8e67f486bdae77a9ad13b', '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', 1, '60000000000000000', 1591765025),
(13, '0xde325236c3dd71fdbf8304f6d74e9b8f4359f84c', '0xde325236c3dd71fdbf8304f6d74e9b8f4359f84c', 1, '60000000000000000', 1591770080),
(14, '0xadb1336bca299ebd2cb5a6942ecc683a085a175b', '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', 1, '60000000000000000', 1591771595),
(15, '0x1d48ab973612a23ceb33d8294c351babd6a04925', '0xec17a9ffb69b08e08af8e67f486bdae77a9ad13b', 1, '60000000000000000', 1591773770),
(16, '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 2, '100000000000000000', 1591774535),
(17, '0x887e60316fc48534c1773081dec32c9542d14b16', '0xec17a9ffb69b08e08af8e67f486bdae77a9ad13b', 1, '60000000000000000', 1591775225),
(18, '0x182205c74d92d345b789d978b71876dd058453fb', '0xadb1336bca299ebd2cb5a6942ecc683a085a175b', 1, '60000000000000000', 1591852897),
(19, '0x466af25e6fc077d4ac09d879d2b0f2894d1e763f', '0xadb1336bca299ebd2cb5a6942ecc683a085a175b', 1, '60000000000000000', 1591853467),
(20, '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1591856377),
(21, '0xf0723376038b5ae42909b2d70c876b70ec5ca0a4', '0x1d48ab973612a23ceb33d8294c351babd6a04925', 1, '60000000000000000', 1591857442),
(22, '0x542ca934f4a61a87e7746118a00cf73c12fe6a57', '0x182205c74d92d345b789d978b71876dd058453fb', 1, '60000000000000000', 1591860457),
(23, '0xdda01f879ef99272735733f97eb7e1eb83599263', '0x182205c74d92d345b789d978b71876dd058453fb', 1, '60000000000000000', 1591862392),
(24, '0x86a1677a1fce4e26eb00caa0b93b3a8c8ae29af4', '0x466af25e6fc077d4ac09d879d2b0f2894d1e763f', 1, '60000000000000000', 1591863622),
(25, '0xf234cd09f9d011bb4f7ef715c39de60509f1d70a', '0x466af25e6fc077d4ac09d879d2b0f2894d1e763f', 1, '60000000000000000', 1591938714),
(26, '0x9a784f73bf11b593ab9392dd440c7151065113f0', '0x1d48ab973612a23ceb33d8294c351babd6a04925', 1, '60000000000000000', 1591946664),
(27, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', '0x386975d3f3c6d9df2e1ad88a3358a4cd1cdbb968', 1, '60000000000000000', 1591954269),
(28, '0x887e60316fc48534c1773081dec32c9542d14b16', '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', 2, '100000000000000000', 1592044944),
(29, '0x1d48ab973612a23ceb33d8294c351babd6a04925', '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', 2, '100000000000000000', 1592046744),
(30, '0x86a1677a1fce4e26eb00caa0b93b3a8c8ae29af4', '0xadb1336bca299ebd2cb5a6942ecc683a085a175b', 2, '100000000000000000', 1592047554),
(31, '0xc014a8132f50e5c72318572a35ee5447768a087b', '0x887e60316fc48534c1773081dec32c9542d14b16', 1, '60000000000000000', 1592053044),
(32, '0xba6dd8a6fe13304a2715d736f4cad920b46b1fe5', '0x887e60316fc48534c1773081dec32c9542d14b16', 1, '60000000000000000', 1592056329),
(33, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 1, '60000000000000000', 1592200899),
(34, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592211714),
(35, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 1, '60000000000000000', 1592212614),
(36, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592212629),
(37, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592214579),
(38, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592215134),
(39, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592215269),
(40, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592215689),
(41, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592216349),
(42, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592216364),
(43, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592216859),
(44, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592218149),
(45, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592218284),
(46, '0x2f5c9792b4b901cdc31eb133de7b5de5af9ad281', '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 1, '60000000000000000', 1592219004),
(47, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592219034),
(48, '0x2f5c9792b4b901cdc31eb133de7b5de5af9ad281', '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 1, '60000000000000000', 1592220984),
(49, '0x2f5c9792b4b901cdc31eb133de7b5de5af9ad281', '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 1, '60000000000000000', 1592221359),
(50, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592222049),
(51, '0x515799f98b0d539aa6e99b7098935340f2807671', '0xf0723376038b5ae42909b2d70c876b70ec5ca0a4', 1, '60000000000000000', 1592377884),
(52, '0xba6dd8a6fe13304a2715d736f4cad920b46b1fe5', '0xec17a9ffb69b08e08af8e67f486bdae77a9ad13b', 2, '100000000000000000', 1592378619),
(53, '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592381094),
(54, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', '0x386975d3f3c6d9df2e1ad88a3358a4cd1cdbb968', 1, '60000000000000000', 1592484834),
(55, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', '0x386975d3f3c6d9df2e1ad88a3358a4cd1cdbb968', 1, '60000000000000000', 1592485944),
(56, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 2, '100000000000000000', 1592486019),
(57, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592497404),
(58, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 3, '250000000000000000', 1592499609),
(59, '0x153ae3d4721ffb7e76e78bcea361a6b183956ed9', '0xde325236c3dd71fdbf8304f6d74e9b8f4359f84c', 1, '60000000000000000', 1592547459),
(60, '0x153ae3d4721ffb7e76e78bcea361a6b183956ed9', '0xde325236c3dd71fdbf8304f6d74e9b8f4359f84c', 1, '60000000000000000', 1592547939),
(61, '0x64c7117c31772c3a72b2c0e3b730493247db86aa', '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 1, '60000000000000000', 1592551494),
(62, '0x64c7117c31772c3a72b2c0e3b730493247db86aa', '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 1, '60000000000000000', 1592551494);

-- --------------------------------------------------------

--
-- Table structure for table `event_reglevelev`
--

CREATE TABLE `event_reglevelev` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userWallet` varchar(50) NOT NULL,
  `referrerID` int(11) NOT NULL,
  `originalReferrer` int(11) NOT NULL,
  `timestamp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_reglevelev`
--

INSERT INTO `event_reglevelev` (`id`, `userID`, `userWallet`, `referrerID`, `originalReferrer`, `timestamp`) VALUES
(1, 1, '0xddff6ae42fb1c29cee6a0c107ec286cecae99677', 0, 0, 1591596380),
(2, 2, '0x90309140fe9b02d20bc2601960dfa837d6e06d19', 1, 1, 1591666505),
(3, 3, '0x386975d3f3c6d9df2e1ad88a3358a4cd1cdbb968', 1, 1, 1591666700),
(4, 4, '0x222c1890a53f6dee06aa976449f50c7bca619784', 2, 1, 1591695815),
(5, 5, '0xccb7cc9b34427c82ca204441dad6a797aa1929f1', 4, 4, 1591696985),
(6, 6, '0xe14cf72543f9d1a26d505e2ef6c8de4bc65a159c', 2, 1, 1591764290),
(7, 7, '0xec17a9ffb69b08e08af8e67f486bdae77a9ad13b', 6, 6, 1591765025),
(8, 8, '0xde325236c3dd71fdbf8304f6d74e9b8f4359f84c', 8, 8, 1591770080),
(9, 9, '0xadb1336bca299ebd2cb5a6942ecc683a085a175b', 6, 6, 1591771595),
(10, 10, '0x1d48ab973612a23ceb33d8294c351babd6a04925', 7, 6, 1591773770),
(11, 11, '0x887e60316fc48534c1773081dec32c9542d14b16', 7, 6, 1591775225),
(12, 12, '0x182205c74d92d345b789d978b71876dd058453fb', 9, 6, 1591852897),
(13, 13, '0x466af25e6fc077d4ac09d879d2b0f2894d1e763f', 9, 6, 1591853467),
(14, 14, '0xf0723376038b5ae42909b2d70c876b70ec5ca0a4', 10, 6, 1591857442),
(15, 15, '0x542ca934f4a61a87e7746118a00cf73c12fe6a57', 12, 9, 1591860457),
(16, 16, '0xdda01f879ef99272735733f97eb7e1eb83599263', 12, 9, 1591862392),
(17, 17, '0x86a1677a1fce4e26eb00caa0b93b3a8c8ae29af4', 13, 9, 1591863622),
(18, 18, '0xf234cd09f9d011bb4f7ef715c39de60509f1d70a', 13, 9, 1591938714),
(19, 19, '0x9a784f73bf11b593ab9392dd440c7151065113f0', 10, 6, 1591946664),
(20, 20, '0x4cc5ded8b66edfdc9c992364ce6aba890f1edbf9', 3, 1, 1591954269),
(21, 21, '0xc014a8132f50e5c72318572a35ee5447768a087b', 11, 11, 1592053044),
(22, 22, '0xba6dd8a6fe13304a2715d736f4cad920b46b1fe5', 11, 11, 1592056329),
(23, 23, '0x3d7729c72ddfc0c5e285293555407f9e13c0c363', 20, 20, 1592200899),
(24, 24, '0x2f5c9792b4b901cdc31eb133de7b5de5af9ad281', 23, 23, 1592219004),
(25, 25, '0x515799f98b0d539aa6e99b7098935340f2807671', 14, 10, 1592377884),
(26, 26, '0x153ae3d4721ffb7e76e78bcea361a6b183956ed9', 8, 8, 1592547459),
(27, 27, '0x64c7117c31772c3a72b2c0e3b730493247db86aa', 20, 20, 1592551494);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminsetting`
--
ALTER TABLE `adminsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_blocks_synced`
--
ALTER TABLE `event_blocks_synced`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_levelbuyev`
--
ALTER TABLE `event_levelbuyev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_lostforlevelev`
--
ALTER TABLE `event_lostforlevelev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_paidforlevelev`
--
ALTER TABLE `event_paidforlevelev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_reglevelev`
--
ALTER TABLE `event_reglevelev`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userWallet` (`userWallet`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD UNIQUE KEY `userID_2` (`userID`,`userWallet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminsetting`
--
ALTER TABLE `adminsetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_blocks_synced`
--
ALTER TABLE `event_blocks_synced`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `event_levelbuyev`
--
ALTER TABLE `event_levelbuyev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `event_lostforlevelev`
--
ALTER TABLE `event_lostforlevelev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event_paidforlevelev`
--
ALTER TABLE `event_paidforlevelev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `event_reglevelev`
--
ALTER TABLE `event_reglevelev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
