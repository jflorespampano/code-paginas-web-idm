create table if not exists carreras(
    id integer primary key autoincrement,
    nombre varchar(50),
    alias varchar(10)
);
insert into carreras (nombre, alias) values('ingenieria en computacion','ico');
insert into carreras (nombre, alias) values('ingenieria en sistemas computacionales','isc');
insert into carreras (nombre, alias) values('ingenieria en tecnologias  de compputo y comunicacioes','itcc');
insert into carreras (nombre, alias) values('ingenieria en diseño multimedia','idm');
create table if not exists alumnos(
    id integer primary key autoincrement,
    matricula varchar(20),
    nombre varchar(30),
    carrera integer
);
insert into alumnos(matricula, nombre, carrera) values('202001','juana rodriguez',1);
insert into alumnos(matricula, nombre, carrera) values('202002','pedro lin',1);
insert into alumnos(matricula, nombre, carrera) values('202003','ana pech',2);
insert into alumnos(matricula, nombre, carrera) values('202201','rosa uc',2);
insert into alumnos(matricula, nombre, carrera) values('202204','luis chi',2);
insert into alumnos(matricula, nombre, carrera) values('202209','gina pat',3);