<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard Admin - Lista de Nutricionistas') }}
        </h2>
        <a href="{{ route('admin.home') }}">Solicitações de cadastro </a>
        <a href="{{ route('nutricionistas.inativos.listar') }}">Nutricionistas inativos</a>
    </x-slot>
    <h1>Lista de Nutricionistas</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col" >Ação</th>
            </tr>
        </thead>
        @foreach ($nutricionistas as $nutricionista)
            <tbody>
                <tr>
                    <td>{{ $nutricionista->user->nome }}</td>
                    <td class="alinhar-esquerda">
                        <form action="/inativar/{{ $nutricionista->user->id }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="button-reprova" type="submit" dusk="desativar-button-{{$nutricionista->user->id}}">Desativar</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        @endforeach
    
    </table>

</x-app-layout>