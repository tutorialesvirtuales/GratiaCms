<?php echo $this->session->flashdata('mensaje') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>Usuarios del sistema</span>
                <span>
                    <a href="<?php echo $this->url ?>crear" class="btn btn-success btn-sm tooltips" data-original-title="Nuevo registro">
                        Nuevo registro <i class="fa fa-plus-circle"></i></a>
                </span>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Display</th>
                                <th>Observación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $datas = $this->Modelo->get_all() ?>
                            <?php foreach ($datas as $data): ?>
                                <tr>
                                    <td><?php echo $data->nombre ?></td>
                                    <td><?php echo $data->nombre_a_mostrar ?></td>
                                    <td><?php echo $data->observacion ?></td>
                                    <td>
                                        <a href="<?php echo $this->url . 'actualizar/' . $data->id ?>" class="btn btn-warning btn-sm tooltips" data-original-title="Editar este registro">
                                            <i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        GratiaCms.datatables();
    });
</script>

