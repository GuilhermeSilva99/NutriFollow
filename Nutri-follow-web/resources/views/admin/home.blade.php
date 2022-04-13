<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard Admin') }}
        </h2>
        <a href="{{ route('nutricionistas.listar') }}">Nutricionistas cadastrados </a>
        <a href="{{ route('nutricionistas.inativos.listar') }}">Nutricionistas inativos</a>

    </x-slot>

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
                        <form action="{{ route('cadastro.ativar', $nutricionista->user->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="button-aprova" type="submit">Aprovar</button>
                        </form>
                    </td>
                    <td class="alinhar-esquerda">
                        <form action="{{ route('cadastro.recusar', $nutricionista->user->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="button-reprova" type="submit">Reprovar</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        @endforeach
    
    </table>

</x-app-layout>