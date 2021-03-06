@extends('layouts.app')

@section('content')

<div class="card-body">
    <a class="btn btn-primary float-right my-3" href="{{ route('servicios.create')}}" role="button"><span data-feather="user-plus"></span> Agregar</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="form-group">
        <input type="text" class="form-control pull-right" style="width:100%; margin-top:3rem;" id="search" placeholder="Escribe para buscar">
    </div>

    <table class="table-bordered table table-responsive-lg" id="mytable" cellspacing="0">
        <thead class="table-light">
            <tr role="row">
                <th scope="col">Opciones</th>
                <th scope="col">Cliente</th>
                <th scope="col">Dispositivo</th>
                <th scope="col">Costo estimado</th>
                <th scope="col">Personal</th>
                <th scope="col">Fecha de Asignación</th>
                <th scope="col">Fecha de Entrega</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($servicios as $servicio)
                <tr>
                    <th scope="row">
                        <div class="row clearfix">
                            <button type="button" class="btn">
                                <a class="btn btn-warning" href="{{ route('servicios.show', $servicio->id) }}" role="button"><span data-feather="eye"></span></a>
                            </button>
                        </div>

                    </th>
                    <td>{{ $servicio->ordenServicio->cliente->nombre_cliente}} {{ $servicio->ordenServicio->cliente->apellido_paterno}}</td>
                    <td>{{ $servicio->dispositivo->numSerie}}</td>
                    <td>{{ $servicio->ordenServicio->costo_estimado }}</td>
                    <td>{{ $servicio->seguimientoOrden->usuario->name }}</td>
                    <td>{{ $servicio->seguimientoOrden->fecha_asignacion->format('d-m-Y') }}</td>
                    <td>{{ $servicio->seguimientoOrden->fecha_entrega->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
 $(document).ready(function(){
     $("#search").keyup(function(){
         _this = this;
         $.each($("#mytable tbody tr"), function() {
             if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
             $(this).hide();
             else
             $(this).show();
             });
             });
             });
</script>

@endsection