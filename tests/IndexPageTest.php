<?php
use PHPUnit\Framework\TestCase;

class IndexPageTest extends TestCase {
    public function testIndexPageOutputsExpectedContent() {
        // Simula sessione e include la pagina
        $_SESSION = [];

        ob_start();
        include __DIR__ . '/../index.php';
        $output = ob_get_clean();

        // Controlli base sul contenuto
        $this->assertStringContainsString('Untuned', $output);
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('<html', $output);
    }
}
