<?php echo validation_errors() ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <span>Datos del tipo de menú</span>
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
                            <label class="control-label">Descripcion <span class="required">*</span></label>
                            <input type=text" name="descripcion" class="form-control" id="descripcion" value="<?php echo set_value('descripcion', isset($data->descripcion) ? $data->descripcion : '') ?>" descripcion/>
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


