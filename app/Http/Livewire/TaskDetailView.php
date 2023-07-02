<?php

namespace App\Http\Livewire;

use App\Models\Task;
use LaravelViews\Facades\UI;
use LaravelViews\Views\DetailView;

class TaskDetailView extends DetailView
{
    protected $modelClass = Task::class;
    public $title = "Title";

    /**
     * @param $model Model instance
     * @return Array Array with all the detail data or the components
     */
    public function detail(Task $task): array
    {
        return [
            'Превью' => UI::avatar('storage/' . $task->img_orig_path),
            'Название' => $task->name,
            'Описание' => $task->description,
            'Статус' => $task->status,
            'Теги' => '#',
        ];
    }
}
