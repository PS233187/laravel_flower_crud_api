<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['store_link'];

    

    public function flowers()
    {
        return $this->hasMany(Flower::class, 'functie_id', 'id');
    }
}
