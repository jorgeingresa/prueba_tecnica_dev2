ALTER SESSION SET CONTAINER = XEPDB1;
ALTER SESSION SET CURRENT_SCHEMA = PRUEBA;

INSERT INTO categorias (descripcion, activa) VALUES ('Premium', 1);
INSERT INTO categorias (descripcion, activa) VALUES ('Básica', 0);


-- Persona con categoría activa (debería aparecer)
INSERT INTO personas (nombre, categoria_id, estado)
VALUES ('Juan Pérez', 1, 1);

-- Persona con categoría INACTIVA (desaparece por el bug del LEFT JOIN)
INSERT INTO personas (nombre, categoria_id, estado)
VALUES ('Ana Gómez', 2, 1);

-- Persona SIN categoría (LEFT JOIN debería permitirla)
INSERT INTO personas (nombre, categoria_id, estado)
VALUES ('Pedro Soto', NULL, 1);

-- Persona inactiva (correctamente filtrada)
INSERT INTO personas (nombre, categoria_id, estado)
VALUES ('Usuario Inactivo', 1, 0);


INSERT INTO pagos (monto) VALUES (100);
INSERT INTO pagos (monto) VALUES (0);
INSERT INTO pagos (monto) VALUES (NULL);
COMMIT;
