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
  <style>
    body {
      background-color: #D3DFFF;
    }

    .peq {
      max-width: 70px;
      text-align: center;
    }

    .container mx-auto {
      margin-top: 1%;
    }
  </style>
</head>

<body>
  <br>
  <div class="container mx-auto">
    <div class="card shadow-lg">
      <div class="card-body">
        <form action="" method="POST">
          <div class="card-body" style="background-color: #F2F2F2;">
            <label for="buscar"> Buscar: </label>
            <input type="text" class="peq" name="id" placeholder="id" value="<?php echo $_POST['id'] ?>">
            <input type="text" name="nombre" placeholder="Nombre producto" value="<?php echo $_POST['nombre'] ?>">
            <input type="text" name="categoria" placeholder="Categoria" value="<?php echo $_POST['categoria'] ?>">
            <input type="text" name="marca" placeholder="Marca" value="<?php echo $_POST['marca'] ?>">
            <label>Rango precios: </label>
            <input type="text" class="peq" name="precio_min" placeholder="minimo" value="<?php echo $_POST['precio_min'] ?>"> -
            <input type="text" class="peq" name="precio_max" placeholder="maximo" value="<?php echo $_POST['precio_max'] ?>">
            <label for="Mostrar agotados">- Mostrar agotados:</label>
            <input type="checkbox" name="mostrar_agotados" <?php if ($mostrar_agotados == "1") echo "checked"; ?>>
            <input type="submit" class="btn btn-success" name="buscar" value="Buscar">
          </div>
          <!-- <input type="submit" name="agregar" value="agregar"> -->
          <br>
          <label>- mostrar opciones avanzadas</label>
          <input type="checkbox" id="opciones" name="opciones_avanzadas" <?php if ($mostrar_opciones == "1") echo "checked";?>>
          <div id="div_agregar" class="card-body" style="background-color: #F2F2F2; display: none;">
            <input type="text" class="peq" name="a_id" placeholder="id" value="<?php echo $_POST['id'] ?>">
            <input type="text" name="a_nombre" placeholder="Nombre producto" value="<?php echo $_POST['nombre'] ?>">
            <input type="text" name="a_categoria" placeholder="Categoria" value="<?php echo $_POST['categoria'] ?>">
            <input type="text" class="peq" name="a_cantidad" placeholder="cantidad" value="<?php echo $_POST['categoria'] ?>">
            <input type="text" name="a_marca" placeholder="Marca" value="<?php echo $_POST['marca'] ?>">
            <input type="text" class="peq" name="a_precio" placeholder="precio" value="<?php echo $_POST['precio_min'] ?>">
            <input type="submit" class="btn btn-warning" name="agregar" value="Agregar">
          </div>
          <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>categoria</th>
                <th>cantidad</th>
                <th>marca</th>
                <th>precio</th>
                <th></th>
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
                  <td><button type="submit" name="eliminar" class="btn btn-danger btn-sm" onclick=eliminarfila(this)>Eliminar</button></td>
                </tr>
            </tbody>
          <?php
              }
          ?>

          </table>
          <div style="text-align: center;">
            <input type="submit" name="atras" class="btn btn-info" value="anterior">
            <input type="text" class="peq" name="offset" value="<?php echo $_POST['offset'] ?>">
            <input type="submit" name="adelante" class="btn btn-info" value="siguiente">
          </div>
          <input id="del" name="del" style="display: none;">
        </form>
      </div>
    </div>
  </div>
</body>
<!-- <script src="index.js"></script> -->
<script>
  const checkbox = document.getElementById('opciones');
  checkbox.addEventListener("change", revisar);
  revisar()
  function revisar(){
    const div = document.getElementById('div_agregar');
    if (checkbox.checked) {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }
  }

  function eliminarfila(boton) {
    let fila = boton.parentNode.parentNode;
    let id = fila.getElementsByTagName("td")[0];
    document.getElementById("del").value = id.innerHTML;
    console.log("<?php echo $eliminar ?>")
  }
</script>

</html>