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
                Registrar Partida
            </h1>

            <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{ url('/') }}">
                @csrf
                <div class="form-group">
                    <div class="row g-3 mt-4">
                        <div class="col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required="">
                        </div>

                        <div class="col-md-6">
                            <label for="frecuencia">Frecuencia</label>
                            <select name="frecuencia" id="frecuencia" class="form-select">
                                <option value="Mensual">Mensual</option>
                                <option value="Semanal">Semanal</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input id="fecha_inicio" name="fecha_inicio" class="form-control" required="">
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" required="">
                        </div>

                        <div class="col-md-4 mt-4">
                            <label for="monto">Monto</label>
                            <input type="text" id="monto" name="monto" class="form-control" required="">
                        </div>

                        <div class="col-md-2 mt-4">
                            <label for="id_moneda"> SM</label>
                            <select name="id_moneda" id="id_moneda" class="form-select">
                                @foreach ($monedas as $moneda)
                                <option value="{{ $moneda['id'] }}" @selected(old('id_moneda')==$moneda['id'])>
                                    {{ $moneda['s_monetario'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-md-6 mt-4">
                            <label for="capacidad">Capacidad de participantes</label>
                            <input type="number" id="capacidad" name="capacidad" class="form-control" required="">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="multa">Multa</label>
                            <input type="double" id="multa" name="multa" class="form-control" required="">
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="duracion_oferta">Duracion de la puja(horas)</label>
                            <input type="number" id="duracion_oferta" name="duracion_oferta" class="form-control" required="">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="dias_tolerancia_pago">Dias de tolerancia de pago</label>
                            <input type="number" id="dias_tolerancia_pago" name="dias_tolerancia_pago" class="form-control" required="">
                        </div>
                    </div>


                    <div class="d-flex justify-content-around mt-4">

                        <a href="{{ route('/') }}" class="btn btn-secondary">Atras</a>
                        <button type="submit" class="btn btn-primary ">Crear</button>

                    </div>
            </form>
        </div>
    </div>


</div>


<script type="module">
    $(function() {
        var calendar = $("#fecha_inicio").flatpickr({
            enableTime: true,
            "locale": "es",
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.programar-inicio', function() {
            var id = document.getElementById("Editarid").value;
            var fechaSeleccionada = calendar.selectedDates[0];


            var fechaFormateada = fechaSeleccionada.getFullYear() + '-' +
                ('0' + (fechaSeleccionada.getMonth() + 1)).slice(-2) + '-' +
                ('0' + fechaSeleccionada.getDate()).slice(-2) + ' ' +
                ('0' + fechaSeleccionada.getHours()).slice(-2) + ':' +
                ('0' + fechaSeleccionada.getMinutes()).slice(-2) + ':' +
                ('0' + fechaSeleccionada.getSeconds()).slice(-2);

            console.log(id_partida);
            var userURL = "{{env('URL_BACK_API')}}" + 'partidas/actualizar-estado/' + id;

            $.ajax({
                url: userURL,
                method: 'PUT',
                data: {
                    fecha_inicio: fechaFormateada,
                    id_estado: 2

                },
                success: function(response) {
                    console.log(response);
                    // Aquí puedes actualizar los datos de la tabla
                    location.reload();
                },
            });

        });

    });
</script>
@endsection