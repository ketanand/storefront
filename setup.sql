CREATE database movies;
use movies;
CREATE TABLE IF NOT EXISTS `movies` (
  `groupid` varchar(25) DEFAULT NULL,
  `productid` varchar(25) NOT NULL,
  `title` varchar(255) NOT NULL,
  `store` varchar(25) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `subcategory` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `price` int(11) NOT NULL,
  `shippingduration` int(11) NOT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE USER 'unbxd'@'%'  IDENTIFIED BY PASSWORD '*E9F5280893B0AA397DAFB579C12353643E4ED9C3';
GRANT ALL PRIVILEGES ON `movies`.* TO 'unbxd'@'%';
