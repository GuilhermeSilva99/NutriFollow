<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard Admin') }}
        </h2>
        <a href="{{ route('admin.home') }}" style="text-decoration:none"> <input disabled="disabled" type="button" class="button-selecao" value="Solicitações de cadastro"> </a>
        <a href="{{ route('nutricionistas.listar') }}" style="text-decoration:none"> <input class="button-selecao" type="button" value="Nutricionistas cadastrados"> </a>
        <a href="{{ route('nutricionistas.inativos.listar') }}" style="text-decoration:none"> <input type="button" class="button-selecao" value="Nutricionistas inativos"> </a>

    </x-slot>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col-6">Nome</th>
                    <th scope="col-3">Ações</th>
                    <th scope="col-3"></th>
                </tr>
            </thead>
            @foreach ($nutricionistas as $nutricionista)
            <tbody>
                <tr>
                    <div class="row">
                        <div class="col-6">
                            <td data-bs-toggle="modal" data-bs-target="#modal-nutricionista-{{$nutricionista->id}}">{{ $nutricionista->user->nome }}

                            </td>
                        </div>
                        <div class="col-3">
                            <td>
                                <form action="{{ route('cadastro.ativar', $nutricionista->user->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn btn-success" type="submit" dusk="aprovar-button-{{$nutricionista->user->id}}">Aprovar</button>
                                </form>
                            </td>
                        </div>
                        <div class="col-3">
                            <td>
                                <form action="{{ route('cadastro.recusar', $nutricionista->user->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Reprovar</button>
                                </form>
                            </td>
                        </div>
                    </div>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
    @foreach ($nutricionistas as $nutricionista)
    <div class="modal fade" id="modal-nutricionista-{{$nutricionista->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$nutricionista->user->name}}</h5>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">CPF</th>
                                <th scope="col">Telefone 1</th>
                                <th scope="col">Telefone 2</th>
                                <th scope="col">CRN</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$nutricionista->user->email}}</td>
                                <td>{{$nutricionista->user->cpf}}</td>
                                <td>{{$nutricionista->user->telefone_1}}</td>
                                <td>{{$nutricionista->user->telefone_2}}</td>
                                <td>{{$nutricionista->crn}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>