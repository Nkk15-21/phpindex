CREATE TABLE lehed( id int null AUTO_INCREMENT PRIMARY KEY,
                    pealkiri varchar(50),
                    sisu TEXT);
insert into lehed(pealkiri, sisu)
VALUES('Ilm on külm','Aprill on käes');

ALTER TABLE lehed ADD kuupaev date;
insert into lehed(pealkiri, sisu, kuupaev)
values('test','probuem','2025-04-10');