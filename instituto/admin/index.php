<?php
include('../app/config.php');
include('layout/parte1.php');
include('../app/controladores/cursos/cursosListadoControlador.php');
include('../app/controladores/matriculas/matriculasListadoControlador.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="container-fluid  ">
        <div class="container-fluid ">
            <div class="row ml-4">
                <h1>Bienvenido <?= $nombre_sesion_usuario; ?></h1>
            </div>
            <div class="row ml-4">
                <h3>Estos son los cursos que tenemos disponibles para ti:</h2>

            </div>
            <br>

            <div class="row ml-4">
                <?php foreach ($cursos as $curso) :
                    if ($curso['alumnoId'] == $id_sesion_usuario) {
                        $idCurso = $curso['idCurso']; ?>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?= $curso['descripcion']; ?></h3>
                                </div>
                                <div class="icon">
                                    <i class="fas"><i class="fa-solid fa-layer-group"></i></i>
                                </div>
                                <a href="<?= APP_URL; ?>admin/turnos/index.php?id=<?= $idCurso; ?>" class="small-box-footer">Seleccionar Horario <i class="fas fa-arrow-circle-right"></i></a>

                            </div>
                        </div>
                <?php
                    }

                endforeach; ?>
            </div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary ">
                            <div class="card-header">
                                <h1 class="">Cursos Matriculados</h1>

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
                                        foreach ($matriculas as $matricula) {
                                            if ($matricula['idAlumno'] == $id_sesion_usuario) {
                                                $idMatricula = $matricula['idMatricula'];
                                        ?>
                                                <tr>
                                                    <td><?= $contador++; ?></td>
                                                    <td><?= $matricula['descripcion']; ?></td>
                                                    <td><?= $matricula['cursoId']; ?></td>
                                                    <td><?= $matricula['turno']; ?></td>
                                                    <td><?= $matricula['horaInicio']; ?></td>
                                                    <td><?= $matricula['horaFin']; ?></td>
                                                    <td><?= $matricula['docente']; ?></td>


                                                    <td>
                                                        <center>
                                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                                <a href="#" class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $idMatricula; ?>);">
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
                                <form action="<?= APP_URL; ?>/app/controladores/matriculas/matriculasCreateControlador.php" method="POST">
                                    <input type="hidden" name="alumnoId" value="<?= $alumnoId; ?>">


                                  
                                </form>




                            </div>





                        </div>
                    </div>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

    </div>
</div>

<?php
include('layout/parte2.php');
include('../layout/mensajes.php');

?>

<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "Aún no registras matricula de asignaturas",
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