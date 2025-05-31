<?php
use PHPUnit\Framework\TestCase;

class FakeCurlServer {
    public function get_request($url, $token) {
        return (object)[
            'display_name' => 'Mario Spotify',
            'email' => 'mario@example.com'
        ];
    }
}

class ProfiloPageTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION = [
            'name' => 'Mario Test',
            'email' => 'mario@test.com',
            'spotify_token' => (object)[ 'access_token' => 'fake_token' ]
        ];
    }

    public function testProfiloPageShowsUserInfo()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION = [
        'name' => 'Mario Test',
        'email' => 'mario@test.com',
        'spotify_token' => (object)['access_token' => 'fake_token']
    ];

    global $curl;
    $curl = new FakeCurlServer();

    ob_start();
    include __DIR__ . '/../../profilo.php';
    $output = ob_get_clean();
    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    $this->assertStringContainsString('Mario Spotify', $output);
    $this->assertStringContainsString('Informazioni Utente', $output);
}

}
