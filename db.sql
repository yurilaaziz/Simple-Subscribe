--
-- Table structure for table `guests`
--

CREATE TABLE IF NOT EXISTS `guests` (
`id_guest` int(11) NOT NULL,
  `civility_guest` varchar(5) NOT NULL,
  `firstname_guest` varchar(40) NOT NULL,
  `name_guest` varchar(40) NOT NULL,
  `email_guest` varchar(50) NOT NULL,
  `phone_guest` varchar(16) NOT NULL,
  `birthday_guest` date NOT NULL,
  `website_guest` varchar(80) NOT NULL,
  `date_subscribe` date DEFAULT NULL,
  `ip_subscribe` varchar(15) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
