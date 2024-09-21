<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden pt-4 pb-10 shadow-xl sm:rounded-lg">
                <div class="flex justify-center space-x-10">
                    <div class="justify-center">
                        <i class="fas fa-users text-5xl text-blue-600"></i>
                        <label class="mt-14 absolute -ml-10 font-bold">{{$funcionarios}}</label>
                    </div>
                    <div class="justify-center">
                        <i class="fas fa-dumpster text-5xl text-green-600"></i>
                        <label class="mt-14 absolute -ml-9 font-bold">{{$lojas}}</label>
                    </div>
                    <div class="justify-center">
                        <i class="fas fa-shopping-basket text-5xl text-gray-600"></i>
                        <label class="mt-14 absolute -ml-9 font-bold">{{$produtos}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>