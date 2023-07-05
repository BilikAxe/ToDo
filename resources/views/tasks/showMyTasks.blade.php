@extends('layouts.main')
@section('content')
    <h1 style="text-align: center;" class="m-0">Мои задачи:</h1>
    <div style="position: relative;left: 410px;width: 500px;">
        <button type="button" class="btn btn-primary me-3" data-toggle="modal" data-target="#createTaskModal">Создать задачу</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shareTasksModal">Поделиться списком</button>
    </div>
    <div class="container mt-4">
        <div>
            <div class="input-group mb-3 justify-content-left">
                <label for="search"></label>
                <input type="text" class="search-input" name="search" placeholder="Поиск" id="search" value="{{ old('search') }}" style="border-radius: 50px; padding-left: 12px;">
                <div class="input-group-append">
                    <button class="search-button m-1" type="button" id="filter-btn"><i style="font-size: 15px;" class="fas fa-search"></i></button>
                    <a class="search-a" href="{{ route('tasks.showMyTasks') }}"><i class="fas fa-times"></i></a>
                </div>
                <form method="GET" action="{{ route('tasks.filter') }}" style="position: relative; left: 400px;">
                    <div class="col-auto" style="position:relative;right: 180px;">
                        <input type="text" class="search-input" name="tag" id="tag" placeholder="Введите тег" style="border-radius: 50px; padding-left: 12px;width: 300px;">
                        <button class="but-fil" type="submit" style="position: relative;border-radius: 50%; font-size: 12px;background-color: white;border: none;right: 30px;bottom: 3px;"><i class="fas fa-filter"></i></button>
                        <a href="{{ route('tasks.showMyTasks') }}"><i class="fas fa-times"></i></a>
                    </div>
                </form>
            </div>
            <p id="search-no-results" class="my-3" style="display: none;"></p>
        </div>


        @if ($tasks->count())
            <table class="table table-hover" id="table">
                <thead class="thead-dark">
                <tr>
                    <th>Превью</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Статус</th>
                    <th>Теги</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr class="task-row">
                            <td>
                                @if ($task->img_prev_path)
                                    <a href="{{ asset('/storage/' . $task->img_orig_path) }}" target="_blank">
                                        <img src="{{ asset('/storage/' . $task->img_prev_path) }}" alt="{{ $task->title }}">
                                    </a>
                                @else
                                    <img src="{{ asset('storage/images/no_image.jpg') }}" style="width: 150px;" alt="Default Image" class="task-image">
                                @endif
                            </td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->status }}</td>
                            <td class="tag">
                                @foreach($task->tags as $tag)
                                    <pre>{{ $tag->name }}</pre>
                                @endforeach
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <button type="button" class="btn btn-outline-secondary btn-view-task mr-2" data-toggle="modal"
                                        data-target="#exampleModal{{ $task->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                            @include('tasks.showTask', ['task' => $task])

                            <td style="text-align: center; vertical-align: middle;">
                                <button type="button" class="btn btn-outline-secondary btn-edit-task" data-toggle="modal"
                                        data-target="#editTaskModal{{ $task->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            @include('tasks.editTask', ['task' => $task])

                            <td style="text-align: center; vertical-align: middle;">
                                <form action="{{ route('tasks.delete', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger " style="display: block;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($tasks->lastPage() > 1)
                <div>
                    {{ $tasks->links('pagination::bootstrap-4') }}
                </div>
            @endif
        @else
            <div class="text-center my-5">
                <p>Задачи отсутствуют</p>
            </div>
        @endif
        <link href="{{ asset('css/styleSearch.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styleTable.css') }}" rel="stylesheet">
        <script src="{{ asset('js/search.js') }}"></script>
        <script src="{{ asset('js/modal.js') }}"></script>
    </div>
    <form id="createTaskFormModal" method="POST" action="{{ route('tasks.store') }}">
        {{ csrf_field() }}
        @include('tasks.addTask')
    </form>
    <form id="shareTaskFormModal" method="POST" action="{{ route('tasks.share') }}">
        {{ csrf_field() }}
        @include('tasks.shareTasks')
    </form>
@endsection
