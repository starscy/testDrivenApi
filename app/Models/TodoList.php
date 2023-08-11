<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    static public function boot()
    {
        parent::boot();
//        self::deleting(function (TodoList $todoList){
//            $todoList->tasks->each->delete();
//        });
    }

    public function tasks():HasMany
    {
        return $this->hasMany(Task::class);
    }
}
