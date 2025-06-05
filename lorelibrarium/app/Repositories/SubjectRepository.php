<?php
namespace App\Repositories;

use App\Models\Subject;
use App\Models\BookSubject;
use App\Repositories\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function create(array $data)
    {
        return Subject::create([
            'Descricao' => $data['Descricao'],
            'Token' => $data['Token'],
        ]);
    }

    public function getByToken($token)
    {
        return Subject::where('Token', $token)->first();
    }

    public function findRelationship($bookCodI, $assuntoCodAs)
    {
        return BookSubject::where('Livro_CodI', $bookCodI)
                ->where('Assunto_codAs', $assuntoCodAs)
                ->first();
    }
    
    public function createRelationship($bookCodI, $assuntoCodAs)
    {
        return BookSubject::create([
            "Livro_CodI" => $bookCodI,
            "Assunto_codAs" => $assuntoCodAs
        ]);
    }

    public function deleteRelationship($bookCodI, $assuntoCodAs)
    {
        BookSubject::where('Livro_CodI', $bookCodI)
            ->where('Assunto_codAs', $assuntoCodAs)
            ->delete();
    }
}