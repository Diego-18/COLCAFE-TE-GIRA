<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var info_dept;
    const Toast2 = Swal.mixin({
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

    $('#departamento option').remove();
    $("#departamento").append('<option value="100">SELECCIONA UNA OPCIÓN*</option>');
    $.ajax({
        method: "GET",
        dataType: "json",
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        url: "http://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.min.json"
    }).done(function(data) {
        info_dept = data;
        $.each(data, function(index, value) {
            $("#departamento").append('<option value="' + data[index].id + '">' + data[index]
                .departamento + '</option>');
        });
    }).fail(function() {
        Toast2.fire({
            icon: 'error',
            title: '<span class="mu7 alert-error">Ocurrió un error, intenta más tarde</span>',
        });
    }).always(function() {});

    $('#departamento').on('change', function() {
        var dep = $("#departamento").val();
        if (dep == 100) {
            $('#ciudad option').remove();
            $("#ciudad").append('<option value="100">SELECCIONA UNA OPCIÓN*</option>');
        } else if (dep != 100 && dep < 100) {
            $('#ciudad option').remove();

            var ciudades = info_dept[dep].ciudades;

            $.each(ciudades, function(index, value) {
                $("#ciudad").append('<option value="' + index + '">' + value + '</option>');
            });
        }

    });
</script>
