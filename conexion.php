<?php
// if (array_key_exists('codigo', $_REQUEST)) {
// 	$where = $_REQUEST['codigo'];
// } else {
// 	$where = '';
// }

$conexion = pg_connect("host=localhost dbname=prueba user=postgres password=contraPostgre");
// $query = "SELECT * FROM almacen.productos p Where p.cantidad = 0";
$query = "SELECT * FROM almacen.productos p Where p.id != -1";
if (isset($_POST['submit'])) {
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
		$query .= " and p.categoria = '".$categoria."'";
	}

	$marca = $_POST['marca'];
	if (!empty($marca)) {
		$query .= " and p.marca = '".$marca."'";
	}

	$mostrar_agotados = isset($_POST['mostrar_agotados']);
	if (!$mostrar_agotados) {
		$query .= " and p.cantidad != 0";
	}

	$precio_min = $_POST['precio_min'];
	$precio_max = $_POST['precio_max'];
	if (!empty($precio_max)) {
		$query .= " and p.precio BETWEEN '".$precio_min."' and '".$precio_max."'";
	}
}
$query .= " LIMIT 199"; 
$consulta = pg_query($conexion, $query);
?>