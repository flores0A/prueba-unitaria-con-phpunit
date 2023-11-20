<?php 
include("../../src/bd.php");
if ($_POST) {
// recolectar datos
$nombre=(isset($_POST["nombre"])? $_POST["nombre"]:"");
$descripcion=(isset($_POST["descripcion"])? $_POST["descripcion"]:"");
$cantidad_stock=(isset($_POST["cantidad_stock"])? $_POST["cantidad_stock"]:"");
$precio_unidad=(isset($_POST["precio_unidad"])? $_POST["precio_unidad"]:"");
$fecha_caducidad=(isset($_POST["fecha_caducidad"])? $_POST["fecha_caducidad"]:"");
$Proveedor_ID=(isset($_POST["Proveedor_ID"])? $_POST["Proveedor_ID"]:"");
//insertamos los datos
$sentencia=$conexion->prepare("INSERT INTO product (ID_Producto,nombre,descripcion,cantidad_stock,precio_unidad,fecha_caducidad,Proveedor_ID) VALUES(null,:nombre,:descripcion,:cantidad_stock,:precio_unidad,:fecha_caducidad,:Proveedor_ID);");

//asignamos valores de las variables
$sentencia->bindParam(":nombre",$nombre);
$sentencia->bindParam(":descripcion",$descripcion);
$sentencia->bindParam(":cantidad_stock",$cantidad_stock);
$sentencia->bindParam(":precio_unidad",$precio_unidad);
$sentencia->bindParam(":fecha_caducidad",$fecha_caducidad);
$sentencia->bindParam(":Proveedor_ID",$Proveedor_ID);
$sentencia->execute();
$mensaje="Registro Agregado";
header("Location:index.php?mensaje=".$mensaje);
}
$sentencia = $conexion->prepare("SELECT * FROM `proveedores`");
$sentencia->execute();
$lista_proveedores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
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
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId"
                    placeholder="nombre">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId"
                    placeholder="descripcion">
            </div>
            <div class="mb-3">
                <label for="cantidad_stock" class="form-label">cantidad stock</label>
                <input type="text" class="form-control" name="cantidad_stock" id="cantidad_stock" aria-describedby="helpId" 
                placeholder="cantidad_stock">
            </div>
            <div class="mb-3">
                <label for="precio_unidad" class="form-label">precio unidad</label>
                <input type="text" class="form-control" name="precio_unidad" id="precio_unidad" aria-describedby="helpId" placeholder="precio_unidad">
            </div>
            <div class="mb-3">
                <label for="fecha_caducidad" class="form-label">fecha caducidad</label>
                <input type="date" class="form-control" name="fecha_caducidad" id="fecha_caducidad"
                    aria-describedby="helpId" placeholder="fecha_caducidad">
            </div>
            <div>
                <div class="mb-3">
                    <label for="Proveedor_ID" class="form-label">Proveedor</label>
                    <select class="form-select form-select-lg" name="Proveedor_ID" id="Proveedor_ID">
                        <?php foreach ($lista_proveedores as $registro) {  ?>
                        <option value="<?php echo $registro['ID_Proveedor']?>"><?php echo $registro['Nombre']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<br />
<?php include("../../templates/footer.php");?>