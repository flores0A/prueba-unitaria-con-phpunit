
<?php 
include("../../src/bd.php");
if ($_POST) {
// recolectar datos
$Nombre=(isset($_POST["Nombre"])? $_POST["Nombre"]:"");
$Direccion=(isset($_POST["Direccion"])? $_POST["Direccion"]:"");
$Telefono=(isset($_POST["Telefono"])? $_POST["Telefono"]:"");
$Correo=(isset($_POST["Correo"])? $_POST["Correo"]:"");
$Historial=(isset($_POST["Historial"])? $_POST["Historial"]:"");
//insertamos los datos
$sentencia=$conexion->prepare("INSERT INTO clientes (IDCliente,Nombre,Direccion,Telefono,Correo,Historial) VALUES(null,:Nombre,:Direccion,:Telefono,:Correo,:Historial);");

//asignamos valores de las variables
$sentencia->bindParam(":Nombre",$Nombre);
$sentencia->bindParam(":Direccion",$Direccion);
$sentencia->bindParam(":Telefono",$Telefono);
$sentencia->bindParam(":Correo",$Correo);
$sentencia->bindParam(":Historial",$Historial);
$sentencia->execute();
$mensaje="Registro Agregado";
header("Location:index.php?mensaje=".$mensaje);
}
?>

<?php include("../../templates/header.php");?>
<br/>
<div class="card">
    <div class="card-header">
    Agregar Cliente
    </div>
    <div class="card-body">
        
<form action="" method="post" enctype="multipart/form-data">
<div class="mb-3">
  <label for="Nombre" class="form-label">Nombre</label>
  <input type="text"
    class="form-control" name="Nombre" id="Nombre" aria-describedby="helpId" placeholder="Nombre">
</div>
<div class="mb-3">
  <label for="Direccion" class="form-label">Direccion</label>
  <input type="text"
    class="form-control" name="Direccion" id="Direccion" aria-describedby="helpId" placeholder="Direccion">
</div>
<div class="mb-3">
  <label for="Telefono" class="form-label">Telefono</label>
  <input type="number"
    class="form-control" name="Telefono" id="Telefono" aria-describedby="helpId" placeholder="Telefono">
</div>
<div class="mb-3">
  <label for="Correo" class="form-label">Correo Electronico</label>
  <input type="email"
    class="form-control" name="Correo" id="Correo" aria-describedby="helpId" placeholder="Correo">
</div>
<div class="mb-3">
  <label for="Historial" class="form-label">Historial</label>
  <input type="text"
    class="form-control" name="Historial" id="Historial" aria-describedby="helpId" placeholder="Historial">
</div>

<button type="submit" class="btn btn-success">Agregar</button>
<a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

</form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<br/>
<?php include("../../templates/footer.php");?>