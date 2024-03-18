<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'books';
    protected $primaryKey = 'bookID';  
    protected $fillable = [
        'vePlateNo',
        'veType',
        'veBrand',
        'veModel',
        'vePrice',
        'status_message',
        'file',
    ];
    public function user()   
    {
        return $this->belongsTo(User::class, 'user_id'); 
    } 
    public function reserve()   
    { 
        return $this->belongsTo(Reserve::class, 'reserve_id');  
    } 
}
