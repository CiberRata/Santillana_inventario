-- Crear la tabla Estados_del_equipo
IF OBJECT_ID ('Estados_del_equipo') IS NOT NULL
DROP TABLE Estados_del_equipo
GO
CREATE TABLE Estados_del_equipo (
    id INT PRIMARY KEY IDENTITY,
    estado_equipo VARCHAR(100)
);

-- Crear la tabla Tipo_equipo
IF OBJECT_ID ('Tipo_equipo') IS NOT NULL
DROP TABLE Tipo_equipo
GO
CREATE TABLE Tipo_equipo (
    id INT PRIMARY KEY IDENTITY,
    tipo_equipo VARCHAR(100)
);

-- Crear la tabla Sede
IF OBJECT_ID ('Sede') IS NOT NULL
DROP TABLE Sede
GO
CREATE TABLE Sede (
    id INT PRIMARY KEY IDENTITY,
    sede VARCHAR(100)
);

-- Crear la tabla Gerencia
IF OBJECT_ID ('Gerencia') IS NOT NULL
DROP TABLE Gerencia
GO
CREATE TABLE Gerencia (
    id INT PRIMARY KEY IDENTITY,
    gerencia VARCHAR(100)
);

-- Crear la tabla SubGerencia
IF OBJECT_ID ('subgerencia') IS NOT NULL
DROP TABLE subgerencia
GO
CREATE TABLE subgerencia (
    id INT PRIMARY KEY IDENTITY,
    subgerencia VARCHAR(100)
);

-- Crear usuario
IF OBJECT_ID ('usuario_anterior') IS NOT NULL
DROP TABLE usuario_anterior
GO
CREATE TABLE usuario_anterior (
    id INT PRIMARY KEY IDENTITY,
    usuario_anterior VARCHAR(100)
);

-- Crear usuario
IF OBJECT_ID ('usuario_anterior') IS NOT NULL
DROP TABLE usuario_anterior
GO
CREATE TABLE usuario_anterior (
    id INT PRIMARY KEY IDENTITY,
    usuario_anterior VARCHAR(100)
);


-- Crear la tabla Equipo
IF OBJECT_ID ('Equipo') IS NOT NULL
DROP TABLE Equipo
GO
CREATE TABLE Equipo (
    id INT IDENTITY,
    nombre VARCHAR(100),
    serie VARCHAR(10) PRIMARY KEY, --La llave primaria es la serie,ya que sólo puede existir una serie globalmente
    usuario_responsable INT NOT NULL,
    usuario_anterior INT NOT NULL,
    estado_equipo INT NOT NULL,
    tipo_equipo INT NOT NULL,
    sede INT NOT NULL,
    gerencia INT NOT NULL,
    subgerencia INT NOT NULL,
    FOREIGN KEY (estado_equipo) REFERENCES Estados_del_equipo(id),
    FOREIGN KEY (tipo_equipo) REFERENCES Tipo_equipo(id),
    FOREIGN KEY (sede) REFERENCES Sede(id),
    FOREIGN KEY (gerencia) REFERENCES Gerencia(id),
	FOREIGN KEY (subgerencia) REFERENCES subgerencia(id),
	FOREIGN KEY (usuario_anterior) REFERENCES usuario_anterior(id),
	FOREIGN KEY (usuario_anterior) REFERENCES usuario_anterior(id)
);


SELECT * FROM Equipo WHERE serie = 123 or nombre = 'PRUEBA3213'
--Insertar usuario


Insert into usuario_anterior(usuario_anterior) values ('Labajos Arce Giovanni');
Insert into usuario_responsable (usuario_responsable) values ('Soporte sermicro 3');





--Insert Estados_del_equipo

Insert into Estados_del_equipo (estado_equipo) values ('activo');
Insert into Estados_del_equipo (estado_equipo) values ('no activo');

--Insert Gerencia

Insert into Gerencia (gerencia) values ('Gerencia Comercial');
Insert into Gerencia (gerencia) values ('Gerencia de Operaciones');
Insert into Gerencia (gerencia) values ('Gerencia de Sistemas / Formacion');
Insert into Gerencia (gerencia) values ('Gerencia Ediciones');
Insert into Gerencia (gerencia) values ('Gerencia Educativa');
Insert into Gerencia (gerencia) values ('Gerencia General');
Insert into Gerencia (gerencia) values ('Gerencia Idiomas');
Insert into Gerencia (gerencia) values ('Gerencia Marketing');
Insert into Gerencia (gerencia) values ('Gerencia Recursos humanos');
Insert into Gerencia (gerencia) values ('Gerencia Sistema educativo');
Insert into Gerencia (gerencia) values ('Gerencia Tecnologia Educativa');

--Insert Sede

