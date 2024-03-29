@extends('admin.principal')
@section('admin')
    <div class="page-content">

        @if (isset($message) )
            <tr>
                <div>{{ $message }}</div>
            </tr>
        @endif
        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="{{ route('registrar-partida') }}" class="card card-clickable">
                    <div class="card-body">
                        <h5 class="card-title">Crear Partida</h5>
                    </div>
                </a>
            </div>
            @foreach($partidas as $partida)
            <div class="col-md-4 mb-4">
                <div class="card card-clickable">
                    <div class="card-body">
                        <h5 class="card-title">{{ $partida['nombre'] }}</h5>
                        <p class="card-text">{{ $partida['descripcion'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
