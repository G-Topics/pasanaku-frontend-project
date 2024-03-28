@extends('admin.principal')
@section('admin')
    <div class="page-content">

        @if (isset($message) )
            <tr>
                <div>{{ $message }}</div>
            </tr>
        @endif
        <a href="{{ route('registrar-partida') }}" class="button">Crear Partida</a>
    </div>
@endsection
