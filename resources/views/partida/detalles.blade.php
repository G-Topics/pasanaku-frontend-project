@extends('admin.principal')
@section('admin')
    <div class="page-content">


        <div class="container">
            <h1 class=" text-center font-weight-bold mt-5">
                {{ $detalles['nombre'] }}

            </h1>

            <div class="page-content">
                <div class="row">
                    <div class="col-md-4 grid-margin stretch-card">
                        <input id="id_partida" type="hidden" name="id_partida" value={{ $detalles['id'] }}>
                        <ul>

                            <ul>
                                <li class="mt-3">
                                    <div class="ml-4">
                                        <h4>Fecha de Inicio: <span id="fecha_inicio" class="custom-span">{{ $detalles['fecha_inicio'] }}</span>
                                        </h4>
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <div class="ml-4">
                                        <h4>Frecuencia: <span class="custom-span">{{ $detalles['frecuencia'] }}</span></h4>
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <div class="ml-4">
                                        <h4>Monto: <span
                                                class="custom-span">{{ $detalles['monto'] . ' ' . $detalles['s_monetario'] }}</span>
                                        </h4>
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <div class="ml-4">
                                        <h4>Multa: <span
                                                class="custom-span">{{ $detalles['multa'] . ' ' . $detalles['s_monetario'] }}</span>
                                        </h4>
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <div class="ml-4">
                                        <h4>Capacidad: <span class="custom-span">{{ $detalles['capacidad'] }}</span></h4>
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <div class="ml-4">
                                        <h4>Moneda: <span class="custom-span">{{ $detalles['moneda'] }}</span></h4>
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <div class="ml-4">
                                        <h4>Estado: <span class="custom-span">{{ $detalles['estado'] }}</span></h4>
                                    </div>
                                </li>
                            </ul>
                        </ul>


                    </div>

                    <div class="col-md-8 grid-margin stretch-card">
                        <div class="container">
                            <div class="table-responsive">
                                <table id="tableParticipantes" class="table">
                                    <thead>
                                        <tr>
                                            <th>Rol</th>
                                            <th>Nombre</th>
                                            <th>Telefono</th>
                                            <th>Correo</th>
                                            <th>Fecha de Ingreso</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($detalles['participantes'] as $participante)
                                            <tr>
                                                <td>{{ $participante['rol'] }}</td>
                                                <td>{{ $participante['nombre'] }}</td>
                                                <td>{{ $participante['telefono'] }}</td>
                                                <td>{{ $participante['email'] }}</td>
                                                <td>{{ date('Y-m-d', strtotime($participante['fecha_ingreso'])) }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="d-flex justify-content-around mt-4">

            <a href="{{ route('/') }}" class="btn btn-secondary">Cancelar</a>
            <a class="btn btn-primary establecer-inicio" data-bs-toggle="modal"
                data-bs-target="#editModal"data-id="{{ $detalles['fecha_inicio'] }}">
                Programar Inicio
            </a>

        </div>


    </div>
    @include('partida.programar-invitacion')

    <script type="module">
        //type="module" is the important part
        $(function() {


            $(document).ready(function() {
                $('#tableParticipantes').DataTable({
                    paging: false,
                    searching: false
                });
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).on('click', '.establecer-inicio', function(ele) {
                var fecha_inicio = document.getElementById("fecha_inicio").innerText;
                var id = document.getElementById("id_partida").value;
                
                $('#Editarid').val(id);
                $('#Editarfecha_inicio').val(fecha_inicio);
                console.log(id+' ' +fecha_inicio);
            });


        });
    </script>
@endsection
