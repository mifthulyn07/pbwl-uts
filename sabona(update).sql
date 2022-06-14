/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.24-MariaDB : Database - db_sabona
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_sabona` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_sabona`;

/*Table structure for table `tb_anggota` */

DROP TABLE IF EXISTS `tb_anggota`;

CREATE TABLE `tb_anggota` (
  `id_agt` int(11) NOT NULL AUTO_INCREMENT,
  `nama_agt` varchar(100) DEFAULT NULL,
  `tlp_agt` varchar(100) DEFAULT NULL,
  `almt_agt` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_agt`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_anggota` */

insert  into `tb_anggota`(`id_agt`,`nama_agt`,`tlp_agt`,`almt_agt`) values 
(1,'Junaidi','0813','Jl.Bintang Timur'),
(2,'Nadia','0813','Jl.Maharani'),
(3,'Mumun','0821','Blok B Barat'),
(9,'Astuti','0812','Perumahan Indah'),
(10,'Putri','0833','Gg.Kemangi');

/*Table structure for table `tb_arisan` */

DROP TABLE IF EXISTS `tb_arisan`;

CREATE TABLE `tb_arisan` (
  `id_ars` int(11) NOT NULL AUTO_INCREMENT,
  `idprd_ars` int(11) DEFAULT NULL,
  `jns_ars` varchar(100) DEFAULT NULL,
  `nama_ars` varchar(100) DEFAULT NULL,
  `tgl_ars` date DEFAULT NULL,
  `masuk_ars` bigint(20) DEFAULT NULL,
  `keluar_ars` bigint(20) DEFAULT NULL,
  `ket_ars` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_ars`),
  KEY `idprd_ars` (`idprd_ars`),
  CONSTRAINT `idprd_ars` FOREIGN KEY (`idprd_ars`) REFERENCES `tb_periode` (`id_prd`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_arisan` */

insert  into `tb_arisan`(`id_ars`,`idprd_ars`,`jns_ars`,`nama_ars`,`tgl_ars`,`masuk_ars`,`keluar_ars`,`ket_ars`) values 
(4,1,'Arisan','Keluarga Nurli','2022-05-17',430000,30000,''),
(5,1,'Donasi','Keluarga Mimin','2022-05-10',0,80000,'Nenek Meninggal'),
(7,3,'Biaya Lainnya','Spanduk','2022-05-18',0,30000,''),
(11,3,'Arisan','ggg','0000-00-00',0,0,''),
(22,16,'Arisan','fcngfn','2022-05-13',0,0,''),
(25,16,'Donasi','hiaku','0000-00-00',0,0,'');

/*Table structure for table `tb_bayar` */

DROP TABLE IF EXISTS `tb_bayar`;

CREATE TABLE `tb_bayar` (
  `id_byr` int(11) NOT NULL AUTO_INCREMENT,
  `idars_byr` int(11) DEFAULT NULL,
  `idagt_byr` int(11) DEFAULT NULL,
  `tgl_byr` date DEFAULT NULL,
  `byr` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_byr`),
  KEY `idars_byr` (`idars_byr`),
  KEY `idagt_byr` (`idagt_byr`),
  CONSTRAINT `idagt_byr` FOREIGN KEY (`idagt_byr`) REFERENCES `tb_anggota` (`id_agt`),
  CONSTRAINT `idars_byr` FOREIGN KEY (`idars_byr`) REFERENCES `tb_arisan` (`id_ars`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_bayar` */

insert  into `tb_bayar`(`id_byr`,`idars_byr`,`idagt_byr`,`tgl_byr`,`byr`) values 
(1,NULL,1,'2022-05-11',20000),
(2,NULL,3,'2022-05-13',50000),
(6,NULL,9,'2022-05-02',50000),
(7,NULL,2,'2022-05-24',40000),
(13,22,2,'2022-05-09',50000),
(18,4,2,'2022-05-15',30000),
(19,4,3,'0000-00-00',400000);

/*Table structure for table `tb_biayalainnya` */

DROP TABLE IF EXISTS `tb_biayalainnya`;

CREATE TABLE `tb_biayalainnya` (
  `id_bl` int(11) NOT NULL AUTO_INCREMENT,
  `idars_bl` int(11) DEFAULT NULL,
  `nama_bl` varchar(100) DEFAULT NULL,
  `tgl_bl` date DEFAULT NULL,
  `bl` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_bl`),
  KEY `idars_bl` (`idars_bl`),
  CONSTRAINT `idars_bl` FOREIGN KEY (`idars_bl`) REFERENCES `tb_arisan` (`id_ars`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_biayalainnya` */

insert  into `tb_biayalainnya`(`id_bl`,`idars_bl`,`nama_bl`,`tgl_bl`,`bl`) values 
(1,NULL,'Darurat','2022-05-30',500000),
(2,NULL,'Jalan-Jalan','2022-05-10',40000);

/*Table structure for table `tb_donasi` */

DROP TABLE IF EXISTS `tb_donasi`;

CREATE TABLE `tb_donasi` (
  `id_dns` int(11) NOT NULL AUTO_INCREMENT,
  `idars_dns` int(11) DEFAULT NULL,
  `idagt_dns` int(11) DEFAULT NULL,
  `tgl_dns` date DEFAULT NULL,
  `dns` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_dns`),
  KEY `idars_dns` (`idars_dns`),
  KEY `idagt_dns` (`idagt_dns`),
  CONSTRAINT `idagt_dns` FOREIGN KEY (`idagt_dns`) REFERENCES `tb_anggota` (`id_agt`),
  CONSTRAINT `idars_dns` FOREIGN KEY (`idars_dns`) REFERENCES `tb_arisan` (`id_ars`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_donasi` */

insert  into `tb_donasi`(`id_dns`,`idars_dns`,`idagt_dns`,`tgl_dns`,`dns`) values 
(1,25,9,'2022-05-15',30000),
(3,25,1,'2022-05-17',40000),
(5,5,2,'2022-05-18',80000);

/*Table structure for table `tb_periode` */

DROP TABLE IF EXISTS `tb_periode`;

CREATE TABLE `tb_periode` (
  `id_prd` int(11) NOT NULL AUTO_INCREMENT,
  `nama_prd` varchar(100) DEFAULT NULL,
  `mulaitgl_prd` date DEFAULT NULL,
  PRIMARY KEY (`id_prd`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_periode` */

insert  into `tb_periode`(`id_prd`,`nama_prd`,`mulaitgl_prd`) values 
(1,'Periode I','2019-08-29'),
(3,'Periode II','2022-05-28'),
(16,'Periode III','2022-05-10');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`username`,`password`) values 
('admin','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
