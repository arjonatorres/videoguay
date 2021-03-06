------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
    id         bigserial    PRIMARY KEY
  , nombre     varchar(255) NOT NULL UNIQUE
  , password   varchar(255) NOT NULL
  , email      varchar(255) NOT NULL
  , auth_key   varchar(255)
  , token_val  varchar(255) UNIQUE
  , created_at timestamp(0) NOT NULL DEFAULT localtimestamp
);

CREATE INDEX idx_usuarios_email ON usuarios (email);

DROP TABLE IF EXISTS socios CASCADE;

CREATE TABLE socios
(
    id        bigserial    PRIMARY KEY
  , numero    numeric(6)   NOT NULL UNIQUE
  , nombre    varchar(255) NOT NULL
  , direccion varchar(255)
  , telefono  numeric(9)   CONSTRAINT ck_telefono_no_negativo
                           CHECK (telefono IS NULL OR telefono >= 0)
);

CREATE INDEX idx_socios_nombre ON socios (nombre);
CREATE INDEX idx_socios_telefono ON socios (telefono);

DROP TABLE IF EXISTS peliculas CASCADE;

CREATE TABLE peliculas
(
    id         bigserial    PRIMARY KEY
  , codigo     numeric(4)   NOT NULL UNIQUE
  , titulo     varchar(255) NOT NULL
  , precio_alq numeric(5,2) NOT NULL
);

CREATE INDEX idx_peliculas_titulo ON peliculas (titulo);

DROP TABLE IF EXISTS alquileres CASCADE;

CREATE TABLE alquileres
(
    id          bigserial    PRIMARY KEY
  , socio_id    bigint       NOT NULL REFERENCES socios (id)
                             ON DELETE NO ACTION ON UPDATE CASCADE
  , pelicula_id bigint       NOT NULL REFERENCES peliculas (id)
                             ON DELETE NO ACTION ON UPDATE CASCADE
  , created_at  timestamp(0) NOT NULL DEFAULT localtimestamp
  , devolucion  timestamp(0)
  , UNIQUE (socio_id, pelicula_id, created_at)
);

CREATE INDEX idx_alquileres_pelicula_id ON alquileres (pelicula_id);
CREATE INDEX idx_alquileres_created_at ON alquileres (created_at DESC);

INSERT INTO usuarios (nombre, password, email)
     VALUES('pepe', crypt('pepe', gen_salt('bf', 13)), 'pepe@pepe.com')
         , ('juan', crypt('juan', gen_salt('bf', 13)), 'juan@juan.com');

INSERT INTO socios (numero, nombre, direccion, telefono)
     VALUES (100, 'Pepe', 'Su casa', 956956956)
          , (200, 'Juan', 'Su hogar', 856856856)
          , (300, 'María', 'Su calle', 756756756);

INSERT INTO peliculas (codigo, titulo, precio_alq)
     VALUES (1000, 'Los últimos Jedi', 5)
          , (2000, 'La amenaza fantasma', 4)
          , (3000, 'El ataque de los clones', 3);

INSERT INTO alquileres (socio_id, pelicula_id, created_at, devolucion)
     VALUES (1, 1, localtimestamp - 'P4D'::interval, null) --current_timestamp - 'P3D'::interval)
          , (1, 2, localtimestamp - 'P2D'::interval, null)
          , (1, 3, localtimestamp - 'P1D'::interval, null); --current_timestamp)
          --, (3, 1, current_timestamp - 'P3D'::interval, null);
