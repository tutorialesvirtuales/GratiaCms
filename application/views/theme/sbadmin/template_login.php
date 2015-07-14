<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login Tutorialesvirtuales</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url() . TEMPLATEASSETS ?>dist/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
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
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url() . TEMPLATEASSETS ?>dist/js/sb-admin-2.js"></script>
    </body>
</html>
