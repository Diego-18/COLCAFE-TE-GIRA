@include('head')
@include('header')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="cotainer">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registro de empaques</div>
                <div class="card-body">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text mu7 info-cc-ingreso">Gramaje</div>
                        </div>
                        <select id="gramaje" class="form-control" value="0">
                            <option value="0">Elige*</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                        <br>
                        <div class="input-group-prepend">
                            <div class="input-group-text mu7 info-cc-ingreso">Producto</div>
                        </div>
                        <select id="producto" class="form-control" value="0">
                            <option value="0">Elige*</option>
                            <option value="1">Colcafé 3 en 1</option>
                            <option value="2">Colcafé 2 en 1</option>
                        </select>
                        <a style="margin-left: 10px; height: 40px;" href="#" id="add_cod_val" title="Agregar más"><img
                                src="{{ asset('img/add-cod.png') }}"></a>
                    </div>
                    <div class="input-group mb-2" id="container_add_2" style="display: none;">
                        <div class="input-group-prepend">
                            <div class="input-group-text mu7 info-cc-ingreso">Gramaje</div>
                        </div>
                        <select id="gramaje2" class="form-control" value="0" data-value1="1">
                            <option value="0">Elige*</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                        <br>
                        <div class="input-group-prepend">
                            <div class="input-group-text mu7 info-cc-ingreso">Producto</div>
                        </div>
                        <select id="producto2" class="form-control" value="0">
                            <option value="0">Elige*</option>
                            <option value="1">Colcafé 3 en 1</option>
                            <option value="2">Colcafé 2 en 1</option>
                        </select>
                        <a id="eliminar_cod_2" style="margin-left: 10px; height: 40px;" href="#" title="Eliminar"><img
                                src="{{ asset('img/delete-cod.png') }}"></a>
                    </div>
                    <div class="input-group mb-2" id="container_add_3" style="display: none;">
                        <div class="input-group-prepend">
                            <div class="input-group-text mu7 info-cc-ingreso">Gramaje</div>
                        </div>
                        <select id="gramaje3" class="form-control" value="0">
                            <option value="0">Elige*</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                        <br>
                        <div class="input-group-prepend">
                            <div class="input-group-text mu7 info-cc-ingreso">Producto</div>
                        </div>
                        <select id="producto3" class="form-control" value="0">
                            <option value="0">Elige*</option>
                            <option value="1">Colcafé 3 en 1</option>
                            <option value="2">Colcafé 2 en 1</option>
                        </select>
                        <a id="eliminar_cod_3" style="margin-left: 10px; height: 40px;" href="#" title="Eliminar"><img
                                src="{{ asset('img/delete-cod.png') }}"></a>
                    </div>
                    <div class="input-group mb-2" id="container_add_4" style="display: none;">
                        <div class="input-group-prepend">
                            <div class="input-group-text mu7 info-cc-ingreso">Gramaje</div>
                        </div>
                        <select id="gramaje4" class="form-control" value="0">
                            <option value="0">Elige*</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                        <br>
                        <div class="input-group-prepend">
                            <div class="input-group-text mu7 info-cc-ingreso">Producto</div>
                        </div>
                        <select id="producto4" class="form-control" value="0">
                            <option value="0">Elige*</option>
                            <option value="1">Colcafé 3 en 1</option>
                            <option value="2">Colcafé 2 en 1</option>
                        </select>
                        <a id="eliminar_cod_4" style="margin-left: 10px; height: 40px;" href="#" title="Eliminar"><img
                                src="{{ asset('img/delete-cod.png') }}"></a>
                    </div>
                    <div class="input-group mb-2" id="container_add_5" style="display: none;">
                        <div class="input-group-prepend">
                            <div class="input-group-text mu7 info-cc-ingreso">Gramaje</div>
                        </div>
                        <select id="gramaje5" class="form-control" value="0">
                            <option value="0">Elige*</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                        <br>
                        <div class="input-group-prepend">
                            <div class="input-group-text mu7 info-cc-ingreso">Producto</div>
                        </div>
                        <select id="producto5" class="form-control" value="0">
                            <option value="0">Elige*</option>
                            <option value="1">Colcafé 3 en 1</option>
                            <option value="2">Colcafé 2 en 1</option>
                        </select>
                        <a id="eliminar_cod_5" style="margin-left: 10px; height: 40px;" href="#" title="Eliminar"><img
                                src="{{ asset('img/delete-cod.png') }}"></a>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" id="registro_emp">
                            Guardar
                        </button>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" id='ver_registro_empa' >
                            Ver empaques
                        </button>
                        
                        {{-- @foreach( $productos as $key => $value)
                        <tr>
                            <td class="mu5 tbody-par-nam">{{$key+1}}. {{$value->producto}}</td>
                        </tr>
                        @endforeach --}}
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('login')
@include('footer')
@include('validaciones')

<script type="text/javascript">
    $(function() {
        $("#add_cod_val").click(function() {
            var dos = $("#container_add_2").attr("style");
            var tres = $("#container_add_3").attr("style");
            var cuatro = $("#container_add_4").attr("style");
            var cinco = $("#container_add_5").attr("style");
            if (dos) {
                $("#container_add_2").show();
            } else if (tres) {
                $("#container_add_3").show();
            } else if (cuatro) {
                $("#container_add_4").show();
            } else if (cinco) {
                $("#container_add_5").show();
            } else {
                Swal.fire({
                    icon: 'error',
                    background: "#c8a767",
                    iconColor: '#a01822',
                    html: "<span class='mu7 alert-error'>Sólo puedes ingresar 5 códigos al mismo tiempo</span>",
                    showCancelButton: false,
                    confirmButtonColor: '#432c1d',
                    cancelButtonColor: '#a01822',
                    confirmButtonText: '<span class="mu7 btn-confirm">Aceptar</span>',
                    allowOutsideClick: false,
                });
            }
        });

        $("#eliminar_cod_2").click(function() {
            $("#cod_add_2").val("");
            $("#container_add_2").hide();
        });

        $("#eliminar_cod_3").click(function() {
            $("#cod_add_3").val("");
            $("#container_add_3").hide();
        });

        $("#eliminar_cod_4").click(function() {
            $("#cod_add_4").val("");
            $("#container_add_4").hide();
        });

        $("#eliminar_cod_5").click(function() {
            $("#cod_add_5").val("");
            $("#container_add_5").hide();
        });

        $("#btn_cerrar_sesion_cod").click(function() {
            Swal.fire({
                icon: 'warning',
                background: "#c8a767",
                iconColor: '#a01822',
                html: "<span class='mu7 alert-error'>¿Deseas cerrar sesión?</span>",
                showCancelButton: true,
                confirmButtonColor: '#432c1d',
                cancelButtonColor: '#a01822',
                confirmButtonText: '<span class="mu7 btn-confirm">Sí</span>',
                cancelButtonText: "<span class='mu7 btn-confirm'>No</span>",
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "{{ url('/') }}";
                }
            });
        });

    });
</script>
