<?php
class FilterGenreCest
{
    public function filterPopGenre(AcceptanceTester $I)
    {
        $I->amOnPage('/Untuned-2.0-main/index.php'); // Assicurati che il percorso sia corretto
        $I->see('Filter'); // Verifica che il filtro sia visibile
        $I->selectOption('select[name=genere]', 'Pop'); // Selettore "select" con name="genere"
        $I->click('Filter'); // Il nome esatto del bottone deve essere "Filter" o simile
        $I->see('Pop'); // Verifica che i post Pop siano visibili
        $I->dontSee('Rock'); // Controlla che altri generi siano nascosti
    }
}
