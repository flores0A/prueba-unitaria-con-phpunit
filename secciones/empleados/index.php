<?php 
include("../../src/bd.php");

if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))? $_GET['txtID']:"";

    //buscar archivos relacionados
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

  $sentencia=$conexion->prepare("DELETE FROM empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
$sentencia->execute();
$mensaje="Registro Eliminado";
header("Location:index.php?mensaje=".$mensaje);
}



$sentencia = $conexion->prepare("SELECT *, (SELECT cargo FROM cargo WHERE cargo.id = empleados.idPuesto LIMIT 1) AS cargo FROM empleados");
$sentencia->execute();
$lista_empleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>

<?php include("../../templates/header.php");?>
<br />
<div class="text-center"> <h2 > Empleados</h2> </div>

<div class="card">
    <div class="card-header">

        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">agregar Empleados</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">DIRECCION</th>
                        <th scope="col"> CORREO</th>
                        <th scope="col">TELEFONO</th>
                        <th scope="col"> IMAGEN</th>
                        <th scope="col">CARGO</th>
                        <th scope="col"> ACCIONES</th>


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_empleados as $registro) {  ?>
                    <tr class="">
                        < <td scope="row"><?php echo $registro['id'];?></td>
                            <td><?php echo $registro['nombre'];?></td>
                            <td><?php echo $registro['Direccion'];?></td>
                            <td><?php echo $registro['Correo'];?></td>
                            <td><?php echo $registro['Telefono'];?></td>
                            <td><img width="50" src="<?php echo $registro['Imagen'];?>" class="img-fluid rounded-top"
                                    alt=""></td>
                            <td><?php echo $registro['cargo'];?></td>

                            <td>
                                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id'];?>"
                                    role="button">Editar</a>

                                <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id'];?>);"
                                    role="button">Eliminar</a>
                            </td>


                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>
<br />
<?php include("../../templates/footer.php");?>