@include('head')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //LOGIN
    $("#validar_cc").click(function() {
        let val = $("#cc_ingreso").val();
        if (val.length < 8 || val.length > 10 || !val.match(/^[0-9]+$/)) {
            Toast.fire({
                icon: 'error',
                title: '<span class="mu7 alert-error">Ingresa una cédula válida</span>',
            });
        } else if (val < 100) {
            Toast.fire({
                icon: 'error',
                title: '<span class="mu7 alert-error">Ingresa una cédula válida</span>',
            });
        } else {
            $(this).prop('disabled', true);
            $.ajax({
                url: "{{ route('login') }}",
                dataType: "json",
                type: "POST",
                data: {
                    cc: val
                },
                success: function(response) {
                   
                    if (response.result == true) {
                        if (response.valid == 1) {
                            window.location.href = "{{ route('registro_empaques') }}";
                        } else if (response.valid == 0) {
                            console.log(response.tipoDeDocumentos);
                            preguntar_login(val);
                        }
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde aqui</span>',
                        });
                        $("#validar_cc").prop('disabled', false);
                    }
                },
                error: function(response) {
                    Toast.fire({
                        icon: 'error',
                        title: '<span class="mu7 alert-error">Ocurrió un error</span>',
                    });
                    $("#validar_cc").prop('disabled', false);
                }
            });
        }
    });

    function preguntar_login(cc) {
        $("#validar_cc").prop('disabled', false);
        location.href = "{{ url('registro') }}" + "/" + cc;
    }

    //REGISTRO de persona
    $("#registro_pers").click(function() {

        let tipo_documento = $("#tipo_documento").val();
        let documento = $("#documento").val();
        let nombre = $("#nombres").val().toUpperCase();
        let apellido = $("#apellidos").val().toUpperCase();
        let departamento = $("#departamento").val();
        let ciudad = $("#ciudad").val();

        let email = $("#email").val();
        let telefono = $("#celular").val();
        let tel_adic = $("#tel_adic").val();
        let terminos = $('#terminos').prop('checked');
        let privacidad = $('#privacidad').prop('checked');

        if (tipo_documento == 0 || tipo_documento > 3 || tipo_documento < 0) {
            $("#alert_error_registro").modal("show");
        } else if (documento.length > 10 || documento.length < 8 || !documento.match(/^[0-9]+$/)) {
            $("#alert_error_registro").modal("show");
        } else if (documento < 100) {
            $("#alert_error_registro").modal("show");
        } else if (!nombre.match(
                /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/
            )) {
            $("#alert_error_registro").modal("show");
        } else if (nombre.length < 3 || nombre.length > 60) {
            $("#alert_error_registro").modal("show");
        } else if (!apellido.match(
                /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/
            )) {
            $("#alert_error_registro").modal("show");
        } else if (apellido.length < 5 || apellido.length > 60) {
            $("#alert_error_registro").modal("show");
        } else if (departamento == 100) {
            $("#alert_error_registro").modal("show");
        } else if (ciudad == 100) {
            $("#alert_error_registro").modal("show");
        } else if (email.length >= 1 && !email.match(
                /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/
            )) {
            $("#alert_error_registro").modal("show");
        } else if (telefono.length > 10 || telefono.length < 10 || !telefono.match(/^[3][0-9]+$/)) {
            $("#alert_error_registro").modal("show");
        } else if (tel_adic.length > 10) {
            $("#alert_error_registro").modal("show");
        } else if (terminos == false) {
            $("#alert_error_registro").modal("show");
        } else if (privacidad == false) {
            $("#alert_error_registro").modal("show");
        } else {
            var tp_nombre = $("#tipo_documento option:selected").text();
            var dp_nombre = $("#departamento option:selected").text();
            var ci_nombre = $("#ciudad option:selected").text();

            $.ajax({
                url: "{{ route('registro_post') }}",
                dataType: "json",
                type: "POST",
                data: {
                    tipo_documento: tipo_documento,
                    documento: documento,
                    nombre: nombre,
                    apellido: apellido,
                    departamento: departamento,
                    ciudad: ciudad,
                    email: email,
                    telefono: telefono,
                    tel_adic: tel_adic,
                    tp_nombre: tp_nombre,
                    dp_nombre: dp_nombre,
                    ci_nombre: ci_nombre,
                },
                success: function(response) {
                    if (response.result == true) {
                        registrar_usuario(response.info);
                    } else {
                        ;
                        Toast.fire({
                            icon: 'error',
                            title: '<span class="mu7 alert-error este es el error">' +
                                response.data +
                                '</span>',
                        });
                    }
                },
                error: function(response) {

                    Toast.fire({
                        icon: 'error',
                        title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tardeeeee</span>',
                    });

                }
            });
        }
    });

    //ABRIR MODAL CÓDIGOS
    function registrar_usuario(data) {

        if (!data.tel_adic) {
            data.tel_adic = "";
        }
        if (!data.email) {
            data.email = "";
        }
        Swal.fire({
            icon: 'success',
            background: "#c8a767",
            iconColor: '#1c4d0c',
            html: `<span class='mu7 alert-error2'><strong>Verifica tus datos</strong></span><br><br>
                <div style="text-align: left;">       
                <span class='mu5 alert-error2'>Tipo de documento: <strong>` + data.tipo_documento + `</strong></span><br>
                <span class='mu5 alert-error2'>Documento: <strong>` + data.documento + `</strong></span><br>
                <span class='mu5 alert-error2'>Nombres: <strong>` + data.nombre + `</strong></span><br>
                <span class='mu5 alert-error2'>Apellidos: <strong>` + data.apellido + `</strong></span><br>
                <span class='mu5 alert-error2'>Departamento: <strong>` + data.dp_nombre + `</strong></span><br>
                <span class='mu5 alert-error2'>Ciudad: <strong>` + data.ci_nombre + `</strong></span><br>
                <span class='mu5 alert-error2'>Correo electrónico: <strong>` + data.email + `</strong></span><br>
                <span class='mu5 alert-error2'>Celular: <strong>` + data.telefono + `</strong></span><br>
                <span class='mu5 alert-error2'>Teléfono adicional: <strong>` + data.tel_adic + `</strong></span>
             

                </div>`,
            showCancelButton: true,
            confirmButtonColor: '#432c1d',
            cancelButtonColor: '#a01822',
            confirmButtonText: '<span class="mu7 btn-confirm">Registrarme</span>',
            cancelButtonText: "<span class='mu7 btn-confirm'>Corregir información</span>",
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                var count_cod_user = 0;
                var info_user = null;
                $.ajax({
                    url: "{{ route('registro_newpost') }}",
                    dataType: "json",
                    type: "POST",
                    data: {
                        data: data,
                    },
                    success: function(response) {

                        if (response.result == true) {
                            ;
                            info_user = response.data_user;
                            Swal.fire({
                                icon: 'success',
                                background: "#c8a767",
                                iconColor: '#1c4d0c',
                                showCancelButton: false,
                                html: `<span class='mu5 alert-error'>Registrado correctamente</span>`,
                                confirmButtonColor: '#432c1d',
                                cancelButtonColor: '#a01822',
                                confirmButtonText: '<span class="mu7 btn-confirm">Aceptar</span>',
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "{{ route('registro_empaques') }}";
                                }
                            });
                        } else if (response.result == false) {
                            console.log(response)
                            Toast.fire({
                                icon: 'error',
                                title: '<span class="mu7 alert-error">' + response.data +
                                    '</span>',
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde</span>',
                            });

                        }
                    },
                    error: function(response) {
                        Toast.fire({
                            icon: 'error',
                            title: '<span class="mu7 alert-error">Ocurrió un error</span>',
                        });
                    }
                });
            } else {

            }
        });
    }

    var gramProducto = new Object();
    var gramProducto2 = new Object();
    var gramProducto3 = new Object();
    var gramProducto4 = new Object();
    var gramProducto5 = new Object();
    var arregloObjeto = Array();
    $("#registro_emp").click(function() {

        var gramaje = $("#gramaje").val();
        var producto = $("#producto").val();
        var gramaje2 = $("#gramaje2").val();
        var producto2 = $("#producto2").val();
        var gramaje3 = $("#gramaje3").val();
        var producto3 = $("#producto3").val();
        var gramaje4 = $("#gramaje4").val();
        var producto4 = $("#producto4").val();
        var gramaje5 = $("#gramaje5").val();
        var producto5 = $("#producto5").val();

        if (gramaje == 0 && gramaje2 == 0 && gramaje3 == 0 && gramaje4 == 0 && gramaje5 == 0) {
            Toast.fire({
                icon: 'error',
                title: '<span class="mu7 alert-error">Ingrese por lo menos el grameje</span>',
            });
        } else if (producto == 0 && producto2 == 0 && producto3 == 0 && producto4 == 0 && producto5 == 0) {
            Toast.fire({
                icon: 'error',
                title: '<span class="mu7 alert-error">Ingrese por lo menos un producto</span>',
            });
        } else {
            if (gramaje != 0 && producto != 0) {
                gramProducto.gramajes = gramaje;
                gramProducto.productos = producto;
                arregloObjeto.push(gramProducto);

            }
            if (gramaje2 != 0 && producto2 != 0) {
                gramProducto2.gramajes = gramaje2;
                gramProducto2.productos = producto2;
                arregloObjeto.push(gramProducto2);
            }

            if (gramaje3 != 0 && producto3 != 0) {
                gramProducto3.gramajes = gramaje3;
                gramProducto3.productos = producto3;
                arregloObjeto.push(gramProducto3);
            }

            if (gramaje4 != 0 && producto4 != 0) {
                gramProducto4.gramajes = gramaje4;
                gramProducto4.productos = producto4;
                arregloObjeto.push(gramProducto4);
            }

            if (gramaje5 != 0 && producto5 != 0) {
                gramProducto5.gramajes = gramaje5;
                gramProducto5.productos = producto5;
                arregloObjeto.push(gramProducto5);
            }
            var gramos = 0;
            for (let i = 0; i < arregloObjeto.length; i++) {
                gramos += parseInt(arregloObjeto[i].gramajes)
            }

          
            $.ajax({
                url: "{{ route('registro_empa') }}",
                dataType: "json",
                type: "POST",
                data: {
                    productGram: arregloObjeto,
                    gramos: gramos,
                },
                success: function(response) {
                    if (response.result == true) {
                        info_empaque = response.data_empaque;
                        Swal.fire({
                            icon: 'success',
                            background: "#c8a767",
                            iconColor: '#1c4d0c',
                            showCancelButton: false,
                            html: `<span class='mu5 alert-error'>Registrado correctamente</span>`,
                            confirmButtonColor: '#432c1d',
                            cancelButtonColor: '#a01822',
                            confirmButtonText: '<span class="mu7 btn-confirm">Aceptar</span>',
                            allowOutsideClick: false,

                        }).then((result) => {
                            if (result.isConfirmed) {
                            }
                        });
                    } else {
                    
                        Toast.fire({
                            icon: 'error',
                            title: '<span class="mu7 alert-error">' + response.valid +
                                '</span>',
                        });
                        $("#registro_emp").prop('disabled', false);
                    }
                },
                error: function(response) {
                    Toast.fire({
                        icon: 'error',
                        title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde</span>',
                    });
                    $("#registro_emp").prop('disabled', false);
                }
            });
        }
    });

    $("#ver_registro_empa").click(function() {
        $.ajax({
            url: "{{ route('ver_registro_empa') }}",
            dataType: "json",
            type: "GET",
            success: function(response) {
                console.log(response)
                if (response.result == true) {
                    data = interpretar(response);
                    $("#producto_ver").empty();
                    $("#gramaje_ver").empty();
                    $("#cantidad_ver").empty();
                    $.each(data, function(index, value) {
                        $("#producto_ver").append('<input value="' + data[index].producto +
                            '">');
                        $("#gramaje_ver").append('<input value="' + data[index].gramaje +
                            '">');
                        $("#cantidad_ver").append('<input value="' + data[index]
                            .gramos_registrados +
                            '">');
                    });
                    data = []
                    console.log(response)
                    $("#modaldocument").modal("show");
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde</span>',
                    });
                    $("#validar_cc").prop('disabled', false);
                }
            },
            error: function(response) {
                Toast.fire({
                    icon: 'error',
                    title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde</span>',
                });
                $("#validar_cc").prop('disabled', false);
            }
        });

    });


    function interpretar(data) {

        var array = data.productos;
        var result = [];
        array.reduce(function(res, value) {
            if (!res[value.producto]) {
                res[value.producto] = {
                    producto: value.producto,
                    gramaje: 0,
                    gramos_registrados: 0
                };
                result.push(res[value.producto])
            }
            res[value.producto].gramaje += value.gramaje;
            res[value.producto].gramos_registrados += value.gramos_registrados;
            return res;
        }, {});

        return result
    }

    const Toast = Swal.mixin({
        showConfirmButton: true,
        showCancelButton: false,
        confirmButtonColor: '#a01822',
        background: '#c8a767',
        iconColor: '#a01822',
        confirmButtonText: '<span class="mu7 btn-confirm">Aceptar</span>',
        allowOutsideClick: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
</script>
