<?php 
include("../../src/bd.php");
if ($_POST) {
// recolectar datos
$Fecha_Hora_Venta=(isset($_POST["Fecha_Hora_Venta"])? $_POST["Fecha_Hora_Venta"]:"");
$Cliente_ID=(isset($_POST["Cliente_ID"])? $_POST["Cliente_ID"]:"");
$Total_Venta=(isset($_POST["Total_Venta"])? $_POST["Total_Venta"]:"");
//insertamos los datos
$sentencia=$conexion->prepare("INSERT INTO ventas (ID_Venta,Fecha_Hora_Venta,Cliente_ID,Total_Venta) VALUES (NULL,:Fecha_Hora_Venta,:Cliente_ID,:Total_Venta);");

//asignamos valores de las variables
$sentencia->bindParam(":Fecha_Hora_Venta",$Fecha_Hora_Venta);
$sentencia->bindParam(":Cliente_ID",$Cliente_ID);
$sentencia->bindParam(":Total_Venta",$Total_Venta);
$sentencia->execute();
$mensaje="Registro Agregado";
header("Location:index.php?mensaje=".$mensaje);
}

$sentencia=$conexion->prepare("SELECT * FROM `clientes`");
$sentencia->execute();
$lista_clientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);
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
                <label for="Fecha_Hora_Venta" class="form-label">Fecha Hora Venta</label>
                <input type="datetime-local" class="form-control" name="Fecha_Hora_Venta" id="Fecha_Hora_Venta"
                    aria-describedby="helpId" placeholder="Fecha Hora Venta">
            </div>
            <div>
                <div class="mb-3">
                    <label for="Cliente_ID" class="form-label">Cliente</label>
                    <select class="form-select form-select-lg" name="Cliente_ID" id="Cliente_ID">
                        <?php foreach ($lista_clientes as $registro) {  ?>
                        <option value="<?php echo $registro['IDCliente']?>"><?php echo $registro['Nombre']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="Total_Venta" class="form-label">Total Venta</label>
                <input type="number" class="form-control" name="Total_Venta" id="Total_Venta" aria-describedby="helpId"
                    placeholder="Total Venta">
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