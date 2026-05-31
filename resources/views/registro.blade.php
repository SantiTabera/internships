<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | InternConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; letter-spacing: -0.02em; }
        .bg-soft { background-color: #fcfcfd; }
        .input-focus:focus { border-color: #2b6df2; box-shadow: 0 0 0 4px rgba(43,109,242,0.1); }
        .role-active { color: #2b6df2 !important; font-weight: 700; border-bottom-color: #2b6df2 !important; }
        
        /* Clases de validación explícitas en tiempo real */
        .error-input { border-color: #ef4444 !important; background-color: #fef2f2 !important; }
        .success-input { border-color: #10b981 !important; background-color: #f0fdf4 !important; }
        .success-input:focus { box-shadow: 0 0 0 4px rgba(16,185,129,0.1) !important; border-color: #10b981 !important; }

        .req-item { transition: all 0.2s ease; }
        
        /* Animaciones de transición */
        .fade-in { animation: fadeIn 0.4s ease forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-soft min-h-screen flex items-center justify-center p-4 py-12">

    <div id="step-selector" class="w-full max-w-[800px] fade-in">
        <div class="flex justify-center mb-6">
            <a href="{{ route('index') }}" class="flex items-center gap-2 group text-gray-400 hover:text-black transition-colors text-xs font-bold uppercase tracking-wider">
                <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-0.5"></i> Volver al inicio
            </a>
        </div>

        <div class="text-center mb-10">
            <div class="flex items-center justify-center gap-2 group mb-4">
                <div class="w-10 h-10 bg-black rounded-xl flex items-center justify-center shadow-lg">
                    <i data-lucide="layers" class="text-white w-6 h-6"></i>
                </div>
                <span class="text-2xl font-bold tracking-tight text-black">InternConnect</span>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Bienvenido, ¿cómo deseas unirte?</h1>
            <p class="text-gray-500 text-sm mt-1">Selecciona tu perfil de usuario para configurar tu cuenta.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4">
            <button onclick="selectInitialRole('student')" class="group text-left bg-white p-8 rounded-[2rem] border border-gray-200 shadow-[0_15px_30px_rgba(0,0,0,0.02)] hover:border-[#2b6df2] hover:shadow-[0_20px_40px_rgba(43,109,242,0.06)] transition-all duration-300 flex flex-col justify-between h-[260px]">
                <div class="w-14 h-14 bg-blue-50 text-[#2b6df2] rounded-2xl flex items-center justify-center transition-colors group-hover:bg-[#2b6df2] group-hover:text-white duration-300">
                    <i data-lucide="graduation-cap" class="w-7 h-7"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1 flex items-center gap-2">
                        Soy Estudiante 
                        <i data-lucide="arrow-right" class="w-4 h-4 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all text-[#2b6df2]"></i>
                    </h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">Busco pasantías, convenios institucionales y mi primera experiencia laboral en Bolivia.</p>
                </div>
            </button>

            <button onclick="selectInitialRole('company')" class="group text-left bg-white p-8 rounded-[2rem] border border-gray-200 shadow-[0_15px_30px_rgba(0,0,0,0.02)] hover:border-[#2b6df2] hover:shadow-[0_20px_40px_rgba(43,109,242,0.06)] transition-all duration-300 flex flex-col justify-between h-[260px]">
                <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-[#2b6df2] group-hover:text-white duration-300">
                    <i data-lucide="building-2" class="w-7 h-7"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1 flex items-center gap-2">
                        Soy Empresa / Reclutador
                        <i data-lucide="arrow-right" class="w-4 h-4 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all text-[#2b6df2]"></i>
                    </h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">Quiero publicar vacantes, gestionar postulantes y firmar convenios con universidades.</p>
                </div>
            </button>
        </div>
    </div>

    <main id="form-container" class="w-full max-w-[700px] hidden fade-in">
        <div class="flex justify-center mb-10">
            <button onclick="backToSelector()" class="flex items-center gap-2 group text-gray-400 hover:text-black transition-colors text-xs font-bold uppercase tracking-wider">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Volver a selección
            </button>
        </div>

        <section class="bg-white rounded-[2rem] border border-gray-200 shadow-[0_20px_50px_rgba(0,0,0,0.04)] overflow-hidden">
            
            <div class="flex border-b border-gray-100 bg-gray-50/50">
                <button type="button" onclick="setRole('student')" id="tab-student" class="flex-1 py-5 text-sm font-medium text-gray-400 border-b-2 border-transparent role-active transition-all">
                    Estudiante
                </button>
                <button type="button" onclick="setRole('company')" id="tab-company" class="flex-1 py-5 text-sm font-medium text-gray-400 border-b-2 border-transparent transition-all">
                    Empresa
                </button>
            </div>

            <div class="p-8 md:p-12">
                <form id="reg-form" class="space-y-8" method="POST" action="{{ route('register.student') }}" onsubmit="return validateFinal(event)">
                    @csrf
                    <input type="hidden" id="selected-role" name="selected_role" value="student">
                    
                    <div id="form-header">
                        <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Crea tu cuenta personal</h1>
                        <p class="text-gray-500 text-sm">Completa tus datos para empezar.</p>
                    </div>

                    <div id="dynamic-content" class="space-y-6"></div>

                    <div class="pt-8 border-t border-gray-100 space-y-6">
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Correo Electrónico</label>
                            <div class="relative">
                                <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                                <input type="email" name="correo" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all" placeholder="usuario@ejemplo.com">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Contraseña</label>
                                <div class="relative">
                                    <input type="password" id="pass" name="contrasena" required class="w-full pl-4 pr-11 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all" placeholder="Escribe tu contraseña" oninput="checkPasswordStrength(this.value)">
                                    <button type="button" onclick="togglePassword('pass', 'eye-icon-1')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none">
                                        <i id="eye-icon-1" data-lucide="eye" class="w-5 h-5"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Confirmar</label>
                                <div class="relative">
                                    <input type="password" id="confirm_pass" name="contrasena_confirmation" required class="w-full pl-4 pr-11 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all" placeholder="Repite contraseña" oninput="checkPasswordMatch()">
                                    <button type="button" onclick="togglePassword('confirm_pass', 'eye-icon-2')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none">
                                        <i id="eye-icon-2" data-lucide="eye" class="w-5 h-5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-500">Seguridad de la contraseña:</span>
                                <span id="strength-label" class="text-xs font-bold text-gray-400 transition-colors duration-200">Vacía</span>
                            </div>
                            <div class="grid grid-cols-4 gap-1.5">
                                <div id="bar-1" class="h-1.5 rounded-full bg-gray-200 transition-all duration-300"></div>
                                <div id="bar-2" class="h-1.5 rounded-full bg-gray-200 transition-all duration-300"></div>
                                <div id="bar-3" class="h-1.5 rounded-full bg-gray-200 transition-all duration-300"></div>
                                <div id="bar-4" class="h-1.5 rounded-full bg-gray-200 transition-all duration-300"></div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1 text-xs">
                                <div id="req-length" class="req-item flex items-center gap-2 text-gray-400 font-medium">
                                    <span id="ico-length" class="flex items-center text-gray-300"><i data-lucide="circle" class="w-3.5 h-3.5 stroke-[3]"></i></span> Mínimo 8 caracteres
                                </div>
                                <div id="req-number" class="req-item flex items-center gap-2 text-gray-400 font-medium">
                                    <span id="ico-number" class="flex items-center text-gray-300"><i data-lucide="circle" class="w-3.5 h-3.5 stroke-[3]"></i></span> Al menos un número (0-9)
                                </div>
                                <div id="req-upper" class="req-item flex items-center gap-2 text-gray-400 font-medium">
                                    <span id="ico-upper" class="flex items-center text-gray-300"><i data-lucide="circle" class="w-3.5 h-3.5 stroke-[3]"></i></span> Una letra mayúscula
                                </div>
                                <div id="req-special" class="req-item flex items-center gap-2 text-gray-400 font-medium">
                                    <span id="ico-special" class="flex items-center text-gray-300"><i data-lucide="circle" class="w-3.5 h-3.5 stroke-[3]"></i></span> Un carácter especial (@$!%*?&)
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-black text-white py-4.5 rounded-2xl font-bold text-sm hover:bg-gray-800 shadow-xl shadow-black/10 transition-all mt-4">
                        Finalizar Registro
                    </button>
                </form>
            </div>
        </section>
    </main>

    <script>
        const oldRole = document.body.dataset.oldRole || 'student';
        const oldStudent = JSON.parse(document.body.dataset.oldStudent || '{}');
        let currentRole = oldRole;

        function initIcons() {
            lucide.createIcons();
        }
        window.addEventListener('DOMContentLoaded', () => {
            initIcons();
            selectInitialRole(oldRole);
        });

        // CONTROL DE FLUJO ENTRE VISTAS
        function selectInitialRole(role) {
            document.getElementById('step-selector').classList.add('hidden');
            document.getElementById('form-container').classList.remove('hidden');
            setRole(role);
        }

        function backToSelector() {
            document.getElementById('form-container').classList.add('hidden');
            document.getElementById('step-selector').classList.remove('hidden');
        }

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }

        function onlyLetters(input) {
            input.value = input.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ ]/g, '');
        }

        function checkCellInput(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
            if (input.value.length > 8) input.value = input.value.slice(0, 8);

            if (input.value.length === 8) {
                input.className = "w-full px-4 py-3.5 rounded-xl border outline-none text-sm font-medium transition-all success-input";
            } else {
                input.className = "w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all";
            }
        }

        function checkPasswordStrength(password) {
            const passInput = document.getElementById('pass');
            const label = document.getElementById('strength-label');
            const bars = [document.getElementById('bar-1'), document.getElementById('bar-2'), document.getElementById('bar-3'), document.getElementById('bar-4')];

            const hasLength = password.length >= 8;
            const hasNumber = /[0-9]/.test(password);
            const hasUpper = /[A-Z]/.test(password);
            const hasSpecial = /[@$!%*?&]/.test(password);

            updateRequirementState('req-length', 'ico-length', hasLength);
            updateRequirementState('req-number', 'ico-number', hasNumber);
            updateRequirementState('req-upper', 'ico-upper', hasUpper);
            updateRequirementState('req-special', 'ico-special', hasSpecial);

            let passedCount = 0;
            if (hasLength) passedCount++;
            if (hasNumber) passedCount++;
            if (hasUpper) passedCount++;
            if (hasSpecial) passedCount++;

            bars.forEach(bar => bar.className = 'h-1.5 rounded-full bg-gray-200 transition-all duration-300');

            if (passedCount === 4) {
                passInput.className = "w-full pl-4 pr-11 py-3.5 rounded-xl border outline-none text-sm font-medium transition-all success-input";
            } else {
                passInput.className = "w-full pl-4 pr-11 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all";
            }

            if (password.length === 0) {
                label.innerText = "Vacía";
                label.className = "text-xs font-bold text-gray-400";
                checkPasswordMatch();
                return;
            }

            if (passedCount === 1) {
                label.innerText = "Débil ❌";
                label.className = "text-xs font-bold text-red-500";
                bars[0].className = 'h-1.5 rounded-full bg-red-500 transition-all duration-300';
            } else if (passedCount === 2) {
                label.innerText = "Media ⚠️";
                label.className = "text-xs font-bold text-amber-500";
                bars[0].className = 'h-1.5 rounded-full bg-amber-500 transition-all duration-300';
                bars[1].className = 'h-1.5 rounded-full bg-amber-500 transition-all duration-300';
            } else if (passedCount === 3) {
                label.innerText = "Buena 👍";
                label.className = "text-xs font-bold text-blue-500";
                bars[0].className = 'h-1.5 rounded-full bg-blue-500 transition-all duration-300';
                bars[1].className = 'h-1.5 rounded-full bg-blue-500 transition-all duration-300';
                bars[2].className = 'h-1.5 rounded-full bg-blue-500 transition-all duration-300';
            } else if (passedCount === 4) {
                label.innerText = "Excelente / Segura 💪";
                label.className = "text-xs font-bold text-emerald-500";
                bars.forEach(bar => bar.className = 'h-1.5 rounded-full bg-emerald-500 transition-all duration-300');
            }

            checkPasswordMatch();
        }

        function updateRequirementState(rowId, iconWrapperId, isValid) {
            const row = document.getElementById(rowId);
            const wrapper = document.getElementById(iconWrapperId);
            
            if (isValid) {
                row.className = "req-item flex items-center gap-2 text-emerald-600 font-bold scale-[1.01]";
                wrapper.className = "flex items-center text-emerald-500";
                wrapper.innerHTML = `<i data-lucide="check-circle-2" class="w-3.5 h-3.5 stroke-[3]"></i>`;
            } else {
                row.className = "req-item flex items-center gap-2 text-gray-400 font-medium";
                wrapper.className = "flex items-center text-gray-300";
                wrapper.innerHTML = `<i data-lucide="circle" class="w-3.5 h-3.5 stroke-[3]"></i>`;
            }
            lucide.createIcons();
        }

        function checkPasswordMatch() {
            const pass = document.getElementById('pass').value;
            const confirmInput = document.getElementById('confirm_pass');
            const confirmValue = confirmInput.value;

            const isMainSecure = pass.length >= 8 && /[0-9]/.test(pass) && /[A-Z]/.test(pass) && /[@$!%*?&]/.test(pass);

            if (confirmValue.length === 0) {
                confirmInput.className = "w-full pl-4 pr-11 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all";
                return;
            }

            if (pass === confirmValue && isMainSecure) {
                confirmInput.className = "w-full pl-4 pr-11 py-3.5 rounded-xl border outline-none text-sm font-medium transition-all success-input";
            } else {
                confirmInput.className = "w-full pl-4 pr-11 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all";
            }
        }

        function setRole(role) {
            currentRole = role;
            const form = document.getElementById('reg-form');
            const selectedRole = document.getElementById('selected-role');
            const studentBtn = document.getElementById('tab-student');
            const companyBtn = document.getElementById('tab-company');
            const content = document.getElementById('dynamic-content');
            const header = document.getElementById('form-header');
            selectedRole.value = role;
            form.action = role === 'student' ? "{{ route('register.student') }}" : "{{ route('register.company') }}";

            if (role === 'student') {
                studentBtn.classList.add('role-active');
                companyBtn.classList.remove('role-active');
                header.innerHTML = `<h1 class="text-2xl font-extrabold text-gray-900 mb-1 tracking-tight">Registro de Estudiante</h1><p class="text-gray-500 text-sm">Tu futuro profesional comienza aquí.</p>`;
                content.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nombres</label>
                            <input type="text" name="nombre" id="student-nombres" required oninput="onlyLetters(this)" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="Ej. Ana María">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Apellido paterno</label>
                            <input type="text" name="apellido_paterno" id="student-apellido-paterno" required oninput="onlyLetters(this)" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="Ej. López">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Apellido materno</label>
                            <input type="text" name="apellido_materno" id="student-apellido-materno" required oninput="onlyLetters(this)" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="Ej. García">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Universidad</label>
                            <input type="text" name="universidad" required oninput="onlyLetters(this)" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="Ej. UMSA">
                        </div>
                        <div class="md:col-span-2 space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Carrera</label>
                            <input type="text" name="carrera" required oninput="onlyLetters(this)" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="Ej. Ingeniería de Sistemas">
                        </div>
                    </div>`;
            } else {
                companyBtn.classList.add('role-active');
                studentBtn.classList.remove('role-active');
                header.innerHTML = `<h1 class="text-2xl font-extrabold text-gray-900 mb-1 tracking-tight">Registro de Empresa</h1><p class="text-gray-500 text-sm">Encuentra el talento que tu equipo necesita.</p>`;
                content.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nombres</label>
                            <input type="text" name="nombre" id="company-nombres" required oninput="onlyLetters(this)" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="Ej. Laura Elena">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Apellido paterno</label>
                            <input type="text" name="apellido_paterno" id="company-apellido-paterno" required oninput="onlyLetters(this)" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="Ej. Pérez">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Apellido materno</label>
                            <input type="text" name="apellido_materno" id="company-apellido-materno" required oninput="onlyLetters(this)" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="Ej. López">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nombre de la empresa</label>
                            <input type="text" name="nombre_empresa" required class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="Ej. Tech Corp S.R.L.">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Industria</label>
                            <input type="text" name="industria" required oninput="onlyLetters(this)" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="Ej. Tecnología">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Sitio web</label>
                            <input type="url" name="sitio_web" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" placeholder="https://empresa.com.bo">
                        </div>
                    </div>`;
            }
            lucide.createIcons();
        }

        function validateFinal(e) {
            const pass = document.getElementById('pass');
            const confirm = document.getElementById('confirm_pass');
            let isValid = true;

            const pwd = pass.value;
            const isSecure = pwd.length >= 8 && /[0-9]/.test(pwd) && /[A-Z]/.test(pwd) && /[@$!%*?&]/.test(pwd);
            if (!isSecure) {
                pass.classList.add('error-input');
                isValid = false;
            }

            if (pass.value !== confirm.value) {
                confirm.classList.add('error-input');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                alert("Por favor, asegúrate de que todos los campos y contraseñas cumplan con los requisitos marcados en verde.");
            }
            return isValid;
        }
    </script>
</body>
</html>

