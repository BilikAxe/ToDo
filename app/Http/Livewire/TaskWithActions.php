<?php

namespace App\Http\Livewire;

use App\Actions\ActivateTaskAction;

class TaskWithActions extends TasksWithFiltersTableView
{
    protected function actionsByRow(): array
    {
        return [
            new ActivateTaskAction,
        ];
    }
}
