<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = ["flower_name", "flower_type", "store_id"];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
}
