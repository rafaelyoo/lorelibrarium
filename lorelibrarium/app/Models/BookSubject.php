<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookSubject extends Model
{
    protected $table = 'book_subject';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'Livro_CodI',
        'Assunto_codAs',
    ];

    public $timestamps = true;

    // Se quiser, pode adicionar relações (opcional):
    public function book()
    {
        return $this->belongsTo(Book::class, 'Livro_CodI', 'CodI');
    }

    public function subject()
    {
        return $this->belongsTo(Author::class, 'Assunto_codAs', 'CodAu');
    }
}