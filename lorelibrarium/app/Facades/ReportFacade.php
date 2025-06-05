<?php

namespace App\Facades;

use App\Repositories\ReportRepositoryInterface;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class ReportFacade
{
    protected $repository;

    public function __construct(
        ReportRepositoryInterface $repository,
    )
    {
        $this->repository = $repository;   
    }

    public function generate()
    {
        $data = $this->repository->getAll();
        
        $pdf = PDF::loadView('relatorio', ['data' => $data]);
        
        $fileName = time() . "-relatorio.pdf";
        $filePath = storage_path("/app/public/{$fileName}");
        $pdf->loadView('relatorio', ['data' => $data])->save($filePath);

        return [$filePath, $fileName];
    }
}