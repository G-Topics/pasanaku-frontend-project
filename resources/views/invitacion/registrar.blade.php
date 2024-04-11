@extends('admin.principal')
@section('admin')
    @if (isset($message))
        <tr>
            <div>{{ $message }}</div>
        </tr>
    @endif

    <div class="page-content">
        <div class="container">

            <div class="container">
                <h1 class=" text-center font-weight-bold mt-5">
                    Registrar Invitacion
                    @if ($invitaciones != '[]')
                        <tr>

                        </tr>
                    @endif
                </h1>
                <form name="add-blog-post-form" id="add-blog-post-form" method="post"
                    action="{{ url('registrar-invitacion', ['id_partida' => $id_partida]) }}">
                    @csrf
                    <div class="form-group">
                        <div class="row g-3 mt-4">
                            <input id="id_partida" type="hidden" name="id_partida" value={{ $id_partida }}>
                            <input name="id_participante" type="hidden" value={{ $id_participante }}>
                            <div class="col-md-4 mt-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required="">
                            </div>

                            <div class="col-md-4 mt-4">
                                <label for="telefono">Celular</label>
                                <input type="tel" id="telefono" name="telefono" class="form-control"
                                    required="telefono">
                            </div>

                            <div class="col-md-4 mt-4">
                                <label for="email">Correo Electronico</label>
                                <input type="text" id="email" name="email" class="form-control" required="email">
                            </div>


                        </div>


                        <div class="d-flex justify-content-around mt-4">

                            <button class="btn btn-primary">Añadir</button>
                            <a href="javascript:void(0)" data-id="{{ $id_partida }}" class="btn btn-primary send-todos"
                                id={{ $id_partida }}>Enviar todos</i>
                            </a>
                            <a href="javascript:void(0)" data-id="{{ $id_partida }}"
                                class="btn btn-secondary delete-invitaciones" id={{ $id_partida }}>
                                Eliminar todos</a>

                        </div>
                </form>

                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="container">
                                <div class="table-responsive">
                                    <table id="dataTableExample" class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Telefono</th>
                                                <th>Correo</th>
                                                <th>Estado</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($invitaciones as $invitacion)
                                                <tr>
                                                    <td>{{ $invitacion['nombre'] }}</td>
                                                    <td>{{ $invitacion['telefono'] }}</td>
                                                    <td>{{ $invitacion['email'] }}</td>
                                                    <td>{{ $invitacion['nombre_estado'] }}</td>

                                                    <td>
                                                        <div class="d-flex flex-row justify-content-around">
                                                                <a class="btn btn-primary btn-icon border-0 show_user_details"
                                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                                    data-id="{{ $invitacion['id'] }}"
                                                                    data-id_partida="{{ $id_partida }}"
                                                                    data-nombre="{{ $invitacion['nombre'] }}"
                                                                    data-telefono="{{ $invitacion['telefono'] }}"
                                                                    data-email="{{ $invitacion['email'] }}" href="#">
                                                                    <i data-feather="edit-2"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    data-id="{{ $invitacion['id'] }}"
                                                                    class="btn btn-primary btn-icon border-0 delete-invitacion"
                                                                    id={{ $invitacion['id'] }}><i
                                                                        data-feather="trash-2"></i></a>

                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-primary btn-icon border-0 send"
                                                                    data-id="{{ $invitacion['id'] }}"
                                                                    id={{ $invitacion['id'] }}><i data-feather="mail"></i>
                                                                </a>
                                                            </div>
                                                    </td>
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
        </div>


    </div>
    @include('invitacion.editar')
    <script type="module">
        //type="module" is the important part
        $(function() {

            $(document).ready(function() {
                $("#abrirAlerta").click(function() {
                    alert('jquery ok');
                });

            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function anadirInvitacion() {
                $.ajax({
                    type: "POST",
                    url: 'http://3.137.171.204/api/invitaciones/',
                    data: '_method=DELETE&_token=' + _token,
                    success: function(result) {
                        console.log(result);

                    }
                });
            };
            $(document).on('click', '.delete-invitacion', function() {
                var id = $(this).data('id');
                var userURL = 'http://3.137.171.204/api/invitaciones/' + id;
                var trObj = $(this);
                var id_partida = $("#id_partida").val();
                if (confirm("¿Está seguro de eliminar la invitación?")) {
                    $.ajax({
                        url: userURL,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            // Aquí puedes actualizar los datos de la tabla
                            window.location.href =
                                "http://localhost:8001/registrar-invitacion/" + id_partida;
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Error en la solicitud AJAX:", textStatus, errorThrown);

                        }
                    });
                }
            });
            $(document).on('click', '.delete-invitaciones', function() {
                var id = $(this).data('id');
                var trObj = $(this);
                var id_partida = $("#id_partida").val();
                var userURL = 'http://3.137.171.204/api/invitaciones/delete-partida/' + id_partida;
                if (confirm("¿Está seguro de eliminar las invitaciones No enviadas y En espera?")) {
                    $.ajax({
                        url: userURL,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            // Aquí puedes actualizar los datos de la tabla
                            window.location.href =
                                "http://localhost:8001/registrar-invitacion/" + id_partida;
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Error en la solicitud AJAX:", textStatus, errorThrown);

                        }
                    });
                }
            });
            $(document).on('click', '.show_user_details', function(ele) {

                var id = $(this).data('id');
                var id_partida = $(this).data('id_partida');
                var nombre = $(this).data('nombre');
                var telefono = $(this).data('telefono');
                var email = $(this).data('email');

                $('#Editarid_partida').val(id_partida);
                $('#Editarid').val(id);
                $('#Editarnombre').val(nombre);
                $('#Editartelefono').val(telefono);
                $('#Editaremail').val(email);
                $("#saveModalButton").attr('href', window.location.href + '/update/' + id);
            });
            $(document).on('click', '.send', function() {

                var id = $(this).data('id');
                console.log(id);
                var userURL = 'http://3.137.171.204/api/invitaciones/send/' + id;
                var trObj = $(this);
                var id_partida = $("#id_partida").val();

                $.ajax({
                    url: userURL,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        // Aquí puedes actualizar los datos de la tabla
                        window.location.href =
                            "http://localhost:8001/registrar-invitacion/" + id_partida;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error en la solicitud AJAX:", textStatus, errorThrown);

                    }
                });

            });
            $(document).on('click', '.send-todos', function() {

                var id_partida = $("#id_partida").val();
                console.log(id_partida);
                var userURL = 'http://3.137.171.204/api/invitaciones/send-todos/' + id_partida;
                var trObj = $(this);


                $.ajax({
                    url: userURL,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        // Aquí puedes actualizar los datos de la tabla
                        window.location.href =
                            "http://localhost:8001/registrar-invitacion/" + id_partida;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error en la solicitud AJAX:", textStatus, errorThrown);

                    }
                });

            });
        });
    </script>
@endsection
