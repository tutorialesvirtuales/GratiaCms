<?php echo validation_errors() ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <span>Datos del menú</span>
                <div class="pull-right">
                    <a href="<?php echo $this->url ?>" style="color:#FFF">
                        Volver al listado <i class="fa fa-hand-o-left"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open('', 'id="form-principal"'); ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Etiqueta <span class="required">*</span></label>                                
                            <input type="text" name="etiqueta" id="etiqueta" class="form-control defecto" value="<?php echo set_value('etiqueta', isset($data->etiqueta) ? $data->etiqueta : '') ?>" placeholder="Etiqueta del menu" required/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Url <span class="required">*</span></label>                                
                            <input type="text" name="url" id="url" class="form-control" value="<?php echo set_value('url', isset($data->url) ? $data->url : '') ?>" placeholder="Url" required/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Tipo menu <span class="required">*</span></label>
                            <?php echo form_dropdown('tipo_menu_id', $this->Tipo_menu_model->dropdown('descripcion'), set_value('tipo_menu_id', isset($data->tipo_menu_id) ? $data->tipo_menu_id : ''), 'id="tipo_menu_id" class="form-control bs-select" required')  ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Icono</label>                               
                                <input type="text" name="icono" id="icono" class="form-control" value="<?php echo set_value('icono', isset($data->icono) ? $data->icono : '') ?>" placeholder="Icono" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-icon left">
                                    <i style="font-size:30px; margin-top:30px" class="icono <?php echo isset($data->icono) ? $data->icono : '' ?>"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-lg-offset-1 col-lg-11">
                    <input type="hidden" id="id" name="id" value="<?php echo isset($data->id) ? $data->id : '' ?>" />
                    <button type="submit" class="btn btn-info"><?php echo isset($data->id) ? "Actualizar" : "Crear" ?></button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        GratiaCms.validacion_general('#form-principal');
        $('#icono').on('blur', function () {
            $('.icono').addClass($(this).val());
        });
    });
</script>


