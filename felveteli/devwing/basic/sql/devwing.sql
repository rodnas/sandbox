CREATE TABLE `dw_news` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(100) DEFAULT '',
  `shortDescription` varchar(255) DEFAULT '',
  `description` longtext,
  `listIMG` varchar(100) DEFAULT '',
  `pageIMG` varchar(100) DEFAULT '',
  `active` int(1) UNSIGNED DEFAULT '1',
  `insertWhen` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `dw_news` (`id`, `label`, `shortDescription`, `description`, `listIMG`, `pageIMG`, `active`, `insertWhen`) VALUES
(1, 'első', 'rövid leírás', 'leírás nagyon-nagyon hosszasan', '1.JPG', '1.JPG', 1, '2018-10-13 00:00:00'),
(2, 'második', 'rövid leírás', 'leírás nagyon-nagyon hosszasan', '2.JPG', '2.JPG', 1, '2018-10-13 00:00:00');

ALTER TABLE `dw_news` ADD PRIMARY KEY (`id`);

ALTER TABLE `dw_news` MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

