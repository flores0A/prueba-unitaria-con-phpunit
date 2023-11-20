<?php 
include("../../src/bd.php");
if ($_POST) {
// recolectar datos
$usuario=(isset($_POST["usuario"])? $_POST["usuario"]:"");
$password=(isset($_POST["password"])? $_POST["password"]:"");
$correo=(isset($_POST["correo"])? $_POST["correo"]:"");
//insertamos los datos
$sentencia=$conexion->prepare("INSERT INTO usuario (id,usuario,password,correo) VALUES(null,:usuario,:password,:correo)");
//asignamos valores de las variables
$sentencia->bindParam(":usuario",$usuario);
$sentencia->bindParam(":password",$password);
$sentencia->bindParam(":correo",$correo);
$sentencia->execute();
$mensaje="Registro Agregado";
header("Location:index.php?mensaje=".$mensaje);
}
?>

<?php include("../../templates/header.php");?>
<br/>
<div class="card">
    <div class="card-header">
    Agregar  Usuario
    </div>
    <div class="card-body">
       <form action="" method="post" enctype="multipart/form-data">

<div class="mb-3">
  <label for="usuario" class="form-label">Nombre del Usuario</label>
  <input type="text"
    class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="usuario">
</div>
<div class="mb-3">
  <label for="password" class="form-label">Password </label>
  <input type="password"
    class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="password">
</div>
<div class="mb-3">
  <label for="correo" class="form-label">Correo </label>
  <input type="email"
    class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="correo">
</div>

<button type="submit" class="btn btn-success">Agregar</button>
<a name="" id="" class="btn btn-warning" href="index.php" role="button">Cancelar</a>
       </form>
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>
<br/>
<?php include("../../templates/footer.php");?>