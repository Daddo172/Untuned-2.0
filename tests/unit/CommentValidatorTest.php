<?php
class CommentValidatorTest extends \PHPUnit\Framework\TestCase {
    public function testCommentTextValidation() {
        $this->assertTrue(CommentValidator::validate('Test valido'));
        $this->assertFalse(CommentValidator::validate('')); // Testo vuoto
        $this->assertFalse(CommentValidator::validate(str_repeat('a', 1001))); // Limite caratteri
    }
}