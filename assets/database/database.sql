CREATE TABLE usuarios(
id              int(255) auto_increment not null,
nombre          varchar(100) not null,
apellidos       varchar(255) not null,
email           varchar(255) not null,
password        varchar(255) not null,
rol             varchar(40),
imagen          varchar(2500),
PRIMARY KEY(id),
UNIQUE(email)
)ENGINE=InnoDb;


INSERT INTO usuarios (id, nombre, apellidos, email, password, rol, imagen)
VALUES (NULL, 'Admin', 'Admin', 'admin@admin.com','admin', 'administrador', null);


CREATE TABLE categorias(
id              int(255) auto_increment not null,
nombre          varchar(100) not null,
PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO categorias(id, nombre) VALUES(NULL, 'revistas');
INSERT INTO categorias(id, nombre) VALUES(NULL, 'figuras');
INSERT INTO categorias(id, nombre) VALUES(NULL, 'accesorios');
INSERT INTO categorias(id, nombre) VALUES(NULL, 'ropa');


CREATE TABLE productos(
id              int(255) auto_increment not null,
categoria_id    int(255) not null,
nombre          varchar(100) not null,
descripcion     text,
precio          float(100,2) not null,
stock           int(255) not null,
oferta          varchar(2),
fecha           date not null,
imagen          varchar(255),
PRIMARY KEY(id),
FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;


CREATE TABLE pedidos(
id              int(255) auto_increment not null,
usuario_id      int(255) not null,
provincia       varchar(255) not null,
localidad       varchar(255) not null,
direccion       varchar(255) not null,
coste           float(200,2) not null,
estado          varchar(20) not null,
fecha           date,
hora            time,
PRIMARY KEY(id),
FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;


CREATE TABLE lineas_pedidos(
id              int(255) auto_increment not null,
pedido_id       int(255) not null,
producto_id     int(255) not null,
unidades        int(255) not null,
PRIMARY KEY(id),
FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=INNODB;