<?php

namespace App\Http\Livewire;

use App\Filters\TasksActiveFilter;

class TasksWithFiltersTableView extends TasksWithSortColumnsTableView
{
    public $searchBy = ['title', 'description', 'status'];

    protected function filters(): array
    {
        return [
            new TasksActiveFilter(),
        ];
    }
}
