
/* ==================== constants ==================== */
SET @tnow = NOW();
SET @tnl  = '0000-00-00 00:00:00';
SET @tns  = '0000-00-00';
SET @db   = DATABASE();

/* ==================== tables ==================== */

CREATE TABLE IF NOT EXISTS `#__pv_pollingplaces` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pin_address` varchar(255) NOT NULL,
  `display_address` varchar(255) DEFAULT NULL,
  `zip_code` int(5) unsigned NOT NULL,
  `location` varchar(255) NOT NULL DEFAULT '',
  `display_location` varchar(255) NOT NULL DEFAULT '',
  `building` char(1) NOT NULL DEFAULT '',
  `parking` char(1) NOT NULL DEFAULT '',
  `lat` decimal(15,12) NOT NULL,
  `lng` decimal(15,12) NOT NULL,
  `elat` decimal(15,12) NOT NULL,
  `elng` decimal(15,12) NOT NULL,
  `alat` decimal(15,12) NOT NULL,
  `alng` decimal(15,12) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

INSERT INTO `#__pv_pollingplaces` 
  (`pin_address`, `location`, `published`, `created`) 
SELECT DISTINCT `pin_address`, `location`, 1, @tnl FROM `#__pollingplaces`;
 
UPDATE `#__pv_pollingplaces` as `p` SET `p`.`display_address`=(SELECT `display_address` FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address`);
