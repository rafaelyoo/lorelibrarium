<?php
namespace App\Repositories;

interface SubjectRepositoryInterface
{
    public function create(array $data);
    public function getByToken($token);
    public function findRelationship($bookCodI, $assuntoCodAs);
    public function createRelationship($bookCodI, $assuntoCodAs);
    public function deleteRelationship($bookCodI, $assuntoCodAs);
}