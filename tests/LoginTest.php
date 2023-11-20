<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

// Include necessary files
require_once __DIR__ . '/../src/bd.php';
require_once __DIR__ . '/../src/login.php';

class LoginTest extends TestCase
{
    public function testAttemptLoginSuccess()
    {
        // Simulacro de PDO y preparación de declaración
        $pdoMock = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stmtMock = $this->getMockBuilder(PDOStatement::class)
            ->getMock();

        $pdoMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        // Crear instancia de inicio de sesión con PDO simulado
        $login = new Login($pdoMock);

        // Realiza la prueba
        $result = $login->attemptLogin('usuario', 'contraseña');

        // Afirmaciones
        $this->assertFalse($result);
    }

    // Prueba de renderizado
    public function testLoginPageStructure()
    {
        // Simular datos POST
        $_POST['usuario'] = 'usuario_valido';
        $_POST['password'] = 'clave_valida';

        // Captura la salida de iniciarsesion.php
        ob_start();
        require_once __DIR__ . '/../public/iniciarsesion.php';
        $output = ob_get_clean();

        // Crea una instancia de Crawler para analizar el HTML generado
        $crawler = new Crawler($output);

        // Afirmaciones sobre la estructura HTML
        $this->assertEquals(1, $crawler->filter('html:contains("Login")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Ingresar")')->count());
        $this->assertEquals(1, $crawler->filter('form[action=""]')->count());
        $this->assertEquals(1, $crawler->filter('input[name="usuario"]')->count());
        $this->assertEquals(1, $crawler->filter('input[name="password"]')->count());
        $this->assertEquals(2, $crawler->filter('div[class="mb-3"]')->count());
        $this->assertEquals(1, $crawler->filter('div[class="row"]')->count());
        $this->assertEquals(1, $crawler->filter('button[type="submit"]')->count());
    }

    // Pruebas de eventos
    public function testLoginFormSubmissionFailure()
    {
        // Simular datos POST inválidos
        $_POST['usuario'] = 'usuario';
        $_POST['password'] = 'password';

        // Captura la salida de iniciarsesion.php
        ob_start();
        require_once __DIR__ . '/../public/iniciarsesion.php';
        ob_get_clean(); // Limpiar el buffer de salida

        // Verificar que la sesión no se haya iniciado
        $this->assertFalse(isset($_SESSION['logueado']) && $_SESSION['logueado']);
    }
   
}
?>
