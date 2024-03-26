@extends('layouts.auth')

@section('page.title', 'Регистрация')

@section('auth.content')
    {!! htmlScriptTagJsApi() !!}
    <x-card>
        <x-card-header>
            <x-card-title>
                {{ __('Регистрация') }}
            </x-card-title>

            <x-slot name="right">
                <a href="{{ route('login') }}">
                    {{ __('Вход') }}
                </a>
            </x-slot>
        </x-card-header>

        <x-card-body>
            <x-errors/>
            <x-form action="{{ route('register.store') }}" method="POST">
                <x-form-item>
                    <x-checks type="text" name="name" autofocus>
                        {{ __('Имя') }}
                    </x-checks>
                </x-form-item>

                <x-form-item>
                    <x-checks type="email" name="email">
                        {{ __('Email') }}
                    </x-checks>
                </x-form-item>

                <x-form-item>
                    <x-checks type="password" name="password">
                        {{ __('Пароль') }}
                    </x-checks>
                </x-form-item>

                <x-form-item>
                    <x-checks type="password" name="password_confirmation">
                        {{ __('Еще раз') }}
                    </x-checks>
                </x-form-item>

                <x-form-item>
                    <x-checkbox name="agreement" :checked="!! request()->old('agreement')">
                        {{ __('Я согласен на обработку пользовательский данных') }}

                    </x-checkbox>
                </x-form-item>
                {!! htmlFormSnippet() !!}
                <x-button type="submit">
                    {{ __('Войти') }}
                </x-button>
            </x-form>
        </x-card-body>
    </x-card>
@endsection

