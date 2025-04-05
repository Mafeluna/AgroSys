CREATE DATABASE AgrosysDB;
USE AgrosysDB;

CREATE TABLE Usuario(
	id_usuario TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    documento BIGINT UNSIGNED UNIQUE NOT NULL,
    email VARCHAR(255) NOT NULL,
    clave VARCHAR(255) NOT NULL,
    rol ENUM('Administrador','Encargado Animales','Encargado de Producción','Veterinario') NOT NULL,
    telefono INT UNSIGNED NOT NULL,
	direccion VARCHAR(255) NOT NULL,
    fecha_registro DATE DEFAULT CURRENT_TIMESTAMP,
	estado ENUM('Activo','Inactivo') DEFAULT 'Activo'
);

INSERT INTO Usuario (nombre, apellido, documento, email, clave, rol, telefono, direccion)
VALUES ('Maria Fernanda', 'Luna', 1031651096, 'smfernandaluna@gmail.com', 'MAFE123', 1, 3052955391, 'cll 146 #138a-04');


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
    IN p_rol ENUM('Administrador','Encargado Animales','Encargado de Producción','Veterinario'),
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
    IN p_rol ENUM('Administrador','Encargado Animales','Encargado de Producción','Veterinario'),
    IN p_telefono INT UNSIGNED,
    IN p_direccion VARCHAR(255)
)
    UPDATE Usuario
    SET nombre = p_nombre,
        apellido = p_apellido,
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
    estado ENUM('Activo','Inactivo')
);

#procedimientos almacenados especie
CREATE PROCEDURE RegistrarEspecie(
	IN p_nombre VARCHAR(50),
    IN p_cantidad SMALLINT UNSIGNED
)
	INSERT INTO Especie(nombre,cantidad) VALUES(p_nombre,p_cantidad);

CREATE PROCEDURE ConsultaGeneralEspecie()
	SELECT*FROM Especie WHERE estado=1;

CREATE PROCEDURE ConsultaEspecificaEspecie(
	IN p_id_especie TINYINT UNSIGNED
) 
	SELECT*FROM Especie WHERE id_especie = p_id_especie AND estado=1;

CREATE PROCEDURE ModificarEspecie(
	IN p_id_especie TINYINT UNSIGNED,
    IN p_nombre VARCHAR(50),
    IN p_cantidad SMALLINT UNSIGNED
)
	UPDATE Especie
    SET nombre = p_nombre,
		cantidad = p_cantidad
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
    foto LONGBLOB NOT NULL,
    estado ENUM ('Activo','Inactivo') DEFAULT 'Activo'
);

#procedimientos almacenados Animal
CREATE PROCEDURE RegistrarAnimal(
    IN p_nombre VARCHAR(100),
    IN p_especie TINYINT UNSIGNED,
    IN p_peso DECIMAL(5,2),
    IN p_registrado_por TINYINT UNSIGNED,
    IN p_foto LONGBLOB
)
    INSERT INTO Animal (nombre, especie, peso, registrado_por,foto)
    VALUES (p_nombre, p_especie, p_peso, p_registrado_por,p_foto);
    
CREATE PROCEDURE ConsultaGeneralAnimal()
	SELECT Animal.id_animal,Animal.nombre,Animal.especie,Animal.peso,Animal.fecha_ingreso,Usuario.nombre as "nombre_user",Usuario.apellido as "apellido_user",Animal.foto 
    FROM Usuario 
    INNER JOIN Animal ON Animal.registrado_por = Usuario.id_usuario WHERE Animal.estado=1;
    
    
CREATE PROCEDURE ConsultaEspecificaAnimal(
	IN p_id_animal SMALLINT UNSIGNED
)
	SELECT Animal.id_animal,Animal.nombre,Animal.especie,Animal.peso,Animal.fecha_ingreso,Usuario.nombre as "nombre_user",Usuario.apellido as "apellido_user",Animal.foto
    FROM Usuario 
    INNER JOIN Animal ON Animal.registrado_por = Usuario.id_usuario WHERE Animal.estado=1 AND id_animal = p_id_animal;

CREATE PROCEDURE ModificarAnimal(
    IN p_id_animal SMALLINT UNSIGNED,
    IN p_nombre VARCHAR(100),
    IN p_especie ENUM('Vaca', 'Cerdo', 'Gallina', 'Caballo', 'Oveja', 'Pato', 'Conejo','Perro'),
    IN p_peso DECIMAL(5,2)
)
    UPDATE Animal
    SET nombre = p_nombre,
        especie = p_especie,
        peso = p_peso
    WHERE id_animal = p_id_animal;

CREATE PROCEDURE EliminarAnimal(
    IN p_id_animal SMALLINT UNSIGNED
)
    UPDATE Animal
    SET estado = 2
    WHERE id_animal = p_id_animal;


#----------------------------------------------------------------------------------------------------
CREATE TABLE Alimento(
	id_alimento TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(40) NOT NULL,
    especie TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (especie) REFERENCES Especie(id_especie),
    cantidad SMALLINT UNSIGNED NOT NULL,
    tipo_medida ENUM('Kilogramos','Litros') NOT NULL,
    estado ENUM ('Activo','Inactivo') DEFAULT 'Activo'
);

#procedimientos almacenados alimento
CREATE PROCEDURE InsertarAlimento 
(
    IN p_descripcion VARCHAR(40),
    IN p_cantidad SMALLINT UNSIGNED
)
    INSERT INTO Alimento (descripcion, cantidad) 
    VALUES (p_descripcion, p_cantidad);


CREATE PROCEDURE ConsultaGeneralAlimento()
	SELECT*FROM Alimento WHERE estado=1;


