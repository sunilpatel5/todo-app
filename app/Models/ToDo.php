<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToDo extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'todos';

    protected $fillable = ['title', 'description', 'status', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}