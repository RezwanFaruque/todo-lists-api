<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TodoList;

class TodoTask extends Model
{
    use HasFactory;

    public function todo(){
        return $this->belongsTo(TodoList::class);
    }
}
