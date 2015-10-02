<?php echo validation_errors() ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <span>Datos del Permiso</span>
                <div class="pull-right">
                    <a href="<?php echo $this->url ?>" style="color:#FFF">
                        Volver al listado <i class="fa fa-hand-o-left"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open('', 'id="form-principal"'); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Nombre <span class="required">*</span></label>
                            <input type=text" name="nombre" class="form-control" id="nombre" value="<?php echo set_value('nombre', isset($data->nombre) ? $data->nombre : '') ?>" required/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Nombre a mostrar <span class="required">*</span></label>
                            <input type=text" name="nombre_a_mostrar" class="form-control" id="nombre_a_mostrar" value="<?php echo set_value('nombre_a_mostrar', isset($data->nombre_a_mostrar) ? $data->nombre_a_mostrar : '') ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Observación <span class="required">*</span></label>
                            <input type=text" name="observacion" class="form-control" id="observacion" value="<?php echo set_value('observacion', isset($data->observacion) ? $data->observacion : '') ?>" required/>
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
    });
</script>


