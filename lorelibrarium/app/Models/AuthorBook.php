<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorBook extends Model
{
    protected $table = 'author_book';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'Livro_CodI',
        'Autor_CodAu',
    ];

    public $timestamps = true;

    public function book()
    {
        return $this->belongsTo(Book::class, 'Livro_CodI', 'CodI');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'Autor_CodAu', 'CodAu');
    }
}