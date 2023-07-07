@extends('layouts.main')
@section('content')
    <h1 style="text-align: center;">Общие задачи:</h1>
    <div class="container mt-4">
        <div class="input-group mb-3 justify-content-left">
            <label for="search"></label>
            <input type="text" class="search-input" name="search" placeholder="Поиск" id="search" value="{{ old('search') }}" style="border-radius: 50px; padding-left: 12px;">
            <div class="input-group-append">
                <button class="search-button m-1" type="button" id="filter-btn"><i class="fas fa-search"></i></button>
                <a class="search-a" href="{{ route('lists.shared') }}"><i class="fas fa-times"></i></a>
            </div>
        </div>
        <p id="search-no-results" class="my-3" style="display: none;"></p>
    </div>
    <div class="container mt-4">
        @if (!empty($shares))
            <table class="table table-hover text-center">
                <thead class="thead-dark">
                <tr>
                    <th>Название</th>
                    <th>Владелец</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($shares as $share)
                    @foreach ($share->taskLists as $taskList)
                        <tr class="task-row">
                            <td>{{ $taskList->title }}</td>
                            <td>
                                @foreach($otherUsers as $otherUser)
                                    @if($otherUser->id === $taskList->user_id)
                                        {{ $otherUser->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <form action="{{ route('tasks.shared', $taskList->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="taskListId" value="{{ $taskList->id }}">
                                    <button class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </form>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
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

