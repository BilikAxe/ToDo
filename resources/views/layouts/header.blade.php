<div class="mb-20">
    @auth()
    <section class="navigation">
        <div class="nav-container">
            <div class="brand"><a href="{{ route('home') }}">ToDo</a></div>
            <nav>
                <ul class="nav-list">
                    <li class = "dropdown"><a class="text-white">Задачи</a>
                        <ul class="nav-dropdown">
                            <li><a href="{{ route('tasks.showMyTasks') }}">Мои задачи</a></li>
                            <li><a href="{{ route('tasks.showTasks') }}">Все задачи</a></li>
                            <li><a href="{{ route('tasks.shared') }}">Общие задачи</a></li>
                        </ul>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('signOut') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger m-3 ms-4">Выйти</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    @endauth
</div>
<link href="{{ asset('css/styleHeader.css') }}" rel="stylesheet">
<script src="{{ asset('js/header.js') }}"></script>

