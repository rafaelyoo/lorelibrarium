<?php

namespace App\Http\Controllers;

use App\Facades\ReportFacade;

class ReportController extends Controller
{
    protected $facade;

    public function __construct(ReportFacade $facade)
    {
        $this->facade = $facade;
    }
    public function generate()
    {
        [$filePath, $fileName] = $this->facade->generate();
        // Retorna o download do PDF
        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}