
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
) ENGINE=InnoDB;


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
) ENGINE=InnoDB;


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
		NoReserva tinyint(4),
		primary key (Id)
) ENGINE=InnoDB;


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
) ENGINE=InnoDB;


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
) ENGINE=InnoDB;


--
--		Entity:		UsoMultiple
--		Description:	Salon de Uso Multiple
--


drop table if exists usomultiples;


create table usomultiples (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		Codigo varchar(10),
		IdConsorcio int,
		Notas text,
		primary key (Id)
) ENGINE=InnoDB;


--
--		Entity:		Reserva
--		Description:	Reserva
--


drop table if exists reservas;


create table reservas (
		Id int NOT NULL auto_increment,
		DesdeFecha date,
		DesdeHora varchar(5),
		HastaFecha date,
		HastaHora varchar(5),
		IdUsoMultiple int,
		IdUser int,
		primary key (Id)
) ENGINE=InnoDB;


--
--		Entity:		Evento
--		Description:	Evento
--


drop table if exists eventos;


create table eventos (
		Id int NOT NULL auto_increment,
		Tipo varchar(4),
		IdParametro int,
		IdUsuario int,
		FechaHora datetime,
		primary key (Id)
) ENGINE=InnoDB;

