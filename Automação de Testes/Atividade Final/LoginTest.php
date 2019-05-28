<?php
require_once('vendor/autoload.php');
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;

class LoginTests extends TestCase {
    private $navegador;

    protected function setUp() : void {
        $this->navegador = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::chrome());

        // $browserStack = "http://guilherme171:MJk3fqsGRyzgeaQcxNQq@hub-cloud.browserstack.com/wd/hub";
        // $this->navegador = RemoteWebDriver::create($browserStack, array(
        //      "browser" => "Chrome",
        //      "browser_version" => "74.0",
        //      "os" => "Windows",
        //      "os_version" => "10",
        //      "resolution" => "1024x768"
        // )); 

        $this->navegador->get('https://aluno.unicesumar.edu.br/lyceump/aonline/logon.asp');
        $this->navegador->manage()->window()->maximize();
        $this->navegador->manage()->timeouts()->implicitlyWait(5);
    }

    protected function tearDown() : void {
        $this->navegador->quit();
    }

    public static function dataInfoLogin() {
    
        $json = file_get_contents('.\tests\trab\infoLogin.json');
        $json_data = json_decode($json,true);
        
        return $json_data;
    }

    /**
    * @dataProvider dataInfoLogin
    */

    public function testLoginAlunoOnline($ra, $senha, $validacao) {

        //Digitando RA no campo Login
        $this->navegador
            ->findElement(WebDriverBy::id('txtnumero_matricula'))
            ->sendKeys($ra);

        //Digitando senha no campo Senha
        $this->navegador
            ->findElement(WebDriverBy::id('txtsenha_tac'))
            ->sendKeys($senha);

        //Clicando no botao OK p/ logar
        $this->navegador
            ->findElement(WebDriverBy::name('cmdEnviar'))
            ->click();    

        //Clicando no botao OK do Alert ao logar
        $alerta = $this->navegador->switchTo()->alert();
        $alerta->getText();
        $alerta->accept();

        // Validar que o elemento TD que exibe o nome do aluno logado seja o mesmo que foi passado
        $alunoLogado = $this->navegador->findElement(WebDriverBy::cssSelector('td[colspan="3"]'))->getText();
        $this->assertEquals($alunoLogado, $validacao);
        $this->navegador->takeScreenshot("$ra.jpg");
    }

}