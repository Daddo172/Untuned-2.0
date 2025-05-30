<?php
class ArticleCest {
    public function testClickArticleRedirect(AcceptanceTester $I)
{
    $I->amOnPage('/');
    $I->click('Leggi tutto', 'article:first-child');
    $I->seeCurrentUrlMatches('~article/\d+~');
    $I->seeInTitle('Articolo');
}
}