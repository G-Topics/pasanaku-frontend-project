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

                <form action="" method="POST" enctype="multipart/form-data" method="POST" id="ModalForm">
                    {{ csrf_field() }}
                    <input type="hidden" id="Editarid" value="">
                    <input type="hidden" id="Editarid_partida" value="">
                    <div class="form-group">
                        <label for="Editarnombre">Nombre</label>
                        <input type="text" name="Editarnombre" class="form-control" id="Editarnombre"
                            placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="Editartelefono">Telefono</label>
                        <input type="tel" name="Editartelefono" class="form-control" id="Editartelefono"
                            placeholder="+44" required>
                    </div>
                    <div class="form-group">
                        <label for="Editaremail">Correo</label>
                        <input type="email" name="Editaremail" class="form-control" id="Editaremail"
                            placeholder="name@example.com" required>
                    </div>

                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        <button type="button" id="saveModalButton" class="btn btn-primary actualizar-invitacion">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="module">
    //type="module" is the important part
    $(function() {

        $(document).ready(function() {

        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.actualizar-invitacion', function() {
            var id = document.getElementById("Editarid").value;
            var id_partida = document.getElementById("Editarid_partida").value;
            var nombre = document.getElementById("Editarnombre").value;
            var telefono = document.getElementById("Editartelefono").value;
            var email = document.getElementById("Editaremail").value;

            console.log(id_partida);
            var userURL = 'http://127.0.0.1:8000/api/invitaciones/' + id;
            
            

            $.ajax({
                url: userURL,
                method: 'PUT',
                data: {
                    nombre : nombre,
                    telefono: telefono,
                    email : email
                },
                success: function(response) {
                            console.log(response);
                            // Aquí puedes actualizar los datos de la tabla
                            window.location.href =
                                "http://localhost:8001/registrar-invitacion/" + id_partida;
                        },   
            });

        });



    });
</script>
