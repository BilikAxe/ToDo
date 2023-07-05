@extends('layouts.main')
@section("content")
    @guest
        <div class="m-3">
            <a class="btn btn-primary ms-4"  href="{{ route('signIn') }}">Войти</a>
            <a class="btn btn-info" href="{{ route('signUp') }}">Регистрация</a>
        </div>

        <div class="text-center mt-4">
            <h1 style="font-size: 40px;">Списки задач</h1>
            <p>Авторизируйтесь или Зарегистрируйтесь для взаимодействия с ToDo</p>
        </div>
    @endguest
@endsection
