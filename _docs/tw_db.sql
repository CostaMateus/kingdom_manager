-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `twlan`;
CREATE DATABASE `twlan` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `twlan`;

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id_user` int(11) unsigned NOT NULL,
  `hash` varchar(32) NOT NULL,
  `time` double unsigned NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `INDEX_session_hash` (`hash`),
  CONSTRAINT `FK_session_user_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `session` (`id_user`, `hash`, `time`) VALUES
(3,	'63b56dfbb587f0.79161324',	1672834555);

DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id_task` int(11) NOT NULL AUTO_INCREMENT,
  `data` text,
  `progress` float DEFAULT '0',
  PRIMARY KEY (`id_task`),
  KEY `INDEX_task_progress` (`progress`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `task` (`id_task`, `data`, `progress`) VALUES
(1,	'{\"type\":\"new_abandoned_village\",\"world\":\"world\",\"amount\":10,\"units\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"research\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0},\"buildings\":{\"main\":5,\"barracks\":1,\"stable\":1,\"garage\":1,\"snob\":1,\"smith\":1,\"place\":1,\"statue\":0,\"market\":0,\"wood\":5,\"stone\":5,\"iron\":5,\"farm\":5,\"storage\":5,\"hide\":1,\"wall\":0},\"amount_done\":10}',	1);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `gender` enum('m','f','u') NOT NULL DEFAULT 'u',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(45) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `INDEX_user_id_user` (`id_user`),
  KEY `INDEX_user_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id_user`, `name`, `password`, `gender`, `banned`, `ip`, `is_admin`) VALUES
(1,	'Costa',	'051daad54902731742bbd0820970b0cf',	'u',	0,	'127.0.0.1',	1),
(2,	'Lopes',	'8d708a55899a5fc77b2bfdf464250b64',	'u',	0,	'127.0.0.1',	1),
(3,	'Costa1',	'5b016de04e3545e3755b61e92c039548',	'u',	0,	'127.0.0.1',	1);

DROP TABLE IF EXISTS `versioning`;
CREATE TABLE `versioning` (
  `id_versioning` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table` varchar(50) NOT NULL,
  `log` text NOT NULL,
  `old_revision` int(10) unsigned NOT NULL,
  `new_revision` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_versioning`),
  UNIQUE KEY `UNIQUE_versioning_id_versioning` (`id_versioning`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

INSERT INTO `versioning` (`id_versioning`, `table`, `log`, `old_revision`, `new_revision`) VALUES
(1,	'session',	'Auto created at 1672791269.9684',	0,	2),
(2,	'task',	'Auto created at 1672791269.9692',	0,	2),
(3,	'user',	'Auto created at 1672791269.9694',	0,	2),
(4,	'versioning',	'Auto created at 1672791269.9698',	0,	2),
(5,	'world_ally',	'Auto created at 1672791269.97',	0,	2),
(6,	'world_ally_contract',	'Auto created at 1672791269.9702',	0,	2),
(7,	'world_ally_event',	'Auto created at 1672791269.9704',	0,	2),
(8,	'world_ally_forum',	'Auto created at 1672791269.9705',	0,	2),
(9,	'world_ally_forum_poll',	'Auto created at 1672791269.9707',	0,	2),
(10,	'world_ally_forum_poll_answer',	'Auto created at 1672791269.9709',	0,	2),
(11,	'world_ally_forum_poll_vote',	'Auto created at 1672791269.9711',	0,	2),
(12,	'world_ally_forum_post',	'Auto created at 1672791269.9713',	0,	2),
(13,	'world_ally_forum_thread',	'Auto created at 1672791269.9714',	0,	2),
(14,	'world_ally_forum_thread_userstate',	'Auto created at 1672791269.9716',	0,	2),
(15,	'world_ally_invitation',	'Auto created at 1672791269.9718',	0,	2),
(16,	'world_ally_permissions',	'Auto created at 1672791269.972',	0,	2),
(17,	'world_event',	'Auto created at 1672791269.9721',	0,	2),
(18,	'world_event_army',	'Auto created at 1672791269.9723',	0,	2),
(19,	'world_event_build',	'Auto created at 1672791269.9725',	0,	2),
(20,	'world_event_research',	'Auto created at 1672791269.9727',	0,	2),
(21,	'world_event_train',	'Auto created at 1672791269.9728',	0,	2),
(22,	'world_group',	'Auto created at 1672791269.973',	0,	2),
(23,	'world_knight_items',	'Auto created at 1672791269.9732',	0,	2),
(24,	'world_quickbar',	'Auto created at 1672791269.9734',	0,	2),
(25,	'world_report',	'Auto created at 1672791269.9736',	0,	2),
(26,	'world_unit',	'Auto created at 1672791269.9737',	0,	2),
(27,	'world_user',	'Auto created at 1672791269.9739',	0,	2),
(28,	'world_vevent_train',	'Auto created at 1672791269.9741',	0,	2),
(29,	'world_village',	'Auto created at 1672791269.9743',	0,	2),
(30,	'world_village_group',	'Auto created at 1672791269.9744',	0,	2);

DROP TABLE IF EXISTS `world_ally`;
CREATE TABLE `world_ally` (
  `id_ally` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `tag` varchar(6) NOT NULL,
  `welcome_igm` text,
  `announcement` text,
  `homepage` varchar(100) NOT NULL DEFAULT '',
  `irc` varchar(100) NOT NULL DEFAULT '',
  `forumurl` varchar(100) NOT NULL DEFAULT '',
  `allowapply` tinyint(1) NOT NULL DEFAULT '0',
  `recruitpattern` text,
  `desc` text,
  `cached_points` int(11) unsigned NOT NULL DEFAULT '0',
  `cached_rank` int(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ally`),
  UNIQUE KEY `UNIQUE_world_ally_id_ally` (`id_ally`),
  KEY `INDEX_world_ally_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `world_ally` (`id_ally`, `name`, `tag`, `welcome_igm`, `announcement`, `homepage`, `irc`, `forumurl`, `allowapply`, `recruitpattern`, `desc`, `cached_points`, `cached_rank`) VALUES
(1,	'TESTE1',	'T1',	NULL,	NULL,	'',	'',	'',	0,	NULL,	NULL,	3919,	2),
(2,	'Teste2',	'T2',	NULL,	NULL,	'',	'',	'',	0,	NULL,	NULL,	12904,	1);

DROP TABLE IF EXISTS `world_ally_contract`;
CREATE TABLE `world_ally_contract` (
  `id_ally_source` int(11) unsigned NOT NULL,
  `type` int(11) unsigned NOT NULL,
  `id_ally_target` int(11) unsigned NOT NULL,
  KEY `INDEX_world_ally_contract_tribe` (`id_ally_source`),
  KEY `INDEX_world_ally_contract_ally_target` (`id_ally_target`),
  CONSTRAINT `FK_world_ally_contracts_ally_id_source` FOREIGN KEY (`id_ally_source`) REFERENCES `world_ally` (`id_ally`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_ally_contracts_ally_id_target` FOREIGN KEY (`id_ally_target`) REFERENCES `world_ally` (`id_ally`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_ally_event`;
CREATE TABLE `world_ally_event` (
  `id_ally` int(11) unsigned NOT NULL,
  `id_user_source` int(11) unsigned DEFAULT NULL,
  `id_user_target` int(11) unsigned DEFAULT NULL,
  `id_ally_target` int(11) unsigned DEFAULT NULL,
  `time_ins` double unsigned NOT NULL,
  `type` int(11) unsigned NOT NULL,
  KEY `INDEX_world_ally_event_id_ally` (`id_ally`),
  KEY `FK_world_ally_event_user_1_idx` (`id_user_source`),
  KEY `FK_world_ally_event_user_target_idx` (`id_user_target`),
  KEY `FK_world_ally_event_ally_target_idx` (`id_ally_target`),
  CONSTRAINT `FK_world_ally_event_ally_id` FOREIGN KEY (`id_ally`) REFERENCES `world_ally` (`id_ally`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_ally_event_ally_target` FOREIGN KEY (`id_ally_target`) REFERENCES `world_ally` (`id_ally`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_ally_event_user_src` FOREIGN KEY (`id_user_source`) REFERENCES `world_user` (`id_user`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_ally_event_user_target` FOREIGN KEY (`id_user_target`) REFERENCES `world_user` (`id_user`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `world_ally_event` (`id_ally`, `id_user_source`, `id_user_target`, `id_ally_target`, `time_ins`, `type`) VALUES
(1,	2,	NULL,	NULL,	1672834068.4759,	1),
(2,	1,	NULL,	NULL,	1672834288.0527,	1);

DROP TABLE IF EXISTS `world_ally_forum`;
CREATE TABLE `world_ally_forum` (
  `id_ally_forum` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` int(11) unsigned NOT NULL,
  `id_ally` int(11) unsigned NOT NULL,
  `pos` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ally_forum`),
  UNIQUE KEY `UNIQUE_ally_forum_id_ally_forum` (`id_ally_forum`),
  KEY `INDEX_world_ally_forum_tribe` (`id_ally`),
  CONSTRAINT `FK_world_ally_forum_id_ally` FOREIGN KEY (`id_ally`) REFERENCES `world_ally` (`id_ally`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_ally_forum_poll`;
CREATE TABLE `world_ally_forum_poll` (
  `id_ally_forum_poll` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_ally_forum_thread` int(11) unsigned NOT NULL,
  `question` text,
  `end` int(11) unsigned NOT NULL DEFAULT '0',
  `show` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ally_forum_poll`),
  UNIQUE KEY `UNIQUE_ally_forum_poll_id_ally_forum_poll` (`id_ally_forum_poll`),
  KEY `INDEX_world_ally_forum_poll_id_thread` (`id_ally_forum_thread`),
  CONSTRAINT `FK_world_ally_forum_poll_id_thread` FOREIGN KEY (`id_ally_forum_thread`) REFERENCES `world_ally_forum_thread` (`id_ally_forum_thread`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_ally_forum_poll_answer`;
CREATE TABLE `world_ally_forum_poll_answer` (
  `id_ally_forum_poll_answer` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_ally_forum_poll` int(11) unsigned NOT NULL,
  `text` varchar(127) NOT NULL,
  PRIMARY KEY (`id_ally_forum_poll_answer`),
  UNIQUE KEY `UNIQUE_id_ally_forum_poll_answer` (`id_ally_forum_poll_answer`),
  KEY `INDEX_world_ally_forum_poll_answer_id_forum_poll` (`id_ally_forum_poll`),
  CONSTRAINT `FK_world_ally_forum_poll_answers_id_poll` FOREIGN KEY (`id_ally_forum_poll`) REFERENCES `world_ally_forum_poll` (`id_ally_forum_poll`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_ally_forum_poll_vote`;
CREATE TABLE `world_ally_forum_poll_vote` (
  `id_user` int(11) unsigned NOT NULL,
  `id_ally_forum_poll_answer` int(11) unsigned NOT NULL,
  KEY `INDEX_world_ally_forum_poll_vote_vote` (`id_ally_forum_poll_answer`),
  KEY `world_ally_forum_poll_vote_user` (`id_user`),
  CONSTRAINT `FK_world_ally_forum_poll_votes_id_poll_answer` FOREIGN KEY (`id_ally_forum_poll_answer`) REFERENCES `world_ally_forum_poll_answer` (`id_ally_forum_poll_answer`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_ally_forum_poll_votes_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_ally_forum_post`;
CREATE TABLE `world_ally_forum_post` (
  `id_ally_forum_post` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_ally_forum_thread` int(11) unsigned NOT NULL,
  `text` text NOT NULL,
  `time_upd` double unsigned NOT NULL,
  `id_user_upd` int(11) unsigned NOT NULL,
  `time_ins` double unsigned NOT NULL,
  `id_user_ins` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_ally_forum_post`),
  UNIQUE KEY `UNIQUE_world_ally_forum_post_id` (`id_ally_forum_post`),
  KEY `INDEX_world_ally_forum_post_thread` (`id_ally_forum_thread`),
  KEY `INDEX_world_ally_forum_post_user_ins` (`id_user_ins`),
  KEY `INDEX_world_ally_forum_post_upd_user` (`id_user_upd`),
  CONSTRAINT `FK_world_ally_forum_post_forum_thread_id` FOREIGN KEY (`id_ally_forum_thread`) REFERENCES `world_ally_forum_thread` (`id_ally_forum_thread`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_ally_forum_post_id_user_ins` FOREIGN KEY (`id_user_ins`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_ally_forum_post_id_user_upd` FOREIGN KEY (`id_user_upd`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_ally_forum_thread`;
CREATE TABLE `world_ally_forum_thread` (
  `id_ally_forum_thread` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_ally_forum` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ally_forum_thread`),
  UNIQUE KEY `UNIQUE_world_ally_forum_thread_id_forum` (`id_ally_forum_thread`),
  KEY `INDEX_world_ally_forum_thread_forum` (`id_ally_forum`),
  CONSTRAINT `FK_world_ally_forum_thread_id_ally_forum` FOREIGN KEY (`id_ally_forum`) REFERENCES `world_ally_forum` (`id_ally_forum`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_ally_forum_thread_userstate`;
CREATE TABLE `world_ally_forum_thread_userstate` (
  `id_ally_forum_thread` int(11) unsigned NOT NULL,
  `id_user` int(11) unsigned NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  KEY `INDEX_world_ally_forum_thread_user` (`id_user`),
  KEY `INDEX_world_ally_forum_thread_thread` (`id_ally_forum_thread`),
  CONSTRAINT `FK_world_ally_forum_thread_thread` FOREIGN KEY (`id_ally_forum_thread`) REFERENCES `world_ally_forum_thread` (`id_ally_forum_thread`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_ally_forum_thread_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_ally_invitation`;
CREATE TABLE `world_ally_invitation` (
  `id_ally` int(11) unsigned NOT NULL,
  `id_user` int(11) unsigned NOT NULL,
  `time_ins` double unsigned NOT NULL,
  KEY `INDEX_world_ally_invitation_user` (`id_user`),
  KEY `INDEX_world_ally_invitation_ally` (`id_ally`),
  CONSTRAINT `FK_world_ally_invitations_ally` FOREIGN KEY (`id_ally`) REFERENCES `world_ally` (`id_ally`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_ally_invitations_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_ally_permissions`;
CREATE TABLE `world_ally_permissions` (
  `id_ally` int(11) unsigned NOT NULL,
  `id_user` int(11) unsigned NOT NULL,
  `permission` int(11) unsigned NOT NULL,
  `title` varchar(127) NOT NULL,
  `title_outside` tinyint(1) NOT NULL DEFAULT '0',
  KEY `INDEX_world_ally_permissions_user` (`id_user`),
  KEY `INDEX_world_ally_permissions_ally` (`id_ally`),
  CONSTRAINT `FK_world_ally_permissions_ally` FOREIGN KEY (`id_ally`) REFERENCES `world_ally` (`id_ally`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_ally_permissions_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `world_ally_permissions` (`id_ally`, `id_user`, `permission`, `title`, `title_outside`) VALUES
(1,	2,	1,	'',	0),
(2,	1,	1,	'',	0);

DROP TABLE IF EXISTS `world_event`;
CREATE TABLE `world_event` (
  `id_event` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_type` int(11) unsigned DEFAULT NULL,
  `finish` double unsigned NOT NULL DEFAULT '0',
  `start` double unsigned NOT NULL DEFAULT '0',
  `id_village_to` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_event`),
  UNIQUE KEY `UNIQUE_world_event_id_event` (`id_event`),
  KEY `FK_world_event_village_to` (`id_village_to`),
  CONSTRAINT `FK_world_event_village_to` FOREIGN KEY (`id_village_to`) REFERENCES `world_village` (`id_village`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=472 DEFAULT CHARSET=utf8;

INSERT INTO `world_event` (`id_event`, `event_type`, `finish`, `start`, `id_village_to`) VALUES
(360,	1,	0,	1672794207.4151,	1),
(361,	1,	0,	1672794221.2939,	1),
(471,	1,	0,	1672832850.5164,	12);

DROP TABLE IF EXISTS `world_event_army`;
CREATE TABLE `world_event_army` (
  `id_event` int(11) unsigned NOT NULL,
  `id_village_from` int(11) unsigned NOT NULL,
  `unit_spear` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_sword` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_axe` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_archer` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_spy` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_light` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_marcher` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_heavy` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_ram` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_catapult` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_knight` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_snob` int(11) unsigned NOT NULL DEFAULT '0',
  `movement_type` int(11) unsigned NOT NULL DEFAULT '0',
  `data` text,
  PRIMARY KEY (`id_event`),
  UNIQUE KEY `UNIQUE_world_event_army_id_event` (`id_event`),
  KEY `FK_world_event_army_village_from` (`id_village_from`),
  CONSTRAINT `FK_world_event_army_event` FOREIGN KEY (`id_event`) REFERENCES `world_event` (`id_event`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_event_army_village_from` FOREIGN KEY (`id_village_from`) REFERENCES `world_village` (`id_village`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_event_build`;
CREATE TABLE `world_event_build` (
  `id_event` int(11) unsigned NOT NULL,
  `destroy` tinyint(1) NOT NULL DEFAULT '0',
  `building` varchar(255) NOT NULL,
  PRIMARY KEY (`id_event`),
  UNIQUE KEY `UNIQUE_world_event_build_id` (`id_event`),
  CONSTRAINT `FK_world_event_build_event` FOREIGN KEY (`id_event`) REFERENCES `world_event` (`id_event`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_event_research`;
CREATE TABLE `world_event_research` (
  `id_event` int(10) unsigned NOT NULL,
  `technology` varchar(255) NOT NULL,
  PRIMARY KEY (`id_event`),
  UNIQUE KEY `UNIQUE_world_event_research_id_event` (`id_event`),
  CONSTRAINT `FK_world_event_research_event` FOREIGN KEY (`id_event`) REFERENCES `world_event` (`id_event`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_event_train`;
CREATE TABLE `world_event_train` (
  `id_event` int(11) unsigned NOT NULL,
  `decommission` tinyint(1) NOT NULL DEFAULT '0',
  `unit` varchar(255) NOT NULL,
  `amount` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_event`),
  UNIQUE KEY `UNIQUE_world_event_train_id_event` (`id_event`),
  KEY `INDEX_world_event_train_unit` (`unit`),
  CONSTRAINT `FK_world_event_train_event` FOREIGN KEY (`id_event`) REFERENCES `world_event` (`id_event`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `world_event_train` (`id_event`, `decommission`, `unit`, `amount`) VALUES
(360,	0,	'spy',	1276),
(361,	1,	'heavy',	75),
(471,	0,	'archer',	100);

DROP TABLE IF EXISTS `world_group`;
CREATE TABLE `world_group` (
  `id_group` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned NOT NULL,
  `name` varchar(127) NOT NULL,
  PRIMARY KEY (`id_group`),
  UNIQUE KEY `UNIQUE_world_group_id_group` (`id_group`),
  KEY `FK_world_group_id_user` (`id_user`),
  CONSTRAINT `FK_world_group_id_user` FOREIGN KEY (`id_user`) REFERENCES `world_user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `world_group` (`id_group`, `id_user`, `name`) VALUES
(1,	1,	'teste_gr');

DROP TABLE IF EXISTS `world_knight_items`;
CREATE TABLE `world_knight_items` (
  `id_user` int(10) unsigned NOT NULL,
  `chosen_item` varchar(127) NOT NULL DEFAULT '',
  `progress` float unsigned NOT NULL DEFAULT '0',
  `time_update` double unsigned NOT NULL DEFAULT '0',
  `spear` tinyint(1) NOT NULL DEFAULT '0',
  `sword` tinyint(1) NOT NULL DEFAULT '0',
  `axe` tinyint(1) NOT NULL DEFAULT '0',
  `archer` tinyint(1) NOT NULL DEFAULT '0',
  `spy` tinyint(1) NOT NULL DEFAULT '0',
  `light` tinyint(1) NOT NULL DEFAULT '0',
  `heavy` tinyint(1) NOT NULL DEFAULT '0',
  `marcher` tinyint(1) NOT NULL DEFAULT '0',
  `ram` tinyint(1) NOT NULL DEFAULT '0',
  `catapult` tinyint(1) NOT NULL DEFAULT '0',
  `snob` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `UNIQUE_world_knight_items_id_user` (`id_user`),
  CONSTRAINT `FK_world_knight_items_id_user` FOREIGN KEY (`id_user`) REFERENCES `world_user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `world_knight_items` (`id_user`, `chosen_item`, `progress`, `time_update`, `spear`, `sword`, `axe`, `archer`, `spy`, `light`, `heavy`, `marcher`, `ram`, `catapult`, `snob`) VALUES
(1,	'',	100,	1672837731,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1,	1),
(2,	'',	0,	1672827438,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(3,	'',	0,	1672834130,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0);

DROP TABLE IF EXISTS `world_quickbar`;
CREATE TABLE `world_quickbar` (
  `rank` int(11) unsigned NOT NULL,
  `id_user` int(11) unsigned NOT NULL,
  `image` text,
  `name` text NOT NULL,
  `url` text,
  `new_window` tinyint(1) NOT NULL DEFAULT '0',
  KEY `INDEX_world_quickbar_user_id_user` (`id_user`),
  CONSTRAINT `FK_world_quickbar_user_id_user` FOREIGN KEY (`id_user`) REFERENCES `world_user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_report`;
CREATE TABLE `world_report` (
  `id_report` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned NOT NULL,
  `id_village_from` int(11) unsigned NOT NULL,
  `id_village_to` int(11) unsigned NOT NULL,
  `type` int(11) unsigned NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  PRIMARY KEY (`id_report`),
  UNIQUE KEY `UNIQUE_world_report_id_report` (`id_report`),
  KEY `FK_world_report_id_user` (`id_user`),
  KEY `FK_world_report_village_id_village_from` (`id_village_from`),
  KEY `FK_world_report_village_id_village_to` (`id_village_to`),
  CONSTRAINT `FK_world_report_user_id_user` FOREIGN KEY (`id_user`) REFERENCES `world_user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_report_village_id_village_from` FOREIGN KEY (`id_village_from`) REFERENCES `world_village` (`id_village`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_report_village_id_village_to` FOREIGN KEY (`id_village_to`) REFERENCES `world_village` (`id_village`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO `world_report` (`id_report`, `id_user`, `id_village_from`, `id_village_to`, `type`, `is_read`, `data`) VALUES
(1,	1,	1,	2,	0,	1,	'{\"time\":1672792674.1865,\"luck\":-8.1,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":100,\"axe\":100,\"archer\":100,\"spy\":0,\"light\":200,\"marcher\":100,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":100,\"axe\":100,\"archer\":100,\"spy\":0,\"light\":200,\"marcher\":100,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":6855,\"max\":24500,\"res\":{\"wood\":2285,\"stone\":2285,\"iron\":2285}},\"color\":\"green\"}'),
(2,	1,	1,	2,	0,	1,	'{\"time\":1672793757.286,\"luck\":-24.3,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":100,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":150,\"knight\":1,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":150,\"knight\":1,\"snob\":0}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":6855,\"max\":20100,\"res\":{\"wood\":2285,\"stone\":2285,\"iron\":2285}},\"color\":\"yellow\"}'),
(3,	1,	1,	2,	0,	1,	'{\"loyalty\":[100,79],\"time\":1672793886.7625,\"luck\":9.2,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":500,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":1,\"snob\":1},\"after\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":500,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":1,\"snob\":1}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":6855,\"max\":60100,\"res\":{\"wood\":2285,\"stone\":2285,\"iron\":2285}},\"color\":\"green\"}'),
(4,	1,	1,	2,	0,	1,	'{\"loyalty\":[100,77],\"time\":1672793911.1064,\"luck\":-9.3,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":750,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":1,\"snob\":1},\"after\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":750,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":1,\"snob\":1}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":5571,\"max\":57600,\"res\":{\"wood\":1856,\"stone\":1856,\"iron\":1856}},\"color\":\"green\"}'),
(5,	1,	1,	2,	0,	0,	'{\"loyalty\":[100,80],\"time\":1672793986.176,\"luck\":14.7,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":500,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1},\"after\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":500,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":6855,\"max\":60000,\"res\":{\"wood\":2285,\"stone\":2285,\"iron\":2285}},\"color\":\"green\"}'),
(6,	1,	1,	2,	0,	0,	'{\"loyalty\":[97.905775043699,66.905775043699],\"time\":1672793999.069,\"luck\":5,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1},\"after\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":2952,\"max\":20000,\"res\":{\"wood\":983,\"stone\":983,\"iron\":983}},\"color\":\"green\"}'),
(7,	1,	1,	2,	0,	0,	'{\"loyalty\":[77.402170870039,53.402170870039],\"time\":1672794006.6273,\"luck\":-2.5,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":1250,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":1250,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":4680,\"max\":12500,\"res\":{\"wood\":1559,\"stone\":1559,\"iron\":1559}},\"color\":\"green\"}'),
(8,	1,	1,	2,	0,	0,	'{\"loyalty\":[61.087930533621,38.087930533621],\"time\":1672794012.1625,\"luck\":-8.9,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1},\"after\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":1266,\"max\":20000,\"res\":{\"wood\":421,\"stone\":421,\"iron\":421}},\"color\":\"green\"}'),
(9,	1,	1,	2,	0,	0,	'{\"loyalty\":[45.484215272797,14.484215272797],\"time\":1672794017.4886,\"luck\":-6.8,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":250,\"axe\":0,\"archer\":1250,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1},\"after\":{\"spear\":0,\"sword\":250,\"axe\":0,\"archer\":1250,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":2487,\"max\":16250,\"res\":{\"wood\":828,\"stone\":828,\"iron\":828}},\"color\":\"green\"}'),
(10,	1,	1,	2,	0,	0,	'{\"loyalty\":[24.711358043882,2.7113580438821],\"time\":1672794024.853,\"luck\":13.4,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1},\"after\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":1686,\"max\":20000,\"res\":{\"wood\":561,\"stone\":561,\"iron\":561}},\"color\":\"green\"}'),
(11,	1,	1,	2,	0,	1,	'{\"loyalty\":[11.244912319713,-11.755087680287],\"time\":1672794030.9956,\"luck\":-18,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":1250,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":1250,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":[],\"color\":\"green\"}'),
(12,	1,	1,	2,	0,	1,	'{\"time\":1672794036.9516,\"luck\":22.1,\"morale\":100,\"winner\":\"defender\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":1250,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":327,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":[],\"color\":\"yellow\"}'),
(13,	1,	1,	2,	0,	1,	'{\"time\":1672794036.9516,\"luck\":22.1,\"morale\":100,\"winner\":\"defender\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":2000,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":1},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":1250,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":327,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":[],\"color\":\"red\"}'),
(14,	1,	1,	6,	0,	1,	'{\"time\":1672794184.411,\"luck\":4.3,\"morale\":100,\"winner\":\"defender\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":1000,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":[],\"color\":\"red\"}'),
(15,	2,	12,	11,	1,	1,	'{\"time\":1672832916.1819,\"supporter\":{\"spear\":95,\"sword\":50,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}}'),
(16,	2,	12,	9,	0,	1,	'{\"time\":1672833095.3627,\"luck\":-12.2,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":25,\"archer\":0,\"spy\":50,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":25,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":25,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":25,\"catapult\":0,\"knight\":0,\"snob\":0}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":250,\"max\":250,\"res\":{\"wood\":84,\"stone\":83,\"iron\":83}},\"color\":\"yellow\"}'),
(17,	2,	12,	5,	0,	1,	'{\"time\":1672833142.2195,\"luck\":12.2,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":25,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":25,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":25,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":25,\"catapult\":0,\"knight\":0,\"snob\":0}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":250,\"max\":250,\"res\":{\"wood\":84,\"stone\":83,\"iron\":83}},\"color\":\"green\"}'),
(18,	2,	12,	9,	0,	1,	'{\"time\":1672833203.0596,\"luck\":23.7,\"morale\":100,\"winner\":\"attacker\",\"attacker\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":25,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":25,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":25,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":25,\"catapult\":0,\"knight\":0,\"snob\":0}},\"defender\":{\"before\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0},\"after\":{\"spear\":0,\"sword\":0,\"axe\":0,\"archer\":0,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}},\"loot\":{\"used\":250,\"max\":250,\"res\":{\"wood\":84,\"stone\":83,\"iron\":83}},\"color\":\"green\"}'),
(19,	1,	1,	2,	1,	0,	'{\"time\":1672834205.1176,\"supporter\":{\"spear\":500,\"sword\":0,\"axe\":0,\"archer\":1250,\"spy\":0,\"light\":0,\"marcher\":0,\"heavy\":0,\"ram\":0,\"catapult\":0,\"knight\":0,\"snob\":0}}');

DROP TABLE IF EXISTS `world_unit`;
CREATE TABLE `world_unit` (
  `id_army` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_village_from` int(11) unsigned NOT NULL,
  `id_village_to` int(11) unsigned NOT NULL,
  `unit_spear` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_sword` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_axe` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_archer` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_spy` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_light` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_marcher` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_heavy` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_ram` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_catapult` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_knight` int(11) unsigned NOT NULL DEFAULT '0',
  `unit_snob` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_army`),
  UNIQUE KEY `UNIQUE_world_unit_id_army` (`id_army`),
  KEY `INDEX_world_unit_village_from` (`id_village_from`),
  KEY `INDEX_world_unit_village_to` (`id_village_to`),
  CONSTRAINT `FK_world_unit_village_from` FOREIGN KEY (`id_village_from`) REFERENCES `world_village` (`id_village`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_unit_village_to` FOREIGN KEY (`id_village_to`) REFERENCES `world_village` (`id_village`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `world_unit` (`id_army`, `id_village_from`, `id_village_to`, `unit_spear`, `unit_sword`, `unit_axe`, `unit_archer`, `unit_spy`, `unit_light`, `unit_marcher`, `unit_heavy`, `unit_ram`, `unit_catapult`, `unit_knight`, `unit_snob`) VALUES
(1,	1,	1,	0,	250,	3000,	0,	0,	500,	750,	675,	250,	150,	1,	0),
(2,	2,	2,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(3,	3,	3,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(4,	4,	4,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(5,	5,	5,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(6,	6,	6,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(7,	7,	7,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(8,	8,	8,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(9,	9,	9,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(10,	10,	10,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(11,	11,	11,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(12,	12,	12,	0,	0,	25,	0,	0,	0,	0,	0,	25,	0,	0,	0),
(13,	12,	11,	95,	50,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(14,	1,	2,	500,	0,	0,	1250,	0,	0,	0,	0,	0,	0,	0,	0);

DROP TABLE IF EXISTS `world_user`;
CREATE TABLE `world_user` (
  `id_user` int(11) unsigned NOT NULL,
  `id_ally` int(11) unsigned DEFAULT NULL,
  `cached_points` int(11) unsigned NOT NULL DEFAULT '0',
  `cached_rank` int(3) unsigned NOT NULL DEFAULT '0',
  `cached_villages` int(11) unsigned NOT NULL DEFAULT '0',
  `start` double unsigned NOT NULL DEFAULT '0',
  `visual` tinyint(1) NOT NULL DEFAULT '1',
  `show_levels` tinyint(1) NOT NULL DEFAULT '1',
  `show_all_widgets` tinyint(1) NOT NULL DEFAULT '0',
  `show_all_buildings` tinyint(1) NOT NULL DEFAULT '0',
  `hide_completed_buildings` tinyint(1) NOT NULL DEFAULT '0',
  `new_reports` tinyint(1) NOT NULL DEFAULT '0',
  `new_messages` tinyint(1) NOT NULL DEFAULT '0',
  `leftcolumn` text,
  `rightcolumn` text,
  `snob_data` text,
  `knightname` varchar(127) NOT NULL DEFAULT 'GÃ¼nther',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `UNIQUE_world_user_id_user` (`id_user`),
  KEY `FK_world_user_ally_id_ally` (`id_ally`),
  CONSTRAINT `FK_world_user_ally_id_ally` FOREIGN KEY (`id_ally`) REFERENCES `world_ally` (`id_ally`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_user_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `world_user` (`id_user`, `id_ally`, `cached_points`, `cached_rank`, `cached_villages`, `start`, `visual`, `show_levels`, `show_all_widgets`, `show_all_buildings`, `hide_completed_buildings`, `new_reports`, `new_messages`, `leftcolumn`, `rightcolumn`, `snob_data`, `knightname`) VALUES
(1,	2,	12904,	1,	2,	1672791308.6497,	1,	1,	0,	0,	0,	0,	0,	NULL,	NULL,	'{\"pagination\":100,\"coins\":6}',	'Jax'),
(2,	1,	3919,	2,	2,	1672827429.9311,	1,	1,	0,	0,	0,	0,	0,	NULL,	NULL,	'[]',	'GÃ¼nther'),
(3,	NULL,	611,	3,	1,	1672834128.6017,	1,	1,	0,	0,	0,	0,	0,	NULL,	NULL,	'[]',	'GÃ¼nther');

DROP VIEW IF EXISTS `world_vevent_train`;
CREATE TABLE `world_vevent_train` (`id_event` int(11) unsigned, `decommission` tinyint(1), `unit` varchar(255), `amount` int(11) unsigned, `doneUnits` double(17,0));


DROP TABLE IF EXISTS `world_village`;
CREATE TABLE `world_village` (
  `id_village` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user_owner` int(11) unsigned DEFAULT NULL,
  `name` varchar(127) NOT NULL,
  `x` int(5) unsigned NOT NULL DEFAULT '0',
  `y` int(5) unsigned NOT NULL DEFAULT '0',
  `map_sector` varchar(8) NOT NULL DEFAULT '',
  `update` double unsigned NOT NULL DEFAULT '0',
  `visual` tinyint(1) NOT NULL DEFAULT '1',
  `show_levels` tinyint(1) NOT NULL DEFAULT '1',
  `show_all_widgets` tinyint(1) NOT NULL DEFAULT '0',
  `leftcolumn` text,
  `rightcolumn` text,
  `loyalty` double unsigned NOT NULL DEFAULT '0',
  `points` int(11) unsigned NOT NULL DEFAULT '0',
  `res_wood` double unsigned NOT NULL DEFAULT '0',
  `res_stone` double unsigned NOT NULL DEFAULT '0',
  `res_iron` double unsigned NOT NULL DEFAULT '0',
  `building_main` int(3) unsigned NOT NULL DEFAULT '0',
  `building_barracks` int(3) unsigned NOT NULL DEFAULT '0',
  `building_stable` int(3) unsigned NOT NULL DEFAULT '0',
  `building_garage` int(3) unsigned NOT NULL DEFAULT '0',
  `building_church` int(3) unsigned NOT NULL DEFAULT '0',
  `building_church_f` int(3) unsigned NOT NULL DEFAULT '0',
  `building_snob` int(3) unsigned NOT NULL DEFAULT '0',
  `building_smith` int(3) unsigned NOT NULL DEFAULT '0',
  `building_place` int(3) unsigned NOT NULL DEFAULT '0',
  `building_statue` int(3) unsigned NOT NULL DEFAULT '0',
  `building_market` int(3) unsigned NOT NULL DEFAULT '0',
  `building_wood` int(3) unsigned NOT NULL DEFAULT '0',
  `building_stone` int(3) unsigned NOT NULL DEFAULT '0',
  `building_iron` int(3) unsigned NOT NULL DEFAULT '0',
  `building_farm` int(3) unsigned NOT NULL DEFAULT '0',
  `building_storage` int(3) unsigned NOT NULL DEFAULT '0',
  `building_hide` int(3) unsigned NOT NULL DEFAULT '0',
  `building_wall` int(3) unsigned NOT NULL DEFAULT '0',
  `research_spear` int(3) unsigned NOT NULL DEFAULT '0',
  `research_sword` int(3) unsigned NOT NULL DEFAULT '0',
  `research_axe` int(3) unsigned NOT NULL DEFAULT '0',
  `research_archer` int(3) unsigned NOT NULL DEFAULT '0',
  `research_spy` int(3) unsigned NOT NULL DEFAULT '0',
  `research_light` int(3) unsigned NOT NULL DEFAULT '0',
  `research_marcher` int(3) unsigned NOT NULL DEFAULT '0',
  `research_heavy` int(3) unsigned NOT NULL DEFAULT '0',
  `research_ram` int(3) unsigned NOT NULL DEFAULT '0',
  `research_catapult` int(3) unsigned NOT NULL DEFAULT '0',
  `cached_population` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_village`),
  UNIQUE KEY `UNIQUE_world_village_id_village` (`id_village`),
  KEY `INDEX_world_village_owner` (`id_user_owner`),
  KEY `INDEX_world_village_x` (`x`),
  KEY `INDEX _world_village_y` (`y`),
  KEY `INDEX_world_village_name` (`name`),
  KEY `INDEX_world_village_map_sector` (`map_sector`),
  CONSTRAINT `FK_world_village_user_owner` FOREIGN KEY (`id_user_owner`) REFERENCES `world_user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `world_village` (`id_village`, `id_user_owner`, `name`, `x`, `y`, `map_sector`, `update`, `visual`, `show_levels`, `show_all_widgets`, `leftcolumn`, `rightcolumn`, `loyalty`, `points`, `res_wood`, `res_stone`, `res_iron`, `building_main`, `building_barracks`, `building_stable`, `building_garage`, `building_church`, `building_church_f`, `building_snob`, `building_smith`, `building_place`, `building_statue`, `building_market`, `building_wood`, `building_stone`, `building_iron`, `building_farm`, `building_storage`, `building_hide`, `building_wall`, `research_spear`, `research_sword`, `research_axe`, `research_archer`, `research_spy`, `research_light`, `research_marcher`, `research_heavy`, `research_ram`, `research_catapult`, `cached_population`) VALUES
(1,	1,	'001 - Village',	500,	500,	'25_25',	1672834204.7354,	1,	1,	0,	NULL,	NULL,	100,	12154,	400000,	400000,	400000,	30,	25,	20,	15,	0,	0,	1,	20,	1,	1,	25,	30,	30,	30,	30,	30,	10,	20,	0,	0,	1,	1,	1,	1,	1,	1,	1,	1,	22250),
(2,	1,	'002 - Village',	500,	499,	'25_24',	1672794324.9686,	1,	1,	0,	NULL,	NULL,	100,	750,	2810,	2810,	2810,	5,	2,	1,	1,	0,	0,	1,	4,	1,	1,	2,	5,	6,	5,	6,	6,	3,	3,	0,	0,	1,	0,	1,	0,	0,	0,	1,	0,	235),
(3,	NULL,	'Barbarian village',	502,	499,	'25_24',	1672792195.9752,	1,	1,	0,	NULL,	NULL,	100,	709,	0.0091815372902557,	0.0091815372902557,	0.0091815372902557,	5,	1,	1,	1,	0,	0,	1,	1,	1,	0,	0,	5,	5,	5,	5,	5,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	179),
(4,	NULL,	'Barbarian village',	499,	501,	'24_25',	1672792195.9752,	1,	1,	0,	NULL,	NULL,	100,	709,	0.0091815372902557,	0.0091815372902557,	0.0091815372902557,	5,	1,	1,	1,	0,	0,	1,	1,	1,	0,	0,	5,	5,	5,	5,	5,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	179),
(5,	NULL,	'Barbarian village',	502,	501,	'25_25',	1672833142.2168,	1,	1,	0,	NULL,	NULL,	100,	709,	2201,	2202,	2202,	5,	1,	1,	1,	0,	0,	1,	1,	1,	0,	0,	5,	5,	5,	5,	5,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	179),
(6,	NULL,	'Barbarian village',	501,	499,	'25_24',	1672792195.9752,	1,	1,	0,	NULL,	NULL,	100,	709,	0.0091815372902557,	0.0091815372902557,	0.0091815372902557,	5,	1,	1,	1,	0,	0,	1,	1,	1,	0,	0,	5,	5,	5,	5,	5,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	179),
(7,	NULL,	'Barbarian village',	499,	502,	'24_25',	1672792195.9752,	1,	1,	0,	NULL,	NULL,	100,	709,	0.0091815372902557,	0.0091815372902557,	0.0091815372902557,	5,	1,	1,	1,	0,	0,	1,	1,	1,	0,	0,	5,	5,	5,	5,	5,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	179),
(8,	NULL,	'Barbarian village',	502,	500,	'25_25',	1672792195.9752,	1,	1,	0,	NULL,	NULL,	100,	709,	0.0091815372902557,	0.0091815372902557,	0.0091815372902557,	5,	1,	1,	1,	0,	0,	1,	1,	1,	0,	0,	5,	5,	5,	5,	5,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	179),
(9,	NULL,	'Barbarian village',	501,	502,	'25_25',	1672833203.0569,	1,	1,	0,	NULL,	NULL,	100,	709,	2285,	2285,	2285,	5,	1,	1,	1,	0,	0,	1,	1,	1,	0,	0,	5,	5,	5,	5,	5,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	179),
(10,	NULL,	'Barbarian village',	500,	498,	'25_24',	1672792195.9752,	1,	1,	0,	NULL,	NULL,	100,	709,	0.0091815372902557,	0.0091815372902557,	0.0091815372902557,	5,	1,	1,	1,	0,	0,	1,	1,	1,	0,	0,	5,	5,	5,	5,	5,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	179),
(11,	2,	'Barbarian village',	499,	503,	'24_25',	1672832796.3284,	1,	1,	0,	'',	'',	100,	2671,	2285,	2285,	2285,	30,	1,	1,	1,	0,	0,	1,	1,	1,	1,	0,	5,	5,	5,	5,	5,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	655),
(12,	2,	'001 - Lopes',	497,	499,	'24_24',	1672833201.0471,	1,	1,	0,	'',	'',	100,	1248,	18037,	18037,	18037,	17,	5,	1,	1,	0,	0,	0,	10,	1,	1,	10,	15,	15,	15,	10,	15,	5,	10,	0,	0,	1,	1,	1,	0,	0,	0,	1,	0,	876),
(13,	3,	'Costa1\'s village',	501,	503,	'25_25',	1672834559.0874,	1,	1,	0,	NULL,	NULL,	100,	611,	2285,	2285,	2285,	5,	0,	0,	0,	0,	0,	0,	0,	1,	0,	0,	5,	5,	5,	5,	5,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	56);

DROP TABLE IF EXISTS `world_village_group`;
CREATE TABLE `world_village_group` (
  `id_village` int(11) unsigned NOT NULL,
  `id_group` int(11) unsigned NOT NULL,
  KEY `INDEX_world_village_group_village` (`id_village`),
  KEY `INDEX_world_village_group_group` (`id_group`),
  CONSTRAINT `FK_world_villages_groups_group` FOREIGN KEY (`id_group`) REFERENCES `world_group` (`id_group`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_world_villages_groups_village` FOREIGN KEY (`id_village`) REFERENCES `world_village` (`id_village`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `world_vevent_train`;
CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY INVOKER VIEW `world_vevent_train` AS select `wt`.`id_event` AS `id_event`,`wt`.`decommission` AS `decommission`,`wt`.`unit` AS `unit`,`wt`.`amount` AS `amount`,floor(((unix_timestamp() - `we`.`start`) / ((`we`.`finish` - `we`.`start`) / `wt`.`amount`))) AS `doneUnits` from (`world_event_train` `wt` join `world_event` `we` on((`we`.`id_event` = `wt`.`id_event`)));

-- 2023-01-04 13:09:19
