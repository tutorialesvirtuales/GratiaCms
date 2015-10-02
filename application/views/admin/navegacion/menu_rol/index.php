<?php echo $this->session->flashdata('mensaje') ?>
<?php
$rols = $this->Rol_model->get_all();
$menus = $this->Menu_model->order_by('posicion', 'asc')->get_many_by(array('menu_id IS NULL'));
$menu_rol = $this->Modelo->getAll();
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>Asignar Menus a Roles</span>
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
                            <?php foreach ($menus as $menu) : $menu_p = isset($menu_rol[$menu->id]) ? $menu_rol[$menu->id] : '' ?>
                                <tr>
                                    <td><span style="color:#428bca"><i class="fa fa-arrows" style="padding-right:5px"></i><?php echo $menu->etiqueta ?></span></td>
                                    <?php foreach ($rols as $rol): ?>
                                        <td>
                                            <input 
                                                type="checkbox" 
                                                class="menu_rol" 
                                                name="menu_rol[]" 
                                                menu_id="<?php echo $menu->id ?>" 
                                                value="<?php echo $rol->id ?>" 
                                                <?php echo is_array($menu_p) ? (isset($menu_p[$rol->id]) ? ($menu_p[$rol->id] ? 'checked' : '') : '') : '' ?>/>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php foreach (getMenuHijos($menu->id) as $hijo): $menu_h = isset($menu_rol[$hijo->id]) ? $menu_rol[$hijo->id] : '' ?>
                                    <tr>
                                        <td><span><i class="fa fa-long-arrow-right" style="padding-left:10px;padding-right:5px"></i><?php echo $hijo->etiqueta ?></span></td>
                                        <?php foreach ($rols as $rol): ?>
                                            <td>
                                                <input 
                                                    type="checkbox" 
                                                    class="menu_rol" 
                                                    name="menu_rol[]" 
                                                    menu_id="<?php echo $hijo->id ?>" 
                                                    value="<?php echo $rol->id ?>" 
                                                    <?php echo is_array($menu_h) ? (isset($menu_h[$rol->id]) ? ($menu_h[$rol->id] ? 'checked' : '') : '') : '' ?>/>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php foreach (getMenuHijos($hijo->id) as $hijo2): $menu_h2 = isset($menu_rol[$hijo2->id]) ? $menu_rol[$hijo2->id] : '' ?>
                                        <tr>
                                            <td><span><i class="fa fa-long-arrow-right" style="padding-left:30px;padding-right:5px"></i><?php echo $hijo2->etiqueta ?></span></td>
                                            <?php foreach ($rols as $rol): ?>
                                                <td>
                                                    <input 
                                                        type="checkbox" 
                                                        class="menu_rol" 
                                                        name="menu_rol[]" 
                                                        menu_id="<?php echo $hijo2->id ?>" 
                                                        value="<?php echo $rol->id ?>" 
                                                        <?php echo is_array($menu_h2) ? (isset($menu_h2[$rol->id]) ? ($menu_h2[$rol->id] ? 'checked' : '') : '') : '' ?>/>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php foreach (getMenuHijos($hijo2->id) as $hijo3): $menu_h3 = isset($menu_rol[$hijo3->id]) ? $menu_rol[$hijo3->id] : '' ?>
                                            <tr>
                                                <td><span><i class="fa fa-long-arrow-right" style="padding-left:50px;padding-right:5px"></i><?php echo $hijo3->etiqueta ?></span></td>
                                                <?php foreach ($rols as $rol): ?>
                                                    <td>
                                                        <input 
                                                            type="checkbox" 
                                                            class="menu_rol" 
                                                            name="menu_rol[]" 
                                                            menu_id="<?php echo $hijo3->id ?>" 
                                                            value="<?php echo $rol->id ?>" 
                                                            <?php echo is_array($menu_h3) ? (isset($menu_h3[$rol->id]) ? ($menu_h3[$rol->id] ? 'checked' : '') : '') : '' ?>/>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <?php foreach (getMenuHijos($hijo3->id) as $hijo4): $menu_h4 = isset($menu_rol[$hijo4->id]) ? $menu_rol[$hijo4->id] : '' ?>
                                                <tr>
                                                    <td><span><i class="fa fa-long-arrow-right" style="padding-left:70px;padding-right:5px"></i><?php echo $hijo4->etiqueta ?></span></td>
                                                    <?php foreach ($rols as $rol): ?>
                                                        <td>
                                                            <input 
                                                                type="checkbox" 
                                                                class="menu_rol" 
                                                                name="menu_rol[]" 
                                                                menu_id="<?php echo $hijo4->id ?>" 
                                                                value="<?php echo $rol->id ?>" 
                                                                <?php echo is_array($menu_h4) ? (isset($menu_h4[$rol->id]) ? ($menu_h4[$rol->id] ? 'checked' : '') : '') : '' ?>/>
                                                        </td>
                                                    <?php endforeach; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
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
        $('.menu_rol').on('change', function () {
            var data;
            if ($(this).is(':checked')) {
                data = {
                    menu_id: $(this).attr('menu_id'),
                    rol_id: $(this).val(),
                    estado: 1,
                    '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
                };
            } else {
                data = {
                    menu_id: $(this).attr('menu_id'),
                    rol_id: $(this).val(),
                    estado: 0,
                    '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
                };
            }
            GratiaCms.ajax('<?php echo $this->url ?>crear', data, '', $(".panel-default"), 'general');
        });
    });
</script>
