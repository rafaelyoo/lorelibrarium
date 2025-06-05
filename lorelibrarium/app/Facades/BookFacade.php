<?php

namespace App\Facades;

use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\SubjectRepositoryInterface;

class BookFacade
{
    protected $bookRepository;
    protected $authorRepository;
    protected $subjectRepository;

    public function __construct(
        BookRepositoryInterface $bookRepository,
        AuthorRepositoryInterface $authorRepository,
        SubjectRepositoryInterface $subjectRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
        $this->subjectRepository = $subjectRepository;      
    }

    public function listBooks()
    {
        return $this->bookRepository->getAll();
    }

    public function createBook($data)
    {
        try {
            DB::beginTransaction();

            $book = $this->bookRepository->create($data);

            if (isset($data['assuntos']) && is_array($data['assuntos']))
            {
                foreach ($data['assuntos'] as $assunto)
                {
                    $Token = $this->createWordToken($assunto);
                    $subject = $this->subjectRepository->getByToken($Token);
                    $createRelationship = false;

                    if(!$subject) {
                        $subject = $this->subjectRepository->create([
                            'Descricao' => $assunto,
                            'Token' => $Token
                        ]);
                        $createRelationship = [$book->CodI, $subject->codAs];
                    } else {
                        $bookSubject = $this->subjectRepository->findRelationship($book->CodI, $subject->codAs);

                        if(!$bookSubject)
                        {                            
                            $createRelationship = [$book->CodI, $subject->codAs];
                        }
                    }

                    if ($createRelationship) 
                    {
                        [$CodI, $codAs] = $createRelationship;
                        $this->subjectRepository->createRelationship($CodI, $codAs);
                    }                    
                }
            }

            if (isset($data['autores']) && is_array($data['autores']))
            {
                foreach ($data['autores'] as $autor)
                {
                    $Token = $this->createWordToken($autor);
                    $author = $this->authorRepository->getByToken($Token);
                    $createRelationship = false;
                    
                    if(!$author) {
                        $author = $this->authorRepository->create([
                            'Nome' => $autor,
                            'Token' => $Token
                        ]);
                        $createRelationship = [$book->CodI, $author->CodAu];
                    } else {
                        $authorBook = $this->authorRepository->findRelationship($book->CodI, $subject->CodAu);

                        if(!$authorBook)
                        {                            
                            $createRelationship = [$book->CodI, $author->CodAu];
                        }
                    }

                    if ($createRelationship) 
                    {
                        [$CodI, $CodAu] = $createRelationship;
                        $this->authorRepository->createRelationship($CodI, $CodAu);
                    }                    
                }
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }        
    }

    public function updateBook($CodI, $data)
    {
        try {
            DB::beginTransaction();

            $book = $this->bookRepository->update($CodI, $data);

            $this->removeAuthors($book, $data);
            $this->removeSubjects($book, $data);
            $this->createSubjects($book, $data);            
            $this->createAuthors($book, $data);            

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }        
    }

    public function createAuthors($book, array $data)
    {
        if (isset($data['autores']) && is_array($data['autores']))
        {
            foreach ($data['autores'] as $autor)
            {
                $Token = $this->createWordToken($autor);
                $author = $this->authorRepository->getByToken($Token);
                $createRelationship = false;
                
                if(!$author) {
                    $author = $this->authorRepository->create([
                        'Nome' => $autor,
                        'Token' => $Token
                    ]);
                    $createRelationship = [$book->CodI, $author->CodAu];
                } else {
                    $authorBook = $this->authorRepository->findRelationship($book->CodI, $author->CodAu);

                    if(!$authorBook)
                    {                            
                        $createRelationship = [$book->CodI, $author->CodAu];
                    }
                }

                if ($createRelationship) 
                {
                    [$CodI, $CodAu] = $createRelationship;
                    $this->authorRepository->createRelationship($CodI, $CodAu);
                }                    
            }
        }
    }

    public function createSubjects($book, array $data)
    {
        if (isset($data['assuntos']) && is_array($data['assuntos']))
        {
            foreach ($data['assuntos'] as $assunto)
            {
                $Token = $this->createWordToken($assunto);
                $subject = $this->subjectRepository->getByToken($Token);
                $createRelationship = false;

                if(!$subject) {
                    $subject = $this->subjectRepository->create([
                        'Descricao' => $assunto,
                        'Token' => $Token
                    ]);
                    $createRelationship = [$book->CodI, $subject->codAs];
                } else {
                    $bookSubject = $this->subjectRepository->findRelationship($book->CodI, $subject->codAs);

                    if(!$bookSubject)
                    {                            
                        $createRelationship = [$book->CodI, $subject->codAs];
                    }
                }

                if ($createRelationship) 
                {
                    [$CodI, $codAs] = $createRelationship;
                    $this->subjectRepository->createRelationship($CodI, $codAs);
                }                    
            }
        }
    }

    public function removeAuthors($book, $data)
    {
        if(isset($data['removerAutores']) && is_array($data['removerAutores']))
        {
            foreach($data['removerAutores'] as $autor)
            {
                $Token = $this->createWordToken($autor);
                $author = $this->authorRepository->getByToken($Token);
                
                if ($author) {
                    $this->authorRepository->deleteRelationship($book->CodI, $author->CodAu);
                }
            }
        }
    }

    public function removeSubjects($book, $data)
    {
        if(isset($data['removerAssuntos']) && is_array($data['removerAssuntos']))
        {
            foreach($data['removerAssuntos'] as $assunto)
            {
                $Token = $this->createWordToken($assunto);
                $subject = $this->subjectRepository->getByToken($Token);
                
                if ($subject) {
                    $this->subjectRepository->deleteRelationship($book->CodI, $subject->codAs);
                }
            }
        }
    }

    public function getBook($id)
    {
        return $this->bookRepository->find($id);
    }

    public function deleteBook($id)
    {
        return $this->bookRepository->delete($id);
    }

    public function createWordToken($word)
    {
        return strtolower(
            preg_replace('/[^a-zA-Z0-9]/', '', 
                transliterator_transliterate('Any-Latin; Latin-ASCII', $word)
            )
        );
    }
}