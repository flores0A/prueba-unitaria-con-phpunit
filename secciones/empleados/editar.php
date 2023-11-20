<?php 
include("../../src/bd.php");

if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))? $_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT *  FROM empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
$sentencia->execute();
$registro=$sentencia->fetch(PDO::FETCH_LAZY);

$nombre=$registro["nombre"];
$Direccion=$registro["Direccion"];
$Correo=$registro["Correo"];
$Telefono=$registro["Telefono"];
$Imagen=$registro["Imagen"];
$idPuesto=$registro["idPuesto"];

$sentencia = $conexion->prepare("SELECT * FROM `cargo`");
$sentencia->execute();
$lista_cargo = $sentencia->fetchAll(PDO::FETCH_ASSOC);


}
if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $Direccion = (isset($_POST["Direccion"]) ? $_POST["Direccion"] : "");
    $Correo = (isset($_POST["Correo"]) ? $_POST["Correo"] : "");
    $Telefono = (isset($_POST["Telefono"]) ? $_POST["Telefono"] : "");

    $idPuesto = (isset($_POST["idPuesto"]) ? $_POST["idPuesto"] : "");

    // Aquí defines la variable $id a partir de $txtID
    $id = $txtID;

    // Insertar los datos
    $sentencia = $conexion->prepare("UPDATE empleados SET nombre=:nombre, Direccion=:Direccion, Correo=:Correo, Telefono=:Telefono, idPuesto=:idPuesto WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":Direccion", $Direccion);
    $sentencia->bindParam(":Correo", $Correo);
    $sentencia->bindParam(":Telefono", $Telefono);
    $sentencia->bindParam(":idPuesto", $idPuesto);

    $Imagen = (isset($_FILES["Imagen"]['name']) ? $_FILES["Imagen"]['name'] : "");

    $fecha_Imagen = new DateTime();
    $nombreArchivo_Imagen = ($Imagen != '') ? $fecha_Imagen->getTimestamp() . "_" . $_FILES["Imagen"]['name'] : "";
    $tmp_Imagen = $_FILES["Imagen"]["tmp_name"];
    
    if ($tmp_Imagen != '') {
        move_uploaded_file($tmp_Imagen, "./" . $nombreArchivo_Imagen);

        $sentencia=$conexion->prepare("SELECT Imagen FROM `empleados` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
$sentencia->execute();
$registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
print_r($registro_recuperado);
if (isset($registro_recuperado["Imagen"])&& $registro_recuperado["Imagen"]!="") {
    if (file_exists("./".$registro_recuperado["Imagen"])) {
       unlink("./".$registro_recuperado["Imagen"]);
    }
}
    
        $sentencia = $conexion->prepare("UPDATE empleados SET Imagen=:Imagen WHERE id=:id");
        $sentencia->bindParam(":Imagen", $nombreArchivo_Imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    
}

        $mensaje="Registro Actualizado";
        header("Location:index.php?mensaje=".$mensaje);

}



?>

<?php include("../../templates/header.php");?>
<br />
<div class="card">
    <div class="card-header">
        datos de empleado
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
                <input type="text" value="<?php echo $nombre?>" class="form-control" name="nombre" id="nombre"
                    aria-describedby="helpId" placeholder="nombre">
            </div>

            <div class="mb-3">
                <label for="Direccion" class="form-label">Direccion</label>
                <input type="text" value="<?php echo $Direccion?>" class="form-control" name="Direccion" id="Direccion"
                    aria-describedby="helpId" placeholder="Direccion">
            </div>
            <div class="mb-3">
                <label for="Correo" class="form-label">Correo Electronico</label>
                <input type="text" value="<?php echo $Correo?>" class="form-control" name="Correo" id="Correo"
                    aria-describedby="helpId" placeholder="Correo">
            </div>
            <div class="mb-3">
                <label for="Telefono" class="form-label">Telefono</label>
                <input type="number" value="<?php echo $Telefono?>" class="form-control" name="Telefono" id="Telefono"
                    aria-describedby="helpId" placeholder="Telefono">
            </div>
            <div class="mb-3">
                <label for="Imagen" class="form-label">Imagen</label>
                <br />
                <img width="100" src="<?php echo $Imagen?>" class=" rounded-top" alt="">
                <br />
                <br />
                <input type="file" class="form-control" name="Imagen" id="Imagen" aria-describedby="helpId"
                    placeholder="Imagen">
            </div>
            <div>
                <div class="mb-3">
                    <label for="idPuesto" class="form-label">Puesto:</label>

                    <select class="form-select form-select-lg" name="idPuesto" id="idPuesto">
                        <?php foreach ($lista_cargo as $registro) {  ?>

                        <option <?php echo ($idPuesto == $registro['id']) ? "selected" : ""; ?>
                            value="<?php echo $registro['id']; ?>">
                            <?php echo $registro['cargo']; ?>
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