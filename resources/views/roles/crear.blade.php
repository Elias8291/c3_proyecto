@extends('layouts.app')

@section('content')
<section class="section" style="background-color: #e0e0eb; min-height: 100vh; display: flex; align-items: center;">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header d-flex align-items-center justify-content-between bg-primary text-white">
                        <a href="{{ url()->previous() }}" class="btn btn-back text-white">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        <h3 class="page__heading text-center flex-grow-1 m-0">
                            <i class="fas fa-book mr-2"></i> Crear Roles
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

                        <!-- Formulario para crear roles -->
                        {!! Form::open(['route' => 'roles.store', 'method' => 'POST', 'class' => 'my-4']) !!}
                        
                        <!-- Nombre del rol -->
                        <div class="form-group floating-label">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Rol', 'required']) !!}
                            <label for="name">Nombre del Rol</label>
                        </div>

                        <!-- Descripción del rol -->
                        <div class="form-group floating-label">
                            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Descripción del Rol', 'required']) !!}
                            <label for="description">Descripción del Rol</label>
                        </div>

                        <!-- Permisos -->
                        <div class="form-group">
                            <label for="permission" class="form-label">Permisos para este Rol:</label>
                            <br/>
                            @foreach($permission as $value)
                            <div class="form-check">
                                <label class="form-check-label">
                                    {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'form-check-input']) }}
                                    {{ $value->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <!-- Estado activo/inactivo -->
                        <div class="form-group">
                            <label for="status" class="form-label">Estado del Rol:</label>
                            <select name="status" class="form-control select2">
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                            </select>
                        </div>

                        <!-- Botón de envío -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block btn-submit">Guardar</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Agrega la clase 'active' cuando un campo de entrada está enfocado
    $('input').focus(function() {
        $(this).parent().addClass('active');
    }).blur(function() {
        if ($(this).val() === '') {
            $(this).parent().removeClass('active');
        }
    });
</script>
@endsection

@section('styles')
<style>
    /* Estilos personalizados para los campos y el diseño */
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

    .btn-submit {
        background-color: #4b479c;
        color: #fff;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 18px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        background-color: #3a2c70;
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
        border-radius: 15px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
