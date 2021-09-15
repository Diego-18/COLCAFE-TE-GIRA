
<div class="modal fade" id="modalcc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content" style="background-color: #e32842">
            <div class="modal-header text-center">
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="text-center ">
                <h5 class="modal-title" id="exampleModalLabel">Ingrese numero de documento</h5>
            </div>
            <input type="text" class="form-control input-ced" aria-label="Small" aria-describedby="inputGroup-sizing-sm"
                id="cc_ingreso" title="Ingresa su cédula sin puntos" style=" ">
            <div class="modal-footer" style="border: none !important">
                <button type="button" class="btn btn-primary btn-ingresar" id="validar_cc">Ingresar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="alert_error_registro" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-c fondo-error-registro">
            <div class="modal-header mdal">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center text-center mdal">
                <br><br><br><br><br><br><br><br><br>
            </div>
        </div>
    </div>
</div>

<!-- ERROR -->
<div class="modal fade" id="modal_error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #e32842; border: 0">
            <div class="modal-header text-center"></div>
            <center>
                <img src="{{ asset('img/144ppi/alert_error.png') }}"
                    style="position: absolute; margin-left: -39%; margin-top: -31%; width: 80%;">
                <div class="text-center" style="margin-top: 5.5rem;">
                    <h5 class="modal-title" style="font-family: Letra1 !important; font-size:30px">Verifica que los
                        campos estén diligenciados correctamente</h5>
                    <br>
                </div>
            </center>
        </div>
    </div>
</div>


<div class="modal fade" id="modaldocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="padding: 160px;">
    <div class="modal-dialog modal-lg" role="document">

       
            <div class="shadow-lg p-3 mb-5 bg-white rounded ">
             
                <center>
                    
                    <img src="{{ asset('img/144ppi/alert_error.png') }}" style="width: 40%">
                    <div class="row justify-content-between text-left">
                      
                        <div class="form-group col-sm-4 flex-column d-flex"> <label
                                class="form-control-label px-3" >Producto</label>  <div id="producto_ver"></div> </div>
                        <div class="form-group col-sm-4 flex-column d-flex"> <label
                                class="form-control-label px-3">Cantidad</label> <div id="cantidad_ver"></div> </div>
                        <div class="form-group col-sm-4 flex-column d-flex"> <label
                                class="form-control-label px-3">Gramaje</label> <div id="gramaje_ver"></div></div>
                    </div>
                </center>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            
        </div>
    </div>
