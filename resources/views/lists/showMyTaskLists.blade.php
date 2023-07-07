@extends('layouts.main')
@section('content')
    <h1 style="text-align: center;" class="m-0">Списки задач:</h1>
    <div style="position: relative;left: 410px;width: 500px;">
        <button type="button" class="btn btn-primary me-3" data-toggle="modal" data-target="#createTaskListModal">Создать
            список
        </button>
    </div>
    <div class="container mt-4">
        @if ($taskLists->count())
            <table class="table table-hover" id="table">
                <thead class="thead-dark">
                <tr>
                    <th>Название</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($taskLists as $taskList)
                    <tr class="task-row">
                        <td>{{ $taskList->title }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center; vertical-align: middle; width: 100px;">
                            <a class="btn btn-outline-secondary" href="{{ route('lists.showMyTasks', $taskList->id) }}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </td>

                        <td style="text-align: center; vertical-align: middle;width: 100px;">
                            <form action="{{ route('lists.delete', $taskList->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="taskListId" value="{{ $taskList->id }}">
                                <button type="submit" class="btn btn-outline-danger " style="display: block;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
{{--            @if($tasks->lastPage() > 1)--}}
{{--                <div>--}}
{{--                    {{ $tasks->links('pagination::bootstrap-4') }}--}}
{{--                </div>--}}
{{--            @endif--}}
        @else
            <div class="text-center my-5">
                <p>Задачи отсутствуют</p>
            </div>
        @endif
    </div>






    <form id="createTaskListFormModal" method="POST" action="{{ route('lists.store') }}">
        {{ csrf_field() }}
        @include('lists.addTaskList')
    </form>
@endsection

