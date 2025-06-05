<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'CodI';

    /**
     *
     * @var list<string>
     */
    protected $fillable = [
        'Titulo',
        'Editora',
        'Edicao',
        'AnoPublicacao',
        'Preco',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book', 'Livro_CodI', 'Autor_CodAu'); 
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'book_subject', 'Livro_CodI', 'Assunto_CodAs');
    }
}
