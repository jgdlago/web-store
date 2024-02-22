<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Soluct Web Store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @guest()
                        @section('content')
                            <div class="flex flex-col items-center justify-center">
                                <h1 class="text-3xl font-bold text-gray-800 mb-6">Bem-vindo a Soluct!</h1>

                                <div class="grid grid-cols-2 gap-4">
                                    <a href="{{ route('register') }}" class="btn btn-primary hover:text-blue-600 transition-colors duration-300">Crie uma conta</a>
                                    <a href="{{ route('login') }}" class="btn btn-secondary hover:text-blue-600 transition-colors duration-300">Login</a>
                                    <a href="{{ route('products.index') }}" class="btn btn-primary hover:text-blue-600 transition-colors duration-300">Ver Produtos</a>
                                    <a href="{{ route('promotions.index') }}" class="btn btn-secondary hover:text-blue-600 transition-colors duration-300">Ver Promoções</a>
                                </div>
                            </div>
                        @endsection
                    @endguest

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