CREATE PROCEDURE ConsultarAlimentoPorID(
    IN p_id_alimento TINYINT UNSIGNED
)
    SELECT * FROM Alimento WHERE id_alimento = p_id_alimento;


CREATE PROCEDURE ActualizarAlimento(
    IN p_id_alimento TINYINT UNSIGNED,
    IN p_descripcion VARCHAR(40),
    IN p_cantidad SMALLINT UNSIGNED
)
    UPDATE Alimento
    SET 
    descripcion = p_descripcion,
	cantidad = p_cantidad
    WHERE id_alimento = p_id_alimento;


CREATE PROCEDURE EliminarAlimento(
	IN p_id_alimento TINYINT UNSIGNED
)
    UPDATE Alimento
    SET estado=2
    WHERE id_alimento = p_id_alimento;

#----------------------------------------------------------------------------------------------------------------------------
CREATE TABLE Alimentacion(
	id_alimentacion INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    especie TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (especie) REFERENCES Especie(id_especie),
    alimento TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (alimento) REFERENCES Alimento(id_alimento),
    cantidad SMALLINT UNSIGNED NOT NULL,
    fecha DATE DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('Activo','Inactivo') DEFAULT 'Activo'
);

#procedimientos almacenados
CREATE PROCEDURE InsertarAlimentacion(
    IN p_animal SMALLINT UNSIGNED,
    IN p_alimento TINYINT UNSIGNED,
    IN p_cantidad SMALLINT UNSIGNED
)
    INSERT INTO Alimentacion(animal, alimento, cantidad) 
    VALUES (p_animal, p_alimento, p_cantidad);


CREATE PROCEDURE ConsultaGneralAlimentacion()
	SELECT id_alimentacion,nombre,descripcion,Alimentacion.cantidad,fecha FROM Alimento 
    INNER JOIN Alimentacion ON id_alimento=alimento INNER JOIN Animal ON animal=id_animal WHERE Alimentacion.estado=1;


CREATE PROCEDURE ConsultarAlimentacionPorID(
    IN p_id_alimentacion INT UNSIGNED
)
    SELECT * FROM Alimentacion
    WHERE id_alimentacion = p_id_alimentacion;


CREATE PROCEDURE ActualizarAlimentacion
(
    IN p_id_alimentacion INT UNSIGNED,
    IN p_cantidad SMALLINT UNSIGNED
)
    UPDATE Alimentacion
    SET
	cantidad = p_cantidad
    WHERE id_alimentacion = p_id_alimentacion;

#---------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE Produccion(
	id_produccion INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tipo_produccion VARCHAR(255) NOT NULL,
    cantidad SMALLINT UNSIGNED NOT NULL,
    fecha DATE DEFAULT CURRENT_TIMESTAMP,
    especie TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (especie) REFERENCES Especie(id_especie),
    estado ENUM('Activo','Inactivo') DEFAULT 'Activo'
);

#procedimientos almacenados produccion
CREATE PROCEDURE InsertarProduccion
(
    IN p_tipo_produccion VARCHAR(255),
    IN p_cantidad SMALLINT UNSIGNED,
    IN p_animal SMALLINT UNSIGNED
)
    INSERT INTO Produccion (tipo_produccion, cantidad, animal) 
    VALUES (p_tipo_produccion, p_cantidad, p_animal);


CREATE PROCEDURE ConsultaGeneralProduccion()
	SELECT id_produccion,tipo_produccion,cantidad,fecha,nombre FROM Animal INNER JOIN Produccion ON id_animal=animal WHERE Produccion.estado=1;


CREATE PROCEDURE ConsultarProduccionPorID(	
IN p_id_produccion INT UNSIGNED)
    SELECT * FROM Produccion
    WHERE id_produccion = p_id_produccion AND estado=1;


CREATE PROCEDURE ActualizarProduccion(
    IN p_id_produccion INT UNSIGNED,
    IN p_tipo_produccion VARCHAR(255),
    IN p_cantidad SMALLINT UNSIGNED
)
    UPDATE Produccion
    SET 
    tipo_produccion = p_tipo_produccion,
	cantidad = p_cantidad
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


CREATE PROCEDURE ConsultaGeneralHistorial()
	SELECT historial_clinico.id_historial, historial_clinico.fecha, Animal.nombre as "animal" ,historial_clinico.descripcion,historial_clinico.tratamiento 
    FROM Animal INNER JOIN Historial_clinico ON Historial_clinico.animal=Animal.id_animal WHERE Historial_clinico.estado=1;


CREATE PROCEDURE ConsultarhistorialPorID (
     IN p_id_historial INT
)
    SELECT * FROM historial_clinico
    WHERE id_historial = p_id_historial AND estado=1;


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
CREATE PROCEDURE InsertarFinanzas
(
    IN p_tipo ENUM('ingreso', 'egreso'),
    IN p_monto DECIMAL(15,2),
    IN p_descripcion TEXT,
    IN p_fecha DATE,
    IN p_registrado_por TINYINT UNSIGNED
)
    INSERT INTO Finanzas
    (tipo, monto, descripcion, fecha, registrado_por) 
    VALUES (p_tipo, p_monto, p_descripcion, p_fecha, p_registrado_por);

CREATE PROCEDURE ConsultaGeneralFinanzas()
	SELECT id_transaccion,tipo,monto,descripcion,fecha,nombre FROM Usuario INNER JOIN Finanzas ON id_usuario=registrado_por WHERE Finanzas.estado=1;
    

CREATE PROCEDURE ConsultarfinanzasPorID(
IN p_id_transaccion INT
)
   SELECT * FROM Finanzas
   WHERE id_transaccion = p_id_transaccion AND estado=1;

call ConsultarfinanzasPorID(2);

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
