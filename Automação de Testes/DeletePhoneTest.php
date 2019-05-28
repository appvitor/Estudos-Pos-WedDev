<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;
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

    public function testAddPhone() {
        // Clicar em .hide-on-med-and-down a[data-target="signinbox"]
        $this->navegador
            ->findElement(WebDriverBy::cssSelector('.hide-on-med-and-down a[data-target="signinbox"]'))
            ->click();
        // Digitar julio0001 em #signinbox input[name="login"]
        $this->navegador
            ->findElement(WebDriverBy::cssSelector('#signinbox input[name="login"]'))
            ->sendKeys('appvitor');
        // Digitar 123456 em #signinbox input[name="password"]
        $this->navegador
            ->findElement(WebDriverBy::cssSelector('#signinbox input[name="password"]'))
            ->sendKeys('senha1');

        $this->navegador
            ->findElement(WebDriverBy::id('signinbox'))
            ->findElement(WebDriverBy::linkText('SIGN IN'))
            ->click();

        $this->navegador->findElement(WebDriverBy::className('me'))->click();

        $this->navegador->findElement(WebDriverBy::linkText('MORE DATA ABOUT YOU'))->click();       

        $this->navegador->findElement(WebDriverBy::xpath('//span[text()="997015861"]/parent::li/a'))->click();

        $alerta = $this->navegador->switchTo()->alert();
        $alerta->getText();
        $alerta->accept();

        $wait = new WebDriverWait($this->navegador, 5, 500);
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('toast-container'))
        );
        
        $mensagem = $this->navegador->findElement(WebDriverBy::id('toast-container'))->getText();

        $this->assertEquals('Rest in peace, dear phone!', $mensagem);
    }
}