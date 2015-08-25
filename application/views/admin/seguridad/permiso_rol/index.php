<?php echo $this->session->flashdata('mensaje') ?>
<?php 
$rols = $this->Rol_model->get_all();
$permisos = $this->Permiso_model->order_by('nombre','asc')->get_all();
$permiso_rol = $this->Modelo->getAll();
?>
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
                                <th scope="col" style="height:130px">Permiso</th>
                                <?php foreach ($rols as $rol): ?>
                                    <th style="width:40px !important">
                            <p style="-webkit-transform: rotate(-90deg);-moz-transform: rotate(-90deg); width:40px !important"><?php echo $rol->descripcion ?></p>
                            </th>
                        <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($permisos as $permiso) : $permiso_r = isset($permiso_rol[$permiso->id]) ? $permiso_rol[$permiso->id] : '' ?>
                                <tr>
                                    <td><?php echo $permiso->nombre_a_mostrar ?></td>
                                    <?php foreach ($rols as $rol): ?>
                                        <td>
                                            <input 
                                                type="checkbox" 
                                                class="permiso_rol" 
                                                name="permiso_rol[]" 
                                                permiso_id="<?php echo $permiso->id ?>" 
                                                value="<?php echo $rol->id ?>" 
                                                <?php echo is_array($permiso_r) ? (isset($permiso_r[$rol->id]) ? ($permiso_r[$rol->id] ? 'checked' : '') : '') : '' ?>/></td>
                                        <?php endforeach; ?>
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
        GratiaCms.datatablesEsp();
        $('.permiso_rol').on('change', function () {
            var data;
            if ($(this).is(':checked')) {
                data = {
                    permiso_id: $(this).attr('permiso_id'),
                    rol_id: $(this).val(),
                    estado: 1,
                    '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
                };
            } else {
                data = {
                    permiso_id: $(this).attr('permiso_id'),
                    rol_id: $(this).val(),
                    estado: 0,
                    '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
                };
            }
            GratiaCms.ajax('<?php echo $this->url ?>crear', data, '', $(".panel-default"), 'general');
        });
    });
</script>
