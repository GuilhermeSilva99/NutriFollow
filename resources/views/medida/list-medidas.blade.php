@extends('home')
@section('content')
    <body class="antialiased">
        <div class="row card justify-content-center pt-4">
            <div class="col">
                <div class="card-header"><h1>Medidas</h1></div>
                <div class="card-body">                    
                    <button class="btn btn-sm btn-outline-secondary" type="button" id="button-addon1" data-bs-toggle="modal" data-bs-target="#modal-medida">Adicionar Medida</button>
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
                                    <th>{{date('d-m-y', strtotime($medida->data))}}</th>
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
                                            <button class="btn btn-sm btn-outline-secondary" type="button" id="button-addon1" data-bs-toggle="modal" data-bs-target="#modal-medida-edit-{{$medida->id}}">Editar</button>
                                            <form action="/nutricionista/paciente/deletar/medida/{{$id}}/{{$medida->id}}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-sm btn-outline-danger" type="submit" id="button-deletar">Deletar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Edit-->
                                <div class="modal fade" id="modal-medida-edit-{{$medida->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"><h4>Editar Medida</h4></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/nutricionista/paciente/editar/medida/{{$id}}/{{$medida->id}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="container ">
                                                        <div class="row justify-content-center">
                                                            <div class="mb-3 col">
                                                                <label for="altura" class="form-label">Altura</label>
                                                                <input type="text" class="form-control" id="altura" name="altura" required value="{{$medida->altura}}">
                                                            </div>
                                        
                                                            <div class="mb-3 col">
                                                                <label for="peso" class="form-label">peso</label>
                                                                <input type="text" class="form-control" id="peso" name="peso" required value="{{$medida->peso}}">
                                                            </div>
                                                        </div>    
                                                    </div>

                                                    <div class="container">
                                                        <div class="row justify-content-center">
                                                            <div class="mb-3 col">
                                                                <label for="peito" class="form-label">peito</label>
                                                                <input type="text" class="form-control" id="peito" name="peito" required value="{{$medida->peito}}">
                                                            </div>

                                                            <div class="mb-3 col">
                                                                <label for="cintura" class="form-label">cintura</label>
                                                                <input type="text" class="form-control" id="cintura" name="cintura" required value="{{$medida->cintura}}">
                                                            </div>

                                                            <div class="mb-3 col">
                                                                <label for="quadril" class="form-label">quadril</label>
                                                                <input type="text" class="form-control" id="quadril" name="quadril" required value="{{$medida->quadril}}">
                                                            </div>
                                                        </div>    
                                                    </div>

                                                    <div class="container">
                                                        <div class="row justify-content-center">
                                                            <div class="mb-3 col">
                                                                <label for="ombro" class="form-label">ombro</label>
                                                                <input type="text" class="form-control" id="ombro" name="ombro" required value="{{$medida->ombro}}">
                                                            </div>

                                                            <div class="mb-3 col">
                                                                <label for="biceps" class="form-label">biceps</label>
                                                                <input type="text" class="form-control" id="biceps" name="biceps" required value="{{$medida->biceps}}">
                                                            </div>
                                        
                                                            <div class="mb-3 col">
                                                                <label for="triceps" class="form-label">triceps</label>
                                                                <input type="text" class="form-control" id="triceps" name="triceps" required value="{{$medida->triceps}}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="container">
                                                        <div class="row justify-content-center">        
                                                            <div class="mb-3 col">
                                                                <label for="coxa" class="form-label">coxa</label>
                                                                <input type="text" class="form-control" id="coxa" name="coxa" required value="{{$medida->coxa}}">
                                                            </div>
                                        
                                                            <div class="mb-3 col">
                                                                <label for="panturrilha" class="form-label">panturrilha</label>
                                                                <input type="text" class="form-control" id="panturrilha" name="panturrilha" required value="{{$medida->panturrilha}}">
                                                            </div>

                                                            <div class="mb-3 col">
                                                                <label for="data" class="form-label">data</label>
                                                                <input type="date" class="form-control" id="data" name="data" value="{{$medida->data}}" required>
                                                            </div>
                                                        </div>
                                                    </div>       
                                                    <div class="container text-end">
                                                        <button class="btn btn-sm btn-outline-secondary" type="submit">Editar</button>
                                                    </div>      
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-medida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><h4>Cadastrar Medida</h4></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/nutricionista/paciente/cadastrar/medida/{{$id}}">
                        @csrf
                        <div class="container ">
                            <div class="row justify-content-center">
                                <div class="mb-3 col">
                                    <label for="altura" class="form-label">Altura</label>
                                    <input type="text" class="form-control" id="altura" name="altura" required>
                                </div>
            
                                <div class="mb-3 col">
                                    <label for="peso" class="form-label">peso</label>
                                    <input type="text" class="form-control" id="peso" name="peso" required>
                                </div>
                            </div>    
                        </div>

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="mb-3 col">
                                    <label for="peito" class="form-label">peito</label>
                                    <input type="text" class="form-control" id="peito" name="peito" required>
                                </div>

                                <div class="mb-3 col">
                                    <label for="cintura" class="form-label">cintura</label>
                                    <input type="text" class="form-control" id="cintura" name="cintura" required>
                                </div>

                                <div class="mb-3 col">
                                    <label for="quadril" class="form-label">quadril</label>
                                    <input type="text" class="form-control" id="quadril" name="quadril" required>
                                </div>
                            </div>    
                        </div>

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="mb-3 col">
                                    <label for="ombro" class="form-label">ombro</label>
                                    <input type="text" class="form-control" id="ombro" name="ombro" required>
                                </div>

                                <div class="mb-3 col">
                                    <label for="biceps" class="form-label">biceps</label>
                                    <input type="text" class="form-control" id="biceps" name="biceps" required>
                                </div>
            
                                <div class="mb-3 col">
                                    <label for="triceps" class="form-label">triceps</label>
                                    <input type="text" class="form-control" id="triceps" name="triceps" required>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row justify-content-center">        
                                <div class="mb-3 col">
                                    <label for="coxa" class="form-label">coxa</label>
                                    <input type="text" class="form-control" id="coxa" name="coxa" required>
                                </div>
            
                                <div class="mb-3 col">
                                    <label for="panturrilha" class="form-label">panturrilha</label>
                                    <input type="text" class="form-control" id="panturrilha" name="panturrilha" required>
                                </div>

                                <div class="mb-3 col">
                                    <label for="data" class="form-label">data</label>
                                    <input type="date" class="form-control" id="data" name="data" required>
                                </div>
                            </div>
                        </div>       
                        <div class="container text-end">
                            <button class="btn btn-sm btn-outline-secondary" type="submit">Adicionar</button>
                        </div>      
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

