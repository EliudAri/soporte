<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
   
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <style>
            body {
                min-height: 100vh;
                background: linear-gradient(135deg, #e0e7ff 0%, #f0fdfa 100%);
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                margin: 0;
                display: flex;
                flex-direction: column;
            }
            .header {
                margin: 32px auto 0 auto;
                max-width: 700px;
                width: 95%;
                background: linear-gradient(90deg, #6366f1 0%, #38bdf8 100%);
                border-radius: 2rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0.5rem 2rem 0.5rem 1rem;
                box-shadow: 0 4px 24px 0 rgba(99,102,241,0.08);
            }
            .logo {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            .logo-circle {
                background: #fff;
                border-radius: 50%;
                width: 64px;
                height: 64px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 8px 0 rgba(99,102,241,0.10);
            }
            .logo-text {
                font-weight: 700;
                font-size: 1.3rem;
                color: #3730a3;
                letter-spacing: 1px;
            }
            .header-buttons {
                display: flex;
                gap: 1rem;
            }
            .header-buttons a {
                padding: 0.5rem 2rem;
                border-radius: 1.5rem;
                background: linear-gradient(90deg, #818cf8 0%, #38bdf8 100%);
                color: #fff;
                font-weight: 600;
                border: none;
                text-decoration: none;
                font-size: 1rem;
                box-shadow: 0 2px 8px 0 rgba(56,189,248,0.10);
                transition: background 0.2s, transform 0.2s;
            }
            .header-buttons a:hover {
                background: linear-gradient(90deg, #38bdf8 0%, #818cf8 100%);
                transform: translateY(-2px) scale(1.04);
            }
            .main-content {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .tracker-box {
                background: #f3f4f6cc;
                border-radius: 2rem;
                box-shadow: 0 4px 24px 0 rgba(99,102,241,0.08);
                padding: 3rem 2rem 2.5rem 2rem;
                max-width: 600px;
                width: 90%;
                margin: 2rem auto;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .tracker-box p {
                font-size: 1.15rem;
                color: #373737;
                margin-bottom: 2rem;
                text-align: center;
            }
            .tracker-input {
                width: 70%;
                max-width: 340px;
                padding: 0.8rem 1.2rem;
                border-radius: 1.5rem;
                border: none;
                background: #fff;
                box-shadow: 0 2px 8px 0 rgba(99,102,241,0.10);
                font-size: 1.1rem;
                text-align: center;
                outline: none;
                transition: box-shadow 0.2s;
            }
            .tracker-input:focus {
                box-shadow: 0 0 0 3px #818cf8aa;
            }
            .footer {
                width: 100%;
                background: linear-gradient(90deg,#6366f1 0%,#38bdf8 100%);
                color: #fff;
                text-align: center;
                padding: 0.8rem 0 0.7rem 0;
                font-size: 0.98rem;
                letter-spacing: 0.5px;
                border-bottom-left-radius: 1.5rem;
                border-bottom-right-radius: 1.5rem;
                box-shadow: 0 -2px 12px 0 #6366f133;
                margin-top: 2rem;
            }
            .footer span {
                opacity: 0.85;
            }
            @media (max-width: 600px) {
                .header { flex-direction: column; gap: 1rem; padding: 1rem; }
                .main-content { padding: 0 0.5rem; }
                .tracker-box { padding: 2rem 0.5rem; }
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="logo">
                <div class="logo-circle">
                    <img src="{{ asset('storage/img/Circle.png') }}" alt="Logo FixView" style="width:56px;height:56px;object-fit:contain;display:block;" />
                </div>
                <span class="logo-text">FixView</span>
            </div>
            <div class="header-buttons">
                <a href="{{ route('login') }}">Iniciar sesion</a>
                <a href="{{ route('register') }}">Registrarse</a>
            </div>
        </div>
        <div class="main-content">
            <div class="tracker-box" style="position:relative; overflow:hidden;">
                <!-- Icono decorativo -->
                <div style="position:absolute;top:-32px;left:-32px;width:80px;height:80px;background:linear-gradient(135deg,#818cf8 60%,#38bdf8 100%);border-radius:50%;opacity:0.18;z-index:0;"></div>
                <div style="position:absolute;bottom:-32px;right:-32px;width:100px;height:100px;background:linear-gradient(135deg,#38bdf8 60%,#818cf8 100%);border-radius:50%;opacity:0.13;z-index:0;"></div>
                <div style="position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;">
                    <div style="background:linear-gradient(135deg,#6366f1 60%,#38bdf8 100%);width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 16px 0 #6366f133;margin-bottom:1rem;">
                        <svg width="32" height="32" fill="none" viewBox="0 0 24 24"><rect width="24" height="24" rx="6" fill="#fff"/><path d="M7 17v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" stroke="#6366f1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="10" r="3" stroke="#6366f1" stroke-width="1.5"/></svg>
                    </div>
                    <p style="font-size:1.18rem;color:#373737;margin-bottom:1.2rem;text-align:center;font-weight:500;">¡Bienvenido! Ingresa el código de seguimiento de tu equipo para conocer el estado de tu reparación.<br><span style='font-size:0.98rem;color:#6366f1;'>¿Dudas? Contacta a nuestro equipo de soporte.</span></p>
                    <div style="width:100%;max-width:340px;display:flex;flex-direction:column;align-items:center;gap:1.2rem;">
                        <input class="tracker-input" type="text" placeholder="Código de seguimiento" style="transition:box-shadow 0.2s, border 0.2s;box-shadow:0 2px 8px 0 #6366f11a;border:2px solid #e0e7ff;" onfocus="this.style.boxShadow='0 0 0 3px #818cf8aa';this.style.borderColor='#6366f1'" onblur="this.style.boxShadow='0 2px 8px 0 #6366f11a';this.style.borderColor='#e0e7ff'" />
                        <button style="width:100%;padding:0.7rem 0;border-radius:1.5rem;background:linear-gradient(90deg,#6366f1 0%,#38bdf8 100%);color:#fff;font-weight:600;font-size:1.08rem;box-shadow:0 2px 8px 0 #6366f133;border:none;cursor:pointer;transition:background 0.2s,transform 0.2s;" onmouseover="this.style.background='linear-gradient(90deg,#38bdf8 0%,#6366f1 100%)';this.style.transform='scale(1.04)'" onmouseout="this.style.background='linear-gradient(90deg,#6366f1 0%,#38bdf8 100%)';this.style.transform='scale(1)'">Buscar código</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <span>&copy; {{ date('Y') }} FixView. Todos los derechos reservados.</span>
        </div>
    </body>
</html>
