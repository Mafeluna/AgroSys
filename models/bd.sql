CREATE DATABASE AgrosysDB;
USE AgrosysDB;

CREATE TABLE Usuario(
	id_usuario TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    documento BIGINT UNSIGNED UNIQUE NOT NULL,
    email VARCHAR(255) NOT NULL,
    clave VARCHAR(255) NOT NULL,
    rol ENUM('Administrador','Administrador Operario','Encargado Animales','Encargado de Producción','Veterinario') NOT NULL,
    telefono INT UNSIGNED NOT NULL,
	direccion VARCHAR(255) NOT NULL,
    fecha_registro DATE DEFAULT CURRENT_TIMESTAMP,
	estado ENUM('Activo','Inactivo') DEFAULT 'Activo'
);

INSERT INTO Usuario (nombre, apellido, documento, email, clave, rol, telefono, direccion)
VALUES ('Maria Fernanda', 'Luna', 1031651096, 'smfernandaluna@gmail.com', 'MAFE123', 1, 3052955391, 'cll 146 #138a-04');
INSERT INTO Usuario (nombre, apellido, documento, email, clave, rol, telefono, direccion)
VALUES ('Juan Ricardo', 'Lopez', 123456789, 'jrlopez@gmail.com', 'clave123', 2, 3054564391, 'cll 155 #171a-04');
INSERT INTO Usuario (nombre, apellido, documento, email, clave, rol, telefono, direccion)
VALUES ('Luisa', 'Rodriguez', 987456123, 'lrodriguez@gmail.com', 'clave123', 2, 3087548965, 'Tv 96 #17a-04');
#usuarios ficticios
INSERT INTO Usuario (nombre, apellido, documento, email, clave, rol, telefono, direccion)
VALUES 
('Laura', 'Gómez', 1012345678, 'laura.gomez@example.com', 'clave123', 'Administrador', 3201234567, 'Cra 10 #45-67'),
('Carlos', 'Ramírez', 1023456789, 'carlos.ramirez@example.com', 'clave123', 'Encargado Animales', 3102345678, 'Calle 20 #12-34'),
('Marta', 'López', 1034567890, 'marta.lopez@example.com', 'clave123', 'Encargado de Producción', 3003456789, 'Av. Siempre Viva #101'),
('Pedro', 'Martínez', 1045678901, 'pedro.martinez@example.com', 'clave123', 'Veterinario', 3114567890, 'Cra 8 #23-45'),
('Ana', 'Fernández', 1056789012, 'ana.fernandez@example.com', 'clave123', 'Encargado Animales', 3125678901, 'Calle 50 #10-20'),
('Julián', 'Torres', 1067890123, 'julian.torres@example.com', 'clave123', 'Veterinario', 3136789012, 'Carrera 15 #80-10');
INSERT INTO Usuario (nombre, apellido, documento, email, clave, rol, telefono, direccion)
VALUES
('Camila', 'Rojas', 1078901234, 'camila.rojas@example.com', 'clave123', 'Administrador', 3147890123, 'Calle 100 #15-20'),
('Esteban', 'Mejía', 1089012345, 'esteban.mejia@example.com', 'clave123', 'Encargado Animales', 3158901234, 'Av. Norte #120-30'),
('Sofía', 'Díaz', 1090123456, 'sofia.diaz@example.com', 'clave123', 'Encargado de Producción', 3169012345, 'Cra 3 #45-56'),
('Andrés', 'Gutiérrez', 1101234567, 'andres.gutierrez@example.com', 'clave123', 'Veterinario', 3170123456, 'Calle 22 #60-90'),
('Valentina', 'Pérez', 1112345678, 'valentina.perez@example.com', 'clave123', 'Administrador', 3181234567, 'Diagonal 45 #12-34'),
('Sebastián', 'Castro', 1123456789, 'sebastian.castro@example.com', 'clave123', 'Encargado Animales', 3192345678, 'Transversal 10 #78-90'),
('Daniela', 'Ruiz', 1134567890, 'daniela.ruiz@example.com', 'clave123', 'Encargado de Producción', 3203456789, 'Cra 14 #44-55'),
('Felipe', 'Moreno', 1145678901, 'felipe.moreno@example.com', 'clave123', 'Veterinario', 3214567890, 'Calle 66 #20-33'),
('Isabella', 'Ortiz', 1156789012, 'isabella.ortiz@example.com', 'clave123', 'Administrador', 3225678901, 'Carrera 25 #10-22'),
('Tomás', 'Vargas', 1167890123, 'tomas.vargas@example.com', 'clave123', 'Encargado Animales', 3236789012, 'Av. Central #77-80'),
('Natalia', 'Silva', 1178901234, 'natalia.silva@example.com', 'clave123', 'Encargado de Producción', 3247890123, 'Calle 88 #13-14'),
('Diego', 'Reyes', 1189012345, 'diego.reyes@example.com', 'clave123', 'Veterinario', 3258901234, 'Cra 11 #19-22'),
('Paula', 'Navarro', 1190123456, 'paula.navarro@example.com', 'clave123', 'Encargado Animales', 3269012345, 'Carrera 30 #20-10'),
('Miguel', 'Cortés', 1201234567, 'miguel.cortes@example.com', 'clave123', 'Administrador', 3270123456, 'Calle 12 #30-40'),
('Lucía', 'Salazar', 1212345678, 'lucia.salazar@example.com', 'clave123', 'Veterinario', 3281234567, 'Av. Suba #100-22');

#Procedimientos almacenados Usuario
CREATE PROCEDURE AccesoAlSistema(
	IN p_documento BIGINT UNSIGNED,
    IN p_clave VARCHAR(255)
)
	SELECT*FROM Usuario WHERE documento=p_documento AND clave=p_clave;
    

