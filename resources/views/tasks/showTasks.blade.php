

@extends('layouts.main')
{{--<livewire:task-table-view />--}}
@section('content')
    <div class="container mt-16" id="tasklist">
        <h1 style="font-size: 30px; margin-bottom: 20px;">Список задач</h1>

{{--        <div class="filter-section text-left">--}}
{{--            <div class="input-group mb-3 justify-content-left">--}}
{{--                <label for="search"></label>--}}
{{--                <input type="text" class="form-control" placeholder="Поиск" id="search">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-outline-primary" type="button" id="filter-btn">Поиск</button>--}}
{{--                    <a class="btn btn-outline-primary" href="{{ route('tasks.showTasks') }}">Сбросить поиск</a>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--            <p id="search-no-results" class="my-3" style="display: none;"></p>--}}
{{--        </div>--}}

{{--        <form method="GET" action="{{ route('tasks.filter') }}" class="row g-3 align-items-center">--}}

{{--            <div class="col-auto">--}}
{{--                <label for="title" class="form-label">Наименование:</label>--}}
{{--                <input type="text" class="form-control" name="title" id="title">--}}
{{--            </div>--}}
{{--            <div class="col-auto">--}}
{{--                <label for="description" class="form-label">Описание:</label>--}}
{{--                <input type="text" class="form-control" name="description" id="description">--}}
{{--            </div>--}}
{{--            <div class="col-auto">--}}
{{--                <label for="status" class="form-label">Статус:</label>--}}
{{--                <select class="form-select" name="status" id="status">--}}
{{--                    <option value="В процессе">В процессе</option>--}}
{{--                    <option value="Выполнена">Выполнена</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col-md-2">--}}
{{--                <label for="tag" class="form-label">Тег:</label>--}}
{{--                <input type="text" class="form-control" name="tag" id="tag">--}}
{{--            </div>--}}
{{--            <div class="col-auto" style="position: relative; top: 16px;">--}}
{{--                <button type="submit" class="btn btn-outline-primary filter-button">Фильтровать</button>--}}
{{--                <a class="btn btn-outline-primary" href="{{ route('tasks.showTasks') }}">Сбросить фильтр</a>--}}
{{--            </div>--}}
{{--        </form>--}}
            <button type="button" class="btn btn-primary me-3" data-toggle="modal" data-target="#createTaskModal">
                <i class="fas">Создать задачу</i>
            </button>

            <td style="text-align: center; vertical-align: middle;">
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#shareTasksModal{{ $tasks }}">
                    <i class="fas">Расшарить список </i>
                </button>
            </td>
            @include('tasks.shareTasks', ['tasks' => $tasks, 'otherUsers' => $otherUsers, 'permissions' => $permissions])


        <form id="createTaskFormModal" method="POST" action="{{ route('tasks.store') }}">
            {{ csrf_field() }}
            @include('tasks.addTask')

            <link href="{{ asset('css/styleShowTasks.css') }}" rel="stylesheet">
            <link href="{{ asset('css/stylePaginate.css') }}" rel="stylesheet">

            <script src="{{ asset('js/search.js') }}"></script>
        </form>
    @livewire('task-with-actions')
    </div>
@endsection
