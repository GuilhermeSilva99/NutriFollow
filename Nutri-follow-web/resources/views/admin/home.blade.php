<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <table>
        @foreach ($nutricionistas as $nutricionista)
            <li> {{ $nutricionista->user->nome }}</li>
        @endforeach

    </table>
    
</x-app-layout>