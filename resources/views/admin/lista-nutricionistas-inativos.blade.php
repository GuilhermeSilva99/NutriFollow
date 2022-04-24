<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard Admin - Lista de Nutricionistas Inativos') }}
        </h2>
        <a href="{{ route('admin.home') }}">Solicitações de cadastro </a>
        <a href="{{ route('nutricionistas.listar') }}">Nutricionistas cadastrados</a>
    </x-slot>

    <h1>Lista de Nutricionistas Inativos</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col" >Ação</th>
            </tr>
        </thead>
        @foreach ($users as $user)
            <tbody>
                <tr>
                    <td>{{ $user->nome }}</td>
                    <td class="alinhar-esquerda">
                        <form action="{{ route('nutricionista.reativar', $user->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <button class="button-reativar" type="submit"  dusk="reativar-button-{{$user->id}}">Reativar</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        @endforeach
    
    </table>

</x-app-layout>