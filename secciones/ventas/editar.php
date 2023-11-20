<?php 
include("../../src/bd.php");

if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))? $_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT *  FROM  ventas WHERE ID_Venta=:ID_Venta");
    $sentencia->bindParam(":ID_Venta",$txtID);
$sentencia->execute();
$registro=$sentencia->fetch(PDO::FETCH_LAZY);

$Fecha_Hora_Venta=$registro["Fecha_Hora_Venta"];
$Cliente_ID=$registro["Cliente_ID"];
$Total_Venta=$registro["Total_Venta"];

$sentencia = $conexion->prepare("SELECT * FROM `clientes`");
$sentencia->execute();
$lista_clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
}

if ($_POST) {
    // recolectar datos
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $Fecha_Hora_Venta=(isset($_POST["Fecha_Hora_Venta"])? $_POST["Fecha_Hora_Venta"]:"");
    $Cliente_ID=(isset($_POST["Cliente_ID"])? $_POST["Cliente_ID"]:"");
    $Total_Venta=(isset($_POST["Total_Venta"])? $_POST["Total_Venta"]:"");
    //insertamos los datos
    $sentencia=$conexion->prepare("UPDATE ventas SET Fecha_Hora_Venta=:Fecha_Hora_Venta, Cliente_ID=:Cliente_ID, Total_Venta=:Total_Venta  WHERE ID_Venta=:ID_Venta");
    
    //asignamos valores de las variables
    $sentencia->bindParam(":ID_Venta",$txtID);
    $sentencia->bindParam(":Fecha_Hora_Venta",$Fecha_Hora_Venta);
    $sentencia->bindParam(":Cliente_ID",$Cliente_ID);
    $sentencia->bindParam(":Total_Venta",$Total_Venta);
    $sentencia->execute();
        $mensaje="Registro Actualizado";
        header("Location:index.php?mensaje=".$mensaje);
    }


?>
<?php include("../../templates/header.php");?>
<br />
<div class="card">
    <div class="card-header">
    Agregar Venta
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID?>" class="form-control" readonly name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID">
            </div>
            <div class="mb-3">
                <label for="Fecha_Hora_Venta" class="form-label">Fecha Hora Venta</label>
                <input type="datetime-local" value="<?php echo $Fecha_Hora_Venta?>" class="form-control" name="Fecha_Hora_Venta" id="Fecha_Hora_Venta"
                    aria-describedby="helpId" placeholder="Fecha Hora Venta">
            </div>
           
            <div>
                <div class="mb-3">
                    <label for="Cliente_ID" class="form-label">Cliente:</label>

                    <select class="form-select form-select-lg" name="Cliente_ID" id="Cliente_ID">
                        <?php foreach ($lista_clientes as $registro) {  ?>

                        <option <?php echo ($Cliente_ID == $registro['IDCliente']) ? "selected" : ""; ?>
                            value="<?php echo $registro['IDCliente']; ?>">
                            <?php echo $registro['Nombre']; ?>
                            <?php } ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="Total_Venta" class="form-label">Total Venta</label>
                <input type="text" value="<?php echo $Total_Venta?>" class="form-control" name="Total_Venta" id="Total_Venta" aria-describedby="helpId"
                    placeholder="Total Venta">
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