CREATE PROCEDURE RegistrarUsuario(
    IN p_nombre VARCHAR(100),
    IN p_apellido VARCHAR(100),
    IN p_documento BIGINT UNSIGNED,
    IN p_email VARCHAR(255),
    IN p_clave VARCHAR(255),
    IN p_rol ENUM('Administrador','Administrador Operario','Encargado Animales','Encargado de Producción','Veterinario'),
    IN p_telefono INT UNSIGNED,
    IN p_direccion VARCHAR(255)
)
    INSERT INTO Usuario (nombre, apellido, documento, email, clave, rol, telefono, direccion)
    VALUES (p_nombre, p_apellido, p_documento, p_email, p_clave, p_rol, p_telefono, p_direccion);

CREATE PROCEDURE ConsultaGeneralUsuario()
	SELECT*FROM Usuario WHERE estado=1;

CREATE PROCEDURE ConsultarUsuarioPorDocumento(
    IN p_documento BIGINT UNSIGNED
)
    SELECT id_usuario, nombre, apellido, documento, email, rol, telefono, direccion, fecha_registro FROM Usuario
    WHERE documento = p_documento;
    
 
CREATE PROCEDURE ModificarUsuario(
    IN p_id_usuario TINYINT UNSIGNED,
    IN p_nombre VARCHAR(100),
    IN p_apellido VARCHAR(100),
    IN p_documento BIGINT UNSIGNED,
    IN p_email VARCHAR(255),
    IN p_rol ENUM('Administrador','Administrador Operario','Encargado Animales','Encargado de Producción','Veterinario'),
    IN p_telefono INT UNSIGNED,
    IN p_direccion VARCHAR(255)
)
    UPDATE Usuario
    SET nombre = p_nombre,
        apellido = p_apellido,
        documento = p_documento,
        email = p_email,
        rol = p_rol,
        telefono = p_telefono,
        direccion = p_direccion
    WHERE id_usuario = p_id_usuario;


CREATE PROCEDURE EliminarUsuario(
    IN p_id_usuario TINYINT UNSIGNED
)
    UPDATE Usuario
    SET estado = 2
    WHERE id_usuario = p_id_usuario;


#-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE Especie(
	id_especie TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    cantidad SMALLINT UNSIGNED NOT NULL,
    estado ENUM('Activo','Inactivo') DEFAULT 'Activo'
);

#procedimientos almacenados especie
CREATE PROCEDURE RegistrarEspecie(
	IN p_nombre VARCHAR(50)
)
	INSERT INTO Especie(nombre,cantidad) VALUES(p_nombre,0);
CALL RegistrarEspecie('Vaca');
CALL RegistrarEspecie('Caballo');
CALL RegistrarEspecie('Gallina');
CALL RegistrarEspecie('Cerdo');


CREATE PROCEDURE ConsultaGeneralEspecie()
	SELECT*FROM Especie WHERE estado=1;

CREATE PROCEDURE ConsultaEspecificaEspecie(
	IN p_id_especie TINYINT UNSIGNED
) 
	SELECT*FROM Especie WHERE id_especie = p_id_especie AND estado=1;

CREATE PROCEDURE ModificarEspecie(
	IN p_id_especie TINYINT UNSIGNED,
    IN p_nombre VARCHAR(50)
)
	UPDATE Especie
    SET nombre = p_nombre
	WHERE id_especie = p_id_especie AND estado = 1;

CREATE PROCEDURE EliminarEspecie(
	IN p_id_especie TINYINT UNSIGNED
)
	UPDATE Especie
    SET estado = 2;

#------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE Animal(
	id_animal SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    especie TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (especie) REFERENCES Especie(id_especie),
    peso DECIMAL(5,2) NOT NULL,
    fecha_ingreso DATE DEFAULT CURRENT_TIMESTAMP,
    registrado_por TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (registrado_por) REFERENCES Usuario(id_usuario),
    estado ENUM ('Activo','Inactivo') DEFAULT 'Activo'
);



#procedimientos almacenados Animal
DELIMITER //
CREATE PROCEDURE RegistrarAnimal(
    IN p_nombre VARCHAR(100),
    IN p_especie TINYINT UNSIGNED,
    IN p_peso DECIMAL(5,2),
    IN p_registrado_por TINYINT UNSIGNED
)
BEGIN
    INSERT INTO Animal (nombre, especie, peso, registrado_por)
    VALUES (p_nombre, p_especie, p_peso, p_registrado_por);
	
    UPDATE Especie
		SET cantidad = cantidad + 1
        WHERE id_especie = p_especie;
END //
DELIMITER ;

CREATE PROCEDURE ContarPorEspecie(
	IN p_especie TINYINT UNSIGNED
)
	SELECT COUNT(*) AS cantidad_animales
	FROM Animal 
	JOIN Especie  ON Animal.especie = Especie.id_especie
	WHERE Especie.id_especie = p_especie;
    
call contarPorespecie(2);
DELIMITER //
CREATE PROCEDURE RegistrarAnimalConFecha(
    IN p_nombre VARCHAR(100),
    IN p_especie TINYINT UNSIGNED,
    IN p_peso DECIMAL(5,2),
    IN p_fecha_ingreso DATE,
    IN p_registrado_por TINYINT UNSIGNED
)
BEGIN
    INSERT INTO Animal (nombre, especie, peso, fecha_ingreso, registrado_por)
    VALUES (p_nombre, p_especie, p_peso, p_fecha_ingreso, p_registrado_por);

    UPDATE Especie
    SET cantidad = cantidad + 1
    WHERE id_especie = p_especie;
