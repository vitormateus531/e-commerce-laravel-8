<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $loja->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4 justify-center pb-10">
                <div>
                    <button onclick="window.location='/produtos?loja={{$loja->id}}'" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-boxes text-4xl"></i><br>
                        Produtos
                    </button>
                </div>
                <!-- ... -->
                <div>
                    <button onclick="window.location='/funcionarios?loja={{$loja->id}}'" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-user-tie text-4xl"></i><br>
                        Funcionários
                    </button>
                </div>
            </div>

            <button type="button" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" onclick=redirect("{{route('lojas.index')}}") >
                Voltar
            </button>
        </div>
    </div>
</x-app-layout>