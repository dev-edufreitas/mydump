@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">Entrar</h1>
        <p class="text-gray-600 mt-2">Acesse sua conta para gerenciar o blog</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Email
            </label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                Senha
            </label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember" 
                   type="checkbox" 
                   name="remember" 
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="remember" class="ml-2 block text-sm text-gray-700">
                Lembrar de mim
            </label>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Entrar
            </button>
        </div>
    </form>

    <!-- Links -->
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Não tem uma conta?
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">
                Cadastre-se aqui
            </a>
        </p>
    </div>
</div>
@endsection
