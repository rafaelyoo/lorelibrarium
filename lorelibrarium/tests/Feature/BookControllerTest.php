<?php

use Tests\TestCase;
use App\Models\Author;
use App\Models\Subject;

class BookControllerTest extends TestCase
{
    /***
     * 
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->artisan('key:generate');
    }

    public function testStoreRedirects()
    {
        $author = Author::factory()->create();
        $subject = Subject::factory()->create();

        $response = $this->post('/books', [
            'Titulo' => 'Test Book',
            'Editora' => 'Test Editora',
            'Edicao' => 1,
            'AnoPublicacao' => 2000,
            'Preco' => 10.0,
            'autores' => [$author->Nome],
            'assuntos' => [$subject->Descricao],
        ]);

        $response->assertRedirect('/books'); 

        $this->assertDatabaseHas('books', ['Titulo' => 'Test Book']);
    }
}
