@extends('home')
@section('content')
    <body class="antialiased">
        <div class="row card justify-content-center pt-4">
            <div class="col">
                <div class="card-header"><h1>Medidas</h1></div>
                <div class="card-body">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='#'">Adicionar Medida</button>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">data</th>
                                <th scope="col">peso</th>
                                <th scope="col">altura</th>
                                <th scope="col">ombro</th>
                                <th scope="col">biceps</th>
                                <th scope="col">triceps</th>
                                <th scope="col">peito</th>
                                <th scope="col">cintura</th>
                                <th scope="col">quadril</th>
                                <th scope="col">coxa</th>
                                <th scope="col">panturrilha</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medidas as $medida)
                                <tr>
                                    <th>{{$medida->data}}</th>
                                    <td>{{$medida->peso}}</td>
                                    <td>{{$medida->altura}}</td>
                                    <th>{{$medida->ombro}}</th>
                                    <td>{{$medida->biceps}}</td>
                                    <td>{{$medida->triceps}}</td>
                                    <th>{{$medida->peito}}</th>
                                    <td>{{$medida->cintura}}</td>
                                    <td>{{$medida->quadril}}</td>
                                    <th>{{$medida->coxa}}</th>
                                    <td>{{$medida->panturrilha}}</td>
                                    <td>
                                        <div style="display: flex;">
                                            <form action="#" method="get" style="margin-right: 10px">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-secondary" type="submit" id="button-relatorios">Editar</button>
                                            </form>
                                            <form action="#" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-sm btn-outline-danger" type="submit" id="button-relatorios">Deletar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {!! $medidas->links() !!}
        </div>
    </body>
@endsection