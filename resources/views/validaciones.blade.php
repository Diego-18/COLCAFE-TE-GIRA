<script>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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
                        title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde</span>',
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

    //REGISTRO
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
            console.log("por aqui pase")
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
</script>
