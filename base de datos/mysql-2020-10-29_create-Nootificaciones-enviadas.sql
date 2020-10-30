CREATE TABLE notificaciones_enviadas (
  id INT NOT NULL AUTO_INCREMENT,
  destinatarios TEXT NOT NULL,
  cantidad_destinatarios INT,
  asunto VARCHAR(250),
  fecha DATETIME NOT NULL,
  usuario_id int NOT NULL,
  mensaje varchar(65000),
  PRIMARY KEY (id),
  FOREIGN KEY (usuario_id) REFERENCES cliente(id));