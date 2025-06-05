<?php
namespace App\Repositories;

interface AuthorRepositoryInterface
{
    public function create(array $data);
    public function getByToken($token);
    public function findRelationship($bookCodI, $autorCodAu);
    public function createRelationship($bookCodI, $autorCodAu);
    public function deleteRelationship($bookCodI, $autorCodAu);
}