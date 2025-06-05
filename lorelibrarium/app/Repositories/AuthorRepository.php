<?php
namespace App\Repositories;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Repositories\AuthorRepositoryInterface;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function create(array $data)
    {
        return Author::create([
            'Nome' => $data['Nome'],
            'Token' => $data['Token'],
        ]);
    }

    public function getByToken($token)
    {
        return Author::where('Token', $token)->first();
    }

    public function findRelationship($bookCodI, $AutorCodAu)
    {
        return AuthorBook::where('Livro_CodI', $bookCodI)
                ->where('Autor_CodAu', $AutorCodAu)
                ->first();
    }
    
    public function createRelationship($bookCodI, $autorCodAu)
    {
        return AuthorBook::create([
            "Livro_CodI" => $bookCodI,
            "Autor_CodAu" => $autorCodAu
        ]);
    }

    public function deleteRelationship($bookCodI, $autorCodAu)
    {
        AuthorBook::where('Livro_CodI', $bookCodI)
            ->where('Autor_CodAu', $autorCodAu)
            ->delete();
    }
}