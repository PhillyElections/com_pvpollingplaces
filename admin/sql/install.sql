
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
) ENGINE=ARIA DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__pv_pollingplace_divisions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pollingplace_id` int(11) unsigned NOT NULL DEFAULT '0',
  `division_id` int(11) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=ARIA DEFAULT CHARSET=utf8 ;

INSERT INTO `#__pv_pollingplaces` 
  (`pin_address`, `location`, `published`, `created`) 
SELECT DISTINCT `pin_address`, `location`, 1, @tnow FROM `#__pollingplaces` ORDER BY `lat`;

UPDATE `#__pv_pollingplaces` as `p` 
SET 
  `p`.`display_address`=(SELECT `display_address` FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address` limit 1),
  `p`.`zip_code`=(SELECT `zip_code` FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address` limit 1),
  `p`.`display_location`=(SELECT `display_location` FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address` limit 1),
  `p`.`building`=(SELECT `building` FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address` limit 1),
  `p`.`parking`=(SELECT `parking` FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address` limit 1),
  `p`.`lat`=(SELECT max(`lat`) FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address`),
  `p`.`lng`=(SELECT min(`lng`) FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address`),
  `p`.`elat`=(SELECT min(`elat`) FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address`),
  `p`.`elng`=(SELECT max(`elng`) FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address`),
  `p`.`alat`=(SELECT min(`alat`) FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address`),
  `p`.`alng`=(SELECT max(`alng`) FROM `#__pollingplaces` where `pin_address`=`p`.`pin_address`);

INSERT INTO `#__pv_pollingplace_divisions`
  (`pollingplace_id`, `division_id`, `published`, `created`) 
SELECT `p`.`id`, `p`.`division_id`, 1, @tnow FROM `#__pollingplaces` as `p`;
    