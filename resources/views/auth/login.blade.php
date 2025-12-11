<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <!-- Fuente elegante -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: "Outfit", sans-serif;
        }

        /* --- FONDO DE DOS DEGRADADOS --- */

        .bg-animated {
            /* Degradado principal: azul oscuro → azul pastel → blanco */
            background:
                linear-gradient(135deg,
                    #0A1326 0%,
                    #132A54 25%, 
                    #8BB3FF 65%,     /* azul pastel suave */
                    #F3F6FF 100%     /* blanco azulado */
                ),
                /* Degradado secundario: radial para profundidad */
                radial-gradient(
                    circle at 80% 20%,
                    rgba(150,180,255,0.35),
                    rgba(255,255,255,0) 70%
                );

            background-blend-mode: overlay;
            background-size: 300% 300%;
            animation: gradientMove 16s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
            100% { background-position: 0% 0%; }
        }

        /* Fade-in del card */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-card {
            animation: fadeIn 1.1s ease forwards;
        }

        /* Hover inputs */
        .input-anim:hover {
            background-color: rgba(255,255,255,0.18);
        }

        /* Hover card */
        .card-hover {
            transition: 0.4s ease;
        }

        .card-hover:hover {
            transform: scale(1.02);
            box-shadow: 0 0 35px rgba(200,220,255,0.25);
        }

        /* Botón con brillo */
        .btn-hover {
            position: relative;
            overflow: hidden;
        }

        .btn-hover::after {
            content: "";
            position: absolute;
            top: 0;
            left: -120%;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.3);
            transform: skewX(-20deg);
            transition: 0.6s;
        }

        .btn-hover:hover::after {
            left: 120%;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-animated">

    <div class="w-[490px] backdrop-blur-2xl bg-white/10 border border-white/20 
                shadow-2xl rounded-3xl px-12 py-10 animate-card card-hover">

        <!-- Icono tienda -->
        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 rounded-3xl bg-white/20 border border-white/30 
                        flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-white"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                        d="M3 3h2l3.6 7.59a1 1 0 00.92.59H17a1 1 0 00.96-.74l1.7-6.96H6" />
                    <circle cx="9" cy="19" r="1.5" />
                    <circle cx="17" cy="19" r="1.5" />
                </svg>
            </div>
        </div>

        <h2 class="text-center text-3xl font-semibold text-white">Inicia sesión</h2>
        <p class="text-center text-sm text-gray-200 mb-8">
            Acceso al sistema de inventario
        </p>

        <!-- Formulario -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label class="text-gray-200 text-sm font-medium">Email</label>
            <input type="email" name="email" required
                class="w-full mt-1 mb-5 px-4 py-3 rounded-xl bg-white/20 input-anim
                       border border-white/30 text-white placeholder-gray-300 
                       outline-none focus:border-blue-300 transition duration-200">

            <label class="text-gray-200 text-sm font-medium">Password</label>
            <input type="password" name="password" required
                class="w-full mt-1 mb-7 px-4 py-3 rounded-xl bg-white/20 input-anim
                       border border-white/30 text-white placeholder-gray-300 
                       outline-none focus:border-blue-300 transition duration-200">

            <!-- Botón nuevo -->
            <button type="submit"
                class="w-full py-3 mt-1 rounded-xl bg-blue-400 hover:bg-blue-500 
                       text-white font-semibold shadow-lg transition transform
                       hover:scale-[1.03] active:scale-[0.98] btn-hover">
                Entrar
            </button>
        </form>
    </div>

</body>
</h