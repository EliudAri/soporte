<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <style>
        body {
            background-color: #000;
            color: #fff;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .stars-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            pointer-events: none;
            z-index: 1;
        }
        .box-of-star1, .box-of-star2, .box-of-star3, .box-of-star4 {
            width: 100vw;
            height: 700px;
            position: absolute;
            left: 0; top: 0;
        }
        @keyframes snow { 0% { opacity: 0; transform: translateY(0px); } 20% { opacity: 1; } 100% { opacity: 1; transform: translateY(650px); } }
        .box-of-star1 { animation: snow 5s linear infinite; }
        .box-of-star2 { animation: snow 5s -1.64s linear infinite; }
        .box-of-star3 { animation: snow 5s -2.30s linear infinite; }
        .box-of-star4 { animation: snow 5s -3.30s linear infinite; }
        .star { width: 3px; height: 3px; border-radius: 50%; background-color: #FFF; position: absolute; opacity: 0.7; }
        .star-position1 { top: 30px; left: 5vw; }
        .star-position2 { top: 110px; left: 20vw; }
        .star-position3 { top: 60px; left: 45vw; }
        .star-position4 { top: 120px; left: 70vw; }
        .star-position5 { top: 20px; left: 85vw; }
        .star-position6 { top: 90px; left: 95vw; }
        .star-position7 { top: 30px; left: 98vw; }
        .main-404 {
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            width: 100vw;
        }
        .astronaut-container {
            position: relative;
            width: 250px;
            height: 300px;
            margin: 2rem 0 1.5rem 0;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: astronaut 5s linear infinite;
        }
        @keyframes astronaut { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .astronaut, .schoolbag, .head, .body, .panel, .arm, .leg {
            position: absolute;
        }
        .schoolbag { width: 100px; height: 150px; z-index: 1; top: 75px; left: 75px; background-color: #94b7ca; border-radius: 50px 50px 0 0 / 30px 30px 0 0; }
        .head { width: 97px; height: 80px; z-index: 3; background: -webkit-linear-gradient(left, #e3e8eb 0%, #e3e8eb 50%, #fbfdfa 50%, #fbfdfa 100%); border-radius: 50%; top: 34px; left: 76.5px; }
        .head:after { content: ""; width: 60px; height: 50px; position: absolute; top: 15px; left: 18.5px; background: -webkit-linear-gradient(top, #15aece 0%, #15aece 50%, #0391bf 50%, #0391bf 100%); border-radius: 15px; }
        .head:before { content: ""; width: 12px; height: 25px; position: absolute; top: 27.5px; left: -4px; background-color: #618095; border-radius: 5px; box-shadow: 92px 0px 0px #618095; }
        .body { width: 85px; height: 100px; z-index: 2; background-color: #fffbff; border-radius: 40px / 20px; top: 105px; left: 82px; background: -webkit-linear-gradient(left, #e3e8eb 0%, #e3e8eb 50%, #fbfdfa 50%, #fbfdfa 100%); }
        .panel { width: 60px; height: 40px; top: 20px; left: 12.5px; background-color: #b7cceb; }
        .panel:before { content: ""; width: 30px; height: 5px; position: absolute; top: 9px; left: 7px; background-color: #fbfdfa; box-shadow: 0px 9px 0px #fbfdfa, 0px 18px 0px #fbfdfa; }
        .panel:after { content: ""; width: 8px; height: 8px; position: absolute; top: 9px; right: 7px; background-color: #fbfdfa; border-radius: 50%; box-shadow: 0px 14px 0px 2px #fbfdfa; }
        .arm { width: 80px; height: 30px; top: 121px; z-index: 2; }
        .arm-left { left: 30px; background-color: #e3e8eb; border-radius: 0 0 0 39px; }
        .arm-right { right: 30px; background-color: #fbfdfa; border-radius: 0 0 39px 0; }
        .arm-left:before, .arm-right:before { content: ""; width: 30px; height: 70px; position: absolute; top: -40px; }
        .arm-left:before { border-radius: 50px 50px 0px 120px / 50px 50px 0 110px; left: 0; background-color: #e3e8eb; }
        .arm-right:before { border-radius: 50px 50px 120px 0 / 50px 50px 110px 0; right: 0; background-color: #fbfdfa; }
        .arm-left:after, .arm-right:after { content: ""; width: 30px; height: 10px; position: absolute; top: -24px; }
        .arm-left:after { background-color: #6e91a4; left: 0; }
        .arm-right:after { right: 0; background-color: #b6d2e0; }
        .leg { width: 30px; height: 40px; z-index: 2; bottom: 70px; }
        .leg-left { left: 76px; background-color: #e3e8eb; transform: rotate(20deg); }
        .leg-right { right: 73px; background-color: #fbfdfa; transform: rotate(-20deg); }
        .leg-left:before, .leg-right:before { content: ""; width: 50px; height: 25px; position: absolute; bottom: -26px; }
        .leg-left:before { left: -20px; background-color: #e3e8eb; border-radius: 30px 0 0 0; border-bottom: 10px solid #6d96ac; }
        .leg-right:before { right: -20px; background-color: #fbfdfa; border-radius: 0 30px 0 0; border-bottom: 10px solid #b0cfe4; }
        .btn-dashboard {
            display: inline-block;
            margin: 2.5rem auto 0 auto;
            padding: 0.8rem 2.2rem;
            background: linear-gradient(90deg, #6366f1 0%, #38bdf8 100%);
            color: #fff;
            border: none;
            border-radius: 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 2px 8px 0 #38bdf833;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
            text-decoration: none;
            z-index: 20;
        }
        .btn-dashboard:hover {
            background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%);
            transform: scale(1.04);
        }
        .footer-404 {
            position: fixed;
            bottom: 1.5rem;
            left: 0;
            width: 100vw;
            color: #b3b3b3;
            font-size: 0.95rem;
            z-index: 30;
            text-align: center;
        }
        @media (max-width: 600px) {
            .main-404 { min-height: 70vh; }
            .astronaut-container { width: 140px; height: 170px; margin: 1.2rem 0 1rem 0; }
            h1 { font-size: 2em; }
            p { font-size: 1em; }
            .btn-dashboard { font-size: 1em; padding: 0.7rem 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="stars-bg">
        <div class="box-of-star1">
            <div class="star star-position1"></div>
            <div class="star star-position2"></div>
            <div class="star star-position3"></div>
            <div class="star star-position4"></div>
            <div class="star star-position5"></div>
            <div class="star star-position6"></div>
            <div class="star star-position7"></div>
        </div>
        <div class="box-of-star2">
            <div class="star star-position1"></div>
            <div class="star star-position2"></div>
            <div class="star star-position3"></div>
            <div class="star star-position4"></div>
            <div class="star star-position5"></div>
            <div class="star star-position6"></div>
            <div class="star star-position7"></div>
        </div>
        <div class="box-of-star3">
            <div class="star star-position1"></div>
            <div class="star star-position2"></div>
            <div class="star star-position3"></div>
            <div class="star star-position4"></div>
            <div class="star star-position5"></div>
            <div class="star star-position6"></div>
            <div class="star star-position7"></div>
        </div>
        <div class="box-of-star4">
            <div class="star star-position1"></div>
            <div class="star star-position2"></div>
            <div class="star star-position3"></div>
            <div class="star star-position4"></div>
            <div class="star star-position5"></div>
            <div class="star star-position6"></div>
            <div class="star star-position7"></div>
        </div>
    </div>
    <div class="main-404">
        <h1>Error 404</h1>
        <p>Página no encontrada</p>
        <div class="astronaut-container">
            <div class="schoolbag"></div>
            <div class="head"></div>
            <div class="arm arm-left"></div>
            <div class="arm arm-right"></div>
            <div class="body">
                <div class="panel"></div>
            </div>
            <div class="leg leg-left"></div>
            <div class="leg leg-right"></div>
        </div>
        <a href="/dashboard" class="btn-dashboard" style="margin-top: 1.2rem;">Volver al inicio</a>
    </div>
    <div class="footer-404">Soporte Técnico FixView &copy; {{ date('Y') }}</div>
</body>
</html>
