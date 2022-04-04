<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Ação</th>
                <th scope="col">Aprovado</th>
                </tr>
        </thead>
        @foreach ($nutricionistas as $nutricionista)
            <tbody>
                <tr>
                    <td>{{ $nutricionista->user->nome }}</td>
                    <td>
                        <form action="{{ route('cadastro.ativar', $nutricionista->user->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button type="submit">Aprovar</button>
                        </form>
                
                        <form action="{{ route('cadastro.recusar', $nutricionista->user->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Reprovar</button>
                        </form>
                    </td>

                    <td>{{ $nutricionista->user->cadastro_aprovado }}</td>
                </tr>
            </tbody>
        @endforeach
    
    </table>

</x-app-layout>