END //
DELIMITER ;
CALL RegistrarAnimalConFecha('VA-0001', 1, 3.50, '2025-01-05', 1);
CALL RegistrarAnimalConFecha('VA-0002', 1, 3.55, '2025-01-12', 1);
CALL RegistrarAnimalConFecha('CA-0001', 2, 2.10, '2025-01-15', 2);
CALL RegistrarAnimalConFecha('GA-0001', 3, 4.80, '2025-01-20', 3);
CALL RegistrarAnimalConFecha('CE-0001', 4, 5.60, '2025-01-25', 2);
CALL RegistrarAnimalConFecha('VA-0003', 1, 3.60, '2025-02-03', 1);
CALL RegistrarAnimalConFecha('CA-0002', 2, 2.15, '2025-02-08', 2);
CALL RegistrarAnimalConFecha('CA-0003', 2, 2.20, '2025-02-12', 2);
CALL RegistrarAnimalConFecha('GA-0002', 3, 4.85, '2025-02-16', 3);
CALL RegistrarAnimalConFecha('CE-0002', 4, 5.65, '2025-02-20', 1);
CALL RegistrarAnimalConFecha('CE-0003', 4, 5.70, '2025-02-25', 1);
CALL RegistrarAnimalConFecha('VA-0004', 1, 3.65, '2025-03-01', 1);
CALL RegistrarAnimalConFecha('VA-0005', 1, 3.70, '2025-03-05', 1);
CALL RegistrarAnimalConFecha('VA-0006', 1, 3.75, '2025-03-10', 1);
CALL RegistrarAnimalConFecha('CA-0004', 2, 2.25, '2025-03-12', 2);
CALL RegistrarAnimalConFecha('GA-0003', 3, 4.90, '2025-03-18', 3);
CALL RegistrarAnimalConFecha('CE-0004', 4, 5.80, '2025-03-22', 2);
CALL RegistrarAnimalConFecha('GA-0004', 3, 4.95, '2025-03-28', 3);
CALL RegistrarAnimalConFecha('VA-0007', 1, 3.80, '2025-04-04', 1);
CALL RegistrarAnimalConFecha('CA-0005', 2, 2.30, '2025-04-08', 2);
CALL RegistrarAnimalConFecha('GA-0005', 3, 5.00, '2025-04-12', 3);
CALL RegistrarAnimalConFecha('CE-0005', 4, 5.85, '2025-04-16', 1);
CALL RegistrarAnimalConFecha('CA-0006', 2, 2.35, '2025-04-20', 2);
CALL RegistrarAnimalConFecha('VA-0008', 1, 3.85, '2025-05-03', 1);
CALL RegistrarAnimalConFecha('VA-0009', 1, 3.90, '2025-05-07', 1);
CALL RegistrarAnimalConFecha('VA-0010', 1, 3.95, '2025-05-10', 1);
CALL RegistrarAnimalConFecha('CA-0007', 2, 2.40, '2025-05-14', 2);
CALL RegistrarAnimalConFecha('GA-0006', 3, 5.05, '2025-05-18', 3);
CALL RegistrarAnimalConFecha('CE-0006', 4, 5.90, '2025-05-22', 1);
CALL RegistrarAnimalConFecha('CE-0007', 4, 5.95, '2025-05-26', 1);
CALL RegistrarAnimalConFecha('VA-0011', 1, 4.00, '2025-06-02', 1);
CALL RegistrarAnimalConFecha('CA-0008', 2, 2.45, '2025-06-06', 2);
CALL RegistrarAnimalConFecha('CA-0009', 2, 2.50, '2025-06-10', 2);
CALL RegistrarAnimalConFecha('GA-0007', 3, 5.10, '2025-06-14', 3);
CALL RegistrarAnimalConFecha('CE-0008', 4, 6.00, '2025-06-18', 1);
CALL RegistrarAnimalConFecha('CE-0009', 4, 6.05, '2025-06-22', 1);
CALL RegistrarAnimalConFecha('VA-0012', 1, 4.10, '2025-07-03', 1);
CALL RegistrarAnimalConFecha('VA-0013', 1, 4.15, '2025-07-07', 1);
CALL RegistrarAnimalConFecha('CA-0010', 2, 2.55, '2025-07-11', 2);
CALL RegistrarAnimalConFecha('CA-0011', 2, 2.60, '2025-07-15', 2);
CALL RegistrarAnimalConFecha('GA-0008', 3, 5.15, '2025-07-19', 3);
CALL RegistrarAnimalConFecha('CE-0010', 4, 6.10, '2025-07-23', 1);
CALL RegistrarAnimalConFecha('VA-0014', 1, 4.20, '2025-08-05', 1);
CALL RegistrarAnimalConFecha('CA-0012', 2, 2.65, '2025-08-09', 2);
CALL RegistrarAnimalConFecha('GA-0009', 3, 5.20, '2025-08-13', 3);
CALL RegistrarAnimalConFecha('CE-0011', 4, 6.15, '2025-08-17', 1);
CALL RegistrarAnimalConFecha('CE-0012', 4, 6.20, '2025-08-21', 1);
CALL RegistrarAnimalConFecha('VA-0015', 1, 4.25, '2025-09-02', 1);
CALL RegistrarAnimalConFecha('VA-0016', 1, 4.30, '2025-09-06', 1);
CALL RegistrarAnimalConFecha('CA-0013', 2, 2.70, '2025-09-10', 2);
CALL RegistrarAnimalConFecha('CA-0014', 2, 2.75, '2025-09-14', 2);
CALL RegistrarAnimalConFecha('GA-0010', 3, 5.25, '2025-09-18', 3);
CALL RegistrarAnimalConFecha('GA-0011', 3, 5.30, '2025-09-22', 3);
CALL RegistrarAnimalConFecha('CE-0013', 4, 6.25, '2025-09-26', 1);
CALL RegistrarAnimalConFecha('VA-0017', 1, 4.35, '2025-10-03', 1);
CALL RegistrarAnimalConFecha('CA-0015', 2, 2.80, '2025-10-07', 2);
CALL RegistrarAnimalConFecha('GA-0012', 3, 5.35, '2025-10-11', 3);
CALL RegistrarAnimalConFecha('CE-0014', 4, 6.30, '2025-10-15', 1);
CALL RegistrarAnimalConFecha('GA-0013', 3, 5.40, '2025-10-19', 3);
CALL RegistrarAnimalConFecha('VA-0018', 1, 4.40, '2025-11-03', 1);
CALL RegistrarAnimalConFecha('VA-0019', 1, 4.45, '2025-11-07', 1);
CALL RegistrarAnimalConFecha('CA-0016', 2, 2.85, '2025-11-11', 2);
CALL RegistrarAnimalConFecha('CA-0017', 2, 2.90, '2025-11-15', 2);
CALL RegistrarAnimalConFecha('GA-0014', 3, 5.45, '2025-11-19', 3);
CALL RegistrarAnimalConFecha('CE-0015', 4, 6.35, '2025-11-23', 1);
CALL RegistrarAnimalConFecha('VA-0020', 1, 4.50, '2025-12-02', 1);
CALL RegistrarAnimalConFecha('VA-0021', 1, 4.55, '2025-12-06', 1);
CALL RegistrarAnimalConFecha('VA-0022', 1, 4.60, '2025-12-10', 1);
CALL RegistrarAnimalConFecha('CA-0018', 2, 2.95, '2025-12-14', 2);
CALL RegistrarAnimalConFecha('GA-0015', 3, 5.50, '2025-12-18', 3);
CALL RegistrarAnimalConFecha('CE-0016', 4, 6.40, '2025-12-22', 1);
CALL RegistrarAnimalConFecha('CE-0017', 4, 6.45, '2025-12-26', 1);

    
CREATE PROCEDURE ConsultaGeneralAnimal()
	SELECT Animal.id_animal,Animal.nombre,Especie.nombre as "especie",Animal.peso,Animal.fecha_ingreso,Usuario.nombre as "nombre_user",Usuario.apellido as "apellido_user" 
    FROM Usuario 
    INNER JOIN Animal ON Animal.registrado_por = Usuario.id_usuario INNER JOIN Especie ON Animal.especie = Especie.id_especie WHERE Animal.estado=1;
    
