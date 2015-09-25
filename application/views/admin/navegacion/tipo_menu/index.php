<?php echo $this->session->flashdata('mensaje') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
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
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $datas = $this->Modelo->get_all() ?>
                            <?php foreach ($datas as $data): ?>
                                <tr>
                                    <td><?php echo $data->descripcion ?></td>
                                    <td>
                                        <a href="<?php echo $this->url . 'actualizar/' . $data->id ?>" class="btn btn-warning btn-sm tooltips" data-original-title="Editar este registro">
                                            <i class="fa fa-edit"></i></a>
                                        <a href="<?php echo $this->url . 'eliminar/' . $data->id ?>" class="btn btn-danger btn-sm tooltips eliminar" data-original-title="Eliminar este registro">
                                            <i class="fa fa-trash-o"></i></a>
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

