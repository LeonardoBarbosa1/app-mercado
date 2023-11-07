<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fair;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','status','brand', 'quantity','price','fair_id'];

    public function fair(){
        return $this->belongsTo(Fair::class);
    }
}
