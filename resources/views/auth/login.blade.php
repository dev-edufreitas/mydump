@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">Entrar</h1>
    </div>

    @if (session('status'))
        <div class="mb-4 rounded-md border border-black/20 bg-black/5 px-4 py-3 text-sm text-gray-900">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">
                Email
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="email"
                aria-describedby="{{ $errors->has('email') ? 'email-error' : '' }}"
                @class([
                    // base
                    'block w-full rounded-md border px-3 py-2 text-gray-900 placeholder-gray-500 shadow-sm transition',
                    // tema preto
                    'border-black/60 focus:border-black focus:ring-2 focus:ring-black/50 focus:outline-none',
                    // erro
                    'border-red-500 focus:border-red-600 focus:ring-red-200' => $errors->has('email'),
                ])>
            @error('email')
                <p id="email-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Senha --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-900 mb-2">
                Senha
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                aria-describedby="{{ $errors->has('password') ? 'password-error' : '' }}"
                @class([
                    'block w-full rounded-md border px-3 py-2 text-gray-900 placeholder-gray-500 shadow-sm transition',
                    'border-black/60 focus:border-black focus:ring-2 focus:ring-black/50 focus:outline-none',
                    'border-red-500 focus:border-red-600 focus:ring-red-200' => $errors->has('password'),
                ])>
            @error('password')
                <p id="password-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lembrar de mim + Esqueci a senha --}}
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center select-none">
                <input
                    id="remember"
                    type="checkbox"
                    name="remember"
                    @checked(old('remember'))
                    class="h-4 w-4 rounded border-black/60 text-black focus:ring-black/50">
                <span class="ml-2 text-sm text-gray-900">Lembrar de mim</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-gray-900 underline decoration-black/50 underline-offset-4 hover:decoration-black">
                    Esqueceu a senha?
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <div>
            <button
                type="submit"
                class="w-full inline-flex items-center justify-center rounded-md bg-black px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition
                       hover:bg-neutral-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-black active:translate-y-px disabled:opacity-50">
                Entrar
            </button>
        </div>
    </form>

    {{-- Links --}}
    <!-- <div class="mt-6 text-center">
        <p class="text-sm text-gray-700">
            Não tem uma conta?
            <a href="{{ route('register') }}"
               class="font-medium text-gray-900 underline decoration-black/50 underline-offset-4 hover:decoration-black">
                Cadastre-se aqui
            </a>
        </p>
    </div> -->
</div>
@endsection
