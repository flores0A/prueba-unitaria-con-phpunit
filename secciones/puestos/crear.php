<?php include("../../src/bd.php");
if ($_POST) {
print_r($_POST);
// recolectar datos
$cargo=(isset($_POST["cargo"])? $_POST["cargo"]:"");
//insertamos los datos
$sentencia=$conexion->prepare("INSERT INTO cargo(id,cargo) VALUES(null, :cargo)");
//asignamos valores
$sentencia->bindParam(":cargo",$cargo);
$sentencia->execute();
$mensaje="Registro Agregado";
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
        Agregar Cargo
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="cargo" class="form-label">Nombre del cargo</label>
                <input type="text" class="form-control" name="cargo" id="cargo" aria-describedby="helpId"
                    placeholder="cargo">
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-warning" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>
<br />
<?php include("../../templates/footer.php");?>