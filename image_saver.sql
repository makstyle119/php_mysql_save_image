CREATE TABLE `image_saver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(225) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_by` varchar(225) NOT NULL,
  `created_on` date NOT NULL,
  `updated_by` int(225) NOT NULL,
  `updated_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

