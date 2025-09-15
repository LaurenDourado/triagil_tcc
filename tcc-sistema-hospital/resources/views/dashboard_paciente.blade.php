<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Paciente - TriÁgil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html { 
            margin: 0; 
            padding: 0; 
            font-family: 'Unbounded', sans-serif; 
            height: 100%; 
        }

        .container-dashboard { 
            background: url("{{ asset('imagens/sala.jpg') }}") no-repeat center center; 
            background-size: cover; 
            height: 100vh; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
        }

        .logo-container {
            margin-bottom: 30px;
        }

        .logo-container img {
            width: 90px;
            height: auto;
        }

        .card-container {
            background-color: #13678A;
            border-radius: 30px;
            padding: 30px;
            text-align: center;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.4);
            width: 90%;
            max-width: 600px;
            position: relative;
        }

        .btn-option { 
            color: white; 
            font-weight: bold; 
            padding: 15px 30px; 
            margin: 15px 0; 
            border-radius: 30px; 
            font-size: 1.2rem; 
            text-decoration: none; 
            transition: 0.3s; 
            display: block;
        }

        .btn-pre-triagem {
            background-color: #322172;
        }
        .btn-pre-triagem:hover { 
            background-color: #24175d; 
        }

        .btn-guia-socorros {
            background-color: #6CD0B1;
        }
        .btn-guia-socorros:hover { 
            background-color: #55B594; 
        }

        .btn-resultado {
            background-color: #ffc107; /* Amarelo para destaque */
            color: #000;
        }
        .btn-resultado:hover {
            background-color: #e0ac05;
            color: #000;
        }

        .logout-link { 
            color: #7CDA77;
            font-size: 1rem;
            align-items: center;
            justify-content: center;
            margin-top: -10px;
            padding: 8px 20px;
            text-decoration:underline;
            transition: 0.3s; 
        }

        .alert-success { 
            position: absolute; 
            top: 20px; 
            left: 50%; 
            transform: translateX(-50%); 
            z-index: 1000; 
            width: 90%; 
            max-width: 500px;
        }

        @media (max-width: 768px) {
            .card-container {
                padding: 20px;
            }

            .btn-option {
                font-size: 1rem;
                padding: 12px 25px;
            }

            .logout-link {
                font-size: 0.8rem;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
<div class="container-dashboard">
    @if(session('success'))
        <div class="alert alert-success text-center w-50">{{ session('success') }}</div>
    @endif

    <div class="card-container">

        <div class="logo-container">
            <img src="{{ asset('imagens/Monograma.png') }}" alt="Logo TriÁgil" />
        </div>

        <!-- Botões principais -->
        <a href="{{ route('formulario.pre-triagem') }}" class="btn-option btn-pre-triagem w-100">Formulário Pré-Triagem</a>
        <a href="{{ route('guia.primeiro-socorros') }}" class="btn-option btn-guia-socorros w-100">Guia de Primeiro Socorros</a>

        <!-- Botão para ver o código -->
        <a href="{{ route('resultado.prioridade', ['codigo' => Auth::guard('paciente')->user()->preTriagem->codigo ?? '']) }}" class="btn-option btn-resultado w-100">Ver Código e Resultado</a>

        <!-- Link "Sair" -->
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ url('/identificacao') }}" class="logout-link">Voltar</a>
        </div>
        
    </div>
</div>
</body>
</html>
