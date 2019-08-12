ALTER TABLE cliente
    ADD column activo tinyint(1) null;

ALTER TABLE cliente
    ADD column existe tinyint(1) null;

update cliente
   set existe=1
 where existe is null;