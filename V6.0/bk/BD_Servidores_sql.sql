create database DB_Servidores
GO

/*DROP TABLE T_Servidores
DROP TABLE T_detalle_servidor
DROP TABLE T_detalle_servidor_discos
*/

IF OBJECT_ID ('T_servidores') IS NOT NULL
DROP TABLE T_Servidores
GO
Create table T_Servidores(
id_servidor int not null,
nombre_dns_servidor varchar (30),
IP_servidor varchar(30)
);

Alter table T_Servidores add primary key (id_servidor)

IF OBJECT_ID ('T_detalle_servidor') IS NOT NULL
DROP TABLE T_detalle_servidor
GO
create table T_detalle_servidor(
id_servidor int not null,
id_detalle_servidor int IDENTITY(1,1) not null,
cantidad_discos_detalle_servidor int not null,
memoria_ram_detalle_servidor int not null
)

Alter table T_detalle_servidor add primary key (id_detalle_servidor),
CONSTRAINT FK_servidor_detalle FOREIGN KEY (id_servidor) REFERENCES T_Servidores(id_servidor)

IF OBJECT_ID ('T_detalle_servidor_discos') IS NOT NULL
DROP TABLE T_detalle_servidor_discos
GO
create table T_detalle_servidor_discos(
id_servidor int not null,
id_detalle_servidor int IDENTITY(1,1) not null,
total_espacio_servidor decimal (10,2) not null default 0,
total_usado_servidor decimal (10,2) not null default 0,
total_libre decimal (10,2) not null default 0,
nombre_unidad varchar (50),
comentarios varchar (100)
)

ALTER TABLE T_detalle_servidor_discos
ADD CONSTRAINT DF_Unidad 
DEFAULT 'SIN_UNIDAD' FOR nombre_unidad;

Alter table T_detalle_servidor_discos add primary key (id_detalle_servidor)

ALTER TABLE T_detalle_servidor_discos ADD CONSTRAINT FK_servidor_detalle_T FOREIGN KEY (id_servidor) REFERENCES T_Servidores(id_servidor)

/*ALTER TABLE T_detalle_Servidor_discos ADD CONSTRAINT FK_servidor_detalle_DT FOREIGN KEY (id_detalle_servidor) REFERENCES T_detalle_servidor(id_detalle_servidor)*/


Select * from T_Servidores
Select * from T_detalle_servidor
Select * from T_detalle_servidor_discos

/*Pruebas con inserts*/


/*Pruebas de insert para Servidor 1 NPEFSPRO001*/

Insert into T_Servidores (id_servidor,nombre_dns_servidor,IP_servidor) values ('1','NPEFSPRO01','10.137.192.74');
Insert into T_detalle_servidor (id_servidor,cantidad_discos_detalle_servidor,memoria_ram_detalle_servidor) values ('1','2','4');
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values ('1','39.4','3.8','8.65','C:/(OS)','');
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre, nombre_unidad, comentarios) values ('1','3061.76','2426.88','643','D:/(DATOS_NORMA)','');

Exec SP_Insertar_servidor '1','NPEFSPRO01','10.137.192.74','2','4','39.4','32.5','C:/(OS)','','3064.76','2467.84','D:/(DATOS_NORMA)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '2','SPEFSSANPRO01','10.137.192.73','3','4','39.4','31.3','C:/(OS)','','2037.76','1525.76','D:/(DATOS_SANTILLANA)','','1525.76','844','E:/(DATOS2)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';



/*Pruebas sin nombre unidad*/
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre, comentarios) values ('1','3061.76','2426.88','643','');

/*Inner join general*/
SELECT * FROM T_Servidores TS inner JOIN T_detalle_servidor TDS ON TS.id_servidor= TDS.id_servidor inner JOIN T_detalle_servidor_discos TDSD ON TS.id_servidor = TDSD.id_servidor


/*Pruebas de insert para Servidor 1 SPEFSSANPRO01*/


