/*
SQLyog Community
MySQL - 10.4.11-MariaDB : Database - simutu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `user` */

CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(16) DEFAULT NULL,
  `nidn` varchar(30) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `frontTitle` varchar(20) NOT NULL,
  `endTitle` varchar(20) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `pascasarjana` varchar(40) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` text NOT NULL,
  `imageProfile` varchar(100) NOT NULL DEFAULT 'user-default.png',
  `role` int(11) NOT NULL,
  `idprogramstudi` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `isActive` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `nip` (`nip`),
  KEY `idprogramstudi` (`idprogramstudi`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`userid`,`nip`,`nidn`,`firstName`,`lastName`,`frontTitle`,`endTitle`,`gender`,`tanggalLahir`,`pascasarjana`,`jabatan`,`email`,`password`,`token`,`imageProfile`,`role`,`idprogramstudi`,`createdDate`,`status`,`alamat`,`telepon`,`username`,`createdAt`,`createdBy`,`updatedBy`,`updatedAt`,`isActive`) values (1,'343434343','7878','Super','User','Mr','Sp.PD',1,'2011-11-10','Sastra','d','simutu@hexcod.com','e10adc3949ba59abbe56e057f20f883e','','e41bd346fbbdd0c25f1e71e1275b9557.jpg',1,10051,'2021-11-12 02:09:09',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `user`(`userid`,`nip`,`nidn`,`firstName`,`lastName`,`frontTitle`,`endTitle`,`gender`,`tanggalLahir`,`pascasarjana`,`jabatan`,`email`,`password`,`token`,`imageProfile`,`role`,`idprogramstudi`,`createdDate`,`status`,`alamat`,`telepon`,`username`,`createdAt`,`createdBy`,`updatedBy`,`updatedAt`,`isActive`) values (74,'1977070120021220','0001077702','Vivianti','Novita','','S.E., M.Si.',0,'1977-07-01','S2','Lektor','viviantinovita@polmed.ac.id','55131f0ffa8c6ddfc0101afc7400f576','-','',9,10053,'2021-11-18 14:42:13',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `user`(`userid`,`nip`,`nidn`,`firstName`,`lastName`,`frontTitle`,`endTitle`,`gender`,`tanggalLahir`,`pascasarjana`,`jabatan`,`email`,`password`,`token`,`imageProfile`,`role`,`idprogramstudi`,`createdDate`,`status`,`alamat`,`telepon`,`username`,`createdAt`,`createdBy`,`updatedBy`,`updatedAt`,`isActive`) values (76,'1980092420150420','0124098003','Nurlinda','-','Dr.','S.E., Ak., M.Si., CA',0,'1980-09-24','S3','Lektor','nurlinda@polmed.ac.id','96ecc6e2ad8c7835b4839c75e9d8c5bf','-','',4,10048,'2021-11-18 13:32:37',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `user`(`userid`,`nip`,`nidn`,`firstName`,`lastName`,`frontTitle`,`endTitle`,`gender`,`tanggalLahir`,`pascasarjana`,`jabatan`,`email`,`password`,`token`,`imageProfile`,`role`,`idprogramstudi`,`createdDate`,`status`,`alamat`,`telepon`,`username`,`createdAt`,`createdBy`,`updatedBy`,`updatedAt`,`isActive`) values (78,'1981031020150410','-','Junus','Sinuraya','','M.Kom',1,'2021-11-20','-','-','junussinuraya@polmed.ac.id','e5849ddc7bf0abc46e29d96a05883df7','-','-',10,10046,'2021-11-20 04:53:58',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `user`(`userid`,`nip`,`nidn`,`firstName`,`lastName`,`frontTitle`,`endTitle`,`gender`,`tanggalLahir`,`pascasarjana`,`jabatan`,`email`,`password`,`token`,`imageProfile`,`role`,`idprogramstudi`,`createdDate`,`status`,`alamat`,`telepon`,`username`,`createdAt`,`createdBy`,`updatedBy`,`updatedAt`,`isActive`) values (86,'1971061120021220','-','Enda','Yunita Surbakti','','S.E., Ak., M.Si.',1,'2022-01-10','-','-','endayunita@polmed.ac.id','55131f0ffa8c6ddfc0101afc7400f576','-','e41bd346fbbdd0c25f1e71e1275b9558.jpg',3,10053,'2022-01-10 11:46:54',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `user`(`userid`,`nip`,`nidn`,`firstName`,`lastName`,`frontTitle`,`endTitle`,`gender`,`tanggalLahir`,`pascasarjana`,`jabatan`,`email`,`password`,`token`,`imageProfile`,`role`,`idprogramstudi`,`createdDate`,`status`,`alamat`,`telepon`,`username`,`createdAt`,`createdBy`,`updatedBy`,`updatedAt`,`isActive`) values (87,'123456','-','Nursiah','Fitri','','MSI',1,'2022-01-13','-','-','fitri@polmed.ac.id','e10adc3949ba59abbe56e057f20f883e','-','-',3,10053,'2022-01-13 16:32:27',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
