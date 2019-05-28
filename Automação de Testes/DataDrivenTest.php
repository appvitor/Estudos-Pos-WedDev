<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;

class SignInTests extends TestCase {
    private $navegador;

    protected function setUp() : void {
        $this->navegador = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::chrome());
        $this->navegador->get('http://www.juliodelima.com.br/taskit');
        $this->navegador->manage()->window()->maximize();
        $this->navegador->manage()->timeouts()->implicitlyWait(5);
    }

    protected function tearDown() : void {
        $this->navegador->quit();
    }

    public static function dataDoSigninUsingAnExistentUser() {
    
        $json = file_get_contents('./data.json');
        $json_data = json_decode($json,true);
        
        return $json_data;
    }
    
    /**
    * @dataProvider dataDoSigninUsingAnExistentUser
    */
    
    public function testDoSigninUsingAnExistentUser($login, $senha, $nome) {
    // Act
    $this->navegador->findElement(WebDriverBy::linkText('Sign in'))->click();
    $this->navegador->findElement(WebDriverBy::cssSelector('#signinbox input[name="login"]'))->sendKeys($login);
    $this->navegador->findElement(WebDriverBy::cssSelector('#signinbox input[name="password"]'))->sendKeys($senha);
    $this->navegador->findElement(WebDriverBy::cssSelector('#signinbox'))->findElement(WebDriverBy::linkText('SIGN IN'))->click();
    $username = $this->navegador->findElement(WebDriverBy::className('me'))->getText();
    // Assert
        $this->assertStringContainsString($nome, $username);
        $this->navegador->takeScreenshot("$nome.jpg");
    }
}