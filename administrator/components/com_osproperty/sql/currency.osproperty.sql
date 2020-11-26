CREATE TABLE IF NOT EXISTS `#__osrs_currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(100) NOT NULL,
  `currency_code` varchar(3) NOT NULL,
  `currency_symbol` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `#__osrs_currencies` VALUES (1, 'Argentina Peso', 'ARS', '&#36;',1),
(2, 'Australia Dollar', 'AUD', '&#36;',1),
(3, 'Bahamas Dollar', 'BSD', '&#36;',1),
(4, 'Belarus Ruble', 'BYR', '&#112;&#46;',1),
(5, 'Bolivia Boliviano', 'BOB', '&#36;&#98;',1),
(6, 'Bulgaria Lev', 'BGN', '&#1083;&#1074;',1),
(7, 'Brazil Real', 'BRL', '&#82;&#36;',1),
(8, 'Brunei Darussalam Dollar', 'BND', '&#36;',1),
(10, 'Canada Dollar', 'CAD', '&#36;',1),
(11, 'Chile Peso', 'CLP', '&#36;',1),
(12, 'China Yuan Renminbi', 'CNY', '&#165;',1),
(13, 'Colombia Peso', 'COP', '&#36;',1),
(14, 'Cuba Peso', 'CUP', '&#8369;',1),
(15, 'Czech Republic Koruna', 'CZK', '&#75;&#269;',1),
(16, 'Denmark Krone', 'DKK', '&#107;&#114;',1),
(17, 'Egypt Pound', 'EGP', '&#163;',1),
(18, 'Euro Member Countries', 'EUR', '&#8364;',1),
(19, 'Falkland Islands (Malvinas) Pound', 'FKP', '&#163;',1),
(20, 'Fiji Dollar', 'FJD', '&#36;',1),
(21, 'Hong Kong Dollar', 'HKD', '&#36;',1),
(22, 'Hungary Forint', 'HUF', '&#70;&#116;',1),
(23, 'Iceland Krona', 'ISK', '&#107;&#114;',1),
(24, 'India Rupee', 'INR', '&#8377;',1),
(25, 'Indonesia Rupiah', 'IDR', '&#82;&#112;',1),
(27, 'Israel Shekel', 'ILS', '&#8362;',1),
(28, 'Japan Yen', 'JPY', '&#165;',1),
(29, 'Korea (North) Won', 'KPW', '&#8361;',1),
(30, 'Korea (South) Won', 'KRW', '&#8361;',1),
(32, 'Malaysia Ringgit', 'MYR', '&#82;&#77;',1),
(33, 'Mexico Peso', 'MXN', '&#36;',1),
(34, 'Nepal Rupee', 'NPR', '&#8360;',1),
(35, 'Netherlands Antilles Guilder', 'ANG', '&#402;',1),
(36, 'New Zealand Dollar', 'NZD', '&#36;',1),
(37, 'Nicaragua Cordoba', 'NIO', '&#67;&#36;',1),
(38, 'Pakistan Rupee', 'PKR', '&#8360;',1),
(39, 'Panama Balboa', 'PAB', '&#66;&#47;&#46;',1),
(40, 'Paraguay Guarani', 'PYG', '&#71;&#115;',1),
(41, 'Peru Nuevo Sol', 'PEN', '&#83;&#47;&#46;',1),
(42, 'Philippines Peso', 'PHP', '&#8369;',1),
(43, 'Romania New Leu', 'RON', '&#108;&#101;&#105;',1),
(44, 'Russia Ruble', 'RUB', '&#1088;&#1091;&#1073',1),
(45, 'Saint Helena Pound', 'SHP', '&#163;',1),
(46, 'Saudi Arabia Riyal', 'SAR', '&#65020;',1),
(47, 'Singapore Dollar', 'SGD', '&#36;',1),
(48, 'Solomon Islands Dollar', 'SBD', '&#36;',1),
(49, 'South Africa Rand', 'ZAR', '&#82;',1),
(50, 'Sri Lanka Rupee', 'LKR', '&#8360;',1),
(51, 'Sweden Krona', 'SEK', '&#107;&#114;',1),
(52, 'Switzerland Franc', 'CHF', '&#67;&#72;&#70;',1),
(53, 'Taiwan New Dollar', 'TWD', '&#78;&#84;&#36;',1),
(54, 'Thailand Baht', 'THB', '&#3647;',1),
(55, 'Turkey Lira', 'TRY', '&#84;&#76;',1),
(56, 'United Kingdom Pound', 'GBP', '&#163;',1),
(57, 'United States Dollar', 'USD', '&#36;',1),
(58, 'Uzbekistan Som', 'UZS', '&#1083;&#1074;',1),
(59, 'Venezuela Bolivar Fuerte', 'VEF', '&#66;&#115; ',1),
(60, 'Viet Nam Dong', 'VND', '&#8363; ',1),
(61, 'Zimbabwe Dollar', 'ZWD', '&#90;&#36;',1);