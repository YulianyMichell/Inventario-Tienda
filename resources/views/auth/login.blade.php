<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: "Outfit", sans-serif;
        }

        .bg-animated {
            background:
                linear-gradient(135deg,
                    #0A1326 0%,
                    #132A54 25%, 
                    #8BB3FF 65%,
                    #F3F6FF 100%
                ),
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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-card {
            animation: fadeIn 1.1s ease forwards;
        }

        .input-anim:hover {
            background-color: rgba(255,255,255,0.18);
        }

        .card-hover {
            transition: 0.4s ease;
        }

        .card-hover:hover {
            transform: scale(1.03);
            box-shadow: 0 0 40px rgba(200,220,255,0.32);
        }

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

    <!-- CARD MÁS GRANDE -->
    <div class="w-[550px] backdrop-blur-2xl bg-white/10 border border-white/20 
                shadow-2xl rounded-3xl px-14 py-12 animate-card card-hover">

        <!-- Icono tienda -->
        <div class="flex justify-center mb-7">
            <div class="w-24 h-24 rounded-3xl bg-white/25 border border-white/40 
                        flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-white"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                        d="M3 3h2l3.6 7.59a1 1 0 00.92.59H17a1 1 0 00.96-.74l1.7-6.96H6" />
                    <circle cx="9" cy="19" r="1.5" />
                    <circle cx="17" cy="19" r="1.5" />
                </svg>
            </div>
        </div>

        <!-- TEXTOS MÁS GRANDES Y LEGIBLES -->
        <h2 class="text-center text-4xl font-semibold text-white">Inicia sesión</h2>
        <p class="text-center text-md text-gray-100 mb-10">
            Acceso al sistema de inventario
        </p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label class="text-gray-100 text-lg font-medium">Email</label>
            <input type="email" name="email" required
                class="w-full mt-2 mb-6 px-4 py-4 rounded-xl bg-[#1E2A45]/60 input-anim
                       border border-white/30 text-white text-lg placeholder-gray-300 
                       outline-none focus:border-blue-300 transition duration-200">

            <label class="text-gray-100 text-lg font-medium">Password</label>
            <input type="password" name="password" required
                class="w-full mt-2 mb-8 px-4 py-4 rounded-xl bg-[#1E2A45]/60 input-anim
                       border border-white/30 text-white text-lg placeholder-gray-300 
                       outline-none focus:border-blue-300 transition duration-200">

            <!-- BOTÓN COLOR NUEVO (puedes cambiar bg-purple-500 por otro) -->
            <button type="submit"
                class="w-full py-4 mt-1 rounded-xl bg-purple-500 hover:bg-purple-600 
                       text-white text-lg font-semibold shadow-lg transition transform
                       hover:scale-[1.03] active:scale-[0.97] btn-hover">
                Entrar
            </button>
        </form>
    </div>

</body>
</html>
