<?php
include('../../app/config.php');
include('../layout/parte1.php');
$cursoId = $_GET['id'];
include('../../app/controladores/secciones/seccionesListadoControlador.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="container-fluid  ">
        <div class="container-fluid ">
            <div class="row ml-4">
                <?php if (!empty($secciones)) { ?>
                    <h1>Secciones disponibles del curso: <b><?= $secciones[0]['descripcion']; ?></b> </h1>
                <?php } else { ?>
                    <h1>No hay secciones disponibles para este curso</h1>
                <?php } ?>
                <br>
            </div>
            <br>

            <div class="row ml-4">
                <!-- $seccion = "no hay horarios disponibles" -->
                <?php foreach ($secciones as $seccion) :
                    $idSeccion = $seccion['idSeccion'];
                    $alumnoId = $seccion['alumnoId'];
                    $cursoId = $seccion['cursoId'];
                    $aulaId = $seccion['aulaId'];
                    $turno = $seccion['turno'];
                    $horaInicio = $seccion['horaInicio'];
                    $horaFin = $seccion['horaFin'];
                    $docente = $seccion['docente'];
                    $formularioId = 'formSeleccion_' . $idSeccion; // ID único para cada formulario
                ?>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3 class="text-dark">Turno: <?= $turno; ?></h3>
                                <h4>Hora de Inicio: <?= $horaInicio; ?></h4>
                                <h4>Hasta: <?= $horaFin; ?></h4>
                                <h4 class="text-dark">Docente: <?= $docente; ?></h4>
                            </div>
                            <div class="icon">
                                <i class="fas"><i class="fa-solid fa-layer-group"></i></i>
                            </div>
                            <!-- Formulario para agregar la sección al carrito -->
                            <form id="<?= $formularioId ?>" action="<?= APP_URL; ?>/app/controladores/carrito/carritosCreateControlador.php" method="POST">
                                <input type="hidden" name="alumnoId" value="<?= $alumnoId; ?>">
                                <input type="hidden" name="cursoId" value="<?= $cursoId; ?>">
                                <input type="hidden" name="aulaId" value="<?= $aulaId; ?>">
                                <input type="hidden" name="idSeccion" value="<?= $idSeccion; ?>">

                                <div class="text-center">
                                    <button type="button" class="btn btn-primary btn-block" onclick="confirmarSeleccion('<?= $formularioId ?>')">Seleccionar <i class="fas fa-arrow-circle-right"></i></button>
                                </div>
                            </form>
                        </div>
            </div>
        <?php endforeach; ?>
        </div>

        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

</div>

<?php
include('../layout/parte2.php');
include('../../layout/mensajes.php');

?>

<script>
    function confirmarSeleccion(formularioId) {
        Swal.fire({
            title: "¿Seguro que desea seleccionar este turno y horario?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma la acción, enviar el formulario específico
                document.getElementById(formularioId).submit();
            }
        });
    }
</script>