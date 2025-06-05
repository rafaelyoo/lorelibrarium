<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'authors';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'CodAu';

    /**
     *
     * @var list<string>
     */
    protected $fillable = [
        'Nome',
        'Token',
    ];
}