Insert into T_Servidores (id_servidor,nombre_dns_servidor,IP_servidor) values ('2','SPEFSSANPRO01','10.137.192.73');
Insert into T_detalle_servidor (id_servidor,cantidad_discos_detalle_servidor,memoria_ram_detalle_servidor) values ('2','3','4');
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values ('2','39.4','29.7','9.72','C:/(OS)','');
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad, comentarios) values ('2','2037.76','1361.92','683','D:/(DATOS_SANTILLANA)','');
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre, nombre_unidad, comentarios) values ('2','1525.76','822','713','E:/(DATOS2)','');




/*Inner join más especifico*/

SELECT TS.id_servidor,TS.IP_servidor, TS.nombre_dns_servidor, TDS.cantidad_discos_detalle_servidor, TDS.memoria_ram_detalle_servidor, TDSD.total_espacio_servidor, TDSD.total_usado_servidor, TDSD.total_libre, TDSD.nombre_unidad,
TDSD.comentarios FROM T_Servidores TS inner JOIN T_detalle_servidor TDS ON TS.id_servidor= TDS.id_servidor inner JOIN T_detalle_servidor_discos TDSD ON TS.id_servidor = TDSD.id_servidor where nombre_unidad != ''

SELECT TS.id_servidor,TS.IP_servidor, TS.nombre_dns_servidor, TDS.cantidad_discos_detalle_servidor, TDS.memoria_ram_detalle_servidor, TDSD.total_espacio_servidor, TDSD.total_usado_servidor, TDSD.total_libre, TDSD.nombre_unidad,
TDSD.comentarios FROM T_Servidores TS inner JOIN T_detalle_servidor TDS ON TS.id_servidor= TDS.id_servidor inner JOIN T_detalle_servidor_discos TDSD ON TS.id_servidor = TDSD.id_servidor 



/*INSERTAR CON MÁXIMO 9 DISCOS*/


IF OBJECT_ID('SP_Insertar_servidor') IS NOT NULL
BEGIN 
DROP PROC SP_Insertar_servidor 
END
GO
CREATE PROCEDURE SP_Insertar_servidor
	   @id_servidor int,
	   @nombre_dns_servidor varchar(30),
	   @Ip_servidor	varchar(30),
	   @cantidad_discos_detalle_Servidor int,
	   @memoria_ram_detalle_servidor int,
	   @total_espacio_servidor decimal (10,2),
	   @total_usado_servidor decimal (10,2),
	   /*@total_libre decimal (10,2),*/
	   @nombre_unidad varchar (50),
	   @comentarios varchar (100),
	   @total_espacio_servidor2 decimal (10,2),
	   @total_usado_servidor2 decimal (10,2),
	   /*@total_libre2 decimal (10,2),*/
	   @nombre_unidad2 varchar (50),
	   @comentarios2 varchar (100),
	   @total_espacio_servidor3 decimal (10,2),
	   @total_usado_servidor3 decimal (10,2),
	   /*@total_libre3 decimal (10,2),*/
	   @nombre_unidad3 varchar (50),
	   @comentarios3 varchar (100),
	   @total_espacio_servidor4 decimal (10,2),
	   @total_usado_servidor4 decimal (10,2),
	   /*@total_libre4 decimal (10,2),*/
	   @nombre_unidad4 varchar (50),
	   @comentarios4 varchar (100),
	   @total_espacio_servidor5 decimal (10,2),
	   @total_usado_servidor5 decimal (10,2),
	   /*@total_libre5 decimal (10,2),*/
	   @nombre_unidad5 varchar (50),
	   @comentarios5 varchar (100),
	   @total_espacio_servidor6 decimal (10,2),
	   @total_usado_servidor6 decimal (10,2),
	   /*@total_libre6 decimal (10,2),*/
	   @nombre_unidad6 varchar (50),
	   @comentarios6 varchar (100),
	   @total_espacio_servidor7 decimal (10,2),
	   @total_usado_servidor7 decimal (10,2),
	   /*@total_libre7 decimal (10,2),*/
	   @nombre_unidad7 varchar (50),
	   @comentarios7 varchar (100),
	   @total_espacio_servidor8 decimal (10,2),
	   @total_usado_servidor8 decimal (10,2),
	   /*@total_libre8 decimal (10,2),*/
	   @nombre_unidad8 varchar (50),
	   @comentarios8 varchar (100)
	   /*Se debe agregar hasta 10 para tener un máximo de capacidad de 10 unidades */
	 
