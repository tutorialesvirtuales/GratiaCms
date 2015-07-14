<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="pagina principal de tutorialesvirtuales.com">
        <meta name="author" content="tutoriales virtuales">

        <title><?php echo $titulo  ?></title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url() . TEMPLATEASSETS ?>dist/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view(THEME . 'navbar'); //Se Llama la barra de menu ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $titulo  ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?php $this->load->view($contenido); // Se carga la vista con el contenido a mostrar ?>
            </div>
        </div>
        <!-- jQuery -->
        <script src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/metisMenu/dist/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url() . TEMPLATEASSETS ?>dist/js/sb-admin-2.js"></script>
    </body>

</html>

