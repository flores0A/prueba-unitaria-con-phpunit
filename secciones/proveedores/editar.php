<?php 
include("../../src/bd.php");
if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))? $_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT *  FROM proveedores WHERE ID_Proveedor=:ID_Proveedor");
    $sentencia->bindParam(":ID_Proveedor",$txtID);
$sentencia->execute();
$registro=$sentencia->fetch(PDO::FETCH_LAZY);

$Nombre=$registro["Nombre"];
$Direccion=$registro["Direccion"];
$Telefono=$registro["Telefono"];
$Correo_Electronico=$registro["Correo_Electronico"];

}




if ($_POST) {
// recolectar datos
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$Nombre=(isset($_POST["Nombre"])? $_POST["Nombre"]:"");
$Direccion=(isset($_POST["Direccion"])? $_POST["Direccion"]:"");
$Telefono=(isset($_POST["Telefono"])? $_POST["Telefono"]:"");
$Correo_Electronico=(isset($_POST["Correo_Electronico"])? $_POST["Correo_Electronico"]:"");
//insertamos los actualizamos los datos
$sentencia = $conexion->prepare("UPDATE proveedores SET Nombre=:Nombre, Direccion=:Direccion, Telefono=:Telefono, Correo_Electronico=:Correo_Electronico  WHERE ID_Proveedor=:ID_Proveedor");

//asignamos valores de las variables
$sentencia->bindParam(":ID_Proveedor",$txtID);
$sentencia->bindParam(":Nombre",$Nombre);
$sentencia->bindParam(":Direccion",$Direccion);
$sentencia->bindParam(":Telefono",$Telefono);
$sentencia->bindParam(":Correo_Electronico",$Correo_Electronico);
$sentencia->execute();
        $mensaje="Registro Actualizado";
        header("Location:index.php?mensaje=".$mensaje);
}
?>

<?php include("../../templates/header.php");?>
<br />
<div class="card">
    <div class="card-header">
        Agregar proveedores
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID?>" class="form-control" readonly name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID">
            </div>
            <div class="mb-3">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" value="<?php echo $Nombre?>" class="form-control" name="Nombre" id="Nombre" aria-describedby="helpId"
                    placeholder="Nombre">
            </div>
            <div class="mb-3">
                <label for="Direccion" class="form-label">Direccion</label>
                <input type="text" value="<?php echo $Direccion?>" class="form-control" name="Direccion" id="Direccion" aria-describedby="helpId"
                    placeholder="Direccion">
            </div>
            <div class="mb-3">
                <label for="Telefono" class="form-label">Telefono</label>
                <input type="number" value="<?php echo $Telefono?>" class="form-control" name="Telefono" id="Telefono" aria-describedby="helpId"
                    placeholder="Telefono">
            </div>
            <div class="mb-3">
                <label for="Correo_Electronico" class="form-label">Correo Electronico</label>
                <input type="email" value="<?php echo $Correo_Electronico?>" class="form-control" name="Correo_Electronico" id="Correo_Electronico"
                    aria-describedby="helpId" placeholder="Correo_Electronico">
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