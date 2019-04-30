DROP TABLE IF EXISTS `#__assets`;
CREATE TABLE IF NOT EXISTS `#__assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__assets`
--

INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(1, 0, 0, 53, 0, 'root.1', 'Root Asset', '{"core.login.site":{"6":1,"2":1},"core.login.admin":{"6":1},"core.login.offline":{"6":1},"core.admin":{"8":1},"core.manage":{"7":1},"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(2, 1, 1, 2, 1, 'com_admin', 'com_admin', '{}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(3, 1, 3, 4, 1, 'com_banners', 'com_banners', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(4, 1, 5, 6, 1, 'com_cache', 'com_cache', '{"core.admin":{"7":1},"core.manage":{"7":1}}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(5, 1, 7, 8, 1, 'com_checkin', 'com_checkin', '{"core.admin":{"7":1},"core.manage":{"7":1}}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(6, 1, 9, 10, 1, 'com_config', 'com_config', '{}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(7, 1, 11, 12, 1, 'com_contact', 'com_contact', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(8, 1, 13, 14, 1, 'com_content', 'com_content', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(9, 1, 15, 16, 1, 'com_cpanel', 'com_cpanel', '{}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(10, 1, 17, 18, 1, 'com_installer', 'com_installer', '{"core.admin":[],"core.manage":{"7":0},"core.delete":{"7":0},"core.edit.state":{"7":0}}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(11, 1, 19, 20, 1, 'com_languages', 'com_languages', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(12, 1, 21, 22, 1, 'com_login', 'com_login', '{}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(13, 1, 23, 24, 1, 'com_mailto', 'com_mailto', '{}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(14, 1, 25, 26, 1, 'com_massmail', 'com_massmail', '{}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(15, 1, 27, 28, 1, 'com_media', 'com_media', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":{"5":1}}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(16, 1, 29, 30, 1, 'com_menus', 'com_menus', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(17, 1, 31, 32, 1, 'com_messages', 'com_messages', '{"core.admin":{"7":1},"core.manage":{"7":1}}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(18, 1, 33, 34, 1, 'com_modules', 'com_modules', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(19, 1, 35, 36, 1, 'com_newsfeeds', 'com_newsfeeds', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(20, 1, 37, 38, 1, 'com_plugins', 'com_plugins', '{"core.admin":{"7":1},"core.manage":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(21, 1, 39, 40, 1, 'com_redirect', 'com_redirect', '{"core.admin":{"7":1},"core.manage":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(22, 1, 41, 42, 1, 'com_search', 'com_search', '{"core.admin":{"7":1},"core.manage":{"6":1}}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(23, 1, 43, 44, 1, 'com_templates', 'com_templates', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(24, 1, 45, 46, 1, 'com_users', 'com_users', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(25, 1, 47, 48, 1, 'com_weblinks', 'com_weblinks', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(26, 1, 49, 50, 1, 'com_wrapper', 'com_wrapper', '{}');
INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES(27, 1, 51, 52, 1, 'com_finder', 'com_finder', '{"core.admin":{"7":1},"core.manage":{"6":1}}');
