@extends('layouts.app')

@section('content')
<section class="section" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header d-flex align-items-center justify-content-between bg-maroon text-black">
                        <a href="{{ url()->previous() }}" class="btn btn-back text-blsck" >
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        <h3 class="page__heading text-center flex-grow-1 m-0">
                            <i class="fas fa-user mr-2"></i> Editar Evaluado
                        </h3>
                    </div>
                    <div class="card-body p-4 bg-white">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                            @foreach ($errors->all() as $error)
                            <span class="badge badge-danger">{{ $error }}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <form action="{{ route('evaluados.update', $evaluado->id) }}" method="POST" class="my-4">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" value="{{ $evaluado->nombre }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="AP" class="form-label">Apellido Paterno</label>
                                        <input type="text" name="AP" class="form-control" value="{{ $evaluado->AP }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                                        <input type="text" name="AM" class="form-control" value="{{ $evaluado->AM }}" required>
                                    </div>
                                </div>

                        

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="CURP" class="form-label">CURP</label>
                                        <input type="text" name="CURP" class="form-control" value="{{ $evaluado->CURP }}" pattern="[A-Z0-9]{18}" title="La CURP debe tener 18 caracteres alfanuméricos" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="RFC" class="form-label">RFC</label>
                                        <input type="text" name="RFC" class="form-control" value="{{ $evaluado->RFC }}" pattern="[A-Z0-9]{12,13}" title="El RFC debe tener entre 12 y 13 caracteres alfanuméricos" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="CUIP" class="form-label">CUIP</label>
                                        <input type="text" name="CUIP" class="form-control" value="{{ $evaluado->CUIP }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="IFE" class="form-label">IFE</label>
                                        <input type="text" name="IFE" class="form-control" value="{{ $evaluado->IFE }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="SMN" class="form-label">SMN</label>
                                        <input type="text" name="SMN" class="form-control" value="{{ $evaluado->SMN }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fecha_apertura" class="form-label">Fecha de Apertura</label>
                                        <input type="date" name="fecha_apertura" class="form-control" value="{{ $evaluado->fecha_apertura }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select name="sexo" class="form-control" required>
                                        <option value="" disabled selected>Seleccione el sexo</option>
                                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                                    </select>                                                                      
                                    
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-block btn-submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('input[type="text"]').focus(function() {
            $(this).parent().addClass('active');
        }).blur(function() {
            if ($(this).val() === '') {
                $(this).parent().removeClass('active');
            }
        });

        $('#CURP').on('input', function(event) {
            var regex = /[^A-Z0-9]/g;
            var newValue = $(this).val().replace(regex, '').toUpperCase();
            if (newValue.length > 18) {
                newValue = newValue.substring(0, 18);
            }
            $(this).val(newValue);
        });

        $('#RFC').on('input', function(event) {
            var regex = /[^A-Z0-9]/g;
            var newValue = $(this).val().replace(regex, '').toUpperCase();
            if (newValue.length > 13) {
                newValue = newValue.substring(0, 13);
            }
            $(this).val(newValue);
        });
    });
</script>
@endsection

@section('styles')
<style>
    .bg-primary {
        background-color: #4b479c;
    }

    .form-label {
        font-weight: bold;
        color: #4b479c;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .form-control {
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 100%;
        box-sizing: border-box;
        transition: all 0.2s ease;
        font-size: 16px;
        background-color: #f9f9f9;
    }

    .form-control:focus {
        border-color: #4b479c;
        box-shadow: 0 0 8px rgba(75, 71, 156, 0.3);
        background-color: #fff;
    }

    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        padding: 20px;
        background-color: #4b479c;
        border-bottom: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .btn-back {
    /* Otros estilos */
    background-color: #ffffff; /* Fondo blanco */
    color: #800000; /* Texto rojo oscuro */
}

.btn-back:hover {
    background-color: #f0f0f0;
    color: #660000; /* Texto rojo más oscuro al pasar el mouse */
}


    .card-header .btn-back:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .card-header .page__heading {
        color: #ffffff;
    }

    .card-body {
        padding: 30px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-submit {
        transition: all 0.3s ease;
        background-color: #4b479c;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        background-color: #3a2c70;
    }

    .btn-submit:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(75, 71, 156, 0.3);
    }

    .section {
        padding: 60px 0;
        background-color: #e0e0eb;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .custom-container {
        max-width: 800px;
        margin: auto;
        border: 3px solid #4b479c;
        border-radius: 15px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .custom-container:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .custom-container {
            padding: 0 20px;
        }
    }
</style>
@endsection
