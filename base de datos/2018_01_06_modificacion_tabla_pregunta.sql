ALTER TABLE `pregunta` CHANGE `fecha` `fecha` DATETIME NOT NULL;

ALTER TABLE `respuesta` ADD `fecha_respuesta` DATETIME NULL DEFAULT NULL AFTER `pregunta_id_pregunta`;

--ALTER TABLE `localidad` CHANGE `id_privincia` `id_provincia` INT(11) NOT NULL;