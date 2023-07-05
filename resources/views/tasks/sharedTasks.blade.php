@extends('layouts.main')
@section('content')
    <h1 style="text-align: center;">Общие задачи:</h1>
    <div class="container mt-4">
        <div class="input-group mb-3 justify-content-left">
            <label for="search"></label>
            <input type="text" class="search-input" name="search" placeholder="Поиск" id="search" value="{{ old('search') }}" style="border-radius: 50px; padding-left: 12px;">
            <div class="input-group-append">
                <button class="search-button m-1" type="button" id="filter-btn"><i class="fas fa-search"></i></button>
                <a class="search-a" href="{{ route('tasks.shared') }}"><i class="fas fa-times"></i></a>
            </div>
        </div>
        <p id="search-no-results" class="my-3" style="display: none;"></p>
    </div>
    <div class="container mt-4">
        @if (!empty($shares))
            <table class="table table-hover text-center">
                <thead class="thead-dark">
                <tr>
                    <th style="width:10%; text-align: center;">Превью</th>
                    <th style="vertical-align: middle;">Название</th>
                    <th style="vertical-align: middle;">Владелец</th>
                    <th style="vertical-align: middle;">Описание</th>
                    <th style="vertical-align: middle;">Статус</th>
                    <th style="vertical-align: middle;">Теги</th>
                    <th colspan="3" style="text-align: center;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($shares as $share)
                    @foreach ($share->tasks as $task)
                        <tr class="task-row">
                            <td>
                                @if ($task->img_prev_path)
                                    <a href="{{ asset('/storage/' . $task->img_orig_path) }}" target="_blank">
                                        <img src="{{ asset('/storage/' . $task->img_prev_path) }}"
                                             alt="{{ $task->title }}">
                                    </a>
                                @else
                                    <img style="width: 150px;" src="{{ asset('storage/images/no_image.jpg') }}" alt="Default Image"
                                         class="task-image">
                                @endif
                            </td>
                            <td>{{ $task->title }}</td>
                            <td>
                                @foreach($otherUsers as $otherUser)
                                    @if($otherUser->id === $task->user_id)
                                        {{ $otherUser->name  }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->status }}</td>
                            <td>
                                @foreach($task->tags as $tag)
                                    <pre>{{ "#".$tag->name}}</pre>
                                @endforeach
                            </td>


                            <td style="text-align: center; vertical-align: middle;">
                                <button type="button" class="btn btn-outline-secondary btn-view-task mr-2"
                                        data-toggle="modal"
                                        data-target="#exampleModal{{ $task->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                            @include('tasks.showTask', ['task' => $task])

                            @if($share->access === "ReadAndEdit")
                                <td style="text-align: center; vertical-align: middle;">
                                    <button type="button" class="btn btn-outline-secondary btn-edit-task"
                                            data-toggle="modal"
                                            data-target="#editTaskModal{{ $task->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                @include('tasks.editTask', ['task' => $task])
                            @endif
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
            @if ($tasks->lastPage() > 1)
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
    </div>

@endsection
