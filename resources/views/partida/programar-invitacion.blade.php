<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Editar Invitación</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" enctype="multipart/form-data" method="POST" id="ModalForm">
                    {{ csrf_field() }}
                    <div class="col-md-12 mb-4">
                        <input type="hidden" id="Editarid" value="">
                        <input type="hidden" id="Editarfecha_inicio" value="">
                        <label for="establecer">Establecer</label>

                        <select name="establecer" id="establecer" class="form-select">
                            <option value="1">Programar Inicio con la fecha predeterminada</option>
                            <option value="2">Fecha Personalizada</option>
                            <option value="3">Programar Inicio ahora mismo</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="frecuencia">Fecha de Inicio</label>
                        <div id="my-datepicker"> </div>
                    </div>

                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</a>
                        <button type="button" id="saveModalButton" class="btn btn-primary programar-inicio">Establecer
                            Fecha de Inicio</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script type="module">
    $(function() {
        var calendar = $("#my-datepicker").flatpickr({
            inline: true,
            enableTime: true,
            "locale": "es",
        });


        var select = document.querySelector('#establecer'); 

        $('#editModal').on('shown.bs.modal', function() {
            var fechaInicio = new Date($("#Editarfecha_inicio").val());
            calendar.setDate(fechaInicio, true, "");
        });


        select.addEventListener('change', function() {
            var selectedValue = this.value;
            switch (selectedValue) {
                case '1':
                    var fechaInicio = new Date(document.getElementById("Editarfecha_inicio").value);
                    calendar.setDate(fechaInicio, true, "");
                    break;
                case '2':

                    break;
                case '3':
                    calendar.setDate(new Date(), true, "");
                    break;
                default:
                    break;
            }
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
            var userURL = "{{env('URL_BACK_API')}}"+'partidas/actualizar-estado/' + id;

            $.ajax({
                url: userURL,
                method: 'PUT',
                data: {
                    fecha_inicio: fechaFormateada,
                    id_estado: 2
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
            });

        });

    });
</script>
