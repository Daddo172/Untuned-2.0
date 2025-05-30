<?php
class ArticleCest {
    public function testClickArticleRedirect(AcceptanceTester $I) {
        $I->amOnPage('/index.php'); // Homepage
        $I->click('Leggi tutto', '.article-card'); // Clicca sul link nell'articolo (usa un selettore CSS specifico)
        $I->seeInCurrentUrl('/article.php'); // Verifica l'URL
        $I->see('Titolo dell\'articolo'); // Verifica il contenuto della pagina
        $I->see('Contenuto completo dell\'articolo');
    }
}