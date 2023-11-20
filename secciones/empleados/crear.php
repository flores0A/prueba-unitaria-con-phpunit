
<?php
include("../../src/bd.php");

if ($_POST) {
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $Direccion = (isset($_POST["Direccion"]) ? $_POST["Direccion"] : "");
    $Correo = (isset($_POST["Correo"]) ? $_POST["Correo"] : "");
    $Telefono = (isset($_POST["Telefono"]) ? $_POST["Telefono"] : "");

    $Imagen = (isset($_FILES["Imagen"]['name']) ? $_FILES["Imagen"]['name'] : "");

    $idPuesto = (isset($_POST["idPuesto"]) ? $_POST["idPuesto"] : "");

    // Comprobar si se ha cargado un archivo de imagen
    if (!empty($_FILES["Imagen"]["tmp_name"])) {
        $nombreArchivo_foto = time() . "_" . $_FILES["Imagen"]['name']; // Usamos time() para un nombre único
        $rutaArchivo_foto = "./" . $nombreArchivo_foto; // Especifica la carpeta de destino

        // Mover el archivo cargado a la carpeta de destino
        if (move_uploaded_file($_FILES["Imagen"]["tmp_name"], $rutaArchivo_foto)) {
            $Imagen = $nombreArchivo_foto; // Actualiza el nombre de la imagen en la base de datos
        } else {
            echo "Error al subir el archivo.";
            exit; // Detiene la ejecución en caso de error
        }
    }

    // Insertar los datos
    $sentencia = $conexion->prepare("INSERT INTO `empleados` (`id`, `nombre`, `Direccion`, `Correo`, `Telefono`, `Imagen`, `idPuesto`) VALUES (NULL, :nombre, :Direccion, :Correo, :Telefono, :Imagen, :idPuesto);");

    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":Direccion", $Direccion);
    $sentencia->bindParam(":Correo", $Correo);
    $sentencia->bindParam(":Telefono", $Telefono);
    $sentencia->bindParam(":Imagen", $Imagen);
    $sentencia->bindParam(":idPuesto", $idPuesto);

    $sentencia->execute();
    $mensaje="Registro Agregado";
    header("Location:index.php?mensaje=".$mensaje);
}

// Obtener la lista de cargos (esto puede ir fuera del bloque if ($_POST))
$sentencia = $conexion->prepare("SELECT * FROM `cargo`");
$sentencia->execute();
$lista_cargo = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include("../../templates/header.php");?>
<br/>
<div class="card">
    <div class="card-header">
    Agregar Empleados
    </div>
    <div class="card-body">
        
<form action="" method="post" enctype="multipart/form-data">
<div class="mb-3">
  <label for="nombre" class="form-label">Nombre</label>
  <input type="text"
    class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="nombre">
</div>

<div class="mb-3">
  <label for="Direccion" class="form-label">Direccion</label>
  <input type="text"
    class="form-control" name="Direccion" id="Direccion" aria-describedby="helpId" placeholder="Direccion">
</div>
<div class="mb-3">
  <label for="Correo" class="form-label">Correo Electronico</label>
  <input type="text"
    class="form-control" name="Correo" id="Correo" aria-describedby="helpId" placeholder="Correo">
</div>
<div class="mb-3">
  <label for="Telefono" class="form-label">Telefono</label>
  <input type="number"
    class="form-control" name="Telefono" id="Telefono" aria-describedby="helpId" placeholder="Telefono">
</div>
<div class="mb-3">
  <label for="Imagen" class="form-label">Imagen</label>
  <input type="file"
    class="form-control" name="Imagen" id="Imagen" aria-describedby="helpId" placeholder="Imagen">
</div>
<div>
    <div class="mb-3">
        <label for="idPuesto" class="form-label">Puesto:</label>
        <select class="form-select form-select-lg" name="idPuesto" id="idPuesto">
        <?php foreach ($lista_cargo as $registro) {  ?>
            <option value="<?php echo $registro['id']?>"><?php echo $registro['cargo']?></option>
            <?php } ?>
        </select>
    </div>
</div>
<button type="submit" class="btn btn-success" href="index.php">Agregar</button>
<a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

</form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<br/>
<?php include("../../templates/footer.php");?>