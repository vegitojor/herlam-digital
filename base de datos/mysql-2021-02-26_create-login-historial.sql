CREATE TABLE login (
  id INT NOT NULL AUTO_INCREMENT,
  id_cliente int NOT NULL,
  fecha_timestamp int,
  fecha DATETIME NOT NULL,
  user_agent varchar(65000),
  PRIMARY KEY (id),
  FOREIGN KEY (id_cliente) REFERENCES cliente(id));