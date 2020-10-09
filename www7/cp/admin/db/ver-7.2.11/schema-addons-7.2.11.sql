ALTER TABLE `pattachments` 
   ADD `datein` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `code`;

CREATE TABLE IF NOT EXISTS `difprodlogs` (
  `id` int(11) NOT NULL,
  `datein` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code` varchar(64) DEFAULT NULL,
  `ypoloipo1` float DEFAULT '0',
  `ypoloipo2` float DEFAULT '0',
  `price0` float DEFAULT '0',
  `price1` float DEFAULT '0',
  `price2` float DEFAULT '0',
  `pricepc` float DEFAULT '0',
  `weight` float DEFAULT NULL,
  `volume` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='DIF products Log table';
ALTER TABLE `difprodlogs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `difprodlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; 
ALTER TABLE `difprodlogs` ADD `flag` TINYINT(4) NOT NULL AFTER `datein`;
ALTER TABLE `difprodlogs` ADD INDEX(`code`);  

ALTER TABLE `fshistory` ADD `timein` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `id`;