CREATE PROCEDURE ConsultaPorEspecie(
	IN p_especie VARCHAR(50)
)
	SELECT Animal.id_animal,Animal.nombre,Especie.id_especie as "id_especie",Especie.nombre as "especie",Animal.peso,Animal.fecha_ingreso,Usuario.nombre as "nombre_user",Usuario.apellido as "apellido_user" 
    FROM Usuario 
    INNER JOIN Animal ON Animal.registrado_por = Usuario.id_usuario INNER JOIN Especie ON Animal.especie = Especie.id_especie WHERE Animal.estado=1 AND Especie.nombre = p_especie;
   
CREATE PROCEDURE ConsultaPorEspecieEspecifica(
	IN p_especie VARCHAR(50),
    IN p_codigo VARCHAR(255)
)
    SELECT Animal.id_animal,Animal.nombre,Especie.id_especie as "id_especie",Especie.nombre as "especie",Animal.peso,Animal.fecha_ingreso,Usuario.nombre as "nombre_user",Usuario.apellido as "apellido_user" 
    FROM Usuario 
    INNER JOIN Animal ON Animal.registrado_por = Usuario.id_usuario 
    INNER JOIN Especie ON Animal.especie = Especie.id_especie WHERE Animal.estado=1 AND Especie.nombre = p_especie AND Animal.nombre = p_codigo;
    
CREATE PROCEDURE ConsultaEspecificaAnimal(
	IN p_id_animal SMALLINT UNSIGNED
)
	SELECT Animal.id_animal,Animal.nombre,Especie.nombre as "especie",Animal.peso,Animal.fecha_ingreso,Usuario.nombre as "nombre_user",Usuario.apellido as "apellido_user" 
    FROM Usuario 
    INNER JOIN Animal ON Animal.registrado_por = Usuario.id_usuario INNER JOIN Especie ON Animal.especie = Especie.id_especie WHERE Animal.estado=1 AND Animal.id_animal = p_id_animal;
    

CREATE PROCEDURE ModificarAnimal(
    IN p_id_animal SMALLINT UNSIGNED,
    IN p_peso DECIMAL(5,2)
)
    UPDATE Animal
    SET
        peso = p_peso
    WHERE id_animal = p_id_animal;

DELIMITER //
CREATE PROCEDURE EliminarAnimal(
    IN p_id_animal SMALLINT UNSIGNED,
    IN p_especie TINYINT UNSIGNED
)
BEGIN
    UPDATE Animal
    SET estado = 2
    WHERE id_animal = p_id_animal;
    
    UPDATE Especie
    SET cantidad = cantidad-1
    WHERE id_especie = p_especie;
END //
DELIMITER ;

#----------------------------------------------------------------------------------------------------
CREATE TABLE Alimento(
	id_alimento TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(40) NOT NULL,
    especie TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (especie) REFERENCES Especie(id_especie),
    cantidad DECIMAL(10,6) NOT NULL,
    tipo_medida ENUM('Kilogramos','Litros','Unidades','Porciones') NOT NULL,
    estado ENUM ('Activo','Inactivo') DEFAULT 'Activo'
);

INSERT INTO Alimento (descripcion, especie, cantidad, tipo_medida)
VALUES 
('Heno seco', 1, 500.000000, 'Kilogramos'),
('Concentrado bovino', 1, 200.000000, 'Kilogramos'),
('Sal mineralizada', 1, 50.000000, 'Kilogramos'),
('Avena molida', 2, 300.000000, 'Kilogramos'),
('Pasto fresco', 2, 600.000000, 'Kilogramos'),
('Concentrado equino', 2, 150.000000, 'Kilogramos'),
('Maíz molido', 3, 120.000000, 'Kilogramos'),
('Agua tratada', 3, 200.000000, 'Litros'),
('Concentrado porcino', 4, 250.000000, 'Kilogramos'),
('Suero de leche', 4, 80.000000, 'Litros'),
('Huevos', 3, 100.000000, 'Unidades'),
('Ración mixta', 1, 75.000000, 'Porciones'),
('Manzana', 2, 75.000000, 'Unidades');

#procedimientos almacenados alimento
CREATE PROCEDURE InsertarAlimento 
(
    IN p_descripcion VARCHAR(40),
    IN p_cantidad SMALLINT UNSIGNED,
    IN p_especie TINYINT UNSIGNED,
    IN p_tipo ENUM('Kilogramos','Litros','Unidades','Porciones')
)
    INSERT INTO Alimento (descripcion, cantidad,especie,tipo_medida) 
    VALUES (p_descripcion, p_cantidad, p_especie,p_tipo);


CREATE PROCEDURE ConsultaGeneralAlimento()
	SELECT Alimento.id_alimento,Alimento.descripcion,Especie.nombre as "especie",Alimento.cantidad,Alimento.tipo_medida
    FROM Alimento INNER JOIN Especie ON Alimento.especie = Especie.id_especie WHERE Alimento.estado=1 ORDER BY Alimento.id_alimento;

