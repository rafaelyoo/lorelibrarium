<?php
namespace App\Repositories;

use App\Repositories\ReportRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ReportRepository implements ReportRepositoryInterface
{
    public function getAll()
    {
        return DB::table('relatorio_livros')->get();
    }
}