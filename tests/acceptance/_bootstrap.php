<?php
require_once __DIR__.'/_support/Helper/Acceptance.php';
// tests/acceptance/_bootstrap.php
// ==========================================
// File di inizializzazione per i test di acceptance
// Eseguito prima di ogni test in questa suite

// 1. Carica l'autoloader di Composer
require_once __DIR__.'/../../vendor/autoload.php';

// 2. Imposta le costanti di ambiente
define('TEST_MODE', true);
define('BASE_URL', 'http://localhost:8000');

// 3. Configura l'ambiente di test
if (file_exists(__DIR__.'/../../.env.testing')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../', '.env.testing');
    $dotenv->load();
}

// 4. Inizializza il database di test (se necessario)
$testDbConfig = [
    'host' => $_ENV['DB_TEST_HOST'] ?? 'localhost',
    'name' => $_ENV['DB_TEST_NAME'] ?? 'untuned_test',
    'user' => $_ENV['DB_TEST_USER'] ?? 'root',
    'pass' => $_ENV['DB_TEST_PASS'] ?? ''
];

// 5. Helper functions per i test
function clearTestDatabase() {
    // Implementa la pulizia del DB se necessario
}

// 6. Registra shutdown function
register_shutdown_function(function() {
    // Pulizia finale dopo i test
});