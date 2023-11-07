<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Fair extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_CANCELED = 3;

    protected $fillable = ['name','date_fair', 'status','user_id'];

    public static $statusOptions = [
        1 => 'Pendente',
        2 => 'Concluída',
        3 => 'Cancelada',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
