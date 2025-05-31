<?php
class FilterGenreCest
{
    public function filterPopGenre(AcceptanceTester $I)
    {
        $I->amOnPage('/Untuned-2.0/index.php');
        $I->see('Genere'); // Etichetta visibile del filtro
        $I->selectOption('select[name=inputgenerefiltro]', 'Pop');
        $I->click('Applica'); // Etichetta esatta del bottone
        $I->see('Pop'); // Verifica che il genere Pop sia presente nei risultati
        $I->dontSee('Rock'); // Verifica che altri generi non siano presenti
    }
}