CREATE PROCEDURE ConsultarAlimentoPorID(
    IN p_id_alimento TINYINT UNSIGNED
)
    SELECT Alimento.id_alimento,Alimento.descripcion,Especie.id_especie,Especie.nombre as "especie",Alimento.cantidad,Alimento.tipo_medida
    FROM Alimento INNER JOIN Especie ON Alimento.especie = Especie.id_especie WHERE id_alimento = p_id_alimento;


CREATE PROCEDURE ActualizarAlimento(
    IN p_id_alimento TINYINT UNSIGNED,
    IN p_descripcion VARCHAR(40),
    IN p_cantidad DECIMAL(10,8) UNSIGNED,
    IN p_tipo ENUM('Kilogramos','Litros','Unidades','Porciones'),
    IN p_especie TINYINT UNSIGNED
)
    UPDATE Alimento
    SET 
    descripcion = p_descripcion,
	cantidad = p_cantidad,
    especie = p_especie
    WHERE id_alimento = p_id_alimento;


CREATE PROCEDURE EliminarAlimento(
	IN p_id_alimento TINYINT UNSIGNED
)
    UPDATE Alimento
    SET estado=2
    WHERE id_alimento = p_id_alimento;
select*from especie;
#----------------------------------------------------------------------------------------------------------------------------
CREATE TABLE Alimentacion(
	id_alimentacion INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    especie TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (especie) REFERENCES Especie(id_especie),
    alimento TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (alimento) REFERENCES Alimento(id_alimento),
    cantidad SMALLINT UNSIGNED NOT NULL,
    unidad_medida VARCHAR(50) NOT NULL,
    fecha DATE DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('Activo','Inactivo') DEFAULT 'Activo'
);

#procedimientos almacenados
DELIMITER //
CREATE PROCEDURE InsertarAlimentacion(
    IN p_especie TINYINT UNSIGNED,
    IN p_alimento TINYINT UNSIGNED,
    IN p_cantidad SMALLINT UNSIGNED,
    IN p_unidad VARCHAR(50),
    IN p_cantidadB DECIMAL(10,6)
)
BEGIN
    INSERT INTO Alimentacion(especie, alimento, cantidad,unidad_medida) 
    VALUES (p_especie, p_alimento, p_cantidad,p_unidad);
	
    UPDATE Alimento
    SET cantidad = cantidad - p_cantidadb
    WHERE id_alimento = p_alimento;
END //
DELIMITER ;

CALL InsertarAlimentacion(1, 1, 50, 'Kilogramos',50); -- Heno seco
CALL InsertarAlimentacion(1, 2, 30, 'Kilogramos',30); -- Concentrado bovino
CALL InsertarAlimentacion(1, 3, 20, 'Kilogramos',20); -- Sal mineralizada
CALL InsertarAlimentacion(2, 4, 40, 'Kilogramos',40); -- Avena molida
CALL InsertarAlimentacion(2, 5, 40, 'Kilogramos',40); -- Pasto fresco
CALL InsertarAlimentacion(2, 6, 25, 'Kilogramos',25); -- Concentrado equino
CALL InsertarAlimentacion(3, 7, 40, 'Kilogramos',40); -- Maíz molido
CALL InsertarAlimentacion(3, 8, 30, 'Litros',30);     -- Agua tratada
CALL InsertarAlimentacion(4, 9, 15, 'Kilogramos',15); -- Concentrado porcino
CALL InsertarAlimentacion(4, 10, 35, 'Litros',35);    -- Suero de leche
CALL InsertarAlimentacion(1, 1, 40, 'Kilogramos',40);
CALL InsertarAlimentacion(1, 2, 50, 'Kilogramos',50);
CALL InsertarAlimentacion(1, 3, 30, 'Kilogramos',30);
CALL InsertarAlimentacion(2, 4, 20, 'Kilogramos',20);
CALL InsertarAlimentacion(2, 5, 80, 'Kilogramos',80);
CALL InsertarAlimentacion(2, 6, 40, 'Kilogramos',40);
CALL InsertarAlimentacion(3, 7, 20, 'Kilogramos',20);
CALL InsertarAlimentacion(3, 8, 40, 'Litros',40);
CALL InsertarAlimentacion(4, 9, 10, 'Kilogramos',10);
CALL InsertarAlimentacion(4, 10, 40, 'Litros',40);
CALL InsertarAlimentacion(1, 1, 30, 'Kilogramos',30);
CALL InsertarAlimentacion(2, 5, 50, 'Kilogramos',50);
CALL InsertarAlimentacion(3, 7, 20, 'Kilogramos',20);
CALL InsertarAlimentacion(4, 9, 20, 'Kilogramos',20);


CREATE PROCEDURE ConsultaGeneralAlimentacion()
	SELECT 
        Alimentacion.id_alimentacion,
        Especie.nombre AS "especie",
        Alimento.descripcion AS "alimento",
        Alimentacion.cantidad,
        Alimentacion.unidad_medida,
        Alimentacion.fecha
    FROM Alimentacion
    INNER JOIN Alimento ON Alimento.id_alimento = Alimentacion.alimento
    INNER JOIN Especie ON Especie.id_especie = Alimentacion.especie
    WHERE Alimentacion.estado = 'Activo'
    ORDER BY Alimentacion.id_alimentacion ASC;

CREATE PROCEDURE ConsultarAlimentacionPorID(
    IN p_id_alimentacion INT UNSIGNED
)
    	SELECT 
        Alimentacion.id_alimentacion,
        Especie.nombre AS "especie",
        Alimento.descripcion AS "alimento",
        Alimentacion.cantidad,
        Alimentacion.unidad_medida,
        Alimentacion.fecha
    FROM Alimentacion
    INNER JOIN Alimento ON Alimento.id_alimento = Alimentacion.alimento
    INNER JOIN Especie ON Especie.id_especie = Alimentacion.especie
    WHERE Alimentacion.estado = 'Activo'
    AND id_alimentacion = p_id_alimentacion;

