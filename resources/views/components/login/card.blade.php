<x-card>
    <x-card-header>
        <x-card-title>
            {{ __('Вход') }}
        </x-card-title>

        <x-slot name="right">
            <a href="{{ route('register') }}">
                {{ __('Регистация') }}
            </a>
        </x-slot>
    </x-card-header>

    <x-card-body>
        <x-errors/>
        <x-form action="{{ route('login.store') }}" method="POST">
            <x-form-item>
                <x-checks type="email" name="email" autofocus>
                    {{ __('Email') }}
                </x-checks>
            </x-form-item>
            <x-form-item>
                <x-checks type="password" name="password" autofocus>
                    {{ __('Пароль') }}
                </x-checks>
            </x-form-item>

            <x-form-item>
                <x-checkbox name="remember">
                    {{ __('Запомнить меня') }}
                </x-checkbox>
            </x-form-item>

            <x-button type="submit">
                {{ __('Войти') }}
            </x-button>
        </x-form>
    </x-card-body>
</x-card>
