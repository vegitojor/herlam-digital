CREATE TABLE estado_pedido (
    id INT NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);



CREATE TABLE pedido (
  id INT NOT NULL AUTO_INCREMENT,
  id_cliente INT NOT NULL,
fecha DATETIME NOT NULL,
id_estado_pedido INT,
id_localidad INT,
  calle VARCHAR(30) NULL,
  numero VARCHAR(100) NULL,
  codigo_postal INT NULL,
  piso VARCHAR(255) NULL,
  depto VARCHAR(255) NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_localidad) REFERENCES localidad(id),
  FOREIGN KEY (id_cliente) REFERENCES cliente(id),
  FOREIGN KEY (id_estado_pedido) REFERENCES estado_pedido(id));

Alter table carrito_compra add column id_pedido INT NULL;
Alter table carrito_compra add column precio DEcimal(6,2) NULL;

Alter table carrito_compra add FOREIGN KEY (id_pedido) REFERENCES pedido(id);


