<x-guest-layout>
    <x-authentication-card>
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <div class="flex items-center justify-center">
        <img class="size-24" src="https://cdn.discordapp.com/attachments/1219283420207906882/1219283603884871700/logo-no-bg.png?ex=660abd58&is=65f84858&hm=3a6017d376e3dc90b48e9c9bf4315c83d42a5fc1a61b76e744009483733fcab6&" alt="">
        </div>    
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-300">{{ __('Lembrar me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('register'))
                    <a class="underline text-sm text-emerald-400 hover:text-emerald-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                        {{ __('Ainda não possui uma conta?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

</x-guest-layout>
