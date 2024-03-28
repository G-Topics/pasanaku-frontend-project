@extends('admin.principal')
@section('admin')

    @if (isset($message) != null)
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

                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{ url('/partida/registrar') }}">
                    @csrf
                    <div class="form-group">
                        <div class="row g-3 mt-4">
                            <div class="col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required="">
                            </div>

                            <div class="col-md-6">
                                <label for="frecuencia">Frecuencia</label>
                                <select name="frecuencia" id="frecuencia" class="form-control">
                                    <option value="Mensual">Mensual</option>
                                    <option value="Semanal">Semanal</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-4">
                                <label for="fecha_inicio">Fecha de Inicio</label>
                                <input type="date" id="c" name="fecha_inicio" class="form-control"
                                    required="">
                            </div>

                            <div class="col-md-6 mt-4">
                                <label for="descripcion">Descripcion</label>
                                <input type="text" id="descripcion" name="descripcion" class="form-control"
                                    required="">
                            </div>

                            <div class="col-md-5 mt-4">
                                <label for="monto">Monto</label>
                                <input type="text" id="monto" name="monto" class="form-control" required="">
                            </div>

                            <div class="col-md-1 mt-4">
                                <label for="id_moneda"> SM</label>
                                <select name="id_moneda" id="id_moneda" class="form-control">
                                    <option value="1">BOB</option>
                                    <option value="2">$</option>
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


                        </div>


                        <div class="d-grid gap-2 col-4 mx-auto mt-5">
                            <div class="col">
                                <button type="button" class="btn btn-danger ml-3 mr-20">Cancelar</button>
                                <button type="submit" class="btn btn-success ml-5">Crear</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>


    </div>
@endsection
