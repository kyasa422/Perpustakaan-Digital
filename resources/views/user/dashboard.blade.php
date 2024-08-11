<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    
    <a href="{{ route('books.index') }}" class="bg-primary hover:bg-blue-400 btn text-white mb-10 border-0 m-10">Daftar Buku</a>

</x-app-layout>
