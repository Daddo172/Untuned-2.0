<?php 
class CommentIntegrationTest extends \PHPUnit\Framework\TestCase {
    public function testCommentPermissions() {
        $auth = new Auth();
        $auth->login('user@example.com', 'password123');
        $this->assertTrue($auth->canEditComment(1)); // ID commento di proprietà dell'utente
        $this->assertFalse($auth->canEditComment(2)); // ID commento di un altro utente
    }
}