<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Share extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'shared_user_id',
        'task_list_id',
        'access',
    ];

    /**
     * Get the shares for the user.
     *
     * @return HasMany
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'code', 'access');
    }

    /**
     * Get the shareTasks for the user.
     *
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class,'user_id', 'owner_id');
    }

    public function taskLists(): HasMany
    {
        return $this->hasMany(TaskList::class, 'id', 'task_list_id');
    }
}
