<?php
namespace Helper;

// Classe base per gli helper di acceptance
class Acceptance extends \Codeception\Module
{
    // Aggiungi qui i tuoi metodi personalizzati
    public function amLoggedInAs($email, $password)
    {
        $this->getModule('PhpBrowser')->amOnPage('/login.php');
        $this->getModule('PhpBrowser')->fillField('email', $email);
        $this->getModule('PhpBrowser')->fillField('password', $password);
        $this->getModule('PhpBrowser')->click('Login');
    }
}