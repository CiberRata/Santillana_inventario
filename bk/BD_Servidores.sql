DROP TABLE IF EXISTS `T_Servidores`;
CREATE TABLE IF NOT EXISTS `T_Servidores`(
  `id_servidor` int NOT NULL PRIMARY KEY,
  `nombre_dns_servidor` varchar(50),
  `IP_servidor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de servidores';


DROP TABLE IF EXISTS `T_detalle_servidor`;
CREATE TABLE IF NOT EXISTS `T_detalle_servidor`(
  `id_servidor` int NOT NULL,
  `id_detalle_servidor` int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `cantidad_discos_detalle_servidor` int NOT NULL,
  `memoria_ram_detalle_servidor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de detalles del servidor';


Alter table T_detalle_servidor ADD CONSTRAINT FK_servidor_detalle FOREIGN KEY (id_servidor) REFERENCES T_Servidores(id_servidor);

DROP TABLE IF EXISTS `T_detalle_servidor_discos`;
CREATE TABLE IF NOT EXISTS `T_detalle_servidor_discos`(
  `id_servidor` int NOT NULL,
  `id_detalle_servidor` int AUTO_INCREMENT NOT NULL primary key,
  `total_espacio_servidor` double(10,2) NOT NULL DEFAULT 0,
  `total_usado_servidor` double(10,2) NOT NULL default 0,
  `total_libre` double(10,2) NOT NULL default 0,
  `nombre_unidad` varchar(50) NOT NULL default 0,
  `comentarios` varchar(100) NOT NULL default 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de detalles del servidor';

/*ALTER TABLE T_detalle_servidor_discos
ADD CONSTRAINT DF_Unidad 
DEFAULT 'SIN_UNIDAD' FOR nombre_unidad;
*/
ALTER TABLE T_detalle_servidor_discos ADD CONSTRAINT FK_servidor_detalle_T FOREIGN KEY (id_servidor) REFERENCES T_Servidores(id_servidor);


/*Procedimiento para AGREGAR MYSQL*/

DELIMITER $$
DROP PROCEDURE IF EXISTS SP_Insertar_servidor$$
CREATE PROCEDURE SP_Insertar_servidor(IN id_servidor int,nombre_dns_servidor varchar(30),
Ip_servidor varchar (30), 
cantidad_discos_detalle_Servidor int,
memoria_ram_detalle_servidor int,                                      
total_espacio_servidor decimal (10,2),                                     
total_usado_servidor decimal (10,2),                                      
nombre_unidad varchar (50),  
comentarios varchar (100),
total_espacio_servidor2 decimal (10,2),
total_usado_servidor2 decimal (10,2),
nombre_unidad2 varchar (50),
comentarios2 varchar (100),     
total_espacio_servidor3 decimal (10,2),
total_usado_servidor3 decimal (10,2),
nombre_unidad3 varchar (50),
comentarios3 varchar (100),
total_espacio_servidor4 decimal (10,2),
total_usado_servidor4 decimal (10,2),
nombre_unidad4 varchar (50),
comentarios4 varchar (100),
total_espacio_servidor5 decimal (10,2),
total_usado_servidor5 decimal (10,2),
nombre_unidad5 varchar (50),
comentarios5 varchar (100),
total_espacio_servidor6 decimal (10,2),
total_usado_servidor6 decimal (10,2),
nombre_unidad6 varchar (50),
comentarios6 varchar (100),
total_espacio_servidor7 decimal (10,2),
total_usado_servidor7 decimal (10,2),
nombre_unidad7 varchar (50),
comentarios7 varchar (100),
total_espacio_servidor8 decimal (10,2),
total_usado_servidor8 decimal (10,2),
nombre_unidad8 varchar (50),
comentarios8 varchar (100))
BEGIN
    Insert into T_Servidores (id_servidor,nombre_dns_servidor,IP_servidor) values (id_servidor,nombre_dns_servidor,Ip_servidor);
    Insert into T_detalle_servidor (id_servidor,cantidad_discos_detalle_servidor,memoria_ram_detalle_servidor) values (id_servidor,cantidad_discos_detalle_Servidor,memoria_ram_detalle_servidor);


    Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (id_servidor,total_espacio_servidor,total_usado_servidor,	(total_espacio_servidor - total_usado_servidor),nombre_unidad,comentarios);


    Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values 				     (id_servidor,total_espacio_servidor2,total_usado_servidor2,(total_espacio_servidor2 - total_usado_servidor2),nombre_unidad2,comentarios2);
    Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (id_servidor,total_espacio_servidor3,total_usado_servidor3,(total_espacio_servidor3 - total_usado_servidor3),nombre_unidad3,comentarios3);
    Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (id_servidor,total_espacio_servidor4,total_usado_servidor4,(total_espacio_servidor4 - total_usado_servidor4),nombre_unidad4,comentarios4);
    Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (id_servidor,total_espacio_servidor5,total_usado_servidor5,(total_espacio_servidor5 - total_usado_servidor5),nombre_unidad5,comentarios5);
    Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (id_servidor,total_espacio_servidor6,total_usado_servidor6,(total_espacio_servidor6 - total_usado_servidor6),nombre_unidad6,comentarios6);
    Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (id_servidor,total_espacio_servidor7,total_usado_servidor7,(total_espacio_servidor7 - total_usado_servidor7),nombre_unidad7,comentarios7);
    Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (id_servidor,total_espacio_servidor8,total_usado_servidor8,(total_espacio_servidor8 - total_usado_servidor8),nombre_unidad8,comentarios8);

END$$
DELIMITER $$

CREATE VIEW V_mostrar_servidores AS SELECT TS.id_servidor, TDSD.id_detalle_servidor, TS.IP_servidor, TS.nombre_dns_servidor, TDS.cantidad_discos_detalle_servidor, TDS.memoria_ram_detalle_servidor, TDSD.total_espacio_servidor, 
TDSD.total_usado_servidor, TDSD.total_libre, TDSD.nombre_unidad,TDSD.comentarios FROM T_Servidores TS inner JOIN T_detalle_servidor TDS ON TS.id_servidor= TDS.id_servidor inner JOIN T_detalle_servidor_discos TDSD ON 
TS.id_servidor = TDSD.id_servidor where nombre_unidad != '';


CALL SP_Insertar_servidor ('1','NPEFSPRO01','10.137.192.74','2','4','39.4','32.5','C:/(OS)','','3064.76','2467.84','D:/(DATOS_NORMA)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('2','SPEFSSANPRO01','10.137.192.73','3','4','39.4','31.3','C:/(OS)','','2037.76','1525.76','D:/(DATOS_SANTILLANA)','','1525.76','844','E:/(DATOS2)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('3','SPEFSMIN1','10.137.192.174','3','16','59.6','31.3','C:/(OS)','','5621.76','4823.04','E:/(DATA)','','799','166','F:/(DATOS_2)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('4','SPEFSHIST01','10.137.192.95','3','4','69.3','44.1','C:/(OS)','','2549.76','1935.36','D:/(HISTORICO_01)','','2549.76','1136.64','E:/(HISTORICO_02)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('5','SPEFSEDPRO01','10.137.192.77','3','4','69.3','44.1','C:/(OS)','','2140.16','1669.12','D:/(DATA)','','499','100','F:/(RECURSOS DIGITALES)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('6','SPEFSTEPRO01','10.137.192.75','2','4','69.3','25.3','C:/(OS)','','2037.76','1474.56','D:/(DATA)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('7','NPEAPPNAVDES01','10.137.192.64','6','14','59.5','47.6','C:/(OS)','','39.9','20.2','L:/(LOGS)','','269','163','M:/(DATA)','','27.9','13.7','P:/(PAGEFILE)','','14.9','5.05','T:/(TEMP)','','74.9','58','Z:/(BACKUP)','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('8','SPEDCHP01','10.137.192.42','2','8','79.5','54.4','C:/(OS)','','79.5','60.1','P:/(PAGEFILE)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('9','SPEEDI02','10.137.192.94','1','16','69.6','56.3','C:/(OS)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('10','SPIMP01','10.137.192.22','2','16','64.6','47.8','C:/(OS)','','49.9','1.49','D:/(DATA)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('11','SPENAVTEST2016','10.137.192.46','2','32','149','57.2','C:/(OS)','','409','300','D:/(DATA)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('12','SPAPPSEXDES1','10.137.192.71','4','24','99.5','88.2','C:/(OS)','','11.9','7.26','L:/(LOGS)','','29.9','19.1','M:/(DATA)','','9.99','5.04','T:/(TEMP)','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('13','SPEAPPSEXPRO1','10.137.192.67','1','16','229','115','C:/(OS)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('14','SPEDPSCCM01','10.137.192.24','2','16','49.4','32.4','C:/(OS)','','249','106','E:/(SP_SCCM)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('15','SPESAEMOVILES','10.137.192.15','4','16','699.5','60','C:/(OS)','','69.9','58','E:/(DATOS)','','29.9','2.25','F:/(LOGS)','','9.99','7.85','G:/(PAGEFILE)','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('16','SPEIND03','10.137.192.76','5','16','79.3','43.3','C:/(OS)','','39.9','0.736','E:/(E)','','39.9','1.41','F:/(F)','','39.9','1.41','G:/(G)','','39.9','0.532','H:/(H)','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('17','SPEWEBSNAVPRO1','10.137.192.10','2','16','79.3','43.3','C:/(OS)','','19.9','2.22','D:/(DATA)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('18','SPESQLNAV01','10.137.192.54','6','24','79.5','41.2','C:/(OS)','','149','131','E:/(DATA)','','49.9','35.4','F:/(LOG)','','29.9','15.7','P:/(PAGEFILE)','','14.9','11.8','T:/(TEMPBD)','','149','88.2','U:/(BACKUP)','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('19','SPEVSQLMIN01','10.137.192.98','6','12','49.5','37.9','C:/(OS)','','129','19','F:/(DATA)','','44.8','8.01','E:/(LOG)','','9.96','5.06','G:/(TEMPBV)','','1.96','0.053','Q:/(QUORUM)','','1.96','0.049','W:/(DTC)','','19.8','14.2','X:/(BCK)','','0','0','','');
CALL SP_Insertar_servidor ('20','SPEAPPBIPRO','10.137.192.184','5','8','99.5','84.9','C:/(OS)','','9.96','1.12','L:/(LOG)','','49.8','9.43','M:/(DATOS)','','9.96','5.04','T:/(TEMPBD)','','29.8','1.98','Z:/(BACKUP)','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('21','SPEFACTURACION','10.137.192.27','2','40','89.6','65','C:/(OS)','','174','118','D:/(DATA BASE)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('22','SPEVSQLMIN02','10.137.192.99','1','12','69.5','65','C:/(OS)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('23','NPEAPPNAVPRO01','10.137.192.61','3','32','99.5','71.6','C:/(OS)','','69.9','0.103','E:/(DATA)','','49.9','31.3','P:/(PAGE)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('24','NPEAPPFACPRO01','10.137.192.62','6','16','89.5','76.2','C:/(OS)','','24.9','12.5','L:/(LOGS)','','99.9','29.1','M:/(DATA)','','13.9','6.88','P:/(PAGEFILE)','','14.9','3.05','T:/(TEMPBD)','','74.9','5.68','Z:/(BACKUP)','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('25','NPESQLNAVPRO01','10.137.192.63','6','24','59.5','46.2','C:/(OS)','','29.9','17.3','L:/(LOGS)','','179','139','M:/(DATA)','','27.9','13.7','P:/(PAGEFILE)','','24.9','5.66','T:/(TEMPBD)','','79.9','46.3','Z:/(BACKUP)','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('26','SPERR.HH','10.137.192.69','1','16','299','147','C:/(OS)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('27','SPESQLSEXPRO1','10.137.192.68','5','24','69.5','37.8','C:/(OS)','','24.9','10.9','L:/(LOG)','','199','159','M:/(DATA)','','19.9','9.15','T:/(TEMPBD)','','169','137','B:/(BACKUP)','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('28','SPERRHH01','10.137.192.108','5','16','126','79.9','C:/(OS)','','49.8','6.38','D:/(BBDD)','','9.96','0.66','L:/(LOG)','','9.96','0.66','T:/(TEMP)','','49.8','6','B:/(BACKUP)','','0','0','','','0','0','','','0','0','','');
CALL SP_Insertar_servidor ('29','SPENAV2016','10.137.192.32','3','40','199','126','C:/(OS)','','299','109','D:/(DATA)','','19.8','0.064','E:/(Datos2)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','');

