@auth()
    <div id="header">
        <div class="logo">
            <a class="text-decoration-none" href="{{ route('home') }}">ToDo</a>
        </div>
        <nav>
            <ul>
                <li class="dropdown">
                    <a class="text-white">Задачи</a>
                    <ul>
                        <li><a class="text-decoration-none" href="{{ route('lists') }}">Списки задач</a></li>
{{--                        <li><a class="text-decoration-none" href="{{ route('tasks.showMyTasks') }}">Мои задачи</a></li>--}}
                        <li><a class="text-decoration-none" href="{{ route('lists.shared') }}">Общие задачи</a></li>
                    </ul>
                </li>
                <li style="position: relative; width: 100px; left: 1500px; top: 10px;">
                    <form method="POST" id="logout-form" action="{{ route('signOut') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger mt-4">Выйти</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
@endauth


<link href="{{ asset('css/styleHeader.css') }}" rel="stylesheet">
<script src="{{ asset('js/header.js') }}"></script>
