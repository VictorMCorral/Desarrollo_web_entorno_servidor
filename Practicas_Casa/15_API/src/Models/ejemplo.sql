CREATE TABLE IF NOT EXISTS  depart(
    depart_no INT PRIMARY KEY,
    dnombre VARCHAR(255) NOT NULL,
    loc VARCHAR(255) NOT NULL,
);


INSERT INTO depart(depart_no, dnombre, loc) VALUES (10, "Prueba", "Madrid");