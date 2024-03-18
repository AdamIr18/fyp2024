<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes; 
    protected $table = 'vehicle';
    protected $primaryKey = 'veID'; 
    protected $fillable = [
        'vePlateNo',
        'veType',
        'veBrand', 
        'veModel',
        'condition',
        'availability',
        'carSeat',
        'vePrice',
        'veImg',
        'veImg2',
        'veImg3',
    ];
}