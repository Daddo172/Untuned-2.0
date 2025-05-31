<?php
use PHPUnit\Framework\TestCase;

class SessionUserTest extends TestCase
{
    public function testUserSessionData()
    {
        $_SESSION = [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com'
        ];

        $this->assertEquals('Mario Rossi', $_SESSION['name']);
        $this->assertEquals('mario@example.com', $_SESSION['email']);
    }
}
