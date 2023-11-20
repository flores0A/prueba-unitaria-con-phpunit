<?php

class Login
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function attemptLogin($usuario, $password)
    {
        try {
            // Preparar la consulta una vez fuera del bucle
            $sentencia = $this->conexion->prepare("SELECT *, COUNT(*) as n_usuario FROM `usuario` WHERE usuario = :usuario AND password = :password");
            $sentencia->bindParam(":usuario", $usuario);
            $sentencia->bindParam(":password", $password);

            // Ejecutar la consulta
            $sentencia->execute();

            // Verificar si la consulta fue exitosa antes de intentar acceder a $registro
            if ($sentencia) {
                $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

                // Verificar si $registro es un array y si las claves "n_usuario" y "usuario" están definidas
                if (is_array($registro) && array_key_exists("n_usuario", $registro) && array_key_exists("usuario", $registro)) {
                    if ($registro["n_usuario"] > 0) {
                        $_SESSION['usuario'] = $registro["usuario"];
                        $_SESSION['logueado'] = true;
                        return true;
                    }
                }
            }

            return false;
        } catch (PDOException $e) {
            // Manejar la excepción, por ejemplo, registrarla o devolver un mensaje de error
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }
}
?>
