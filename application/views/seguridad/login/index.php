<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Acceso a tutorialesvirtuales.com</h3>
            </div>
            <div class="panel-body">
                <?php echo form_open('', 'id="form_principal"'); ?>
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Usuario" name="usuario"  autofocus required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password"  value="" required />
                    </div>
                    <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                </fieldset>
                <?php echo form_close() ?>
            </div>
        </div>
        <?php echo validation_errors() ?>
    </div>
</div>