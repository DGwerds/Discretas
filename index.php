<?php
require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

  <title>Document</title>

</head>

<body>
  <br>
  <form action="" method="POST">
    <input type="text" name="id" placeholder="Buscar por id" value="<?php echo (isset($_POST['id'])) ? $_POST['id'] : '' ?>">
    <input type="text" name="nombre" placeholder="Buscar por nombre" value="<?php echo (isset($_POST['nombre'])) ? $_POST['nombre'] : '' ?>">
    <input type="text" name="categoria" placeholder="Buscar por categoria" value="<?php echo (isset($_POST['categoria'])) ? $_POST['categoria'] : '' ?>">
    <input type="text" name="marca" placeholder="Buscar por marca" value="<?php echo (isset($_POST['marca'])) ? $_POST['marca'] : '' ?>">
    <input type="text" name="precio_min" placeholder="precio minimo" value="<?php echo (isset($_POST['precio_min'])) ? $_POST['precio_min'] : '' ?>"> -
    <input type="text" name="precio_max" placeholder="precio maximo" value="<?php echo (isset($_POST['precio_max'])) ? $_POST['precio_max'] : '' ?>">
    <br>
    <input type="checkbox" name="mostrar_agotados" <?php if ($mostrar_agotados == "1") {
                                                      echo "checked";
                                                    } ?>> Mostrar agotados
    <br>
    <input type="submit" name="buscar" value="Buscar">
    <!-- <input type="submit" name="agregar" value="agregar"> -->
    <br>
    <br>
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th>id</th>
          <th>Nombre</th>
          <th>categoria</th>
          <th>cantidad</th>
          <th>marca</th>
          <th>precio</th>
        </tr>
      </thead>

      <tbody>
        <?php
        while ($obj = pg_fetch_object($consulta)) {
        ?>
          <tr>
            <td><?php echo $obj->id; ?></td>
            <td><?php echo $obj->nombre; ?></td>
            <td><?php echo $obj->categoria; ?> </td>
            <td><?php echo $obj->cantidad; ?> </td>
            <td><?php echo $obj->marca; ?></td>
            <td><?php echo $obj->precio; ?></td>
          </tr>
      </tbody>
    <?php
        }
    ?>

    </table>

  </form>


</body>
<!-- <script src="index.js"></script> -->
</html>