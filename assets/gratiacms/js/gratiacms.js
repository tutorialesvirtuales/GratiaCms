var GratiaCms = function () {
    return{
        ajax: function (url, data, campo, el, funcion) {
            el.block({ 
                message: '<h1>Procesando...</h1>', 
                css: { border: '3px solid #a00' } 
            }); 
            $.ajax({
                url: url,
                type: "POST",
                data: data,
                success: function (respuesta) {
                    var error = "<strong>!Error¡</strong>";
                    el.unblock(); 
                }
            });
        },
        tooltip: function () {
            $('body').tooltip({
                selector: '.tooltips',
                placement: 'top',
                container: 'body'
            });
        },
        datatables: function () {
            $('#dataTables').DataTable({
                responsive: true,
                language: {
                    lengthMenu: "  _MENU_ items",
                    paginate: {
                        "previous": "Sig",
                        "next": "Prev",
                        "last": "Ultimo",
                        "first": "Primero"
                    },
                    zeroRecords: "No se encontraron registros",
                    info: "Mostrando _PAGE_ de _PAGES_ pagina(s)",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(Filtrado de un total de _MAX_ registros)",
                    sSearch: "Buscar:",
                    processing: "Procesando"
                },
                columnDefs: [{// set default column settings
                        orderable: false,
                        targets: [-1]
                    }, {
                        searchable: false,
                        targets: [-1]
                    }]
            });
        },
        datatablesEsp: function () {
            $('#dataTables').DataTable({
                responsive: true,
                language: {
                    lengthMenu: "  _MENU_ items",
                    paginate: {
                        "previous": "Sig",
                        "next": "Prev",
                        "last": "Ultimo",
                        "first": "Primero"
                    },
                    zeroRecords: "No se encontraron registros",
                    info: "Mostrando _PAGE_ de _PAGES_ pagina(s)",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(Filtrado de un total de _MAX_ registros)",
                    sSearch: "Buscar:",
                    processing: "Procesando"
                },
                "bSort": false,
                columnDefs: [{
                        searchable: false,
                        targets: [-1]
                    }]
            });
        },
        validacion_general: function (id, reglas, mensajes) {
            var form_principal = $(id);
            var error = $('.alert-danger', form_principal);
            validator = form_principal.validate({
                onkeyup: false,
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                ignore: "", // validate all fields including form hidden input
                rules: reglas,
                messages: mensajes,
                highlight: function (element, errorClass, validClass) { // hightlight error inputs
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                },
                success: function (label) {
                    label.closest('.form-group').removeClass('has-error'); // set success class to the control group
                    $('button[type=submit]').attr("disabled", false);
                },
                errorPlacement: function (error, element) {
                    if (element.parents(".input-group").size() > 0) {
                        error.insertAfter(element.parents(".input-group"));
                    } else if ($(element).is('select') && element.hasClass('bs-select')) {//PARA LOS SELECT BOOSTRAP
                        element.next().after(error);
                    } else if (element.attr("data-error-container")) {
                        error.appendTo(element.attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // default placement for everything else
                    }
                },
                invalidHandler: function (event, validator) { //display error alert on form submit              
                    error.show();
                },
                submitHandler: function (form) {
                    $(id).find(':submit').attr('disabled', 'disabled');
                    form.submit();
                }
            });
        },
    };
}();


