<?php
include("../../src/bd.php");

// Verificar la conexión a la base de datos
if (!$conexion) {
    die("Error al conectar a la base de datos");
}

if (isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];

    $sentencia = $conexion->prepare("SELECT * FROM product WHERE ID_Producto=:ID_Producto");
    $sentencia->bindParam(":ID_Producto", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    $nombre = $registro["nombre"];
    $descripcion = $registro["descripcion"];
    $cantidad_stock = $registro["cantidad_stock"];
    $precio_unidad = $registro["precio_unidad"];
    $fecha_caducidad = $registro["fecha_caducidad"];
    $Proveedor_ID = $registro["Proveedor_ID"];

    $sentencia = $conexion->prepare("SELECT * FROM `proveedores`");
    $sentencia->execute();
    $lista_proveedores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
}

if ($_POST) {
    // Recolectar datos y escapar caracteres especiales para evitar inyección SQL
    $txtID = htmlspecialchars($_POST['txtID']);
    $nombre = htmlspecialchars($_POST["nombre"]);
    $descripcion = htmlspecialchars($_POST["descripcion"]);
    $cantidad_stock = htmlspecialchars($_POST["cantidad_stock"]);
    $precio_unidad = htmlspecialchars($_POST["precio_unidad"]);
    $fecha_caducidad = htmlspecialchars($_POST["fecha_caducidad"]);
    $Proveedor_ID = htmlspecialchars($_POST["Proveedor_ID"]);

    // Actualizar datos en la base de datos
    $sentencia = $conexion->prepare("UPDATE product SET nombre=:nombre, descripcion=:descripcion, cantidad_stock=:cantidad_stock, precio_unidad=:precio_unidad, fecha_caducidad=:fecha_caducidad, Proveedor_ID=:Proveedor_ID WHERE ID_Producto=:ID_Producto");

    // Asignar valores de las variables
    $sentencia->bindParam(":ID_Producto", $txtID);
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":cantidad_stock", $cantidad_stock);
    $sentencia->bindParam(":precio_unidad", $precio_unidad);
    $sentencia->bindParam(":fecha_caducidad", $fecha_caducidad);
    $sentencia->bindParam(":Proveedor_ID", $Proveedor_ID);

    $sentencia->execute();
    $mensaje="Registro Actualizado";
    header("Location:index.php?mensaje=".$mensaje);
}
?>



<?php include("../../templates/header.php");?>
<br />
<div class="card">
    <div class="card-header">
    Agregar Productos
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID?>" class="form-control" readonly name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" value="<?php echo $nombre?>"  class="form-control" name="nombre" id="nombre" aria-describedby="helpId"
                    placeholder="nombre">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" value="<?php echo $descripcion?>"  class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId"
                    placeholder="descripcion">
            </div>
            <div class="mb-3">
                <label for="cantidad_stock" class="form-label">cantidad stock</label>
                <input type="text" value="<?php echo $cantidad_stock?>"  class="form-control" name="cantidad_stock" id="cantidad_stock" aria-describedby="helpId" 
                placeholder="cantidad_stock">
            </div>
            <div class="mb-3">
                <label for="precio_unidad" class="form-label">precio unidad</label>
                <input type="text" value="<?php echo $precio_unidad?>"  class="form-control" name="precio_unidad" id="precio_unidad" aria-describedby="helpId" placeholder="precio_unidad">
            </div>
            <div class="mb-3">
                <label for="fecha_caducidad" class="form-label">fecha caducidad</label>
                <input type="date" value="<?php echo $fecha_caducidad?>"  class="form-control" name="fecha_caducidad" id="fecha_caducidad"
                    aria-describedby="helpId" placeholder="fecha_caducidad">
            </div>
           
            <div>
                <div class="mb-3">
                    <label for="Proveedor_ID" class="form-label">Proveedor:</label>

                    <select class="form-select form-select-lg" name="Proveedor_ID" id="Proveedor_ID">
                        <?php foreach ($lista_proveedores as $registro) {  ?>

                        <option <?php echo ($Proveedor_ID == $registro['ID_Proveedor']) ? "selected" : ""; ?>
                            value="<?php echo $registro['ID_Proveedor']; ?>">
                            <?php echo $registro['Nombre']; ?>
                            <?php } ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-warning" href="index.php" role="button">Cancelar</a>


        </form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<br />
<?php include("../../templates/footer.php");?>