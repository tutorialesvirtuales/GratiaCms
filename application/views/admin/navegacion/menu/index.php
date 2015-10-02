<?php echo $this->session->flashdata('mensaje') ?>
<?php $datas = $this->Modelo->order_by('posicion', 'asc')->get_many_by(array('menu_id IS NULL')) ?>
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
                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        <?php foreach ($datas as $data): ?>
                            <li class="dd-item dd3-item" data-id="<?php echo $data->id ?>">
                                <div class="dd-handle dd3-handle">
                                </div>
                                <div class="dd3-content <?php echo $data->url === '#' ? 'bold' : '' ?>">
                                    <a href="<?php echo $this->url ?>actualizar/<?php echo $data->id ?>"><?php echo $data->etiqueta . ' | Url:: ' . $data->url ?> <i style="font-size:20px;" class="icono <?php echo isset($data->icono) ? $data->icono : '' ?>"></i></a>
                                </div>
                                <?php if ($hijos = getMenuHijos($data->id)): ?>
                                    <ol class="dd-list">
                                        <?php foreach ($hijos as $hijo): ?>
                                            <li class="dd-item dd3-item" data-id="<?php echo $hijo->id ?>">
                                                <div class="dd-handle dd3-handle">
                                                </div>
                                                <div class="dd3-content <?php echo $hijo->url === '#' ? 'bold' : '' ?>">
                                                    <a href="<?php echo $this->url ?>actualizar/<?php echo $hijo->id ?>"><?php echo $hijo->etiqueta . ' | Url:: ' . $hijo->url ?> <i style="font-size:20px;" class="icono <?php echo isset($hijo->icono) ? $hijo->icono : '' ?>"></i></a>
                                                </div>
                                                <?php if ($hijos2 = getMenuHijos($hijo->id)): ?>
                                                    <ol class="dd-list">
                                                        <?php foreach ($hijos2 as $hijo2): ?>
                                                            <li class="dd-item dd3-item" data-id="<?php echo $hijo2->id ?>">
                                                                <div class="dd-handle dd3-handle">
                                                                </div>
                                                                <div class="dd3-content <?php echo $hijo2->url === '#' ? 'bold' : '' ?>">
                                                                    <a href="<?php echo $this->url ?>actualizar/<?php echo $hijo2->id ?>"><?php echo $hijo2->etiqueta . ' | Url:: ' . $hijo2->url ?> <i style="font-size:20px;" class="icono <?php echo isset($hijo2->icono) ? $hijo2->icono : '' ?>"></i></a>
                                                                </div>
                                                                <?php if ($hijos3 = getMenuHijos($hijo2->id)): ?>
                                                                    <ol class="dd-list">
                                                                        <?php foreach ($hijos3 as $hijo3): ?>
                                                                            <li class="dd-item dd3-item" data-id="<?php echo $hijo3->id ?>">
                                                                                <div class="dd-handle dd3-handle">
                                                                                </div>
                                                                                <div class="dd3-content <?php echo $hijo3->url === '#' ? 'bold' : '' ?>">
                                                                                    <a href="<?php echo $this->url ?>actualizar/<?php echo $hijo3->id ?>"><?php echo $hijo3->etiqueta . ' | Url:: ' . $hijo3->url ?> <i style="font-size:20px;" class="icono <?php echo isset($hijo3->icono) ? $hijo3->icono : '' ?>"></i></a>
                                                                                </div>
                                                                                <?php if ($hijos4 = getMenuHijos($hijo3->id)): ?>
                                                                                    <?php foreach ($hijos4 as $hijo4): ?>
                                                                                        <ol class="dd-list">
                                                                                            <li class="dd-item dd3-item" data-id="<?php echo $hijo4->id ?>">
                                                                                                <div class="dd-handle dd3-handle">
                                                                                                </div>
                                                                                                <div class="dd3-content <?php echo $hijo4->url === '#' ? 'bold' : '' ?>">
                                                                                                    <a href="<?php echo $this->url ?>actualizar/<?php echo $hijo4->id ?>"><?php echo $hijo4->etiqueta . ' | Url:: ' . $hijo4->url ?> <i style="font-size:20px;" class="icono <?php echo isset($hijo4->icono) ? $hijo4->icono : '' ?>"></i></a>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ol>
                                                                                    <?php endforeach; ?>
                                                                                <?php endif; ?>
                                                                            </li>
                                                                        <?php endforeach; ?>
                                                                    </ol>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ol>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#nestable').nestable().on('change', function () {
            var list = $('#nestable');
            var datam = {
                menu: window.JSON.stringify(list.nestable('serialize')),
                '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
            };
            $.ajax({
                url: '<?php echo $this->url ?>guardar',
                type: "POST",
                dataType: 'JSON',
                data: datam,
                success: function (respuesta) {
                }
            });
        });
        $('.dd').nestable('collapseAll');
    });
</script>
