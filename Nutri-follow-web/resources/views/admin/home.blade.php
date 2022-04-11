<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width:40%">Nome</th>
                    <th scope="col" style="width:30%">CRN</th>
                    <th scope="col" style="width:30%; text-align: center">Ações</th>
                </tr>
            </thead>
            @foreach ($nutricionistas as $nutricionista)
                <tbody>
                    <tr>
                        <td type="button" data-bs-toggle="modal" data-bs-target="#modal-nutricionista-{{$nutricionista->id}}">{{ $nutricionista->user->nome }}</td>
                        <td type="button" data-bs-toggle="modal" data-bs-target="#modal-nutricionista-{{$nutricionista->id}}">{{ $nutricionista->crn }}</td>
                        <td class="row" style="text-align: center; margin: 0px">
                            <div class="col-md-6">
                                <form action="{{ route('cadastro.ativar', $nutricionista->user->id) }}" method="POST">
                                    @method('PUT')  
                                    @csrf
                                    <button class="button-aprova" type="submit">Aprovar</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('cadastro.recusar', $nutricionista->user->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="button-reprova" type="submit">Reprovar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    @foreach ($nutricionistas as $nutricionista)
        <div class="modal fade" id="modal-nutricionista-{{$nutricionista->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$nutricionista->user->email}}</td>
                                    <td>{{$nutricionista->user->cpf}}</td>
                                    <td>{{$nutricionista->user->telefone_1}}</td>
                                    <td>{{$nutricionista->user->telefone_2}}</td>
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