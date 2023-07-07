<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'task_list_id',
        'description',
        'status',
        'img_orig_path',
        'img_prev_path',
        'image_name',
    ];

    protected $appends = [
        'image_url',
    ];

    /**
     * Get the user that owns the task.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class, 'task_id', 'id');
    }

    public function taskList(): BelongsTo
    {
        return $this->belongsTo(TaskList::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->getImageOrigPath())) {
            return null;
        }
        return Storage::url($this->getImageOrigPath());
    }

    public function getImageOrigPath(): ?string
    {
        return $this->img_orig_path;
    }

    public function getImagePrevPath(): ?string
    {
        return $this->img_prev_path;
    }

    public function setImageOrigPath(?string $imageOrigPath): void
    {
        $this->img_orig_path = $imageOrigPath;
    }

    public function setImagePrevPath(?string $imagePrevPath): void
    {
        $this->img_prev_path = $imagePrevPath;
    }

    public function setImageOrigName(?string $imageName): void
    {
        $this->image_name = $imageName;
    }
}
