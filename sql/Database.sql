
--
--		Project:		AjConsorSite
--		Description:	Sitio de Consorcios y Negocios Inmobiliarios
--



--
--		Entity:		Consorcio
--		Description:	Consorcio
--


drop table if exists consorcios;


create table consorcios (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		Codigo varchar(10),
		Domicilio varchar(200),
		Ciudad varchar(200),
		Provincia varchar(200),
		Pais varchar(200),
		Notas text,
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		Unidad
--		Description:	Unidad
--


drop table if exists unidades;


create table unidades (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		Codigo varchar(10),
		Piso varchar(20),
		Numero varchar(20),
		IdConsorcio int,
		Notas text,
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		User
--		Description:	Usuario
--


drop table if exists users;


create table users (
		Id int NOT NULL auto_increment,
		UserName varchar(16),
		Password varchar(200),
		FirstName varchar(40),
		LastName varchar(40),
		Email varchar(100),
		Genre varchar(20),
		IsAdministrator tinyint(4),
		DateTimeInsert datetime,
		DateTimeUpdate datetime,
		DateTimeLastLogin datetime,
		LoginCount int(11),
		Verified tinyint(4),
		Notas text,
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		DocumentoConsorcio
--		Description:	Documento de Consorcio
--


drop table if exists documentosconsorcio;


create table documentosconsorcio (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		Descripcion text,
		NombreArchivo varchar(200),
		Uuid varchar(200),
		IdConsorcio int,
		Notas text,
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		UsuarioUnidad
--		Description:	Usuario Unidad
--


drop table if exists userunidades;


create table userunidades (
		Id int NOT NULL auto_increment,
		IdUser int,
		IdConsorcio int,
		IdUnidad int,
		primary key (Id)
) TYPE=InnoDB;

