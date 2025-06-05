<?php
namespace App\Repositories;

use App\Models\Book;
use App\Repositories\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function getAll()
    {
        return Book::with(['authors', 'subjects'])->get();
    }

    public function find($id)
    {
        return Book::with(['authors', 'subjects'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Book::create([
            "Titulo" => $data['Titulo'],
            "Editora" => $data['Editora'],
            "Edicao" => $data['Edicao'],
            "AnoPublicacao" => $data['AnoPublicacao'],
            "Preco" => $data['Preco'],
        ]);
    }

    public function update($id, array $data)
    {
        $book = Book::find($id);
        $book->Titulo = $data['Titulo'];
        $book->Editora = $data['Editora'];
        $book->Edicao = $data['Edicao'];
        $book->AnoPublicacao = $data['AnoPublicacao'];
        $book->Preco = $data['Preco'];
        $book->save(); 

        return $book;
    }

    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();
    }
}
