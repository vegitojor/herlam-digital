ALTER TABLE `venta_cliente_producto` ADD `total` INT UNSIGNED NOT NULL AFTER `precio_por_cada_uno`;

ALTER TABLE `venta_cliente_producto` ADD `acreditado_MP` BOOLEAN NOT NULL AFTER `total`;

ALTER TABLE `venta_cliente_producto` CHANGE `total` `total` INT(10) UNSIGNED NULL DEFAULT NULL;

CREATE TABLE `modpc`.`carrito_compra` ( `id_cliente` INT NOT NULL , `id_producto` INT NOT NULL , `fecha` DATETIME NOT NULL , PRIMARY KEY (`id_cliente`, `id_producto`)) ENGINE = InnoDB;

ALTER TABLE `carrito_compra` ADD FOREIGN KEY (`id_cliente`) REFERENCES `cliente`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `carrito_compra` ADD FOREIGN KEY (`id_producto`) REFERENCES `producto`(`id_producto`) ON DELETE RESTRICT ON UPDATE RESTRICT;


ALTER TABLE `venta_cliente_producto` ADD `id_estado_venta` INT NOT NULL AFTER `total`;

CREATE TABLE `modpc`.`estado_venta` ( `id_estado` INT NOT NULL AUTO_INCREMENT , `descripcion` VARCHAR(50) NOT NULL , PRIMARY KEY (`id_estado`)) ENGINE = InnoDB;

ALTER TABLE `modpc`.`venta_cliente_producto` DROP INDEX `id_estado_venta`, ADD INDEX `id_estado_venta` (`id_estado_venta`) USING BTREE;

ALTER TABLE `venta_cliente_producto` ADD CONSTRAINT `fk_id_estado` FOREIGN KEY (`id_estado_venta`) REFERENCES `estado_venta`(`id_estado`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `valoracion_producto` ADD FOREIGN KEY (`producto_id_producto`) REFERENCES `producto`(`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `valoracion_producto` ADD FOREIGN KEY (`id_cliente`) REFERENCES `cliente`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `moneda` CHANGE `valor_en_peso` `valor_en_peso` DECIMAL(7,2) NULL DEFAULT NULL;

