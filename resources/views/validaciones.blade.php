<script>
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //$("#modal_error").modal("show");

    //LOGIN
    $("#validar_cc").click(function() {
        var val = $("#cc_ingreso").val();
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
                //cuando me manda una respuesta correcta
                success: function(response) {

                    if (response.result == true) {
                        // cuando me trae el registro de la bd, si exite en ese caso mando la respuesta del ajax
                        console.log(response.valid)
                        if (response.valid == 1) {
                            // console.log(response.id)
                            window.location.href = "{{ route('registro_empaques') }}";
                        } else if (response.valid == 0) {
                            // en caso de que no exita
                            preguntar_login(val);
                        }
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

        var tipo_documento = $("#tipo_documento").val();
        var documento = $("#documento").val();
        var nombre = $("#nombres").val().toUpperCase();
        var apellido = $("#apellidos").val().toUpperCase();
        var departamento = $("#departamento").val();
        var ciudad = $("#ciudad").val();
        var email = $("#email").val();
        var telefono = $("#celular").val();
        var tel_adic = $("#tel_adic").val();

        var terminos = $('#terminos').prop('checked');

        var privacidad = $('#privacidad').prop('checked');

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

            $(this).prop('disabled', true);
            // var tp = $("#tipo_documento option:selected").text();
            // var dp = $("#departamento option:selected").text();
            // var cd = $("#ciudad option:selected").text();

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

                },
                success: function(response) {
                    if (response.result == true) {
                        registrar_usuario(response.info);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: '<span class="mu7 alert-error">' + response.data +
                                '</span>',
                        });
                        $("#registro_pers").prop('disabled', false);
                    }
                },
                error: function(response) {
                    console.log("algo anda mal")
                    Toast.fire({
                        icon: 'error',
                        title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde</span>',
                    });
                    $("#registro_pers").prop('disabled', false);
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
                <span class='mu5 alert-error2'>Departamento: <strong>` + data.departamento + `</strong></span><br>
                <span class='mu5 alert-error2'>Ciudad: <strong>` + data.ciudad + `</strong></span><br>
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
                                    person(info_user, count_cod_user)
                                }
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde</span>',
                            });
                            $("#registro_pers").prop('disabled', false);
                        }
                    },
                    error: function(response) {
                        Toast.fire({
                            icon: 'error',
                            title: '<span class="mu7 alert-error">Ocurrió un error</span>',
                        });
                        console.log(response)
                        $("#registro_pers").prop('disabled', false);
                    }
                });
            } else {
                $("#registro_pers").prop('disabled', false);
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
                    console.log(response)
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
                            title: '<span class="mu7 alert-error">' + response.data +
                                '</span>',
                        });
                        $("#registro_emp").prop('disabled', false);
                    }
                },
                error: function(response) {
                    console.log("algo anda mal")
                    console.log(response)
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

                if (response.result == true) {
                    reducir(response)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde</span>',
                    });
                    console.log(response)
                    $("#validar_cc").prop('disabled', false);
                }
            },
            error: function(response) {
                console.log(response)
                Toast.fire({
                    icon: 'error',
                    title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde</span>',
                });
                $("#validar_cc").prop('disabled', false);
            }
        });

    });


    function reducir(data) {
       console.log(data.producto);
       data_info = data;

    //    var unicos = data.filter(function(e){
    //         return data[e] ? false : (data[e]=true)
    //    })
        
    }


    // function qd_sd($array, $campo, $campo2) {
    //     $nuevo = array();
    //     foreach($array as $parte) {
    //         $clave[] = $parte[$campo];
    //     }
    //     $unico = array_unique($clave);
    //     foreach($unico as $un) {
    //         foreach($array as $original) {
    //             if ($un == $original[$campo]) {
    //                 $fecha2 = '04:30'; //aqui pueden omitir esto 
    //                 $suma = $suma + minutosTranscurridos($original[$campo2],
    //                     $fecha2); //  igual que la funcion minutosTranscurridos y el campo $fecha2
    //             }
    //         }
    //         $ele['cedula'] = $un;
    //         $ele['fecha'] = $suma;
    //         array_push($nuevo, $ele);
    //         $suma = 0;
    //     }
    //     return $nuevo;
    // }


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
