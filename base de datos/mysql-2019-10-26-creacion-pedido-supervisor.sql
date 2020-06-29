CREATE TABLE estado_pedido_supervisor (
  id INT NOT NULL AUTO_INCREMENT,
  nombre varchar(250) NOT NULL,
  PRIMARY KEY (id));


CREATE TABLE pedido_supervisor (
  id INT NOT NULL AUTO_INCREMENT,
  id_pedido INT NOT NULL,
  id_estado_pedido_supervisor INT,
  fecha DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_pedido) REFERENCES pedido(id),
  FOREIGN KEY (id_estado_pedido_supervisor) REFERENCES estado_pedido_supervisor(id));

Alter table carrito_compra add column id_pedido_supervisor INT NULL;
Alter table carrito_compra add FOREIGN KEY (id_pedido_supervisor) REFERENCES pedido_supervisor(id);

Insert Into estado_pedido_supervisor (nombre)
values('Pendiente'),
('Realizado'),
('Cancelado');


Alter table cliente add column supervisor tinyint(1) NULL;
update cliente
set supervisor = 0;




