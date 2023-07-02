<?php

namespace App\Actions;

use App\Models\Task;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class ActivateTaskAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Open";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "eye";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param Task $task
     * @param View $view Current view where the action was executed from
     * @return array
     */
    public function handle(Task $task, View $view)
    {
    }
}