AS
BEGIN

Insert into T_Servidores (id_servidor,nombre_dns_servidor,IP_servidor) values (@id_servidor,@nombre_dns_servidor,@Ip_servidor);
Insert into T_detalle_servidor (id_servidor,cantidad_discos_detalle_servidor,memoria_ram_detalle_servidor) values (@id_servidor,@cantidad_discos_detalle_Servidor,@memoria_ram_detalle_servidor);


Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (@id_servidor,@total_espacio_servidor,@total_usado_servidor,(@total_espacio_servidor - @total_usado_servidor),@nombre_unidad,@comentarios);


Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (@id_servidor,@total_espacio_servidor2,@total_usado_servidor2,(@total_espacio_servidor2 - @total_usado_servidor2),@nombre_unidad2,@comentarios2);
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (@id_servidor,@total_espacio_servidor3,@total_usado_servidor3,(@total_espacio_servidor3 - @total_usado_servidor3),@nombre_unidad3,@comentarios3);
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (@id_servidor,@total_espacio_servidor4,@total_usado_servidor4,(@total_espacio_servidor4 - @total_usado_servidor4),@nombre_unidad4,@comentarios4);
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (@id_servidor,@total_espacio_servidor5,@total_usado_servidor5,(@total_espacio_servidor5 - @total_usado_servidor5),@nombre_unidad5,@comentarios5);
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (@id_servidor,@total_espacio_servidor6,@total_usado_servidor6,(@total_espacio_servidor6 - @total_usado_servidor6),@nombre_unidad6,@comentarios6);
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (@id_servidor,@total_espacio_servidor7,@total_usado_servidor7,(@total_espacio_servidor7 - @total_usado_servidor7),@nombre_unidad7,@comentarios7);
Insert into T_detalle_servidor_discos (id_servidor, total_espacio_servidor, total_usado_servidor, total_libre,nombre_unidad,comentarios) values (@id_servidor,@total_espacio_servidor8,@total_usado_servidor8,(@total_espacio_servidor8 - @total_usado_servidor8),@nombre_unidad8,@comentarios8);


 

END

/*INSERT DE SELECT GENERAL*/
IF OBJECT_ID('V_mostrar_servidores') IS NOT NULL
BEGIN 
DROP VIEW V_mostrar_servidores 
END
GO
CREATE VIEW V_mostrar_servidores AS SELECT TS.id_servidor, TDSD.id_detalle_servidor, TS.IP_servidor, TS.nombre_dns_servidor, TDS.cantidad_discos_detalle_servidor, TDS.memoria_ram_detalle_servidor, TDSD.total_espacio_servidor, 
TDSD.total_usado_servidor, TDSD.total_libre, TDSD.nombre_unidad,TDSD.comentarios FROM T_Servidores TS inner JOIN T_detalle_servidor TDS ON TS.id_servidor= TDS.id_servidor inner JOIN T_detalle_servidor_discos TDSD ON 
TS.id_servidor = TDSD.id_servidor where nombre_unidad != ''

select * from T_detalle_servidor_discos
Select * from V_mostrar_servidores

Select * from V_mostrar_servidores

Select count (*) As conteo from V_mostrar_servidores

Select * from V_mostrar_servidores order by nombre_dns_servidor offset 10 ROWS FETCH NEXT 15 ROWS ONLY
SELECT * from V_mostrar_servidores order by nombre_dns_servidor offset = 15 ROWS FETCH NEXT = 16 ROWS ONLY

