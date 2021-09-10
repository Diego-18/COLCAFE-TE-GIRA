@include('head')
@include('header')


<div class="cotainer">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registro de empaques</div>
                <div class="card-body">
                      
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" >Ingresa el Gramaje</label>
                            <div class="col-md-6">
                                <select id="gramaje" class="form-control" value="0">
                                    <option value="0">Elige*</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" >Ingresa el Producto</label>
                            <div class="col-md-6">
                                <select id="producto" class="form-control" value="0">
                                    <option value="0">Elige*</option>
                                    <option value="1">Colcafé 3 en 1</option>
                                    <option value="2">Colcafé 2 en 1</option>
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">Gramos registrados</label>
                            <div class="col-md-6">
                                <input type="text" id="gramos" class="form-control"  value="100" >
                            </div>
                        </div>
                     
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" id="registro_emp" >
                                Guardar
                            </button>
    
                        </div>
                      
                </div>
                
            </div>
        </div>
    </div>
</div>

@include('login')
@include('footer')
@include('validaciones')
