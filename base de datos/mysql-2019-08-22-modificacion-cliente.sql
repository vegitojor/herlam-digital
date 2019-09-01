Alter table cliente add column depto varchar(100) NULL;
Alter table cliente add column piso varchar(50) NULL;
Alter table cliente add column cuit_cuil varchar(25) NULL;
Alter table cliente add column id_condicion_iva int NULL;


DROP TABLE carrito_compra;
CREATE TABLE carrito_compra (
    id INT NOT NULL AUTO_INCREMENT,
	id_cliente INT NOT NULL,
	id_producto INT NOT NULL,
	fecha DATETIME NOT NULL,
	cantidad INT,
	PRIMARY KEY (id),
	FOREIGN KEY (id_cliente) REFERENCES cliente(id),
	FOREIGN KEY (id_producto) REFERENCES producto(id)
);

Alter table carrito_compra add column id_pedido INT NULL;
Alter table carrito_compra add column precio DEcimal(6,2) NULL;

Alter table carrito_compra add FOREIGN KEY (id_pedido) REFERENCES pedido(id);

ALTER TABLE pedido ADD COLUMN envio_domicilio TINYINT NULL;