<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'descricao', 'preco', 'lote', 'avaliacao',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