Insert into Sede (sede) values ('Arequipa')
Insert into Sede (sede) values ('Chiclayo')
Insert into Sede (sede) values ('Cusco')
Insert into Sede (sede) values ('Huacho')
Insert into Sede (sede) values ('Huancayo')
Insert into Sede (sede) values ('Ica')
Insert into Sede (sede) values ('Libreria Arequipa')
Insert into Sede (sede) values ('Libreria Piura')
Insert into Sede (sede) values ('Libreria San Miguel')
Insert into Sede (sede) values ('Libreria Surco')
Insert into Sede (sede) values ('Piura')
Insert into Sede (sede) values ('Punta Hermosa')
Insert into Sede (sede) values ('Trujillo')
Insert into Sede (sede) values ('Surco')

--Insert Subgerencia

Insert into subgerencia values ('Comercial')
Insert into subgerencia values ('Comercial Lima')
Insert into subgerencia values ('Comercial Norte')
Insert into subgerencia values ('Comercial Regiones')
Insert into subgerencia values ('Comercial Sur')
Insert into subgerencia values ('Ediciones')
Insert into subgerencia values ('Financiera')
Insert into subgerencia values ('General')
Insert into subgerencia values ('Idiomas')
Insert into subgerencia values ('Marketing')
Insert into subgerencia values ('Operaciones')
Insert into subgerencia values ('Operaciones Comerciales')
Insert into subgerencia values ('Recursos humanos')
Insert into subgerencia values ('Sistemas Educativos')
Insert into subgerencia values ('Sistemas / Formacion')
Insert into subgerencia values ('Tecnologia Educativa')


--Insert tipo de equipo

Insert into Tipo_equipo values ('Desktop')
Insert into Tipo_equipo values ('Disco duro externo')
Insert into Tipo_equipo values ('Gaveta')
Insert into Tipo_equipo values ('Impresora')
Insert into Tipo_equipo values ('Laptop')
Insert into Tipo_equipo values ('Lector')
Insert into Tipo_equipo values ('MAC')
Insert into Tipo_equipo values ('Monitor')
Insert into Tipo_equipo values ('Scanner');



--Procedimiento para ingresar datos V1.0
IF OBJECT_ID('SP_InsertarEquipo') IS NOT NULL
BEGIN 
DROP PROC SP_InsertarEquipo 
END
GO
CREATE PROCEDURE SP_InsertarEquipo
    @nombre VARCHAR(100),
    @serie VARCHAR(10),
    @usuario_responsable INT,
    @usuario_anterior INT,
    @estado_equipo INT,
    @tipo_equipo INT,
    @sede INT,
    @gerencia INT,
    @subgerencia INT
AS
BEGIN
    INSERT INTO Equipo (nombre, serie, usuario_anterior, usuario_anterior, estado_equipo, tipo_equipo, sede, gerencia, subgerencia)
    VALUES (@nombre, @serie, @usuario_anterior, @usuario_responsable, @estado_equipo, @tipo_equipo, @sede, @gerencia, @subgerencia);
END;

COMMIT;


EXEC SP_InsertarEquipo 'SPELVALLCA', '5CD824BBHR', 1, 'No aplica', 1, 5, 14, 2, 11;

Select * from Estados_del_equipo
Select * from Tipo_equipo
Select * from Sede
Select * from Gerencia
Select * from subgerencia
Select * from usuario_anterior
Select * from usuario_responsable

Select * from Equipo

Select E.nombre, E.serie, U.usuario_responsable, UA.usuario_anterior, ES.estado_equipo, TE.tipo_equipo,SD.sede,G.gerencia, SG.subgerencia from Equipo E inner join Estados_del_equipo ES on e.estado_equipo = ES.id inner join Tipo_equipo TE 
on e.estado_equipo=TE.id inner join Sede SD on E.sede = SD.id inner join Gerencia G on E.gerencia = G.id inner join subgerencia SG on E.subgerencia = SG.id inner join usuario_responsable U on E.usuario_responsable = U.id
inner join usuario_anterior UA on E.usuario_anterior = UA.id



--Procedimiento para ver datos V1.0
IF OBJECT_ID('SP_VerListaInventario') IS NOT NULL
BEGIN 
DROP PROC SP_VerListaInventario 
END
GO
CREATE PROCEDURE SP_VerListaInventario

AS
BEGIN
    Select E.nombre, E.serie, U.usuario_responsable, UA.usuario_anterior, ES.estado_equipo, TE.tipo_equipo,SD.sede,G.gerencia, SG.subgerencia from Equipo E inner join Estados_del_equipo ES on e.estado_equipo = ES.id inner join Tipo_equipo TE 
on e.estado_equipo=TE.id inner join Sede SD on E.sede = SD.id inner join Gerencia G on E.gerencia = G.id inner join subgerencia SG on E.subgerencia = SG.id inner join usuario_responsable U on E.usuario_responsable= U.id
inner join usuario_anterior UA on E.usuario_anterior = UA.id
END;

EXEC SP_VerListaInventario

--Procedimiento para borrar equipos
IF OBJECT_ID('SP_BorrarEquipo') IS NOT NULL
BEGIN 
DROP PROC SP_BorrarEquipo 
END
GO
CREATE PROCEDURE SP_BorrarEquipo
    @serie VARCHAR(10)
