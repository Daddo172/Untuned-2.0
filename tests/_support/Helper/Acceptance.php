<?php
namespace Helper;

class Acceptance extends \Codeception\Module
{
    /**
     * Simula il login come utente specifico.
     * @param string $email
     * @param string $password
     */
    public function amLoggedInAs($email, $password = 'password123')
    {
        // Ottieni il modulo PhpBrowser
        $phpBrowser = $this->getModule('PhpBrowser');

        // Vai alla pagina di login e invia il form
        $phpBrowser->amOnPage('/login.php');
        $phpBrowser->fillField('email', $email);
        $phpBrowser->fillField('password', $password);
        $phpBrowser->click('Login');

        // Verifica che il login sia avvenuto
        $phpBrowser->see('Benvenuto'); // Modifica con un testo presente dopo il login
    }
}