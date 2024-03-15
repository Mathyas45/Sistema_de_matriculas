<?php
// initializ shopping cart class
// include 'La-carta.php';
include('../../app/config.php');
include('../layout/parte1.php');
include('../../app/controladores/carrito/carritosListadoControlador.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="container-fluid">
        <br>


        <br>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card card-outline card-primary ">
                    <div class="card-header">
                        <h1 class="ml-4">Confirmación de asignaturas</h1>

                    </div>
                </div>
                <div class="card card-outline card-primary">

                    <div class="card-body">
                        <table id="example1" class="table table-resposive table-striped table-bordered table-hover">

                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Curso</th>
                                    <th>ID del Curso</th>
                                    <th>turno</th>
                                    <th>Hora de inicio</th>
                                    <th>Hasta</th>
                                    <th>Docente</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contador = 1;
                                foreach ($carritos as $carrito) {
                                    if ($carrito['idAlumno'] == $id_sesion_usuario) {
                                        $idCarrito = $carrito['idCarrito'];
                                        $alumnoId = $carrito['alumnoId'];
                                ?>
                                        <tr>
                                            <td><?= $contador++; ?></td>
                                            <td><?= $carrito['descripcion']; ?></td>
                                            <td><?= $carrito['cursoId']; ?></td>
                                            <td><?= $carrito['turno']; ?></td>
                                            <td><?= $carrito['horaInicio']; ?></td>
                                            <td><?= $carrito['horaFin']; ?></td>
                                            <td><?= $carrito['docente']; ?></td>


                                            <td>
                                                <center>
                                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                        <a href="#" class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $idCarrito; ?>);">
                                                            <i class="bi bi-trash3-fill"></i> Eliminar
                                                        </a>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>

                        </table>
                        <br>
                        <form id="formSeleccion" action="<?= APP_URL; ?>/app/controladores/matriculas/matriculasCreateControlador.php" method="POST">
                            <input type="hidden" name="alumnoId" value="<?= $alumnoId; ?>">


                            <div class=" text-center">
                                <button type="button" class="btn btn-primary btn-block" onclick="confirmarSeleccion()">Matricular Asignaturas <i class="fas fa-arrow-circle-right"></i></button>

                            </div>
                        </form>




                    </div>



                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>




<?php
include('../layout/parte2.php');
include('../../layout/mensajes.php');

?>


<script>
    function confirmarSeleccion() {
        Swal.fire({
            title: "¿Seguro que desea matricularse a estos cursos y horarios?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma la acción, enviar el formulario
                document.getElementById('formSeleccion').submit();
            }
        });
    }


    function confirmarEliminacion(idCarrito) {
        Swal.fire({
            title: "¿Seguro que desea eliminar?",
            icon: "question",
            iconHtml: "?",
            cancelButtonText: "No",
            confirmButtonText: "Sí",
            showCancelButton: true,
            showCloseButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirecciona al archivo que maneja la eliminación
                window.location.href = "delete.php?idCarrito=" + idCarrito;
            }
        });
        return false; // Evita el comportamiento predeterminado del enlace
    }
    $(function() {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "Aún no agregaste asignaturas",
                "info": "Mostrando _START_ a _END_ de _TOTAL_  Asignaturas",
                "infoEmpty": "Mostrando 0 a 0 de 0  Estudiantes",
                "infoFiltered": "(Filtrado de _MAX_ total  Asignaturas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_  Asignaturas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "searching": false, // Desactivar la funcionalidad de búsqueda
        });
    });
</script>