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
            <?php $this->load->view($contenido) ?>
        </div>
        <!-- jQuery -->
        <script src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url() . TEMPLATEASSETS ?>dist/js/sb-admin-2.js"></script>
    </body>
</html>
