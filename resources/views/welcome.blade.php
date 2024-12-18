<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evalus - Sistema de Autenticación</title>
    <style>
        :root {
            --color-guinda: #9D2449;
            --color-white: #ffffff;
            --color-error: #dc3545;
            --color-success: #28a745;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        body {
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 1000px;
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(157, 36, 73, 0.15);
            background: white;
            animation: fadeIn 0.5s ease-out;
        }

        .header {
            background-color: var(--color-guinda);
            padding: 4rem 3rem;
            width: 45%;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            animation: slideIn 0.5s ease-out;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 50h-25v-25h25z' fill='rgba(255,255,255,0.05)'/%3E%3C/svg%3E");
            opacity: 0.3;
        }

        .logo-text {
            font-size: 5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .header h1 {
            font-size: 1.8rem;
            margin: 1rem 0;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .form-container {
            padding: 4rem;
            width: 55%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            animation: fadeIn 0.5s ease-out;
        }

        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.8rem;
            font-weight: 500;
            color: #333;
            font-size: 1rem;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #eee;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f8f8f8;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--color-guinda);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(157, 36, 73, 0.1);
        }

        .invalid-feedback {
            color: var(--color-error);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: block;
            animation: fadeIn 0.3s ease-out;
        }

        .btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--color-guinda);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            display: block;
            text-decoration: none;
        }

        .btn:hover {
            filter: brightness(110%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(157, 36, 73, 0.2);
        }

        .btn-secondary {
            background-color: #6c757d;
            margin-top: 1rem;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin: 1rem 0;
        }

        .form-check input {
            width: auto;
            margin-right: 0.5rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            animation: fadeIn 0.3s ease-out;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            max-width: 500px;
            width: 90%;
            animation: fadeIn 0.3s ease-out;
        }

        .instructions {
            text-align: center;
            margin-bottom: 2rem;
            line-height: 1.6;
            color: #666;
        }

        .link {
            color: var(--color-guinda);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .link:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                max-width: 400px;
            }
            
            .header, .form-container {
                width: 100%;
                padding: 2rem;
            }
            
            .logo-text {
                font-size: 3rem;
            }
            
            .header h1 {
                font-size: 1.5rem;
            }
        }

        .password-container {
    position: relative;
    display: flex;
    align-items: center;
}

.password-container input {
    padding-right: 45px; /* Espacio para el botón */
}

