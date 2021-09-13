@include('head')
@include('header')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right" >Numero de documento</label>
                                <div class="col-md-6">
                                    <input type="text" id="documento" class="form-control"  value="{{$cedula}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" >Tipo de documento</label>
                                <div class="col-md-6">
                                    <select id="tipo_documento"  class="form-control" value="0">
                                        <option value="0">Elige*</option>
                                        <option value="1">Cédula ciudadanía</option>
                                        <option value="2">Cédula venezolana</option>
                                        <option value="3">Cédula extranjería</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">Nombres</label>
                                <div class="col-md-6">
                                    <input type="text" id="nombres" class="form-control"  value="Christian Fernando">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">Apellidos</label>
                                <div class="col-md-6">
                                    <input type="text" id="apellidos" class="form-control"  value="Alvarez Bertel" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right" >Departamento</label>
                                <div class="col-md-6">
                                    <select id="departamento" class="form-control">
                                        <option>Seleccione una opción*</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right" >Ciudad</label>
                                <div class="col-md-6">
                                    <select id="ciudad" class="form-control">
                                        <option>Seleccione una opción*</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right" >Celular</label>
                                <div class="col-md-6">
                                    <input type="text" id="celular" class="form-control"  value="3234600627"  >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" >Telefono Adicional</label>
                                <div class="col-md-6">
                                    <input type="text" id="tel_adic" class="form-control"   value="5855908"  >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="documento" class="col-md-4 col-form-label text-md-right">Correo electronico</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control"    value="alvarescristian46@gmail.com" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="terminos" > Terminos
                                            <input type="checkbox" id="privacidad"> privacidad
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="registro_pers" >
                                    Registrar Persona
                                </button>
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('mecanica')
    @include('login')
    @include('footer')
    @include('validaciones')
</main>




