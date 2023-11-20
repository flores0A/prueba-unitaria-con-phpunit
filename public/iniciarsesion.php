<?php
// Comprobar si se han enviado encabezados antes de iniciar la sesión
if (headers_sent() === false) {
    // Iniciar una sesión o reanudar la sesión existente
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

require_once __DIR__ . '/../src/login.php';
include(__DIR__ . '/../src/bd.php');

if ($_POST) {
    $login = new Login($conexion);

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    if ($login->attemptLogin($usuario, $password)) {
        $_SESSION['usuario'] = $usuario;  // Puedes almacenar el nombre de usuario en la sesión si lo necesitas
        $_SESSION['logueado'] = true;
        header("Location: ../public/index.php");
        exit();
    } else {
        $mensaje = "ERROR: USUARIO O CLAVE INCORRECTOS";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>

    </header>
    <main class="container ">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4 ">
                <br /> <br />
                <div class="card">
                    <div class=" text-center card-header  ">
                        <h1>Login</h1>
                    </div>
                    <img class="img-fluid mx-auto d-block rounded w-40 h-40" src="imag/login.png" alt="">

                    <div class="card-body">
                        <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong><?php echo $mensaje; ?></strong>
                            </div>
                        <?php } ?>

                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="" class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario"
                                    aria-describedby="helpId" placeholder=" usuario">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mx-auto">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
