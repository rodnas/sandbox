CREATE TABLE `data` (
  `id` int(8) NOT NULL auto_increment,
  `year` int(4) NOT NULL default '0',
  `mon` int(2) NOT NULL default '0',
  `date` int(2) NOT NULL default '0',
  `datetime` varchar(8) NOT NULL default '',
  `title` varchar(250) NOT NULL default '',
  `content` text,
  `rank` tinyint(2) NOT NULL default '0',
  `sender` varchar(100) default NULL,
  PRIMARY KEY  (`datetime`),
  KEY `id` (`id`)
);


CREATE TABLE webcfg (
  id int(2) NOT NULL default '0',
  webname varchar(250) NOT NULL default '',
  weburl varchar(250) NOT NULL default '',
  counter varchar(8) NOT NULL default '0',
  langcode varchar(30) NOT NULL default 'english',
  adminemail varchar(250) NOT NULL default '',
  adminid varchar(100) NOT NULL default '',
  adminpsd varchar(100) NOT NULL default '',
  countrycode char(2) NOT NULL default 'tw',
  timezone int(3) NOT NULL default '8',
  topmsg text,
  footmsg text,
  calstartdate varchar(6) default '199001',
  datetype varchar(30) NOT NULL default 'yymmdd',
  firstweek char(3) NOT NULL default 'sun',
  theme varchar(40) NOT NULL default 'default',
  PRIMARY KEY  (adminid),
  KEY id (id)
) TYPE=MyISAM;

INSERT INTO webcfg VALUES (0, 'Calendar System', 'http://www.yourdomain.com', '0', 'english', 'service@yourdomain.com', 'admin', 'admin', 'tw', 8, '2200net Calendar is an easy calendar system,<BR> and it runs on PHP and MySQL.', 'Calendar System<BR>\r\nCreate by Kevin 2003 ~ 2006', '199001', 'yymmdd', 'sun', 'default');