DELIMITER //

CREATE PROCEDURE ActualizarAlimentacion(
    IN p_id_alimentacion INT UNSIGNED,
    IN p_cantidad DECIMAL(10,6) UNSIGNED,
    IN p_cantidadB DECIMAL(10,6),  -- nueva cantidad en base
    IN p_cantidadAnterior DECIMAL(10,6)
)
BEGIN
    DECLARE v_cantidad_anterior DECIMAL(10,6);
    DECLARE v_id_alimento TINYINT UNSIGNED;
    DECLARE v_diferencia DECIMAL(10,6);
    
    -- 1. Obtener el ID del alimento correspondiente a la alimentación
    SELECT alimento
    INTO v_id_alimento
    FROM Alimentacion
    WHERE id_alimentacion = p_id_alimentacion;

    -- 2. Calcular la diferencia entre lo anterior y lo nuevo
    SET v_cantidad_anterior = p_cantidadAnterior;
    SET v_diferencia = v_cantidad_anterior - p_cantidadB;

    -- 3. Actualizar la tabla Alimentacion con la nueva cantidad
    UPDATE Alimentacion
    SET cantidad = p_cantidad
    WHERE id_alimentacion = p_id_alimentacion;

    -- 4. Ajustar el stock del alimento
    UPDATE Alimento
    SET cantidad = GREATEST(cantidad + v_diferencia, 0)
    WHERE id_alimento = v_id_alimento;
END //

DELIMITER ;


#---------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE Produccion(
	id_produccion INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tipo_produccion VARCHAR(255) NOT NULL,
    cantidad SMALLINT UNSIGNED NOT NULL,
    unidad_medida ENUM('Kilogramos','Litros','Unidades','Porciones') NOT NULL,
    fecha DATE NOT NULL,
    especie TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (especie) REFERENCES Especie(id_especie),
    estado ENUM('Activo','Inactivo') DEFAULT 'Activo'
);


#procedimientos almacenados produccion
CREATE PROCEDURE InsertarProduccion
(
    IN p_tipo_produccion VARCHAR(255),
    IN p_cantidad SMALLINT UNSIGNED,
    IN p_unidad ENUM('Kilogramos','Litros','Unidades','Porciones'),
    IN p_especie SMALLINT UNSIGNED
)
    INSERT INTO Produccion (tipo_produccion, cantidad,unidad_medida,fecha, especie) 
    VALUES (p_tipo_produccion, p_cantidad,p_unidad,CURRENT_TIMESTAMP, p_especie);


CREATE PROCEDURE InsertarProduccionConFecha
(
    IN p_tipo_produccion VARCHAR(255),
    IN p_cantidad SMALLINT UNSIGNED,
    IN p_tipo ENUM('Kilogramos','Litros','Unidades','Porciones'),
    IN p_fecha DATE,
    IN p_especie SMALLINT UNSIGNED
)
    INSERT INTO Produccion (tipo_produccion, cantidad, unidad_medida, fecha, especie)
    VALUES (p_tipo_produccion, p_cantidad, p_tipo, p_fecha, p_especie);
-- Enero
CALL InsertarProduccionConFecha('Leche', 120, 'Litros', '2025-01-05', 1);
CALL InsertarProduccionConFecha('Huevos', 250, 'Kilogramos', '2025-01-12', 3);
CALL InsertarProduccionConFecha('Carne', 80, 'Kilogramos', '2025-01-22', 4);
-- Febrero
CALL InsertarProduccionConFecha('Leche', 140, 'Litros', '2025-02-03', 1);
CALL InsertarProduccionConFecha('Huevos', 270, 'Kilogramos', '2025-02-15', 3);
CALL InsertarProduccionConFecha('Carne', 75, 'Kilogramos', '2025-02-24', 4);
-- Marzo
CALL InsertarProduccionConFecha('Leche', 135, 'Litros', '2025-03-10', 1);
CALL InsertarProduccionConFecha('Huevos', 260, 'Kilogramos', '2025-03-18', 3);
CALL InsertarProduccionConFecha('Carne', 85, 'Kilogramos', '2025-03-25', 4);
-- Abril
CALL InsertarProduccionConFecha('Leche', 155, 'Litros', '2025-04-08', 1);
CALL InsertarProduccionConFecha('Huevos', 280, 'Kilogramos', '2025-04-16', 3);
CALL InsertarProduccionConFecha('Carne', 90, 'Kilogramos', '2025-04-27', 4);
-- Mayo
CALL InsertarProduccionConFecha('Leche', 160, 'Litros', '2025-05-06', 1);
CALL InsertarProduccionConFecha('Huevos', 300, 'Kilogramos', '2025-05-15', 3);
CALL InsertarProduccionConFecha('Carne', 100, 'Kilogramos', '2025-05-23', 4);
-- Junio
CALL InsertarProduccionConFecha('Leche', 145, 'Litros', '2025-06-04', 1);
CALL InsertarProduccionConFecha('Huevos', 290, 'Kilogramos', '2025-06-14', 3);
CALL InsertarProduccionConFecha('Carne', 110, 'Kilogramos', '2025-06-29', 4);
-- Julio
CALL InsertarProduccionConFecha('Leche', 170, 'Litros', '2025-07-02', 1);
CALL InsertarProduccionConFecha('Huevos', 310, 'Kilogramos', '2025-07-11', 3);
CALL InsertarProduccionConFecha('Carne', 95, 'Kilogramos', '2025-07-25', 4);
-- Agosto
CALL InsertarProduccionConFecha('Leche', 165, 'Litros', '2025-08-09', 1);
CALL InsertarProduccionConFecha('Huevos', 305, 'Kilogramos', '2025-08-19', 3);
CALL InsertarProduccionConFecha('Carne', 105, 'Kilogramos', '2025-08-27', 4);
-- Septiembre
CALL InsertarProduccionConFecha('Leche', 150, 'Litros', '2025-09-03', 1);
CALL InsertarProduccionConFecha('Huevos', 295, 'Kilogramos', '2025-09-13', 3);
CALL InsertarProduccionConFecha('Carne', 100, 'Kilogramos', '2025-09-22', 4);
-- Octubre
CALL InsertarProduccionConFecha('Leche', 175, 'Litros', '2025-10-06', 1);
CALL InsertarProduccionConFecha('Huevos', 320, 'Kilogramos', '2025-10-18', 3);
CALL InsertarProduccionConFecha('Carne', 115, 'Kilogramos', '2025-10-29', 4);
-- Noviembre
CALL InsertarProduccionConFecha('Leche', 160, 'Litros', '2025-11-04', 1);
CALL InsertarProduccionConFecha('Huevos', 310, 'Kilogramos', '2025-11-15', 3);
CALL InsertarProduccionConFecha('Carne', 120, 'Kilogramos', '2025-11-24', 4);
-- Diciembre
CALL InsertarProduccionConFecha('Leche', 180, 'Litros', '2025-12-07', 1);
CALL InsertarProduccionConFecha('Huevos', 330, 'Kilogramos', '2025-12-17', 3);
CALL InsertarProduccionConFecha('Carne', 125, 'Kilogramos', '2025-12-27', 4);


