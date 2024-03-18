<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserve extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'reserves';
    protected $primaryKey = 'reserveID';  
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }  
} 