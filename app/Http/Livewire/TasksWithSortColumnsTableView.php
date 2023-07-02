<?php

namespace App\Http\Livewire;

use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class TasksWithSortColumnsTableView extends TaskTableView
{
    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('ID')->sortBy('id'),
            'Превью',
            Header::title('Название')->sortBy('title'),
            'Описание',
            'Статус',
            'Теги',
        ];
    }

}
