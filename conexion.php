<?php
$conexion = pg_connect("host=localhost dbname=prueba user=postgres password=contraPostgre");
pg_query($conexion, "SET lc_monetary = 'es_CO';");
$query = "SELECT * FROM almacen.productos p Where p.id != -1";
$mostrar_agotados = 0;
$mostrar_opciones = 0;
$entrar = false;
$eliminar = 0;
$offset = $_POST['offset'];
if (isset($_POST['adelante'])) {
	$entrar = true;
	$offset += 1;
	$_POST['offset'] = $offset;
}
if (isset($_POST['atras'])) {
	if ($offset >= 1){
		$entrar = true;
		$offset -= 1;
		$_POST['offset'] = $offset;
	}
}

if (isset($_POST['eliminar'])) {
	$eliminar = $_POST['del'];
	pg_query($conexion, "DELETE FROM almacen.productos p  WHERE p.id = ".$eliminar);
}

if (isset($_POST['agregar'])) {
	$a_id = $_POST['a_id'];
	$a_nombre = $_POST['a_nombre'];
	$a_categoria = $_POST['a_categoria'];
	$a_cantidad = $_POST['a_cantidad'];
	$a_marca = $_POST['a_marca'];
	$a_precio = $_POST['a_precio'];

	if (!empty($a_nombre) and !empty($a_categoria) and !empty($a_cantidad) and !empty($a_marca) and !empty($a_precio)){
		$id_aux = '';
		$id_aux2 = '';
		if (!empty($a_id)){
			$id_aux .= 'id, ';
			$id_aux2 .= $a_id.", ";
		}
		$agregar = "INSERT INTO almacen.productos (".$id_aux."nombre, categoria, cantidad, marca, precio)
			VALUES (".$id_aux2."'$a_nombre', '$a_categoria', $a_cantidad, '$a_marca', $a_precio);";
		pg_query($conexion, $agregar);
	}
}

if (isset($_POST['buscar']) or $entrar) {
	$id = $_POST['id'];
	if (!empty($id)) {
		$query .= " and p.id = ".$id;
	}

	$nombre = $_POST['nombre'];
	if (!empty($nombre)) {
		$query .= " and p.nombre ILIKE '%".$nombre."%'";
	}

	$categoria = $_POST['categoria'];
	if (!empty($categoria)) {
		$query .= " and p.categoria ILIKE '%".$categoria."%'";
	}

	$marca = $_POST['marca'];
	if (!empty($marca)) {
		$query .= " and p.marca ILIKE '%".$marca."%'";
	}

	$mostrar_agotados = isset($_POST['mostrar_agotados']);
	if (!$mostrar_agotados) {
		$query .= " and p.cantidad != 0";
	}

	$mostrar_opciones = isset($_POST['opciones_avanzadas']);

	$precio_min = $_POST['precio_min'];
	$precio_max = $_POST['precio_max'];
	if (!empty($precio_min) and !empty($precio_max)) {
		$query .= " and p.precio BETWEEN '".$precio_min."' and '".$precio_max."'";
	}else if(empty($precio_min) and !empty($precio_max)){
		$query .= " and p.precio BETWEEN '0' and '".$precio_max."'";
	}else if(empty($precio_min) and !empty($precio_max)){
		$query .= " and p.precio > '".$precio_min."'";
	}
}

$query .= " order by p.id asc LIMIT 10 offset ".$offset*10;

$consulta = pg_query($conexion, $query);
if (!$consulta){
	$consulta = pg_query($conexion, "SELECT * FROM almacen.productos p Where p.id != -1 
	order by p.id asc LIMIT 10");
	echo "Revisa los parametros de entrada porfavor";
}
?>