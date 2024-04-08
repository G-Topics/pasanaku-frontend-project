@extends('admin.principal')
@section('admin')
    <div class="page-content">

        @if (isset($message))
            <tr>
                <div>{{ $message }}</div>
                
            </tr>
        @endif
        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="{{ route('registrar-partida') }}" class="card card-clickable">
                    <div class="card-body">
                        <i data-feather="plus" class="text-primary icon-xxl d-block mx-auto my-3"></i></i></button>
                    </div>
                </a>
            </div>
            @foreach ($partidas as $partida)
                <div class="col-md-4 mb-4">
                    <div class="card card-clickable">
                        <div class="card-body">
                            <h4 class="card-title">Partida: {{ $partida['nombre'] }}</h4>
                            <p class="card-text">Descripcion: {{ $partida['descripcion'] }}</p>
                            <p class="card-text">Fecha de Inicio: {{ $partida['fecha_inicio'] }}</p>
                            <div class="d-flex flex-row-reverse">
                        
                                <a href="{{ route('registrar-invitacion', ['id_partida' => $partida['id']]) }}" class="btn btn-icon border-0"><i data-feather="user-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
