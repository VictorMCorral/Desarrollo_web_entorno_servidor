CREATE TABLE IF NOT EXISTS pizzas (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(20),
    ingredientes VARCHAR(50),
    alergenos VARCHAR(50),
    precio DECIMAL(5,2),
    PRIMARY KEY (id)
);


INSERT INTO pizzas (nombre, ingredientes, alergenos, precio) 
    VALUES ('Margarita', 'Tomate, mozzarella, albahaca', 'Leche', 8.50);

INSERT INTO pizzas (nombre, ingredientes, alergenos, precio) 
    VALUES ('Pepperoni', 'Tomate, mozzarella, pepperoni', 'Leche', 10.00);

INSERT INTO pizzas (nombre, ingredientes, alergenos, precio) 
    VALUES ('Vegetariana', 'Tomate, mozzarella, pimiento, cebolla, champiñones, aceitunas', 'Leche', 9.20);

INSERT INTO pizzas (nombre, ingredientes, alergenos, precio) 
    VALUES ('Cuatro Quesos', 'Mozzarella, gorgonzola, parmesano, queso de cabra', 'Leche, huevo', 11.00);

INSERT INTO pizzas (nombre, ingredientes, alergenos, precio) 
    VALUES ('Hawaiana', 'Tomate, mozzarella, jamón, piña', 'Leche', 9.80);

INSERT INTO pizzas (nombre, ingredientes, alergenos, precio) 
    VALUES ('Barbacoa', 'Tomate, mozzarella, carne picada, cebolla, salsa barbacoa', 'Leche', 10.50);

INSERT INTO pizzas (nombre, ingredientes, alergenos, precio) 
    VALUES ('Napolitana', 'Tomate, mozzarella, anchoas, orégano', 'Leche, pescado', 9.60);

INSERT INTO pizzas (nombre, ingredientes, alergenos, precio) 
    VALUES ('Carbonara', 'Mozzarella, huevo, bacon, crema', 'Leche, huevo', 10.80);

INSERT INTO pizzas (nombre, ingredientes, alergenos, precio) 
    VALUES ('Diávola', 'Tomate, mozzarella, salami picante, chile', 'Leche', 10.20);

INSERT INTO pizzas (nombre, ingredientes, alergenos, precio) 
    VALUES ('Rústica', 'Tomate, mozzarella, jamón serrano, rúcula, parmesano', 'Leche', 11.50);
