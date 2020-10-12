<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'descricao', 'preco', 'lote', 'avaliacao',
    ];

    protected static function booted(){
        static::deleting(function (Product $product){
            Log::channel('stderr')->info('Evento produto deletado'. $product->image->path);
            Storage::disk('public')->delete($product->image->path);    
        });
        
        /*static::retrieved(function (Product $product){
            Log::channel('stderr')->info('RETRIEVED..'. $product->id);    
        });

        static::creating(function (Product $product){
            Log::channel('stderr')->info('Creating..'. $product->title);    
        });

        static::created(function (Product $product){
            Log::channel('stderr')->info('Created..'. $product->descricao);    
        });*/

    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function image()
    {
        return $this->hasOne('App\Models\Image');
    }

    public function tipos(){
        return $this->belongsToMany('App\Models\Tipo')->withTimestamps();
    }
    

}