AS
BEGIN
    DELETE FROM Equipo WHERE serie = @serie;
END;
GO



EXEC SP_BorrarEquipo '1254789855'

--procedimiento para actualizar equipo

IF OBJECT_ID('SP_ActualizarEquipo') IS NOT NULL
BEGIN 
    DROP PROCEDURE SP_ActualizarEquipo
END 
GO

CREATE PROCEDURE SP_ActualizarEquipo
    @nombre VARCHAR(100),
    @serie VARCHAR(10),
    @usuario_anterior INT,
    @usuario_responsable INT,
    @estado_equipo INT,
    @tipo_equipo INT,
    @sede INT,
    @gerencia INT,
    @subgerencia INT
AS 
BEGIN 
    UPDATE Equipo
    SET  serie=@serie, nombre=@nombre,@usuario_responsable=@usuario_responsable,usuario_anterior=@usuario_anterior,estado_equipo=@estado_equipo,tipo_equipo=@tipo_equipo,sede=@sede,gerencia=@gerencia,subgerencia=@subgerencia
	WHERE
	serie=@serie or @nombre=nombre
END
GO


EXEC SP_BorrarEquipo '1254789855'

DECLARE @nombre VARCHAR(100) = 'PRUEBA3213';
DECLARE @serie VARCHAR(10) = '123454';
DECLARE @usuario_responsable INT = 1;
DECLARE @usuario_anterior INT = 2;
DECLARE @estado_equipo INT = 1;
DECLARE @tipo_equipo INT = 2;
DECLARE @sede INT = 3;
DECLARE @gerencia INT = 4;
DECLARE @subgerencia INT = 5;

EXEC SP_ActualizarEquipo
    @nombre,
    @serie,
    @usuario_responsable,
    @usuario_anterior,
    @estado_equipo,
    @tipo_equipo,
    @sede,
    @gerencia,
    @subgerencia;



Select * from Gerencia

SELECT usuario_anterior FROM usuario_anterior WHERE usuario_anterior LIKE '%giovanni%'


DECLARE @PageSize INT = 2; -- Cantidad de registros por página
DECLARE @PageNumber INT = 1; -- Número de página actual



Select E.nombre, E.serie, U.usuario_responsable, UA.usuario_anterior, ES.estado_equipo, TE.tipo_equipo,SD.sede,G.gerencia, SG.subgerencia from Equipo E inner join Estados_del_equipo ES on e.estado_equipo = ES.id inner join Tipo_equipo TE 
on e.estado_equipo=TE.id inner join Sede SD on E.sede = SD.id inner join Gerencia G on E.gerencia = G.id inner join subgerencia SG on E.subgerencia = SG.id inner join usuario_responsable U on E.usuario_responsable= U.id
inner join usuario_anterior UA on E.usuario_anterior = UA.id
ORDER BY usuario_responsable
OFFSET (@PageNumber - 1) * @PageSize ROWS
FETCH NEXT @PageSize ROWS ONLY;


SELECT E.nombre, E.serie, U.usuario_responsable, UA.usuario_anterior, ES.estado_equipo, TE.tipo_equipo,SD.sede,G.gerencia, SG.subgerencia from Equipo E inner join Estados_del_equipo ES on e.estado_equipo = ES.id inner join Tipo_equipo TE 
        on e.estado_equipo=TE.id inner join Sede SD on E.sede = SD.id inner join Gerencia G on E.gerencia = G.id inner join subgerencia SG on E.subgerencia = SG.id inner join usuario_responsable U on E.usuario_responsable= U.id
        inner join usuario_anterior UA on E.usuario_anterior = UA.id
        ORDER BY usuario_responsable OFFSET 1 ROWS FETCH NEXT 3 ROWS ONLY



DECLARE @PageSize INT = 2; -- Cantidad de registros por página
DECLARE @PageNumber INT = 1; -- Número de página actual

SELECT COUNT(*) OVER() AS TotalRows,
    E.nombre, E.serie, U.usuario_responsable, UA.usuario_anterior, ES.estado_equipo, TE.tipo_equipo, SD.sede, G.gerencia, SG.subgerencia
FROM Equipo E
INNER JOIN Estados_del_equipo ES ON E.estado_equipo = ES.id
INNER JOIN Tipo_equipo TE ON E.estado_equipo = TE.id
INNER JOIN Sede SD ON E.sede = SD.id
INNER JOIN Gerencia G ON E.gerencia = G.id
INNER JOIN subgerencia SG ON E.subgerencia = SG.id
INNER JOIN usuario_responsable U ON E.usuario_responsable = U.id
INNER JOIN usuario_anterior UA ON E.usuario_anterior = UA.id WHERE E.serie LIKE 'asd' OR E.nombre LIKE 'PRUEBA3'
ORDER BY U.usuario_responsable-- Cambia aquí para ordenar por la columna correcta
OFFSET (@PageNumber - 1) * @PageSize ROWS
FETCH NEXT @PageSize ROWS ONLY 