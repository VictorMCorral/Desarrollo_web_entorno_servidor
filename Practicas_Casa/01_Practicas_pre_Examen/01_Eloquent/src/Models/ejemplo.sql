CREATE DATABASE IF NOT EXISTS emple_depart;

USE emple_depart;

CREATE TABLE IF NOT EXISTS depart (
    dept_no INT PRIMARY KEY,
    dnombre VARCHAR(15),
    loc VARCHAR(15)
);

INSERT INTO depart (dept_no, dnombre, loc) VALUES (10, 'CONTABILIDAD', 'MADRID');
INSERT INTO depart (dept_no, dnombre, loc) VALUES (20, 'INVESTIGACION', 'BARCELONA');
INSERT INTO depart (dept_no, dnombre, loc) VALUES (30, 'VENTAS', 'VALENCIA');
INSERT INTO depart (dept_no, dnombre, loc) VALUES (40, 'PRODUCCION', 'SEVILLA');
INSERT INTO depart (dept_no, dnombre, loc) VALUES (50, 'RECURSOS', 'BILBAO');

CREATE TABLE IF NOT EXISTS emple (
    emple_no INT PRIMARY KEY,
    apellido VARCHAR(15),
    oficio VARCHAR(15),
    dept_no INT,
    FOREIGN KEY (dept_no) REFERENCES depart(dept_no)
);

INSERT INTO emple (emple_no, apellido, oficio, dept_no) VALUES (1,'Corral', 'Diseñador', '20');
INSERT INTO emple (emple_no, apellido, oficio, dept_no) VALUES (2,'Navarro', 'Comercial', '30');
INSERT INTO emple (emple_no, apellido, oficio, dept_no) VALUES (3,'Garcia', 'Recuros Humanos', '40');
INSERT INTO emple (emple_no, apellido, oficio, dept_no) VALUES (4,'Muñoz', 'Diseñador', '20');
INSERT INTO emple (emple_no, apellido, oficio, dept_no) VALUES (5,'Corral', 'Administracion', '10');
