USE proyecto;

-- PRODUCTO
DELIMITER $$
CREATE PROCEDURE spu_producto_registro
(
    IN _codigo        VARCHAR(50),
    IN _nombre        VARCHAR(50),
    IN _precio        DECIMAL(10,2),
    IN _stockMin      INT,
    IN _stock         INT
)
BEGIN
    INSERT INTO productos(codigo, nombre, precio, stockMin, stock)
    VALUES (_codigo, _nombre, _precio, _stockMin, _stock);
END $$

DELIMITER $$
CREATE PROCEDURE spu_producto_actualizarStock
(
    IN _idProducto         INT,
    IN _stock         INT
)
BEGIN
    UPDATE productos
    SET
        stock = _stock
    WHERE idProducto = _idProducto;
END $$

DELIMITER $$
CREATE PROCEDURE spu_producto_lista()
BEGIN
	SELECT * FROM productos;
END $$

DELIMITER $$
CREATE PROCEDURE spu_producto_eliminar( IN _idProducto INT)
BEGIN
	DELETE FROM productos WHERE idProducto = _idProducto;
END $$

DELIMITER $$
CREATE PROCEDURE spu_producto_buscar( IN _codigo VARCHAR(50))
BEGIN
	SELECT * FROM productos WHERE codigo = _codigo;
END $$

DELIMITER $$
CREATE PROCEDURE spu_producto_id( IN _idProducto VARCHAR(50))
BEGIN
	SELECT * FROM productos WHERE idProducto = _idProducto;
END $$

-- VENTA

DELIMITER $$
CREATE PROCEDURE spu_venta_registro
(
    IN _nombre        	VARCHAR(50),
    IN _montoFinal		DECIMAL(10,2),
	IN _tipoDocumento	VARCHAR(50),
    IN _tipoCliente     VARCHAR(50),
    IN _fechaEmision    DATE,
    IN _tipo 			VARCHAR(20),
	IN _medioPago 		VARCHAR(20)
)
BEGIN
    INSERT INTO ventas(nombre, montoFinal, tipoDocumento, tipoCliente, fechaEmision, tipo, medioPago)
    VALUES (_nombre, _montoFinal, _tipoDocumento, _tipoCliente, _fechaEmision, _tipo, _medioPago);
    
    SELECT LAST_INSERT_ID() AS inserted_id;
END $$

DELIMITER $$
CREATE PROCEDURE spu_venta_lista(IN _tipo VARCHAR(20))
BEGIN
	SELECT * FROM ventas WHERE tipo = _tipo;
END $$

-- DETALLE
DELIMITER $$
CREATE PROCEDURE spu_detalleVenta_registro
(
    IN _idProducto        	INT,
    IN _idVenta				INT,
	IN _precio				DECIMAL(10, 2),
    IN _cantidad     		INT,
    IN _igv					DECIMAL(10, 2),
    IN _total				DECIMAL(10, 2)
)
BEGIN
    INSERT INTO detalleVenta(idProducto, idVenta, precio, cantidad, igv, total)
    VALUES (_idProducto, _idVenta, _precio, _cantidad, _igv, _total);
    
    SELECT LAST_INSERT_ID() AS inserted_id;
END $$

DELIMITER $$
CREATE PROCEDURE spu_filtrarProductosPorTipoVenta(IN fechaFiltro DATE)
BEGIN
   SELECT 
        dv.idProducto,
        p.nombre AS nombreProducto, -- Se obtiene el nombre del producto desde la tabla productos
        SUM(dv.precio) AS totalPrecio,
        SUM(dv.cantidad) AS totalCantidad,
        SUM(dv.igv) AS totalIGV,
        SUM(dv.total) AS totalVenta,
        v.nombre AS nombreVenta,
        v.tipo
    FROM detalleVenta dv
    INNER JOIN ventas v ON dv.idVenta = v.idVenta
    INNER JOIN productos p ON dv.idProducto = p.idProducto -- Relación con la tabla productos
    WHERE v.tipo = 'venta'
    AND MONTH(v.fechaEmision) = MONTH(fechaFiltro) -- Filtrar por mes
    GROUP BY dv.idProducto, p.nombre, v.nombre, v.tipo;
END $$
DELIMITER ;


-- KARDEX
DELIMITER $$
CREATE PROCEDURE spu_kardex_registro
(
    IN _idProducto        	INT,
    IN _idVenta				INT,
	IN _nombreProducto		VARCHAR(50),
    IN _tipo	     		VARCHAR(50),
    IN _cantidad			INT,
    IN _stockActual			INT
)
BEGIN
    INSERT INTO kardex(idProducto, idVenta, nombreProducto, tipo, cantidad, stockActual, fechaEmision)
    VALUES (_idProducto, _idVenta, _nombreProducto, _tipo, _cantidad, _stockActual, now());
END $$


DELIMITER $$
CREATE PROCEDURE spu_kardex_lista()
BEGIN
	SELECT * 
	FROM kardex
	ORDER BY fechaemision DESC;
END $$

-- USUARIOS
DELIMITER $$
CREATE PROCEDURE spu_usuarios_registro
(
	IN _nombres 		VARCHAR(50),
	IN _apellidos 		VARCHAR(70),
	IN _nombreusuario 	VARCHAR(50),
    IN _nombrerol		VARCHAR(50),
    IN _clave 			VARCHAR(100)
)
BEGIN
	INSERT INTO usuarios(nombres, apellidos, nombreusuario, clave, nombrerol, fechacreacion, estado)
				VALUES(_nombres, _apellidos, _nombreusuario, _clave, _nombrerol, CURDATE(), "A");
END $$

--  Por defecto 123456
DELIMITER $$
CREATE PROCEDURE spu_usuarios_login
(
	IN _nombreusuario 	VARCHAR(25)
)
BEGIN
	SELECT * FROM usuarios
		WHERE nombreusuario = _nombreusuario AND usuarios.estado = "A";
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_list ()
BEGIN
	SELECT * FROM usuarios;
END $$

-- EJECUTAR AQUI
DELIMITER $$
CREATE PROCEDURE spu_stockValorizado_list()
BEGIN
	SELECT k.*, p.nombre AS nombreProducto, p.precio, FORMAT((p.precio * k.stockActual), 2) AS totalValor 
		FROM kardex k INNER JOIN productos p 
		ON k.idProducto = p.idProducto
		WHERE k.tipo = 'Compra';
END $$

-- ESTO NO
CALL spu_usuarios_registro('Carlos', 'Gómez Pérez', 'cgomez', 'Administrador', '$2y$10$dvgzm2Jmh0u98DerZSGkX.QH5rVqqD/ctSC3UCgYNj4jFh0CgR5mi');
CALL spu_usuarios_registro('Ana', 'Martínez López', 'amartinez', 'Administrador' , '$2y$10$dvgzm2Jmh0u98DerZSGkX.QH5rVqqD/ctSC3UCgYNj4jFh0CgR5mi');
CALL spu_usuarios_registro('Luis', 'Fernández Ruiz', 'lfernandez', 'Vendedor', '$2y$10$dvgzm2Jmh0u98DerZSGkX.QH5rVqqD/ctSC3UCgYNj4jFh0CgR5mi');