.password-toggle {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.password-toggle:hover {
    opacity: 0.7;
}

.eye-icon {
    font-size: 1.2rem;
    line-height: 1;
    color: #666;
    transition: all 0.3s ease;
}

/* Asegurarse que el botón no tenga outline al hacer focus */
.password-toggle:focus {
    outline: none;
}

/* Estilo para cuando el password es visible */
.password-toggle.active .eye-icon {
    color: var(--color-guinda);
}
    </style>
</head>
<body>
    <!-- Contenedor Principal -->
    <div class="auth-container" id="mainContainer">
        <div class="header">
            <div class="logo-text">Evalus</div>
            <h1>Centro de Evaluación</h1>
            <p>Gobierno del Estado</p>
        </div>
        
        <div class="form-container">
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" 
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           value="{{ old('email', Cookie::get('email')) }}"
                           placeholder="Ingrese su correo electrónico" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" 
                               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               placeholder="Ingrese su contraseña" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password', 'eyeIcon')">
                            <span id="eyeIcon" class="eye-icon">👁️</span>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" 
                           {{ old('remember', Cookie::get('remember')) ? 'checked' : '' }}>
                    <label for="remember">Recordar mis datos</label>
                </div>

                <button type="submit" class="btn">
                    Iniciar Sesión
                </button>

                <a href="#" class="link" style="display: block; text-align: center; margin-top: 1rem;"
                   onclick="showRecoveryModal()">
                    ¿Olvidaste tu contraseña?
                </a>
            </form>
        </div>
    </div>

    <!-- Modal de Recuperación de Contraseña -->
    <div class="modal" id="recoveryModal">
        <div class="modal-content">
            <div class="instructions">
                <h2 style="color: var(--color-guinda); margin-bottom: 1rem;">Recuperación de Contraseña</h2>
                <p>Ingresa tu correo electrónico y te enviaremos las instrucciones para restablecer tu contraseña.</p>
            </div>

            <form method="POST" action="{{ route('password.email') }}" id="recoveryForm">
                @csrf
                <div class="form-group">
                    <label for="recovery_email">Correo Electrónico</label>
                    <input type="email" id="recovery_email" name="email" required
                           placeholder="Ingrese su correo electrónico">
                </div>

                <button type="submit" class="btn">
                    Enviar Instrucciones
                </button>

                <button type="button" class="btn btn-secondary" onclick="hideRecoveryModal()">
                    Cancelar
                </button>
            </form>
        </div>
    </div>

    <script>
        // Validación del formulario de login
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            let isValid = true;
            const email = document.getElementById('email');
            const password = document.getElementById('password');

            // Validación de email
            if (!email.value || !email.value.includes('@')) {
                showError(email, 'Por favor ingrese un correo electrónico válido');
                isValid = false;
            } else {
                clearError(email);
            }

            // Validación de contraseña
            if (!password.value || password.value.length < 6) {
                showError(password, 'La contraseña debe tener al menos 6 caracteres');
                isValid = false;
            } else {
                clearError(password);
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Validación del formulario de recuperación
        document.getElementById('recoveryForm').addEventListener('submit', function(e) {
            const email = document.getElementById('recovery_email');
            
            if (!email.value || !email.value.includes('@')) {
                e.preventDefault();
                showError(email, 'Por favor ingrese un correo electrónico válido');
            } else {
                clearError(email);
            }
        });

        function showError(input, message) {
            input.classList.add('is-invalid');
            let feedback = input.nextElementSibling;
            if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                feedback = document.createElement('span');
                feedback.className = 'invalid-feedback';
                input.parentNode.insertBefore(feedback, input.nextSibling);
            }
            feedback.textContent = message;
        }

        function clearError(input) {
            input.classList.remove('is-invalid');
            const feedback = input.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.remove();
            }
        }

        function showRecoveryModal() {
            document.getElementById('recoveryModal').style.display = 'flex';
        }

        function hideRecoveryModal() {
            document.getElementById('recoveryModal').style.display = 'none';
        }

        // Cerrar modal al hacer clic fuera de él
        window.onclick = function(event) {
            const modal = document.getElementById('recoveryModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }


          // Expresión regular para validar email
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    
    // Expresión regular para validar contraseña
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

   // Reemplaza las validaciones existentes con estas más simples
document.getElementById('loginForm').addEventListener('submit', function(e) {
    let isValid = true;
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    // Validación del email
    if (!email.value || !email.value.includes('@')) {
        showError(email, 'Por favor ingrese un correo electrónico válido');
        isValid = false;
    } else {
        clearError(email);
    }

    // Validación simple de la contraseña
    if (!password.value) {
        showError(password, 'La contraseña es requerida');
        isValid = false;
    } else {
        clearError(password);
    }

    if (!isValid) {
        e.preventDefault();
    }
});

// Quitar la validación en tiempo real de la contraseña
document.getElementById('password').addEventListener('input', function(e) {
    const password = e.target;
    if (!password.value) {
        showError(password, 'La contraseña es requerida');
    } else {
        clearError(password);
    }
});

// Mantener la validación en tiempo real del email
document.getElementById('email').addEventListener('input', function(e) {
    const email = e.target;
    if (!email.value) {
        showError(email, 'El correo electrónico es requerido');
    } else if (!email.value.includes('@')) {
        showError(email, 'Por favor ingrese un correo electrónico válido');
    } else {
        clearError(email);
    }
});

    // Validación del formulario de recuperación
    document.getElementById('recoveryForm').addEventListener('submit', function(e) {
        const email = document.getElementById('recovery_email');
        
        if (!email.value) {
            e.preventDefault();
            showError(email, 'El correo electrónico es requerido');
        } else if (!emailRegex.test(email.value)) {
            e.preventDefault();
            showError(email, 'Por favor ingrese un correo electrónico válido (ejemplo: usuario@dominio.com)');
        } else {
            clearError(email);
        }
    });

    // Funciones auxiliares
    function showError(input, message) {
        input.classList.add('is-invalid');
        input.style.borderColor = '#dc3545';
        
        let feedback = input.nextElementSibling;
        if (!feedback || !feedback.classList.contains('invalid-feedback')) {
            feedback = document.createElement('span');
            feedback.className = 'invalid-feedback';
            input.parentNode.insertBefore(feedback, input.nextSibling);
        }
        feedback.textContent = message;
        feedback.style.display = 'block';
    }

    function clearError(input) {
        input.classList.remove('is-invalid');
        input.style.borderColor = '';
        const feedback = input.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.style.display = 'none';
        }
    }

    // Funciones del modal
    function showRecoveryModal() {
        document.getElementById('recoveryModal').style.display = 'flex';
    }

    function hideRecoveryModal() {
        document.getElementById('recoveryModal').style.display = 'none';
    }

    // Cerrar modal al hacer clic fuera
    window.onclick = function(event) {
        const modal = document.getElementById('recoveryModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }


    function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(iconId);
    const button = eyeIcon.parentElement;

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.textContent = '🔓';
        button.classList.add('active');
    } else {
        passwordInput.type = 'password';
        eyeIcon.textContent = '👁️';
        button.classList.remove('active');
    }
}

// También agregarlo en el modal de recuperación si es necesario
document.addEventListener('DOMContentLoaded', function() {
    // Prevenir que el botón de mostrar contraseña envíe el formulario
    const toggleButtons = document.querySelectorAll('.password-toggle');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
        });
    });
});
    </script>
</body>
</html>