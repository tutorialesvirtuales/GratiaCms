<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="pagina principal de tutorialesvirtuales.com">
        <meta name="author" content="tutoriales virtuales">

        <title><?php echo $titulo ?></title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/bootstrap/dist/css/bootstrap.min.css" >
        <!-- MetisMenu CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/metisMenu/dist/metisMenu.min.css" >
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" >
        <!-- DataTables Responsive CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/datatables-responsive/css/dataTables.responsive.css" >
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . TEMPLATEASSETS ?>dist/css/sb-admin-2.css" >
        <!-- Custom Fonts -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/font-awesome/css/font-awesome.min.css" >
        <!-- Custom GratiaCms Styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/gratiacms/css/gratiacms.css">
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/jquery/dist/jquery.min.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view(THEME . 'navbar'); //Se Llama la barra de menu ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $titulo ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?php $this->load->view($contenido); // Se carga la vista con el contenido a mostrar ?>
            </div>
        </div>
        <!-- Bootstrap Core JavaScript -->
        <script type="text/javascript" src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script type="text/javascript" src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/metisMenu/dist/metisMenu.min.js"></script>
        <!-- DataTables JavaScript -->
        <script type="text/javascript" src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . TEMPLATEASSETS ?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
        <!--Validacion de Formualarios-->
        <script type="text/javascript" src="<?php echo base_url() ?>assets/gratiacms/js/jquery-validate/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/gratiacms/js/jquery-validate/localization/messages_es.min.js"></script>
        <!--Block en Ajax-->
        <script type="text/javascript" src="<?php echo base_url() ?>assets/gratiacms/js/jquery-blockUI/jquery.blockUI.js"></script>
        <!-- Custom Theme JavaScript -->
        <script type="text/javascript" src="<?php echo base_url() . TEMPLATEASSETS ?>dist/js/sb-admin-2.js"></script>
        <!-- Custom GratiaCms JavaScript -->
        <script type="text/javascript" src="<?php echo base_url() ?>assets/gratiacms/js/gratiacms.js"></script>
        <script>
            $(document).ready(function () {
                GratiaCms.tooltip();
            });
            /*
             * Evitar enter en los forms
             */
            $(document).on("keydown", function (e) {
                if (e.which === 8 && !$(e.target).is("input, textarea")) {
                    e.preventDefault();
                }
            });
        </script>
    </body>

</html>