CREATE PROCEDURE ConsultaGeneralProduccion()
	SELECT Produccion.id_produccion,Produccion.tipo_produccion,Produccion.cantidad,Produccion.unidad_medida,Produccion.fecha,Especie.nombre 
    FROM Especie INNER JOIN Produccion ON Especie.id_especie=Produccion.especie WHERE Produccion.estado='Activo' ORDER BY Produccion.id_produccion;


CREATE PROCEDURE ConsultarProduccionPorID(	
IN p_id_produccion INT UNSIGNED)
    SELECT Produccion.id_produccion,Produccion.tipo_produccion,Produccion.cantidad,Produccion.unidad_medida,Produccion.fecha,Especie.id_especie,Especie.nombre 
    FROM Especie INNER JOIN Produccion ON Especie.id_especie=Produccion.especie WHERE Produccion.estado='Activo' AND Produccion.id_produccion=p_id_produccion;


CREATE PROCEDURE ActualizarProduccion(
    IN p_id_produccion INT UNSIGNED,
    IN p_tipo_produccion VARCHAR(255),
    IN p_cantidad SMALLINT UNSIGNED,
    IN p_especie TINYINT UNSIGNED
)
    UPDATE Produccion
    SET 
        tipo_produccion = p_tipo_produccion,
        cantidad = p_cantidad,
        especie = p_especie
    WHERE id_produccion = p_id_produccion;

CREATE PROCEDURE EliminarProduccion(
    IN p_id_produccion INT UNSIGNED
)
    UPDATE Produccion
    SET estado=2
    WHERE id_produccion = p_id_produccion;

#----------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE Historial_clinico (
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    animal SMALLINT UNSIGNED NOT NULL,
    fecha DATE DEFAULT CURRENT_TIMESTAMP,
    descripcion TEXT NOT NULL,
    tratamiento TEXT NOT NULL,
    FOREIGN KEY (animal) REFERENCES animal(id_animal),
    estado ENUM('Activo','Inactivo') DEFAULT 'Activo'
);


#procedimientos almacenados historial
CREATE PROCEDURE InsertarHistorial(
    IN p_animal SMALLINT UNSIGNED,
    IN p_descripcion TEXT,
    IN p_tratamiento TEXT
)
    INSERT INTO historial_clinico 
    (animal, descripcion, tratamiento) 
    VALUES (p_animal, p_descripcion, p_tratamiento);

CALL InsertarHistorial(1, 'Consulta general para chequeo anual', 'Vacunación y análisis de sangre');
CALL InsertarHistorial(2, 'Revisión post-operatoria', 'Administración de antibióticos y analgésicos');
CALL InsertarHistorial(3, 'Chequeo dental', 'Limpieza dental y revisión de encías');
CALL InsertarHistorial(4, 'Evaluación de comportamiento', 'Aplicación de suplemento nutricional');
CALL InsertarHistorial(5, 'Examen de rutina', 'Desparasitación interna y externa');
CALL InsertarHistorial(1, 'Lesión en pata delantera', 'Curación de herida y vendaje');
CALL InsertarHistorial(2, 'Signos de infección respiratoria', 'Tratamiento con antibióticos y descanso');
CALL InsertarHistorial(3, 'Dolor abdominal', 'Análisis clínico y dieta blanda');
CALL InsertarHistorial(4, 'Control de peso', 'Plan de alimentación y ejercicio');
CALL InsertarHistorial(5, 'Revisión ocular', 'Limpieza y aplicación de colirios');
CALL InsertarHistorial(1, 'Problemas de piel', 'Aplicación de crema antiinflamatoria');
CALL InsertarHistorial(2, 'Consulta preventiva', 'Evaluación general y vacunación complementaria');
CALL InsertarHistorial(3, 'Estrés post traslado', 'Administración de sedante leve');
CALL InsertarHistorial(4, 'Chequeo cardiológico', 'Ecodoppler y seguimiento');
CALL InsertarHistorial(5, 'Problemas digestivos', 'Cambio de dieta y probióticos');
CALL InsertarHistorial(1, 'Herida en cola', 'Sutura y seguimiento');
CALL InsertarHistorial(2, 'Revisión de articulaciones', 'Suplemento para articulaciones y fisioterapia');
CALL InsertarHistorial(3, 'Lesión leve en oreja', 'Limpieza, desinfección y vendaje');
CALL InsertarHistorial(4, 'Chequeo de visión', 'Examen ocular y prescripción de colirios');
CALL InsertarHistorial(5, 'Chequeo post vacunación', 'Monitoreo y análisis de reacción');
CALL InsertarHistorial(1, 'Alérgia estacional', 'Antihistamínico y cambios en la dieta');
CALL InsertarHistorial(2, 'Dolor articular', 'Fisioterapia y medicación antiinflamatoria');
CALL InsertarHistorial(3, 'Consulta de seguimiento', 'Revisión y ajustes en tratamiento');
CALL InsertarHistorial(4, 'Signos de deshidratación', 'Hidratación intravenosa y reposo');
CALL InsertarHistorial(5, 'Chequeo pre-competencia', 'Examen físico y evaluación de condición física');
CALL InsertarHistorial(1, 'Inspección de heridas leves', 'Limpieza y aplicación de pomada');
CALL InsertarHistorial(2, 'Revisión de pérdida de apetito', 'Evaluación nutricional y suplementación');
CALL InsertarHistorial(3, 'Consulta por letargo', 'Análisis de energía y niveles hormonales');
CALL InsertarHistorial(4, 'Control de signos vitales', 'Monitoreo y recomendación de actividad moderada');
CALL InsertarHistorial(5, 'Evaluación por tos persistente', 'Estudio respiratorio y prescripción de broncodilatador');

