<?php 
class ArticleIntegrationTest extends \PHPUnit\Framework\TestCase {
    protected function setUp(): void {
        $this->db = new PDO('mysql:host=localhost;dbname=untuned_test', username: 'postgres', password: 'biar');
    }

    public function testGetArticleById() {
        $stmt = $this->db->prepare("SELECT * FROM articoli WHERE id = 1");
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals('Titolo dell\'articolo', $article['titolo']);
    }
}