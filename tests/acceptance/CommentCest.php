<?php 
class CommentCest {
    public function testAddCommentAsLoggedUser(AcceptanceTester $I) {
        $I->amOnPage('/login.php');
        $I->fillField('email', 'user@example.com');
        $I->fillField('password', 'password123');
        $I->click('Login');
        $I->amOnPage('/article.php?id=1');
        $I->fillField('testo_commento', 'Questo è un commento di test');
        $I->click('Pubblica');
        $I->see('Questo è un commento di test');
    }

    public function testDeleteCommentAsAuthor(AcceptanceTester $I) {
        $I->amLoggedInAs('user@example.com'); // Usa il modulo PhpBrowser o un helper
        $I->amOnPage('/article.php?id=1');
        $I->click('Elimina', '#commento-1'); // Selettore specifico per il bottone
        $I->dontSee('Questo è un commento di test');
    }
}