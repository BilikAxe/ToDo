<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class TaskTableView extends TableView
{
    protected $paginate = 5;

    protected function repository(): Builder
    {
        return Task::query();
    }

    /**
     * Sets a model class to get the initial data
     */
    protected string $task = Task::class;
    protected string $tag = Tag::class;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'ID',
            'Превью',
            'Название',
            'Описание',
            'Статус',
            'Теги',
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param Task $task
     * @return array
     */
    public function row(Task $task): array
    {
        if ($task->img_prev_path) {
            $image = UI::prevue('storage/' . $task->img_prev_path);
        } else {
            $image = UI::prevue('storage/images/no_image.jpg');
        }

        return [
            $task->id,
            $image,
            $task->title,
            $task->description,
            $task->status,
            'tag' => '#',
//            'image' => asset('storage/' . $task->img_prev_path),
        ];
    }
}
