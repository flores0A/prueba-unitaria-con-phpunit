<?php 
include("../../src/bd.php");

if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))? $_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT *  FROM cargo WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
$sentencia->execute();
$registro=$sentencia->fetch(PDO::FETCH_LAZY);
$cargo=$registro["cargo"];

}
if ($_POST) {
    print_r($_POST);
    // recolectar datos
    $txtID=(isset($_POST['txtID']))? $_POST['txtID']:"";
    $cargo=(isset($_POST["cargo"])? $_POST["cargo"]:"");
    //insertamos los datos
    $sentencia=$conexion->prepare("UPDATE  cargo SET cargo= :cargo WHERE id=:id" );
    //asignamos valores
    $sentencia->bindParam(":cargo",$cargo);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $mensaje="Registro Actualizado";
    header("Location:index.php?mensaje=".$mensaje);
   
    }

?>

<?php include("../../templates/header.php");?>
<?php if (isset($_GET['mensaje'])) {?>
<script>
Swal.fire({
    title: '<?php echo $_GET ['mensaje'];?>',
    icon: 'sucess',

});
</script>
<?php }?>
<br />
<div class="card">
    <div class="card-header">
        Cargo
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID?>" class="form-control" readonly name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="cargo" class="form-label">Nombre del cargo</label>
                <input type="text" value="<?php echo $cargo?>" class="form-control" name="cargo" id="cargo"
                    aria-describedby="helpId" placeholder="cargo">
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