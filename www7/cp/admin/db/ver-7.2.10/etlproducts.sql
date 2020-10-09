
CREATE TABLE `etlproducts` (
  `id` int(11) NOT NULL,
  `datein` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code1` int(11) DEFAULT NULL,
  `code2` int(11) DEFAULT NULL,
  `code3` varchar(64) DEFAULT NULL,
  `code4` varchar(64) DEFAULT NULL,
  `code5` varchar(64) DEFAULT NULL,
  `itmname` varchar(128) DEFAULT NULL,
  `itmactive` tinyint(4) DEFAULT NULL,
  `itmfname` varchar(128) DEFAULT NULL,
  `itmremark` varchar(256) DEFAULT NULL,
  `itmdescr` varchar(512) DEFAULT NULL,
  `itmfdescr` varchar(256) DEFAULT NULL,
  `sysins` datetime DEFAULT '0000-00-00 00:00:00',
  `sysupd` datetime DEFAULT NULL,
  `uniida` int(11) DEFAULT '0',
  `uniname1` varchar(64) DEFAULT NULL,
  `uniname2` varchar(64) DEFAULT NULL,
  `uni1uni2` float DEFAULT '0',
  `uni2uni1` float DEFAULT '0',
  `ypoloipo1` float DEFAULT '0',
  `ypoloipo2` float DEFAULT '0',
  `price0` float DEFAULT '0',
  `price1` float DEFAULT '0',
  `cat0` varchar(128) DEFAULT NULL,
  `cat1` varchar(128) DEFAULT NULL,
  `cat2` varchar(128) DEFAULT NULL,
  `cat3` varchar(128) DEFAULT NULL,
  `cat4` varchar(128) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `price2` float DEFAULT '0',
  `pricepc` float DEFAULT '0',
  `p1` varchar(256) DEFAULT NULL,
  `p2` varchar(256) DEFAULT NULL,
  `p3` varchar(256) DEFAULT NULL,
  `p4` varchar(256) DEFAULT NULL,
  `p5` varchar(256) DEFAULT NULL,
  `resources` text,
  `weight` float DEFAULT NULL,
  `volume` float DEFAULT NULL,
  `dimensions` varchar(100) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `xml` tinyint(4) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  `template` varchar(64) DEFAULT NULL,
  `owner` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ETL products table';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `etlproducts`
--
ALTER TABLE `etlproducts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code1` (`code1`,`code2`,`code3`,`code4`,`code5`),
  ADD KEY `itmname` (`itmname`),
  ADD KEY `cat0` (`cat0`),
  ADD KEY `cat1` (`cat1`),
  ADD KEY `cat2` (`cat2`),
  ADD KEY `cat3` (`cat3`),
  ADD KEY `cat4` (`cat4`),
  ADD KEY `itmremark` (`itmremark`(255)),
  ADD KEY `manufacturer` (`manufacturer`),
  ADD KEY `datein` (`datein`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `etlproducts`
--
ALTER TABLE `etlproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;