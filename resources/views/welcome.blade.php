<<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registro - Sistema de Alumnos</title>
        <!-- Tailwind CSS -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- FontAwesome for icons -->
        <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
        <script src="{{ asset('js/sweetalert2.js') }}"></script>

        <style>
            body,
            html {
            font-family: 'Nunito', sans-serif;
            height: 100%;
            margin: 0;
            background: linear-gradient(to bottom right, rgba(114, 114, 114, 0.8), rgba(36, 35, 35, 0.349)),
            url('{{ asset('img/1img.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            background-attachment: fixed;
            /* Esto asegura que el fondo sea fijo */
            display: flex;
            justify-content: center;
            align-items: center;
        }

            .hover:transform {
                transition: transform .2s ease-in-out;
            }

            .text-accent {
                color: #76B041;
                /* Verde del logotipo */
            }

            .card:hover {
                box-shadow: 0 5px 15px rgba(163, 23, 23, 0.3);
                transform: translateY(-5px);
            }

            .animate {
                animation: fadeIn 1s ease-in-out;
            }

            @keyframes fadeIn {
                0% {
                    opacity: 0;
                    transform: translateY(20px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate {
                animation: fadeInUp 1.2s ease-in-out;
            }

            .animate-glow {
                animation: glowEffect 1.5s ease-in-out forwards;
            }

            @keyframes glowEffect {
                0% {
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                    transform: translateY(20px);
                    opacity: 0;
                }

                100% {
                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .hover\:shadow-3xl:hover {
                box-shadow: 0 30px 60px rgba(0, 0, 0, 0.7);
            }

            .hover\:scale-105:hover {
                transform: scale(1.05);
            }


            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 10;
                display: none;
                justify-content: center;
                align-items: center;
            }

            .login-container,
            .register-container {
                max-width: 400px;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                padding: 20px;
                animation: scaleIn .3s ease-in-out;
            }

            .login-title,
            .register-title {
                font-size: 24px;
                font-weight: bold;
                color: #000000;
                text-align: center;
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-control {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                outline: none;
            }

            .form-control:focus {
                border-color: #850707;
            }

            .btn-primary {
                background-color: #9C3D55;
                color: #ffffff;
                padding: 12px 20px;
                border-radius: 25px;
                transition: background-color 0.3s ease;
            }

            .btn-primary:hover {
                background-color: #663a4b;
            }

            .btn-secondary {
                background-color: #0072bc;
                color: #ffffff;
                padding: 12px 20px;
                border-radius: 25px;
                transition: background-color 0.3s ease;
            }

            .btn-secondary:hover {
                background-color: #005a96;
            }

            @keyframes scaleIn {
                from {
                    transform: scale(0.8);
                    opacity: 0;
                }

                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            .btn-primary:hover,
            .btn-secondary:hover {
                transform: scale(1.05);
            }

            .background-animate {
                animation: move-background 10s infinite linear;
            }

            /* 
@keyframes move-background {
    0% {
        background-position: 0% 0%;
    }
    100% {
        background-position: 100% 100%;
    }
}
*/

            @keyframes glow {

                0%,
                100% {
                    box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
                }

                50% {
                    box-shadow: 0 0 40px rgba(255, 255, 255, 0.6);
                }
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-15px);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes textGlow {

                0%,
                100% {
                    text-shadow: 0 0 8px rgba(255, 255, 255, 0.6);
                }

                50% {
                    text-shadow: 0 0 25px rgba(255, 255, 255, 1);
                }
            }

            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.6;
                }
            }

            /* Añadimos cubic-bezier para más suavidad */
            .animate-glow {
                animation: glow 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            .animate-fade-in {
                animation: fadeIn 1.5s ease-out;
            }

            .animate-fade-in-up {
                animation: fadeInUp 1.5s ease-out;
            }
        </style>
    </head>

    <body class="background-animate">
        <div
            class="max-w-4xl mx-auto bg-gradient-to-br from-gray-200 via-gray-300 to-gray-400 rounded-3xl shadow-2xl p-12 flex items-center justify-center animate-glow hover:shadow-3xl hover:scale-105 transform transition duration-700 ease-in-out">

            <div class="mr-8 hidden md:block flex justify-center items-center animate-float">
                <img src="{{ asset('img/PD1.png') }}" alt="Descripción de la imagen"
                    style="width: 900px; height: auto; border: 0; box-shadow: none;" class="rounded-lg">
            </div>
            <div
                class="card w-full md:w-4/5 lg:w-3/4 md:px-12 text-center bg-gray-900 text-white rounded-lg shadow-lg p-12 animate-fade-in">
                <h1 class="text-5xl font-extrabold mb-8 animate-text-glow" style="color:#F0F0F0;">
                    BIENVENIDO AL PORTAL DEL C3
                </h1>

                <p class="text-lg text-gray-300 mb-12 animate-fade-in-up">Página web de gestión de documentos del Centro
                    Estatal de Evaluación y Control de Oaxaca.</p>

                <div class="mb-4 flex justify-center">
                    <a href="#"
                        class="inline-block bg-black text-white font-semibold rounded-full py-4 px-8 hover:bg-gray-800 transition-all duration-300 transform hover:scale-105"
                        onclick="showLoginForm()">Iniciar sesión</a>
                </div>
            </div>

        </div>


        </div>


        <!-- Overlay -->
        <div class="overlay" id="overlay" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="login-container bg-gray-100 text-gray-800 p-8 rounded-lg shadow-xl">
                <div class="login-title text-3xl font-bold mb-6 text-gray-900">Inicio de Sesión</div>
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="text-gray-700">Correo Electrónico</label>
                        <input id="email" type="email"
                            class="form-control bg-gray-200 text-gray-900 border-gray-300 focus:border-blue-400 focus:ring-blue-400{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" placeholder="Ingresa tu correo" tabindex="1"
                            value="{{ old('email', Cookie::get('email')) }}" autofocus required>
                        @if ($errors->has('email'))
                        <div class="invalid-feedback text-red-500">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group mt-4">
                        <label for="password" class="control-label text-gray-700">Contraseña</label>
                        <a href="#" class="text-blue-500 hover:text-blue-700"
                            onclick="event.preventDefault(); showPasswordResetForm();">¿Olvidaste tu contraseña?</a>
                        <input id="password" type="password" placeholder="Ingresa tu contraseña"
                            class="form-control bg-gray-200 text-gray-900 border-gray-300 focus:border-blue-400 focus:ring-blue-400{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            name="password" tabindex="2" required>
                        @if ($errors->has('password'))
                        <div class="invalid-feedback text-red-500">
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember"
                                class="form-checkbox h-5 w-5 text-blue-600" {{ old('remember', Cookie::get('remember'))
                                ? 'checked' : '' }}>
                            <label for="remember" class="ml-2 text-gray-700">Recuérdame</label>
                        </div>
                    </div>
                    <div class="form-group mt-6">
                        <button type="submit"
                            class="btn bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 w-full rounded transition duration-300"
                            tabindex="4">
                            Iniciar Sesión
                        </button>
                        <button type="button"
                            class="btn bg-gray-400 hover:bg-gray-500 text-white font-semibold py-3 px-6 w-full rounded mt-3 transition duration-300"
                            onclick="hideLoginForm()">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Overlay para recuperar contraseña -->
        <div class="overlay fixed inset-0 z-50 flex items-center justify-center" id="passwordResetOverlay"
            style="background-color: rgba(0, 0, 0, 0.6); display: none;">
            <div class="bg-gray-100 text-gray-800 rounded-lg shadow-lg p-8 w-full max-w-md">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Recuperar Contraseña</h2>
                    <p class="text-gray-600">Ingresa tu correo electrónico para recibir instrucciones para restablecer
                        tu contraseña.</p>
                </div>
                <form id="passwordResetForm" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="text-gray-700">Correo Electrónico</label>
                        <input id="email" type="email"
                            class="form-control bg-gray-200 text-gray-900 border-gray-300 focus:border-blue-400 focus:ring-blue-400"
                            name="email" placeholder="Ingresa tu correo" required>
                    </div>
                    <div class="form-group text-center mt-6">
                        <button type="submit"
                            class="btn bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 w-full rounded transition duration-300">
                            Enviar Solicitud
                        </button>
                        <button type="button"
                            class="btn bg-gray-400 hover:bg-gray-500 text-white font-semibold py-3 px-6 w-full rounded mt-3 transition duration-300"
                            onclick="hidePasswordResetForm()">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="overlay-blur fixed inset-0 bg-black bg-opacity-50 hidden" id="overlayBlur"></div>

        <script>
            function showLoginForm() {
            var overlay = document.getElementById('overlay');
            overlay.style.display = 'flex';
            hideBackgroundBlur();
        }

        function hideLoginForm() {
            var overlay = document.getElementById('overlay');
            overlay.style.display = 'none';
            hideBackgroundBlur();
        }

        function showPasswordResetForm() {
            var overlay = document.getElementById('overlay');
            overlay.style.display = 'none';
            var passwordResetOverlay = document.getElementById('passwordResetOverlay');
            passwordResetOverlay.style.display = 'flex';
            showBackgroundBlur();
        }

        function hidePasswordResetForm() {
            var passwordResetOverlay = document.getElementById('passwordResetOverlay');
            passwordResetOverlay.style.display = 'none';
            hideBackgroundBlur();
        }

        function showBackgroundBlur() {
            var overlayBlur = document.getElementById('overlayBlur');
            overlayBlur.style.display = 'block';
        }

        function hideBackgroundBlur() {
            var overlayBlur = document.getElementById('overlayBlur');
            overlayBlur.style.display = 'none';
        }

        </script>
    </body>

    </html>