SELECT * FROM V_mostrar_servidores  ORDER BY nombre_dns_servidor offset 10 ROWS FETCH NEXT 10 ROWS ONLY


IF OBJECT_ID('SP_Mostrar_Servidores') IS NOT NULL
BEGIN 
DROP PROC SP_Mostrar_Servidores 
END
GO
CREATE PROCEDURE SP_Mostrar_Servidores

 
AS
BEGIN

Select * from V_mostrar_servidores

END


Exec SP_Mostrar_Servidores


/*Vista para el select servidores*/


Select * from V_mostrar_servidores


/*SP para actualizar detalle de discos*/

IF OBJECT_ID('SP_Actualizar_detalle_servidor_discos') IS NOT NULL
BEGIN 
DROP PROC SP_Actualizar_detalle_servidor_discos
END
GO
CREATE PROCEDURE SP_Actualizar_detalle_servidor_discos
	   @id_servidor int,
	   @id_detalle_servidor int,
	   @total_espacio_servidor decimal (10,2),
	   @total_usado_servidor decimal (10,2),
	   @nombre_unidad varchar (50),
	   @comentarios varchar (100)
	   
	   /*Se debe agregar hasta 10 para tener un máximo de capacidad de 10 unidades */
	 
AS
BEGIN

update T_detalle_servidor_discos set id_servidor = @id_servidor, total_espacio_servidor = @total_espacio_servidor, total_usado_servidor = @total_usado_servidor, nombre_unidad = @nombre_unidad, comentarios = @comentarios
where id_detalle_servidor = @id_detalle_servidor and id_servidor = @id_servidor


END

/*Pruebas de actualizar con procedimiento*/

Exec SP_Actualizar_detalle_servidor_discos '1','1','39.4','32.5','C:/(OS)',''

Exec SP_Mostrar_Servidores
Select * from T_detalle_servidor_discos

/*SP para actualizar detalle*/

IF OBJECT_ID('SP_Actualizar_detalle_servidor') IS NOT NULL
BEGIN 
DROP PROC SP_Actualizar_detalle_servidor
END
GO
CREATE PROCEDURE SP_Actualizar_detalle_servidor
	   @id_servidor int,
	   /**@id_detalle_servidor int,**/
	   @cantidad_discos_detalle int,
	   @memoria_ram_detalle_servidor int
	   
	   
	   /*Se debe agregar hasta 10 para tener un máximo de capacidad de 10 unidades */
	 
AS
BEGIN

update T_detalle_servidor set id_servidor = @id_servidor, cantidad_discos_detalle_servidor = @cantidad_discos_detalle, memoria_ram_detalle_servidor = @memoria_ram_detalle_servidor
where id_servidor = @id_servidor and id_detalle_servidor = @id_servidor


END

Select * from T_detalle_servidor

Exec SP_Actualizar_detalle_servidor '1','2','4'


/*Pruebas para actualizar nombre e ip del servidor*/

IF OBJECT_ID('SP_Actualizar_servicio') IS NOT NULL
BEGIN 
DROP PROC SP_Actualizar_servicio
END
GO
CREATE PROCEDURE SP_Actualizar_servicio
	   @id_servidor int,
	   /**@id_detalle_servidor int,**/
	   @nombre_dns_servidor varchar(30),
	   @IP_servidor varchar (30)
	   
	   
	   /*Se debe agregar hasta 10 para tener un máximo de capacidad de 10 unidades */
	 
AS
BEGIN

update T_Servidores set id_servidor = @id_servidor, nombre_dns_servidor = @nombre_dns_servidor, IP_servidor = @IP_servidor
where id_servidor = @id_servidor


END


Exec SP_Actualizar_servicio '1','NPEFSPRO01','10.137.192.74'

Select * from T_Servidores

/*Pruebas de procedimiento para buscar servidor*/

select * from V_mostrar_servidores

