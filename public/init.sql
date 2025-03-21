 CREATE DATABASE hilera;

 USE hilera;


-- CATEGORIAS
CREATE TABLE `categorias` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;

-- PRODUCTOS
CREATE TABLE `productos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
	`stock` INT(11) NOT NULL DEFAULT '0',
	`category_id` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `FK__categories` (`category_id`) USING BTREE,
	CONSTRAINT `FK__categories` FOREIGN KEY (`category_id`) REFERENCES `hilera`.`categorias` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;

-- Inserción de categorías relacionadas con hilos y costura
INSERT INTO categorias (nombre) VALUES
('Hilos de algodón'),
('Hilos de poliéster'),
('Hilos de bordado'),
('Hilos elásticos'),
('Hilos de nylon'),
('Hilos metálicos'),
('Hilos encerados'),
('Hilos para quilting'),
('Hilos de seda'),
('Accesorios para hilos');

-- Inserción de productos relacionados con hilos
INSERT INTO productos (nombre, stock, category_id) VALUES
('Hilo algodón blanco', 100, 1),
('Hilo algodón negro', 80, 1),
('Hilo poliéster rojo', 120, 2),
('Hilo poliéster azul', 90, 2),
('Hilo para bordado dorado', 60, 3),
('Hilo para bordado plateado', 50, 3),
('Hilo elástico negro', 70, 4),
('Hilo elástico transparente', 65, 4),
('Hilo de nylon extra resistente', 85, 5),
('Hilo de nylon para pespunte', 75, 5),
('Hilo metálico dorado', 40, 6),
('Hilo metálico plateado', 35, 6),
('Hilo encerado marrón', 95, 7),
('Hilo encerado beige', 85, 7),
('Hilo para quilting multicolor', 55, 8),
('Hilo para quilting azul', 65, 8),
('Hilo de seda natural', 30, 9),
('Hilo de seda blanca', 45, 9),
('Agujas para hilos gruesos', 200, 10),
('Agujas para bordado', 150, 10),
('Porta hilos de madera', 40, 10),
('Cortador de hilos portátil', 90, 10),
('Guía de costura para hilos finos', 70, 10),
('Bobinas de repuesto para máquinas de coser', 110, 10);

