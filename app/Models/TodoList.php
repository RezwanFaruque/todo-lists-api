<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TodoTask;

class TodoList extends Model
{
    use HasFactory;

    /**
     * Get all of the todotasks for the TodoList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function todotasks()
    {
        return $this->hasMany(TodoTask::class, 'todolist_id', 'id');
    }
}
