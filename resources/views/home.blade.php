@extends('layouts.main')
@section("content")
    @auth
        <p class="text-center" >Добро пожаловать <b>{{ Auth::user()->name }}</b></p>

    @endauth
    @guest
        <div style="position: relative; bottom: 50px;">
            <a class="btn btn-primary ms-4"  href="{{ route('signIn') }}">Войти</a>
            <a class="btn btn-info" href="{{ route('signUp') }}">Регистрация</a>
        </div>

        <div class="text-center mt-4">
            <h1 style="font-size: 40px;">Списки задач</h1>
            <p>Авторизируйтесь или Зарегистрируйтесь для взаимодействия с ToDo</p>
        </div>
    @endguest
@endsection