IF OBJECT_ID('SP_Buscar_servidor') IS NOT NULL
BEGIN 
DROP PROC SP_Buscar_servidor
END
GO
CREATE PROCEDURE SP_Buscar_servidor


	   @nombre_dns_servidor varchar(30),
	   @IP_servidor varchar (30)
	   
	   
	   /*Se debe agregar hasta 10 para tener un máximo de capacidad de 10 unidades */
	 
AS
BEGIN

Select * from V_mostrar_servidores where nombre_dns_servidor = @nombre_dns_servidor or IP_servidor = @IP_servidor

Exec SP_Buscar_servidor '','10.137.192.74'

END

/*Pruebas con Procedimiento*/

Exec SP_Insertar_servidor '3','SPEFSMIN1','10.137.192.174','3','16','59.6','31.3','C:/(OS)','','5621.76','4823.04','E:/(DATA)','','799','166','F:/(DATOS_2)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';

/*Exec SP_Insertar_servidor '4','SPEFSHIST01','10.137.192.95','3','4','69.3','40.4','28.9','C:/(OS)','','2549.76','1935.36','615','D:/(HISTORICO_01)','','2549.76','1136.64','1413.12','E:/(HISTORICO_02)','','0','0','0','','','0','0','0','','','0','0','0','','','0','0','0','','','0','0','0','','';*/
Exec SP_Insertar_servidor '4','SPEFSHIST01','10.137.192.95','3','4','69.3','44.1','C:/(OS)','','2549.76','1935.36','D:/(HISTORICO_01)','','2549.76','1136.64','E:/(HISTORICO_02)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';



/*Pruebas con Procedimiento y con disco de 2, cuando el máximo es 6*/

/*Exec SP_Insertar_servidor '5','SPEFSEDPRO01','10.137.192.77','2','4','69.3','22.4','46.9','C:/(OS)','','2140.16','1955.84','188','D:/(DATA)','','0','0','0','','','0','0','0','','','0','0','0','','','0','0','0','','','0','0','0','','','0','0','0','','';*/
Exec SP_Insertar_servidor '5','SPEFSEDPRO01','10.137.192.77','3','4','69.3','44.1','C:/(OS)','','2140.16','1669.12','D:/(DATA)','','499','100','F:/(RECURSOS DIGITALES)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';

/*Se debe validar para que el SQL coloque por defecto valor 0 cuando no existe unidad y en nombre de unidad salga "SIN UNIDAD"*/
/*Lo anterior se hará a nivel de sistema*/


/*Inserts con SP para completar la BD*/

