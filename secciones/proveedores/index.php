<?php 
include("../../src/bd.php");

if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))? $_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM proveedores WHERE ID_Proveedor=:ID_Proveedor");
    $sentencia->bindParam(":ID_Proveedor",$txtID);
    $sentencia->execute();
    $mensaje="Registro Eliminado";
    header("Location:index.php?mensaje=".$mensaje);
}

$sentencia=$conexion->prepare("SELECT * FROM `proveedores`");
$sentencia->execute();
$lista_proveedores=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>

<?php include("../../templates/header.php");?>
<br />
<div class="text-center"> <h2 > Proveedores</h2> </div>

<div class="card">
    <div class="card-header">

        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">agregar Proveedores</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">DIRECCION</th>
                        <th scope="col">TELEFONO</th>
                        <th scope="col"> CORREO</th>
                        <th scope="col"> ACCIONES</th>


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_proveedores as $registro) {  ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['ID_Proveedor'];?></td>
                        <td><?php echo $registro['Nombre'];?></td>
                        <td><?php echo $registro['Direccion'];?></td>
                        <td><?php echo $registro['Telefono'];?></td>
                        <td><?php echo $registro['Correo_Electronico'];?></td>
                        <td>
                            <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['ID_Proveedor'];?>"
                                role="button">Editar</a>

                            <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['ID_Proveedor'];?>);"
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