<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    use HasFactory;
    protected $table = 'task_users';
    protected $fillable = [
        'id_user',
        'id_task',
    ];

}
