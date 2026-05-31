<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | InternConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Importar Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .form-input {
            @apply w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2b6df2] focus:ring-2 focus:ring-[#2b6df2]/20 outline-none transition-all bg-gray-50/50;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-reveal { animation: slideUp 0.6s ease-out forwards; }

        /* Estilos para la animación del logo */
        .logo-container:hover .logo-icon {
            transform: rotate(12deg) scale(1.1);
            background-color: #2b6df2;
        }
        .logo-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-white text-[#1a1a1a]">

    <!-- NAVBAR -->
    <header class="flex justify-between items-center py-4 px-[8%] bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <!-- NUEVO LOGO ANIMADO -->
        <a href="index" class="flex items-center gap-2.5 group logo-container cursor-pointer">
            <div class="w-10 h-10 bg-[#0d121f] rounded-xl flex items-center justify-center logo-icon shadow-sm">
                <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-tighter text-[#0d121f]">InternConnect</span>
        </a>
        
        <nav class="hidden md:flex items-center gap-6">
            <a href="index" class="text-[#666] font-medium hover:text-[#2b6df2] transition">Home</a>
            <a href="login" class="px-5 py-2.5 border border-[#ddd] rounded-xl text-[#1a1a1a] font-medium hover:bg-gray-50 transition">Login</a>
            <a href="registro" class="px-6 py-2.5 bg-[#0d121f] text-white rounded-xl font-semibold hover:bg-slate-800 transition shadow-md active:scale-95">Registro</a>
        </nav>
    </header>

    <!-- CONTACT CONTAINER -->
    <section class="max-w-7xl mx-auto px-[8%] py-16 lg:py-24 flex flex-col lg:flex-row items-center gap-16">
        
        <!-- CONTACT INFO -->
        <div class="flex-1 space-y-8 animate-reveal">
            <span class="inline-block px-4 py-1 bg-blue-50 text-[#2b6df2] rounded-full text-sm font-bold tracking-wide border border-blue-100">
                Estamos aquí para ayudarte
            </span>
            <h1 class="text-4xl md:text-6xl font-bold text-[#0d1b2a] leading-tight">
                Ponte en <span class="text-[#2b6df2]">contacto</span> con nosotros
            </h1>
            <p class="text-lg text-[#666] leading-relaxed max-w-lg">
                ¿Tienes dudas sobre cómo publicar una vacante o cómo mejorar tu perfil? Nuestro equipo te responderá en menos de 24 horas.
            </p>
            
            <div class="space-y-6 pt-4">
               

                <!-- Email -->
                <div class="flex items-center gap-5 group cursor-pointer">
                    <div class="w-12 h-12 bg-[#f8faff] rounded-2xl flex items-center justify-center border border-gray-100 group-hover:bg-[#2b6df2] group-hover:border-[#2b6df2] transition-all duration-300 shadow-sm">
                        <i data-lucide="mail" class="w-6 h-6 text-[#2b6df2] group-hover:text-white transition-colors"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#1a1a1a]">Email</h4>
                        <p class="text-[#666]">soporte@internconnect.com</p>
                    </div>
                </div>

                <!-- Teléfono -->
                <div class="flex items-center gap-5 group cursor-pointer">
                    <div class="w-12 h-12 bg-[#f8faff] rounded-2xl flex items-center justify-center border border-gray-100 group-hover:bg-[#2b6df2] group-hover:border-[#2b6df2] transition-all duration-300 shadow-sm">
                        <i data-lucide="phone" class="w-6 h-6 text-[#2b6df2] group-hover:text-white transition-colors"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#1a1a1a]">Teléfono</h4>
                        <p class="text-[#666]">(+59169917044)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTACT FORM CARD -->
        <div class="flex-1 w-full max-w-lg bg-white p-8 md:p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100 animate-reveal" style="animation-delay: 0.2s;">
            <form id="contact-form" action="#" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Nombre completo</label>
                    <input id="contact-name" type="text" placeholder="Ej. Santiago Tabera" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2b6df2] focus:ring-4 focus:ring-blue-50 outline-none transition-all bg-gray-50/50">
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Correo electrónico</label>
                    <input id="contact-email" type="email" placeholder="santiagotb@.com" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2b6df2] focus:ring-4 focus:ring-blue-50 outline-none transition-all bg-gray-50/50">
                </div>

                <div class="space-y-2 relative">
                    <label class="text-sm font-bold text-gray-700 ml-1">Asunto</label>
                    <select id="contact-asunto" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2b6df2] focus:ring-4 focus:ring-blue-50 outline-none transition-all bg-gray-50/50 appearance-none cursor-pointer text-[#666]">
                        <option>Soporte Técnico</option>
                        <option>Ventas / Empresas</option>
                        <option>Duda de Estudiante</option>
                        <option>Otro</option>
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-4 top-[42px] w-5 h-5 text-gray-400 pointer-events-none"></i>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Mensaje</label>
                    <textarea id="contact-message" rows="4" placeholder="¿En qué podemos ayudarte?" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2b6df2] focus:ring-4 focus:ring-blue-50 outline-none transition-all bg-gray-50/50 resize-none"></textarea>
                </div>

                <button type="submit" class="w-full bg-[#0d121f] text-white py-4 rounded-xl font-bold hover:bg-[#2b6df2] hover:shadow-xl hover:shadow-blue-200 transition-all active:scale-95 flex items-center justify-center gap-2 group">
                    Enviar Mensaje
                    <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                </button>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#0d121f] text-white pt-20 pb-10 px-[8%]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 border-b border-[#222] pb-16">
            <div class="footer-brand space-y-4">
                <!-- NUEVO LOGO EN EL FOOTER -->
                <a href="index" class="flex items-center gap-2.5 group logo-container cursor-pointer">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center logo-icon border border-white/10">
                        <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tighter text-white">InternConnect</span>
                </a>
                <p class="text-[#888] leading-relaxed text-sm max-w-[280px]">Conectando estudiantes y empresas para experiencias de pasantía significativas.</p>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest text-[#2b6df2]">Para Estudiantes</h4>
                <nav class="flex flex-col gap-4 text-sm text-[#888]">
                    <a href="explora" class="hover:text-white transition">Explorar Pasantías</a>
                    <a href="comofunciona" class="hover:text-white transition">Cómo Funciona</a>
                </nav>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest text-[#2b6df2]">Para Empresas</h4>
                <nav class="flex flex-col gap-4 text-sm text-[#888]">
                    <a href="login" class="hover:text-white transition">Publicar Oportunidades</a>
                    <a href="login" class="hover:text-white transition">Encontrar Talento</a>
                </nav>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest text-[#2b6df2]">Compañía</h4>
                <nav class="flex flex-col gap-4 text-sm text-[#888]">
                    <a href="sobrenosotros" class="hover:text-white transition">Sobre Nosotros</a>
                    <a href="contacto" class="hover:text-white transition font-medium text-white">Contacto</a>
                    <a href="privacidad" class="hover:text-white transition">Política de Privacidad</a>
                </nav>
            </div>
        </div>
        <div class="text-center pt-10 text-[#555] text-xs uppercase tracking-[0.2em]">
            © 2026 InternConnect. Todos los derechos reservados.
        </div>
    </footer>

    <!-- Inicializar Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
    <script>
        (function(){
            const form = document.getElementById('contact-form');
            if (!form) return;
            form.addEventListener('submit', function(e){
                e.preventDefault();
                // Use browser validation first
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
                const name = document.getElementById('contact-name')?.value.trim() || '';
                const email = document.getElementById('contact-email')?.value.trim() || '';
                const asunto = document.getElementById('contact-asunto')?.value || '';
                const message = document.getElementById('contact-message')?.value.trim() || '';
                const phone = '59169917044';
                const text = `Hola, soy ${name}${email ? ' ('+email+')' : ''}. Asunto: ${asunto}. Mensaje: ${message}`;
                const url = 'https://wa.me/' + phone + '?text=' + encodeURIComponent(text);
                window.location.href = url;
            });
        })();
    </script>
</body>
</html>