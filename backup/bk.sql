DROP TABLE Configuration;

CREATE TABLE `Configuration` (
  `Cname` tinytext NOT NULL,
  `polldata` int(11) NOT NULL,
  `Ip4` varchar(255) NOT NULL,
  `Subnet` varchar(255) NOT NULL,
  `gateway` char(255) NOT NULL,
  `dns1` varchar(255) NOT NULL,
  `dns2` varchar(255) NOT NULL,
  `smtp` varchar(255) NOT NULL,
  `mailport` int(11) NOT NULL,
  `mail_on` tinyint(1) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `usetls` tinyint(1) NOT NULL,
  `usessl` tinyint(1) NOT NULL,
  `Reportemail` text NOT NULL,
  `report_on` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO Configuration VALUES("Default","10","10.10.10.10","255.255.255.0","10.10.10.11","10.10.10.1","10.10.10.2","mail.domain.com","25","0","","","0","0","","0");
INSERT INTO Configuration VALUES("Current","10","10.10.10.10.88","255.255.255.255","10.10.10.11.22","10.10.10.5.33","10.10.10.2","mail.domain.com","34","0","admin","sdfsdfsf","1","0","dsadasf@gmail.com","1");