Exec SP_Insertar_servidor '6','SPEFSTEPRO01','10.137.192.75','2','4','69.3','25.3','C:/(OS)','','2037.76','1474.56','D:/(DATA)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '7','NPEAPPNAVDES01','10.137.192.64','6','14','59.5','47.6','C:/(OS)','','39.9','20.2','L:/(LOGS)','','269','163','M:/(DATA)','','27.9','13.7','P:/(PAGEFILE)','','14.9','5.05','T:/(TEMP)','','74.9','58','Z:/(BACKUP)','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '8','SPEDCHP01','10.137.192.42','2','8','79.5','54.4','C:/(OS)','','79.5','60.1','P:/(PAGEFILE)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '9','SPEEDI02','10.137.192.94','1','16','69.6','56.3','C:/(OS)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '10','SPIMP01','10.137.192.22','2','16','64.6','47.8','C:/(OS)','','49.9','1.49','D:/(DATA)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '11','SPENAVTEST2016','10.137.192.46','2','32','149','57.2','C:/(OS)','','409','300','D:/(DATA)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '12','SPAPPSEXDES1','10.137.192.71','4','24','99.5','88.2','C:/(OS)','','11.9','7.26','L:/(LOGS)','','29.9','19.1','M:/(DATA)','','9.99','5.04','T:/(TEMP)','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '13','SPEAPPSEXPRO1','10.137.192.67','1','16','229','115','C:/(OS)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '14','SPEDPSCCM01','10.137.192.24','2','16','49.4','32.4','C:/(OS)','','249','106','E:/(SP_SCCM)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '15','SPESAEMOVILES','10.137.192.15','4','16','699.5','60','C:/(OS)','','69.9','58','E:/(DATOS)','','29.9','2.25','F:/(LOGS)','','9.99','7.85','G:/(PAGEFILE)','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '16','SPEIND03','10.137.192.76','5','16','79.3','43.3','C:/(OS)','','39.9','0.736','E:/(E)','','39.9','1.41','F:/(F)','','39.9','1.41','G:/(G)','','39.9','0.532','H:/(H)','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '17','SPEWEBSNAVPRO1','10.137.192.10','2','16','79.3','43.3','C:/(OS)','','19.9','2.22','D:/(DATA)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '18','SPESQLNAV01','10.137.192.54','6','24','79.5','41.2','C:/(OS)','','149','131','E:/(DATA)','','49.9','35.4','F:/(LOG)','','29.9','15.7','P:/(PAGEFILE)','','14.9','11.8','T:/(TEMPBD)','','149','88.2','U:/(BACKUP)','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '19','SPEVSQLMIN01','10.137.192.98','6','12','49.5','37.9','C:/(OS)','','129','19','F:/(DATA)','','44.8','8.01','E:/(LOG)','','9.96','5.06','G:/(TEMPBV)','','1.96','0.053','Q:/(QUORUM)','','1.96','0.049','W:/(DTC)','','19.8','14.2','X:/(BCK)','','0','0','','';
Exec SP_Insertar_servidor '20','SPEAPPBIPRO','10.137.192.184','5','8','99.5','84.9','C:/(OS)','','9.96','1.12','L:/(LOG)','','49.8','9.43','M:/(DATOS)','','9.96','5.04','T:/(TEMPBD)','','29.8','1.98','Z:/(BACKUP)','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '21','SPEFACTURACION','10.137.192.27','2','40','89.6','65','C:/(OS)','','174','118','D:/(DATA BASE)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '22','SPEVSQLMIN02','10.137.192.99','1','12','69.5','65','C:/(OS)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '23','NPEAPPNAVPRO01','10.137.192.61','3','32','99.5','71.6','C:/(OS)','','69.9','0.103','E:/(DATA)','','49.9','31.3','P:/(PAGE)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '24','NPEAPPFACPRO01','10.137.192.62','6','16','89.5','76.2','C:/(OS)','','24.9','12.5','L:/(LOGS)','','99.9','29.1','M:/(DATA)','','13.9','6.88','P:/(PAGEFILE)','','14.9','3.05','T:/(TEMPBD)','','74.9','5.68','Z:/(BACKUP)','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '25','NPESQLNAVPRO01','10.137.192.63','6','24','59.5','46.2','C:/(OS)','','29.9','17.3','L:/(LOGS)','','179','139','M:/(DATA)','','27.9','13.7','P:/(PAGEFILE)','','24.9','5.66','T:/(TEMPBD)','','79.9','46.3','Z:/(BACKUP)','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '26','SPERR.HH','10.137.192.69','1','16','299','147','C:/(OS)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '27','SPESQLSEXPRO1','10.137.192.68','5','24','69.5','37.8','C:/(OS)','','24.9','10.9','L:/(LOG)','','199','159','M:/(DATA)','','19.9','9.15','T:/(TEMPBD)','','169','137','B:/(BACKUP)','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '28','SPERRHH01','10.137.192.108','5','16','126','79.9','C:/(OS)','','49.8','6.38','D:/(BBDD)','','9.96','0.66','L:/(LOG)','','9.96','0.66','T:/(TEMP)','','49.8','6','B:/(BACKUP)','','0','0','','','0','0','','','0','0','','';
Exec SP_Insertar_servidor '29','SPENAV2016','10.137.192.32','3','40','199','126','C:/(OS)','','299','109','D:/(DATA)','','19.8','0.064','E:/(Datos2)','','0','0','','','0','0','','','0','0','','','0','0','','','0','0','','';