CREATE PROCEDURE ConsultaGeneralHistorial()
	SELECT historial_clinico.id_historial, historial_clinico.fecha, Animal.nombre as "animal",Especie.nombre as "especie" ,historial_clinico.descripcion,historial_clinico.tratamiento 
    FROM Especie 
    INNER JOIN Animal ON Especie.id_especie = Animal.especie 
    INNER JOIN Historial_clinico ON Historial_clinico.animal=Animal.id_animal 
    WHERE Historial_clinico.estado=1
    ORDER BY Historial_clinico.id_historial;


CREATE PROCEDURE ConsultarhistorialPorID (
     IN p_id_historial INT
)
    SELECT historial_clinico.id_historial, historial_clinico.fecha, Animal.nombre as "animal",Especie.nombre as "especie" ,historial_clinico.descripcion,historial_clinico.tratamiento 
    FROM Especie 
    INNER JOIN Animal ON Especie.id_especie = Animal.especie 
    INNER JOIN Historial_clinico ON Historial_clinico.animal=Animal.id_animal 
    WHERE Historial_clinico.estado=1
    AND id_historial = p_id_historial;


CREATE PROCEDURE Actualizarhistorial(
    IN p_id_historial INT,
    IN p_descripcion TEXT,
    IN p_tratamiento TEXT
)
UPDATE Historial 
    SET 
	fecha = CURRENT_DATE(),
	descripcion = p_descripcion,
    tratamiento = p_tratamiento
	WHERE id_historial = p_id_historial;


CREATE PROCEDURE Eliminarhistorial
(
	IN p_id_historial INT 
)
    UPDATE historial_clinico
    SET estado=2
    WHERE id_historial = p_id_historial;


#-------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE Finanzas (
    id_transaccion INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('ingreso', 'egreso') NOT NULL,
    monto DECIMAL(15,2) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha DATE DEFAULT CURRENT_TIMESTAMP,
    registrado_por TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (registrado_por) REFERENCES usuario(id_usuario),
    estado ENUM('Activo','Inactivo') DEFAULT 'Activo'
);

    
#procedimientos almacenados finanzas
CREATE PROCEDURE ResumenFinanciero()
	SELECT 
		SUM(CASE WHEN tipo = 'ingreso' THEN monto ELSE 0 END) AS total_ingresos,
		SUM(CASE WHEN tipo = 'egreso' THEN monto ELSE 0 END) AS total_egresos,
		SUM(CASE WHEN tipo = 'ingreso' THEN monto ELSE 0 END) - 
		SUM(CASE WHEN tipo = 'egreso' THEN monto ELSE 0 END) AS balance
	FROM Finanzas
	WHERE estado = 'Activo';

CREATE PROCEDURE InsertarFinanzas
(
    IN p_tipo ENUM('ingreso', 'egreso'),
    IN p_monto DECIMAL(15,2),
    IN p_descripcion TEXT,
    IN p_registrado_por TINYINT UNSIGNED
)
    INSERT INTO Finanzas
    (tipo, monto, descripcion, registrado_por) 
    VALUES (p_tipo, p_monto, p_descripcion, p_registrado_por);

CALL InsertarFinanzas('ingreso', 2500000.00, 'Venta de productos agrícolas', 1);
CALL InsertarFinanzas('egreso', 350000.00, 'Compra de alimento para ganado', 1);
CALL InsertarFinanzas('ingreso', 1250000.00, 'Subsidio estatal recibido', 1);
CALL InsertarFinanzas('egreso', 200000.00, 'Pago de servicios públicos', 1);
CALL InsertarFinanzas('egreso', 450000.00, 'Mantenimiento de maquinaria', 1);
CALL InsertarFinanzas('ingreso', 980000.00, 'Ingreso por asesoría técnica', 1);
CALL InsertarFinanzas('ingreso', 500000.00, 'Reembolso de gastos operativos', 1);
CALL InsertarFinanzas('egreso', 120000.00, 'Transporte de productos', 1);
CALL InsertarFinanzas('ingreso', 2100000.00, 'Venta de leche', 1);
CALL InsertarFinanzas('egreso', 700000.00, 'Compra de insumos agrícolas', 1);

CREATE PROCEDURE ConsultaGeneralFinanzas()
	SELECT id_transaccion,tipo,monto,descripcion,fecha,nombre,apellido FROM Usuario INNER JOIN Finanzas ON id_usuario=registrado_por WHERE Finanzas.estado=1;
    

CREATE PROCEDURE ConsultarfinanzasPorID(
IN p_id_transaccion INT
)
   SELECT id_transaccion,tipo,monto,descripcion,fecha,nombre,apellido FROM Usuario INNER JOIN Finanzas ON id_usuario=registrado_por WHERE Finanzas.estado=1
   AND id_transaccion = p_id_transaccion;

CREATE PROCEDURE Actualizarfinanzas
(
    IN p_id_transaccion INT,
    IN p_tipo ENUM('Ingreso', 'Egreso'),
    IN p_monto DECIMAL(15,2),
    IN p_descripcion TEXT
)
UPDATE Finanzas
    SET 
    tipo = p_tipo,
    monto = p_monto,
    descripcion = p_descripcion
WHERE id_transaccion = p_id_transaccion;

CREATE PROCEDURE Eliminafinanzas(
   IN p_id_transaccion INT
)
   UPDATE Finanzas
   SET estado=2
   WHERE id_transaccion = p_id_transaccion;
