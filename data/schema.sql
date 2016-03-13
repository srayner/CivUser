CREATE TABLE `civ_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `domain`        varchar(128) NOT NULL,
  `username`      varchar(128) NOT NULL,
  `password`      varchar(128) NOT NULL,
  `email_address` varchar(255),
  `display_name`  varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;